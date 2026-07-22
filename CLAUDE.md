# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

Static site for [blog.draciodkaz.cz](https://blog.draciodkaz.cz), a Czech-language blog about the Dračí doupě / DrD+ tabletop RPG. Built with **Hugo** (static site generator). Content is in Czech.

Presentation (templates, CSS, JS, vendored front-end libraries) is NOT in this repo — it comes from the `blog-classic` module of [drdplusinfo/md-publisher](https://github.com/drdplusinfo/md-publisher), mounted as the git submodule `md-publisher/` and wired via `theme = ["blog-classic"]` + `themesDir = "../md-publisher/modules"` in `blog/hugo.toml`. This repo keeps only content, images, site config, and deployment. Look-and-feel changes belong in md-publisher; site texts (menu, footer, RSS metadata, 404) are `[params]` in `blog/hugo.toml`.

## Run locally

```sh
git submodule update --init   # once, after clone
docker compose up
```

Serves on http://localhost:1313 via the `hugomods/hugo` container (see `compose.yml`; the repo root is mounted so the submodule is visible, Hugo runs from `blog/`). Hugo watches content, static files and the module templates and rebuilds automatically. Drafts and future-dated posts are included by the dev server (`--buildDrafts --buildFuture`).

There is no test suite, lint, or build script. Verify changes by reloading the dev server in a browser.

## Repo layout

- `md-publisher/` — git submodule with the `blog-classic` module (layouts, CSS/JS pipeline assets, Bootstrap/Font Awesome/Prism/gifplayer). Update with `git -C md-publisher pull origin main`, then commit the new submodule pointer.
- `blog/hugo.toml` — site config. Notable: `[permalinks] blog = "/blog/:year/:month/:day/:slug/"` preserves the legacy Statie URL shape so old links keep working. Czech default language, RSS at `/rss.xml`. Module behaviour (menu items, footer HTML, search domain, Twitter/OG metadata, 404 texts) is configured under `[params]` — see the md-publisher README for the full param table.
- `blog/content/blog/<year>/<MM-DD-slug>/index.md` — one directory per post (page bundle). Front matter uses `date`, `slug`, `title`, `perex` (lead paragraph), `image`, optional `facebook_image`, `image_author`, and `deprecated_since` (posts with `deprecated_since` set are hidden from listings).
- `blog/static/` — site-specific assets copied verbatim to site root: `assets/images/` (including all post images), `favicon.ico`, `CNAME`.
- `blog/archetypes/` and `blog/data/` — currently empty; available if needed.
- `deploy/`, `.github/workflows/deploy.yml` — GitHub Actions builds `hugo --minify` (with `submodules: true` checkout) and rsyncs `blog/public/` to the server.

A file placed in `blog/layouts/` or `blog/static/` overrides its module counterpart (Hugo project-over-theme precedence).

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
