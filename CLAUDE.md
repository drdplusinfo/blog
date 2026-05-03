# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

Static site for [blog.draciodkaz.cz](https://blog.draciodkaz.cz), a Czech-language blog about the Dračí doupě / DrD+ tabletop RPG. Built with **Hugo** (static site generator). Content is in Czech.

The repo was previously a PHP/Statie/Twig project; the legacy code (Statie config, Twig templates under `blog/source/`, composer/npm tooling, PHPUnit tests, the PHP-FPM Dockerfile, etc.) has been removed. If a piece of legacy infrastructure is still referenced somewhere and isn't used, it can be deleted.

## Run locally

```sh
docker compose up
```

Serves on http://localhost:1313 via the `hugomods/hugo:exts-0.140.2` container (see `compose.yml`). Hugo watches `blog/content/`, `blog/layouts/`, `blog/static/`, and `blog/data/` and rebuilds automatically. Drafts and future-dated posts are included by the dev server (`--buildDrafts --buildFuture`).

There is no test suite, lint, or build script for the Hugo site. Verify changes by reloading the dev server in a browser.

## Hugo site layout

All Hugo files live under `blog/`:

- `blog/hugo.toml` — site config. Notable: `[permalinks] blog = "/blog/:year/:month/:day/:slug/"` preserves the legacy Statie URL shape so old links keep working. Czech default language, RSS at `/rss.xml`.
- `blog/content/blog/<year>/<MM-DD-slug>/index.md` — one directory per post (page bundle). Front matter uses `date`, `slug`, `title`, `perex` (lead paragraph), `image`, optional `facebook_image`, `image_author`, and `deprecated_since` (posts with `deprecated_since` set are hidden from listings).
- `blog/layouts/` — Go templates. `_default/baseof.html` is the shell; `blog/list.html` and `blog/single.html` render the section and individual posts; `index.html` is the homepage; `partials/` holds head, menu, footer, and `post-metadata-line.html`.
- `blog/static/` — assets copied verbatim to site root. Includes Bootstrap 4, Font Awesome 5, Prism, gifplayer, custom CSS in `assets/css/`, and `assets/images/`.
- `blog/archetypes/` and `blog/data/` — currently empty; available if needed.

The homepage (`layouts/index.html`) shows the most recent post as a featured card and the rest as a year-grouped list. Listings filter out posts whose `deprecated_since` front-matter is set.

## Adding a post

Create `blog/content/blog/<year>/<MM-DD-slug>/index.md`:

```yaml
---
date: 2026-03-04
slug: novy-clanek
title: "Nadpis článku"
image: /assets/images/posts/some_image.png
perex: |
    Krátký úvodní text.
---

Tělo článku v Markdownu.
```

Served at `/blog/2026/03/04/novy-clanek/` (the date in the URL comes from `date:`, not the directory name).

## Conventions

- Content language is Czech — keep titles, perex, and prose in Czech unless explicitly told otherwise.
- Permalinks must remain `/blog/YYYY/MM/DD/slug/` so existing inbound links don't break.
- The site uses `markup.goldmark.renderer.unsafe = true`, so raw HTML in posts is allowed.
