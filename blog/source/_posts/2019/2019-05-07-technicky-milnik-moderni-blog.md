---
id: 2019-05-07-1
title: "Technický milník - *Moderní blog*"
image: /assets/images/posts/blog.png
perex: |
    *Šaty dělaj člověka a grafika internet.*

    Starý blog už byl delší dobu dýchavičný a my jsme se konečně dostali k jeho přepracování. A vylepšili jsme mu jak vzhled, tak i užitek.

    *A co vy, kdy jste se naposledy převlékli k nepoznání?*
---

## Kus historie
Blog o vývoji nové verze Dračího doupěte plus je tu s námi už téměř dva roky.

Na jeho začátku jsme chtěli jedinou věc - *psát a to **hned***.

### Jednoduchý Markdown
Jakožto technicky založený jsem vybral [Markdown](https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet). Neznám totiž jednoduší formátování textu, ve kterém můžu rozlišovat nadpisy, psát *kurzívou* a **tučně** a přitom si pamatovat jak se to dělá. I po dvou letech se musím pochválit, jak dobře jsem zvolil.

*Třeba i [Jeskyně a draci](http://jeskyneadraci.cz/), připravovaný český překlad Dungeon and dragons, píší v Markdownu.*

- poznámka: pokud čekáte **jenom** na překlad Dungeon and dragons, tak ten tu už dávno [je](http://www.d20.cz/clanky/pravidla/preklad-dnd-5e.html)

### Příliš rychlé nasazení
Horší už byl můj výběr vykreslovacího programu. U něj jsem sáhnul po něčem, co jde opravdu nejrychleji nasadit a to javascriptem poháněnou [MDWiki](http://dynalon.github.io/mdwiki/#!index.md).

Před dvěma lety to byla volba stejně jasná, jako rozkaz *chceme blog **hned***. Zkopíroval jsem jeden HTML soubor, do podadresáře jsem nacpal soubor s textem blogu a voilà! už to běželo. Co víc si přát.

Jenže ze soukromého, garážového projektu se rychle stávala výkladní skříň našeho snažení a už po roce jsem nadskakoval na židli, kdykoliv jsem chtěl na blogu něco vylepšit.

### Technický dluh
S [kaskádovými styly](https://www.jakpsatweb.cz/css/css-uvod.html) jsem si ještě pohrál, takže náš všudypřítomný vizuál jsem na starý blog dostal. Javascript jsem taky rozklíčoval, takže jsem mohl opravit otravné poskakování stránky, když jste klikli na nadpis.

Ale donutit vyhledávače, aby obsah blogu indexovaly ? U něčeho, co se vykresluje ryze javascriptem? Jenom Google to jakžtakž zvládne.
Nebo čtečky stránek, třeba můj oblíbený [Pocket](https://getpocket.com/explore/trending), pouze poslušně zobrazovaly zdrojový kód.
A co tolik potřebné komentáře od vás, co úvodní texty (perex), úvodní obrázky... Ne, to snadno nešlo. To už bych si to rovnou mohl napsat celé sám.

## Čas hledání
Že to stojí za starou belu jsme věděli poslední rok. Pokukovali jsme po ostatních blogách. Přemýšleli jsme o hotovém blogu od Google, jako to má Paul se svou [Slovanologií](https://slovanologie.blogspot.com/) a Markus se svým [Návratem do dungeonu](https://zpatky.wordpress.com/). Potom o Wordpressu, na kterém má blog dvorní kreslíř Dračí hlídky [Ondřej Hrdina](https://ondrejhrdina.wordpress.com/). A taky o livejournal, na kterém má Bifi své [Hlboké lesy](https://hlbokelesy.livejournal.com/). Ale věděli jsme, že by nás to chvilkové pohodlí, ten *blog hned teď*, zase dohnalo. A taky mi hodně vadí reklamy, které na blogách zdarma prostě jsou.

Ovšem, kdo hledá, najde. A já, jak jsem pořád podvědomě hledal, tak jsem našel blog [Tomáše Votruby](https://www.tomasvotruba.cz/). Tomáš je PHP programátor, který dokázal prorazit z malé české kotliny do okolních zemí, bloguje o tom a hlavně, zatraceně hodně své práce dává [zadarmo všem](https://github.com/TomasVotruba). Včetně svého blogu!

Omrknul jsem mu [zdrojové kódy](https://github.com/tomasvotruba/tomasvotruba.cz), vyzkoušel si to u sebe v [Dockeru](https://www.zdrojak.cz/clanky/proc-pouzivat-docker/) a pak už to šlo ráz na ráz.

## Bez práce to nejde
No, ono teda to *ráz na ráz* trvalo asi čtrnáct dní dost intenzivní práce a vztekání. Hlavně jsem funěl u příliš abstraktní [Symfony](https://symfony.com/) (to je PHP framework, takový švýcarský nůž na weby). Ale šlo to pořád dopředu a vypadalo to čím dál lépe.

A tady to je

- nový vzhled
- rychlejší načítání
- zobrazování i ve čtečkách
- diskuze (konečně!)
- snazží dohledání obsahu přes vyhledávače (časem, až jim to dojde)

Tak ať se líbí!