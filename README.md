# [blog.DračíOdkaz.cz](https://blog.draciodkaz.cz)

**Powered by [Hugo](https://gohugo.io/)** — presentation comes from the
[md-publisher](https://github.com/drdplusinfo/md-publisher) `blog-classic`
module, pulled in as a git submodule.

## Run locally

```sh
git clone --recurse-submodules git@github.com:drdplusinfo/blog.git
docker compose up
```

Then open [http://localhost:1313](http://localhost:1313).

Already cloned without submodules? Run `git submodule update --init`.

The Hugo dev server watches `blog/content/`, `blog/static/`, `blog/data/` and
the `md-publisher/` module templates, and rebuilds automatically.

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

## Change the look

Templates, CSS and JS live in the `md-publisher` repo
(`modules/blog-classic/`). To update the module here:

```sh
git -C md-publisher pull origin main
git add md-publisher && git commit -m "Update blog-classic module"
```

Site-specific texts (menu, footer, RSS metadata, 404) are params in
`blog/hugo.toml`. A file in `blog/layouts/` or `blog/static/` would override
its module counterpart if ever needed.
