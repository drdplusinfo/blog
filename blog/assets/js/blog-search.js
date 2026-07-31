/**
 * In-browser full-text search over /search-index.json.
 *
 * Czech readers type without diacritics ("draci" for "dračí"), so both the
 * index and the query are folded to bare ASCII before matching.
 */
(function () {
    'use strict';

    var SEARCH_INDEX_URL = '/search-index.json';
    var MAX_RESULTS = 12;
    var SNIPPET_RADIUS = 70;
    var RELEVANCE_RATIO = 0.25;

    var searchInput = document.getElementById('search-query');
    var searchForm = document.getElementById('blog-search-form');
    if (searchInput === null || searchForm === null) {
        return;
    }

    var resultsPanel = document.createElement('div');
    resultsPanel.id = 'search-results';
    resultsPanel.setAttribute('role', 'listbox');
    resultsPanel.hidden = true;
    searchForm.appendChild(resultsPanel);

    var posts = null;
    var indexRequested = false;
    var highlightedIndex = -1;

    /**
     * Search is insensitive to case, diacritics and every non-alphanumeric
     * character, so "Foo-Bar" is reachable by "obar". Separators are dropped
     * rather than collapsed to spaces, which is what lets a query span the
     * boundary between two words.
     *
     * Snippets still have to quote the readable original, so alongside the
     * stripped haystack we keep sourceOffsets: for each stripped character,
     * its index in the original string.
     */
    function normalize(text) {
        var lowered = text.toLowerCase().normalize('NFD');
        var stripped = '';
        var sourceOffsets = [];
        var sourceIndex = 0;
        var originalIndex = 0;

        while (sourceIndex < lowered.length) {
            var character = lowered.charAt(sourceIndex);
            var isCombiningMark = character >= '\u0300' && character <= '\u036f';

            if (!isCombiningMark) {
                if (/[a-z0-9]/.test(character)) {
                    stripped += character;
                    sourceOffsets.push(originalIndex);
                }
                originalIndex += 1;
            }
            sourceIndex += 1;
        }

        return { text: stripped, sourceOffsets: sourceOffsets };
    }

    function loadIndex() {
        if (indexRequested) {
            return;
        }
        indexRequested = true;

        fetch(SEARCH_INDEX_URL)
            .then(function (response) {
                if (!response.ok) {
                    throw new Error('Search index responded ' + response.status);
                }
                return response.json();
            })
            .then(function (loadedPosts) {
                posts = loadedPosts.map(function (post) {
                    return {
                        title: post.t,
                        url: post.u,
                        date: post.d,
                        perex: post.p,
                        body: post.b,
                        normalizedTitle: normalize(post.t),
                        normalizedPerex: normalize(post.p),
                        normalizedBody: normalize(post.b)
                    };
                });
                if (searchInput.value.trim() !== '') {
                    renderResults(search(searchInput.value));
                }
            })
            .catch(function (error) {
                console.error('Blog search unavailable:', error);
                renderMessage('Vyhledávání se nepodařilo načíst.');
            });
    }

    /**
     * Substring matching alone ranks "Neboj" as high as "Boj" for the query
     * "boj", so a term sitting on word boundaries scores extra. The stripped
     * haystack has no separators left, so the boundary test reads the original
     * text through sourceOffsets.
     */
    function isWholeWord(field, term, position) {
        var startsWord = position === 0
            || field.sourceOffsets[position] - field.sourceOffsets[position - 1] > 1;

        var endIndex = position + term.length - 1;
        var endsWord = endIndex === field.text.length - 1
            || field.sourceOffsets[endIndex + 1] - field.sourceOffsets[endIndex] > 1;

        return startsWord && endsWord;
    }

    function scoreField(field, term, weight) {
        var position = field.text.indexOf(term);
        if (position === -1) {
            return 0;
        }

        return isWholeWord(field, term, position) ? weight * 2 : weight;
    }

    /**
     * Every term must appear somewhere in the post, so extra words narrow the
     * result set instead of widening it. Title hits outrank perex, perex hits
     * outrank body.
     */
    function search(rawQuery) {
        if (posts === null) {
            return null;
        }

        var terms = rawQuery.split(/\s+/).map(function (word) {
            return normalize(word).text;
        }).filter(function (term) {
            return term !== '';
        });
        if (terms.length === 0) {
            return [];
        }

        var matches = [];
        posts.forEach(function (post) {
            var score = 0;
            var everyTermFound = terms.every(function (term) {
                var termScore = scoreField(post.normalizedTitle, term, 10)
                    + scoreField(post.normalizedPerex, term, 4)
                    + scoreField(post.normalizedBody, term, 1);

                score += termScore;

                return termScore > 0;
            });

            if (everyTermFound) {
                matches.push({ post: post, score: score, firstTerm: terms[0] });
            }
        });

        matches.sort(function (left, right) {
            return right.score - left.score;
        });

        /*
         * Ignoring separators turns every query into a substring match over the
         * whole corpus, so a short term like "boj" also hits "proboj" and even
         * spans joined words. Those land far below a genuine match, so anything
         * well under the best score is dropped rather than padding the list.
         */
        if (matches.length === 0) {
            return matches;
        }

        var bestScore = matches[0].score;
        var relevant = matches.filter(function (match) {
            return match.score >= bestScore * RELEVANCE_RATIO;
        });

        return relevant.slice(0, MAX_RESULTS);
    }

    function buildSnippet(post, term) {
        var inPerex = post.normalizedPerex.text.indexOf(term) !== -1;
        var original = inPerex ? post.perex : post.body;
        var field = inPerex ? post.normalizedPerex : post.normalizedBody;

        var position = field.text.indexOf(term);
        if (position === -1) {
            return post.perex.slice(0, SNIPPET_RADIUS * 2);
        }

        var matchStart = field.sourceOffsets[position];
        var matchEnd = field.sourceOffsets[position + term.length - 1] + 1;

        var start = Math.max(0, matchStart - SNIPPET_RADIUS);
        var end = Math.min(original.length, matchEnd + SNIPPET_RADIUS);

        return (start > 0 ? '…' : '')
            + original.slice(start, end)
            + (end < original.length ? '…' : '');
    }

    function renderMessage(message) {
        resultsPanel.textContent = '';
        var note = document.createElement('p');
        note.className = 'search-note';
        note.textContent = message;
        resultsPanel.appendChild(note);
        resultsPanel.hidden = false;
    }

    function renderResults(matches) {
        highlightedIndex = -1;

        if (matches === null) {
            renderMessage('Načítám…');
            return;
        }
        if (matches.length === 0) {
            renderMessage('Nic jsme nenašli.');
            return;
        }

        resultsPanel.textContent = '';
        matches.forEach(function (match) {
            var link = document.createElement('a');
            link.className = 'search-result';
            link.href = match.post.url;
            link.setAttribute('role', 'option');

            var title = document.createElement('span');
            title.className = 'search-result-title';
            title.textContent = match.post.title;
            link.appendChild(title);

            var date = document.createElement('span');
            date.className = 'search-result-date';
            date.textContent = match.post.date;
            link.appendChild(date);

            var snippetText = buildSnippet(match.post, match.firstTerm);
            if (snippetText !== '') {
                var snippet = document.createElement('span');
                snippet.className = 'search-result-snippet';
                snippet.textContent = snippetText;
                link.appendChild(snippet);
            }

            resultsPanel.appendChild(link);
        });
        resultsPanel.hidden = false;
    }

    function closeResults() {
        resultsPanel.hidden = true;
        highlightedIndex = -1;
    }

    function moveHighlight(offset) {
        var links = resultsPanel.querySelectorAll('.search-result');
        if (links.length === 0) {
            return;
        }

        if (highlightedIndex !== -1) {
            links[highlightedIndex].classList.remove('highlighted');
        }
        highlightedIndex = (highlightedIndex + offset + links.length) % links.length;
        links[highlightedIndex].classList.add('highlighted');
        links[highlightedIndex].scrollIntoView({ block: 'nearest' });
    }

    searchInput.addEventListener('focus', loadIndex);
    searchInput.addEventListener('input', function () {
        loadIndex();
        var query = searchInput.value.trim();
        if (query === '') {
            closeResults();
            return;
        }
        renderResults(search(query));
    });

    searchInput.addEventListener('keydown', function (event) {
        if (event.key === 'ArrowDown') {
            event.preventDefault();
            moveHighlight(1);
        } else if (event.key === 'ArrowUp') {
            event.preventDefault();
            moveHighlight(-1);
        } else if (event.key === 'Enter') {
            if (highlightedIndex !== -1) {
                event.preventDefault();
                resultsPanel.querySelectorAll('.search-result')[highlightedIndex].click();
            }
        } else if (event.key === 'Escape') {
            closeResults();
            searchInput.blur();
        }
    });

    searchForm.addEventListener('submit', function (event) {
        event.preventDefault();
        var links = resultsPanel.querySelectorAll('.search-result');
        if (links.length > 0) {
            links[highlightedIndex === -1 ? 0 : highlightedIndex].click();
        }
    });

    document.addEventListener('click', function (event) {
        if (!searchForm.contains(event.target)) {
            closeResults();
        }
    });
}());
