# [blog.DračíOdkaz.cz](https://blog.draciodkaz.cz)

**Powered by [Hugo](https://gohugo.io/)**

## Run locally

```sh
docker compose up
```

Then open [http://localhost:1313](http://localhost:1313).

The Hugo dev server watches for changes in `blog/content/`, `blog/layouts/`,
`blog/static/`, and `blog/data/` and rebuilds automatically.

## Add a post

Create a directory under `blog/content/blog/<year>/` with the date prefix and
a slug, e.g. `blog/content/blog/2026/03-04-novy-clanek/`. Inside, put an
`index.md` with YAML front matter:

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

The post will be served at `/blog/2026/03/04/novy-clanek/`.
