(() => {
    const hash = window.location.hash
    if (!hash) {
        return
    }

    const postMatches = hash.match(/^#[!]clanky[/](?<post>.+)$/)
    if (!postMatches) {
        return
    }
    const post = postMatches.groups.post

    const partsMatches = post.match(/^(?<year>\d{4})-(?<month>\d{2})-(?<day>\d{2})-(?<name>.+)[.]md$/)
    if (!partsMatches) {
        return
    }
    const year = partsMatches.groups.year
    const month = partsMatches.groups.month
    const day = partsMatches.groups.day
    const name = partsMatches.groups.name
    const url = `/blog/${year}/${month}/${day}/${name}`

    window.location.replace(url)
})();