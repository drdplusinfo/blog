# Broken external links — to process one by one

Checked 2026-07-23 (611 external link occurrences, 408 unique URLs, 183 fragment anchors verified).
The 4 mistyped-but-fixable links were already fixed in commit `afb021b`. Everything below still needs a decision.

File paths are relative to `blog/content/`.

## Broken anchors on our own rules sites

- [x] `https://pph.drdplus.info/#dalsi_bojove_akce` — anchor exists only on the `?trial=1` version; plain URL shows paywalled intro without the anchor. Fix: add `?trial=1`.
  - `blog/2019/10-01-technicky-milnik-bez-chyby/index.md:57`
- [x] `https://pph.drdplus.info/#hod_na_zpracovani_ulovku` — same trial-only anchor problem. Fix: add `?trial=1`.
  - `blog/2019/10-01-technicky-milnik-bez-chyby/index.md:59`
- [x] `https://pph.drdplus.info/#znaceni_a_zapis_zakladniho_hodu_na_uspech` — same trial-only anchor problem. Fix: add `?trial=1`.
  - `blog/2020/08-14-ilustratori-udernik-dan-hamernik/index.md:26`
- [x] `https://pph.drdplus.info/?trial=1#hod2k_6_plus` — no such id; the correct anchor is `#hod_2_k_6_plus`, i.e. `https://pph.drdplus.info/?trial=1#hod_2_k_6_plus` (verified on the live page).
  - `blog/2019/03-15-predstavy_minulosti_myty/index.md:32`
- [x] `https://pph.drdplus.info/?trial=1#tabulka_postihu_za_chybejici_silu` — anchor renamed to `#tabulka_postihu_ke_zbrani_za_chybejici_silu`.
  - `blog/2018/09-11-chybejici_sila_na_zbran/index.md:19` and `:41`
- [x] `https://ppj.drdplus.info/?trial=1#cenik_obleceni` — anchor renamed to `#cenik`.
  - `blog/2018/11-09-vzpominky_na_krasu/index.md:66`
- [x] `https://pph.drdplus.info/css/generic/anchors.css` — 404; the file moved to `https://pph.drdplus.info/css/generic/skeleton/rules-anchors.css` (verified 200).
  - `blog/2018/03-10-technicky_milnik_zrychlili_jsme/index.md:129`

## Dead Discord invites (API says "Unknown Invite")

- [x] `https://discordapp.com/invite/kwFXmWz` — **on the contact page**, the most visible broken link on the blog.
  - `kontakt.md:36`
- [x] `https://discord.com/invite/FVz5V3Q`
  - `blog/2020/08-05-ilustratori-pohodar-ticho762/index.md:307`

  Both now point to the `/discord/` redirect page (`blog/static/discord/index.html`), which JS-assembles the
  current invite (`kCegcAe3Hf`, permanent) so scrapers don't harvest it. To rotate the invite in the future,
  edit only that one file.

## Domain no longer resolves (NXDOMAIN)

- [x] `http://faterpg.cz/` — FIXED: replaced with `https://fatesrd.d20.cz/` (commit 4d55a72). — `blog/2018/10-03-co_chcete/index.md:275`
  - Researched 2026-07-23: was the WordPress promo site of the Czech Fate print edition; already a Wedos
    parking page by Jan 2020, later squatted by an SEO content farm, now dead. The Czech Fate community did
    NOT die, it just lives elsewhere. Best replacement: `https://fatesrd.d20.cz/` (complete Czech Fate SRD
    translation, alive), alternative `https://fate.nepocitacovehry.cz/`.
- [x] `http://minimaxfp.com/fire-extinguishers` — FIXED: replaced with the Wikipedia page (commit 227a8e8). — `blog/2018/05-03-neviditelna_recenze/index.md:120`
  - Researched 2026-07-23: was Minimax Fire Products, the North-American arm of the Minimax fire-protection
    brand; that domain is gone but the brand is alive at `https://www.minimax.com/int/en/`. The link is a
    joke ("going to buy fire extinguishers"), so any live Minimax page works; Wayback copy also exists:
    `http://web.archive.org/web/20210305080948/http://minimaxfp.com/fire-extinguishers`.
- [x] `https://www.fantasy-svet.sk/...798-neviditelna-kniha-neklidny-tauril` — FIXED: replaced with the Wayback snapshot (commit 227a8e8). — `blog/2018/05-03-neviditelna_recenze/index.md:136`
  - Researched 2026-07-23: small Slovak fan webzine that quietly vanished (last Wayback snapshot Feb 2024,
    no farewell note, no successor site found). The review is preserved:
    `http://web.archive.org/web/20200814043041/https://www.fantasy-svet.sk/index.php/publicistika/recenzie/798-neviditelna-kniha-neklidny-tauril`.

## Page gone (404 / 410 / 500)

