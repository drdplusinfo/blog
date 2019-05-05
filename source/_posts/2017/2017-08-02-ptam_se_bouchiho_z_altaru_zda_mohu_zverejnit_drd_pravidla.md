---
id: 2017-08-02-1
title: "Ptám se Bouchiho z Altaru, zda mohu zveřejnit DrD+ pravidla"
perex: |
---

## Ptám se Bouchiho z Altaru, zda mohu zveřejnit DrD+ pravidla

Ahoj či dobrý den, chtěl bych s vámi (autory DrD+, nejenom s Bouchim) navázat spolupráci na dalším vývoji [DrD+](https://www.altar.cz/drdplus/).

Začnu svojí historií a skončím tím, co je napsáno v předmětu tohoto emailu - *s pravidly DrD+ dostupnými jako [webová stránka](https://www.drdplus.info)*.

Jaroslav "Kostřivec" Týc

*DrD jsem začal hrát na základce, úplně paf z toho jak slovo tvoří skutečnost, jak jedna věta dokáže v mojí hlavě poskládat špinavou místnost, vrzající soukolí kdesi za zdí, čpící pach plísně a nevětraných prostor. A také jsem poprvé zjistil, jak vrtkavá slova jsou, jak moc se liší obrazce v hlavách každého hráče.*

*Na střední škole, zatímco ostatní "normální" spolužáci lovili holky v nočních jízdách a přes den žili spořádaný život směřujíc k uvědomělému dospělému, jsem já a několik dalších postižených trávil dlouhé hodiny dobrodružstvími, u kterých by Hollywoodští scénáristé skřípali závistí - alespoň jsme měli ten pocit. Jak ovšem šel čas, bylo stále těžší udržet jakýs takýs smysluplný obsah a z příběhů se stávaly nekonečné seriály. Potřebovali jsme změnu. A ta přišla náhle, přestože nám o ní čtyři roky vyprávěli. Střední skončila, my se rozprchli do všemožných koutů světa, abychom se při občasných srazech uchechtávali nad starými fotkami, jací jsme to byli na škole mlíka, a stárli. Ne tělesně, čert to vem, ale duše dřevnatěla, fantazie kornatěla a volnomyšlenkářství bylo vytlačeno všudypřítomným pocitem povinnosti. Kdo nemá starosti a nechodí domu ubitý z práce, je budižkničemu.*

*Bylo to důležité životní období, hra na takového dospělého, jakého nám celé mládí předkládali. Ale to už je naštěstí za námi. Už se zase vracíme do míst, kde nám je nejlépe. Zpět do fantazie a do dětských zážitků, které mají daleko k dětinskosti. A chtěli jsme zase hrát DrD. Ale už to nešlo. Staré dobré DrD, se kterým jsme začínali na pirátské kopii s černými okraji a prošli až do kompletní série 1.6 včetně všech tehdy existujících rozšíření, nám přišlo moc prosté, příliš okoukané, málo skutečné.*

*A tak jsme potkali DrD+ a přestože jeho vstupní bariéra je vysoká, rozhodli jsme se zatnout zuby, povolali do našich řad úspěšného vysokoškoláka, který má se skripty bohaté zkušenosti a použili jsme ho jako překladač pravidel.*

*To bylo někdy před šesti lety, rok 2011.*

*O rok později, kdy už moji družiníci celkem slušně vládli slovníkem pojmů z DrD+, neztráceli se tolik v převodních tabulkách, v léčbě symptomů a odbourávání únavy, jsem si já potvrdil, že mám špatnou paměť. A přestože už jsem tou dobou byl vybavený PDF pravidly, kde se mi přeci jen magickou kombinací kláves Ctrl+F dařilo částečně odbourat moje věčné zmatení z uspořádání a názvů v pravidlech, pořád jsem zaostával. A tak jsem začal převádět PPH pravidla z PDF do HTML, tedy pro web, v domnění, že až si všechny ty slovní odkazy na tabulky a výpočty zhmotním do odkazů hypertextových, tak bude po problému.*

*Rok na to, s nepříliš vysokým nasazením, spatřila světlo světa [první verze PPH jako webová stránka](https://pph.drdplus.info/?trial=1). A byla hrozná - obrovská, trvalo deset vteřin než se zobrazila v Chromu, ve Firefoxu to občas spadlo, a na telefonu byla naprosto nepoužitelná. Tak jsem to dal k ledu a zapomněl na to.*

*Před dvěma lety (2015) jsem ale objevil [Caddy web server](https://caddyserver.com/), kde stačilo nastavit pár řádků v jediném textovém souboru, a najednou běhaly pravidla mnohem rychleji ([HTTP/2](https://en.wikipedia.org/wiki/HTTP/2)), s validním HTTPS certifikátem zadarmo ([Let's encrypt](https://letsencrypt.org/)) a s tím se najednou začala pravidla načítat celkem svižně. Kluci v družině je začali konečně používat a já o jejich webovou formu začal mít zase zájem. Trochu jsem se ještě pohrabal v sestavování výsledné stránky (běží to [nad PHP](https://php.net/)), přidal nějakou tu radu pro zobrazování na menších obrazovkách a pak už šla pravidla celkem použít i na mobilu, byť stále stahují několik mega dat. Začal jsem si pohrávat s myšlenkou, že bych začal převádět na web i další pravidla.*

*Před rokem (2016) přišel spoludružiník s tím, že by chtěl hrát theurga, ale že se úplně ztrácí v tom sestavování formulí, a jestli bych mu na to něco nenaprogramoval. Tak jsem otevřel pravidla theurga a... zjistil jsem, že se v nich taky nevyznám. Zase jsem narazil na svoji hlavu, která nemá ráda zkratky a potřebuje všechno znovu a znovu opakovat, jinak si to nezapamatuje. Tak jsem začal převádět pravidla z PDF na web, přidal odkazy mezi formulemi a modifikátory a přejmenoval jsem je ze zkratek do plných slov (Mod = Jiskra, Pr = Průraz, Ba = Bariéra a podobně). Vyzbrojen [pravidly theurga bez zkratek](https://theurg.drdplus.info/?trial=1) jsem konečně mohl napsat pomocný [nástroj na sestavování formulí](https://formule.theurg.drdplus.info/).*

*A pak už to šlo ráz na ráz. Převedl jsem [pravidla pro hraničáře](https://hranicar.drdplus.info/?trial=1), kterého jsem začal hrát nedávno a kde jsem často listoval při hledání schopností, pro [čaroděje](https://carodej.drdplus.info/?trial=1) jehož papírový originál jsem smáčel v čaji pro osobitější vzhled, ale převařil poslední dvě stránky s abecedním seznamem kouzel, přidal [bojovníka](https://bojovnik.drdplus.info/?trial=1), aby nezůstal na ocet, napsal pomocníka pro [výpočet bojových parametrů](https://boj.drdplus.info/), z jejichž kalkulace mi jde dodnes hlava kolem, dodal [zloděje](https://zlodej.drdplus.info/?trial=1), kterého jsem pověsil na hřebík nedávno a nakonec [kněze](https://knez.drdplus.info/?trial=1), do něhož jsem se zamiloval a který bude zřejmě mým dalším osudem, až hraničář půjde do důchodu.*

*Všechna tato pravidla jsem pro svou družinu sjednotil na jeden rozcestník, [www.drdplus.info](https://www.drdplus.info)*

Tolik historie a teď k budoucnosti:

Během převádění mě chytla a už nepustila myšlenka, že všechen ten čas a energie pro převod pravidel (každá příručka zabrala přibližně čtyřicet hodin, [PPH](https://pph.drdplus.info/?trial=1) kolem stovky) by mohly mít velký užitek pro všechny hráče DrD+ a upravil jsem proto stránky tak, aby *mohly* být veřejné.

Vás nyní prosím o rozvážné zamyšlení se nad tím, zda by pravidla veřejně dostupná na webu prospěla **budoucnosti** Dračího doupěte plus.

#### Jak se k tomu stavím já:

- DrD+ je krásné, ale pravidla jsou často tak propletena, že mnohé ona nepřehlednost odradí
  - hypertextové odkazy na kapitoly, tabulky a výpočty zjednoduší používání pravidel
- je mnoho nápadů na změny (například na [https://rpgforum.cz/forum/viewforum.php?f=238](https://rpgforum.cz/forum/viewforum.php?f=238)), ať už zjednodušení, rozšíření či opravy pravidel, ale jejich zapracování a vydání v papírové i PDF podobě stojí hodně času a peněz (?)
  - v tom je velká výhoda HTML a online přístupu - jakákoli úprava je prostá editace textu, dostat úpravu k samotným hráčům je dílem okamžiku, za změny se platí pouze vlastním časem
- v dnešní době napěchované příliš dostupnou zábavou je čím dál obtížnější přivést nové hráče k papírovým pravidlům
  - proto jsem přesvědčený, že veřejně dostupná pravidla v poslední, nejlepší verzi zvýší oblíbenost DrD+ mezi hráči, přivede nové a vdechne pravidlům nový život

#### Jak si představuji právní stránku DrD+ na webu:

- ochrana duševního vlastnictví a dostupnost obsahu jdou vždy proti sobě, ale DrD+ beztak většina hráčů hraje podle okopírovaných pravidel a sehnat je [je otázkou několika minut](https://uloz.to/hledej?q=drd)
  - úvodní stránku ke všem pravidlům jsem proto nastavil tak, aby neodradila případné návštěvníky nějakou registrací a kontrolou, zda si daná pravidla od Altaru skutečně koupili, "pouze" apeluji na jejich charakter
  - všude uvádím původní autory a odkaz na obchod Altaru
  - přestože [ostatní nástroje a knihovny k DrD+](https://github.com/search?utf8=%E2%9C%93&q=drd-plus&type=) uvolňuji pod [licencí MIT ("dělej si co chceš")](https://en.wikipedia.org/wiki/MIT_License), tak samotné DrD+, respektive zdrojové kódy pravidel, chci udržovat neveřejné a zamezit tak jejich šíření bez kontroly Altaru (nyní jsou zdrojové kódy na [bitbucket.org](https://bitbucket.org/) v privátních repositářích)

#### Kam bych chtěl směřovat DrD+:

- rád bych do pravidel zapracoval připomínky z rpgforum i další,
- sám mám v hlavě spoustu dalších nápadů, které bych rád do DrD+ přidal s tím, že budu udržovat současnou verzi a k ní zároveň verzi novou, kterou bych chtěl časem přetavit do DrD+ II
  - nová povolání
  - možnost míchat povolání
  - větší provázanost povolání a dovedností
  - rozšíření dovedností jednotlivými povoláními (jako jsou Boje s... Jízda na koni a další, které jsou již nyní jinými mechanismy řešeny u bojovníka, zloděje atd.)
  - marky (jakési jednorázové charakterové vlastnosti, jako například Neduživý - 1 k síle a + 1 k inteligenci atd.),
  - stáří (pro rozvoj jedné vlastnosti bude nutné obětovat jinou, budou přibývat tělesné i duševní komplikace)
  - a další...

Prosím vás proto o společné hledání cesty, jak **pokračovat s vývojem DrD+** a v ideálním případě o svolení, abych mohl současná webová pravidla veřejně ukazovat (zatím o nich vyhledávače typu Google či Seznam nevědí).

Plánované změny plánuji dělat tak jako tak, ale pokud od vás nedostanu svolení, opustím doménu drdplus.info, nebudu nadále veřejně používat název DrD+ a nebudu jim dělat reklamu, ani je indexovat přes webové vyhledávače.

Nechte si to prosím projít hlavou.

Děkuji, Jaroslav "Kostřivec" Týc 

PS: všechny zdrojové kódy jsou vám k dispozici a pokud se rozhodnete, že je použijete po svém, protože jejich obsah je vaším vlastnictvím, nebudu se bránit

Edit: [Bouchi *10. 8. 2017* odpověděl, že si dá čas na rozmyšlenou](2017-08-10-altar_rozvazne_odpovida_ze_se_nad_verejnymi_pravidly_zamysli.md)

Edit: *15. 2. 2018* jsem z různých indicií došel k závěru, že oficiální svolení od Altaru ani nedostanu, protože mi ho dát vlastně nemůže.
