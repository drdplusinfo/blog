---
id: 2019-09-09
title: "Technický milník - Bez chyby"
image: /assets/images/posts/loucime_se_s_pocitadly.png?version=a084e9e08b0006106ac67928ef6db771
image_author: "*Autorem ilustrace fešáka bez chybičky je [Ticho 762](https://www.facebook.com/ticho762). Děkujeme!*"
perex: |
    *Konzervujeme pravidla DrD+ a čistíme hlavu*
    
    Popisujeme, jak těžké bylo dokončit nvaigaci v pravidlech a co z toho máte vy.
    
    *A co vy, kdy vás naposledy zradila navigace?*
---

## Testuj, testuj, testuj!

Testování je zlaté pravidlo jakékoli tvorby pro ostatní. Je jasné, prosté a těžké na dodržování.

Když jsme převáděli PDF do HTML, tak jsme obsah zkopírovali, opravili co se zkopírováním rozbilo a přeleštili trochu vzhled. A když jsme sem tam našli a opravili nějaký ten překlep původních autorů, tak jsme měli povznášející pocit dobře odvedené práce.
Ale žádná idylka netrvá věčně.

### Kulička trusu
Po čase jsme zjistili, že některé externí odkazy prostě přestaly fungovat. Že stránka s licencí, kde můžete podle své zvědavosti nebo osobní cti pokračovat k pravidlům, má sklony k sebepoškozování. Že rejstřík je sice fajn, ale my chceme mít možnost odkazovat na úplně každou kapitolu. A tohle všechno se uplácalo v takovou malou, nenápadnou kuličku trusu, která se pořád nabalovala a zvětšovala a těžkla.
Až příšel čas na hovnivála.

### Z nevýhody výhodu
Nejrpve jsme se pokoušeli chyby opravovat ručně, což bylo stejně úmorné, jako deprimující. Stejné chyby se totiž vracely z naprosto nečekaných důvodů a naše opravy se tak zdály být bojem s větrnými mlýny.

Jakmile se ale nějaká otravná činnost opakuje, tak se máme začít ptát *"Nedá se to zautomatizovat"*?
A tak vznikly první automatizované testy.

Z počátku jsme testovali jen základní funkce. Zda se dá projít licenční stránkou, jestli odkazy stále platí a jestli rejstřík odkazuje na existující kapitoly.

Jak nám testy zelenaly, tak z začínalo padat napětí, kvůli kterému jsme dřívě měli osypky, jakmile jsme chtěli něco v pravidlech změnit.
A začali jsme v testech utahovat šrouby. A chyby lezly na povrch jako žížaly po lijavci.

Podobně jako hovnivál dokáže odpadu, který by jiní obloukem obešli, dát další význam, tak i my jsme našli v chybách novou hodnotu. Jakmile jsme nějaký technický nedostatek objevili, tak jsme nejdříve napsali test, který počítal s opravenou verzí. A když jsme si ověřili, že nový test "padá", mohli jsme chybku opravit, test pustit znovu pak se kochat pohledem na zelený výsledek.
Mít zadek krytý testy byla velká úleva. Hlavně proto, že s pravidly Dračího doupěte plus už se spíše vláčíme, než že bychom je tlačili. Ale o tom až příště.
Teď je důležité, že pravidla DrD+ necháváme v nejlepším možném technickém stavu.

### Naše testy a co z toho máte
A tohle je výtah těch nejdůležitějších testů, které chrání každého čtenáře drdplus.info

- 