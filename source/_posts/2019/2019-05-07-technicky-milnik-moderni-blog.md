---
id: 2019-05-07-1
title: "Technický milník - *Moderní blog*"
perex: |
    *Šaty dělaj člověka a grafika internet*
    
    Starý blog už byl delší dobu dýchavičný a my jsme se konečně dostali k jeho přepracování. A vylepšii jsme mu jak vzhled, tak i užitek.
    
    *A co vy, kdy jste se naposledy převlékli k nepoznání?*
---

## Kus historie
Blog o vývoji nové verze Dračího doupěte plus je tu s námi už téměř dva roky.

Na jeho začátku jsme chtěli jedinou věc - *psát a to **hned***.

### Jednoduchý Markdown
Jakožto technicky založený jsem vybral [Markdown](https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet). Neznám totiž jednoduší formátování textu, ve kterém můžu rozlišovat nadpisy, psát *kurzívou* a **tučně** a přitom si to pamatovat jak. I po dvou letech se musím pochválit, jak dobře jsem zvolil.

*Třeba i [Jeskyně a draci](http://jeskyneadraci.cz/), připravovaný český překlad Dungeon and dragons, píší v Markdownu.*

### Příliš rychlé nasazení
Horší už byl můj výběr vykreslovacího programu, u kerého jsem sáhnul po něčem, co jde opravdu nejrychleji nasadit. Javascriptem poháněnou [MDWiki](http://dynalon.github.io/mdwiki/#!index.md).

Před dvěma lety byla volba stejně jasná, jako rozkaz *chceme to **hned***. Zkopíroval jsem jeden HTML soubor, do podadresáře jsem nacpal soubor s textem a voilà! už to běželo. Co víc si přát.

Ze soukromého, garážového projektu se ale rychle stávala výkladní skříň našeho snažení a už po roce jsem nadskakoval na židli, kdykoliv jsem chtěl na blogu něco vylepšit.

### Technický dluh
S CSS styly jsem si ještě pohrál, takže náš všudypřítomný vzhled jsem na starý blog dostal. Javascript jsem taky rozklíčoval, abych opravil otravné poskakování stránky při každém kliknutí na nadpis.

Ale donutit vyhledávače, aby obsah blogu indexovaly ? U něčeho, co se vykresluje ryze javascriptem? Jenom Google to jakžtakž zvládne.
Nebo čtečky stránek, třeba můj oblíbený [Pocket](https://getpocket.com/explore/trending), pouze poslušně zobrazovaly zdrojový kód.
A co tolik potřebné komentáře od vás, co úvodní texty (perex), úvodní obrázky... Ne, to snadno nešlo. To už bych si to rovnou mohl napsat celé sám.

## Čas hledání
Že to stojí za starou belu jsme věděli poslední rok. Pokukovali jsme po ostatních, přemýšleli o hotovém blogu [Blogger](https://www.blogger.com/) od Google, potom od [Wordpressu](https://wordpress.com/), ale věděli jsme, že by nás to chvilkové pohodlí zase dohnalo. A taky mi hodně vadí reklamy.

Ovšem, kdo hledá, najde a já jak jsem pořád podvědomě hledal, tak jsem našel blog Tomáše Votruby. PHP programátora, který dokázal prorazit z malé české kotliny do okolních zemí, [píše o tom blog](https://www.tomasvotruba.cz/) a hlavně, zatracně hodně své práce dává [zadarmo všem](https://github.com/TomasVotruba). Včetně svého blogu!

Omrknul jsem mu [zdrojové kódy](https://github.com/tomasvotruba/tomasvotruba.cz), vyzkoušel si to u sebe v [Dockeru](https://www.zdrojak.cz/clanky/proc-pouzivat-docker/) a pak už to šlo ráz na ráz.

## Bez práce to nejde
No, ono teda to *ráz na ráz* trvalo asi čtrnáct dní dost intenzivní práce a vztekání se nad příliš abstraktní [Symfony](https://symfony.com/) (PHP framework, takový švýcarský nůž na weby). Ale šlo to pořád dopředu a vypadalo to čím dál lépe.

A tady to je.

- nový vzhled,
- rychlejší načítání
- zobrazování i ve čtečkách
- diskuze (konečně!)
- lepší indexování od vyhledávačů (časem, až jim to dojde)

Tak ať se líbí!