- [ ] `http://brainmadesimple.com/amygdala.html` — 404 — `blog/2018/10-31-cit_pro_charisma/index.md:48`
- [ ] `http://mayrau.omk.cz/rubriky/fotogalerie/hornicky-skanzen-mayrau-/` — 404 — `blog/2018/10-05-prevaha/index.md:33`
- [ ] `https://caddyserver.com/tutorial/caddyfile` — 404 (docs restructured; now `https://caddyserver.com/docs/caddyfile-tutorial`) — `blog/2018/03-10-technicky_milnik_zrychlili_jsme/index.md:33`
- [ ] `https://caddyserver.com/docs/http.git` — 404 (plugin page gone) — `blog/2018/03-10-technicky_milnik_zrychlili_jsme/index.md:39`
- [ ] `https://developer.mozilla.org/en-US/docs/Web/HTML/Using_the_application_cache` — 404, AppCache removed from MDN — `blog/2018/03-10-technicky_milnik_zrychlili_jsme/index.md:61`
- [ ] `https://github.com/jaroslavtyc/drd-plus-story/commit/a33fe07cb881025d560af507ea0bb02fd144c5c3` — whole repo is gone — `blog/2017/06-16-polozen_zakladni_kamen_pro_cely_pribeh_drd_na_jednom_miste/index.md:14`
- [ ] `https://github.com/tomasvotruba/tomasvotruba.cz` — repo deleted/private (`tomasvotruba.com` repo also 404) — `blog/2019/05-07-technicky-milnik-moderni-blog/index.md:45`
- [ ] `https://huskarlar.blogspot.com/2018/08/dotazniky-pro-ne-hrace-drd.html` — 404 — `blog/2018/09-03-velkej_fanousek/index.md:8`, `blog/2018/10-03-co_chcete/index.md:13`
- [ ] `https://mytago.cz/chystame/zapovezene-zeme/` — 404 after redirect — `blog/2020/08-14-ilustratori-udernik-dan-hamernik/index.md:33`
- [ ] `https://rpgforum.cz/anotace` — 404 — `blog/2019/03-29-pidi_pravidla_uroven_nula/index.md:26`
- [ ] `https://slovanologie.blogspot.com/` — 404 — `blog/2019/05-07-technicky-milnik-moderni-blog/index.md:41`
- [ ] `https://uloz.to/hledej?q=drd` — 404, uloz.to removed public search — `blog/2017/08-02-ptam_se_bouchiho_z_altaru_zda_mohu_zverejnit_drd_pravidla/index.md:53`
- [ ] `https://www.fantasyobchod.cz/image/cache/neviditelna-kniha-neklidny-tauril-33121-0-1000x1000.jpg` — redirects to imago.cz 404 page — `blog/2018/05-16-kratky_pribeh_na_motivy_obalky_neviditelne_knihy/index.md:61`
- [ ] `http://taria.unas.cz/index2.php` — 404 — `blog/2018/10-03-co_chcete/index.md:310`, `blog/2020/08-14-ilustratori-udernik-dan-hamernik/index.md:29`
- [ ] `http://www.michaelpetrus.com/6-tipu-jak-najit-svou-specializaci/` — 404 after redirect to non-www — `blog/2020/06-18-ilustratori-kouzelnik-philip-ward/index.md:66`
- [ ] `https://ondrejhrdina.wordpress.com/` — 410, blog deleted — `blog/2019/05-07-technicky-milnik-moderni-blog/index.md:41`, `blog/2020/06-18-ilustratori-kouzelnik-philip-ward/index.md:74`
- [ ] `https://www.vukogvazd.cz/` — HTTP 500, server broken — `blog/2019/10-01-technicky-milnik-bez-chyby/index.md:64`
- [ ] `https://dribbble.com/shots/6621580-dragon-eye` — 404 (the other 5 Dribbble shots are alive) — `blog/2020/08-14-ilustratori-udernik-dan-hamernik/index.md:64` and `:71`

## Content replaced or behind a wall (URL responds, reader doesn't get the content)

- [ ] `http://makyorel.blog.cz/` — blog.cz shut down; redirects to tn.nova.cz homepage — `blog/2018/07-02-sucha_pravidla_mokry_zatylek_a_hledani_pomoci/index.md:79` and `:84`
- [ ] `http://neviditelnakniha.cz` + subpages (`/`, `/category/knihy/`, `/ke-stazeni/pravidla/`, `/ke-stazeni/dobrodruzstvi/`, `/ke-stazeni/mapy-a-planky/`, `/ke-stazeni/ostatni/`) — ~25 occurrences; domain redirects to `https://www.imago.cz/neviditelna-kniha`, all subpages collapse into that one product page, downloads are gone.
  - `blog/2018/02-16-vyskytla_se_nam_neviditelna_soutez/index.md` (6×)
  - `blog/2018/05-03-neviditelna_recenze/index.md` (many)
  - `blog/2018/05-16-kratky_pribeh_na_motivy_obalky_neviditelne_knihy/index.md:57`
  - `blog/2018/10-03-co_chcete/index.md:310`
  - `blog/2019/03-15-predstavy_minulosti_myty/index.md:36`
- [ ] Dropbox Paper doc "Marky hrdinů i padouchů" (3 URL variants) — redirects to Dropbox login wall; public Paper sharing discontinued.
  - `blog/2018/07-02-sucha_pravidla_mokry_zatylek_a_hledani_pomoci/index.md:54`, `:86`, `:89`
  - `blog/2018/10-03-co_chcete/index.md:115`, `:268`
  - `blog/2018/10-10-inteligentni_bojovnik/index.md:51`
- [ ] `https://www.facebook.com/media/set/?set=a.198351584467453&type=3` — "This content isn't available" — `blog/2020/06-18-ilustratori-kouzelnik-philip-ward/index.md:39` and `:420`
- [ ] `https://www.facebook.com/pg/drdplus.info/photos/?tab=album&album_id=339898449855265` and `https://www.facebook.com/pg/ticho762/photos/?ref=page_internal` — old `/pg/` URLs redirect to the page root; the album view is lost.
- [ ] `https://www.google.com/webmasters/tools/submit-url?continue=/addurl` — redirects to Google login; the submit-URL tool was discontinued — `blog/2018/02-09-na_webu_jsou_vsechna_pravidla_a_co_ted/index.md:56`
- [ ] `http://novyprostor.cz/prodejci-a-prodejni-mista#praha` — page alive but the `#praha` anchor no longer exists — `blog/2019/04-17-pidi_pravidla_skrabance_a_pot/index.md:130`
