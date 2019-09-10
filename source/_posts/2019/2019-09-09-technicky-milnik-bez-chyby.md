---
id: 2019-09-09
title: "Technický milník - Bez chyby"
image: /assets/images/posts/loucime_se_s_pocitadly.png?version=a084e9e08b0006106ac67928ef6db771
image_author: "*Autorem ilustrace fešáka bez chybičky je [Ticho 762](https://www.facebook.com/ticho762). Děkujeme!*"
perex: |
    *Konzervujeme pravidla DrD+ a čistíme hlavu.*
    
    Popisujeme, jak těžké bylo dokončit navigaci v pravidlech a jak se to hodí vám.
    
    *A co vy, kdy vás naposledy zradila navigace?*
---

## Testuj, testuj, testuj!

Testování je zlaté pravidlo jakékoli tvorby pro ostatní. Je jasné, prosté a těžké na dodržování.

Když jsme převáděli PDF do HTML, tak jsme obsah zkopírovali, opravili co se zkopírováním rozbilo a přeleštili trochu vzhled. A když už jsme sem tam našli a opravili nějaký ten překlep původních autorů, tak nás z toho zaplavil povznášející pocit dobře odvedené práce.

Ale žádná idylka netrvá věčně.

### Kulička trusu
Po čase jsme zjistili, že některé externí odkazy prostě přestaly fungovat. Že stránka s licencí, kde můžete podle své zvědavosti nebo osobní cti pokračovat k pravidlům, má sklony k sebepoškozování. Že rejstřík je sice fajn, ale my chceme mít možnost odkazovat na úplně každou kapitolu. A tohle všechno se uplácalo v takovou malou, nenápadnou kuličku trusu, která se pořád nabalovala a zvětšovala a těžkla.
Až příšel čas na hovnivála.

### Z nevýhody výhodu
Nejrpve jsme se pokoušeli chyby opravovat ručně, což bylo stejně úmorné, jako deprimující. Stejné chyby se totiž vracely z naprosto nečekaných důvodů a naše opravy se tak zdály být bojem s větrnými mlýny.

Jakmile se ale nějaká otravná činnost opakuje, tak se máme začít ptát *"Nedá se to zautomatizovat"*?
A tak koncem jara 2018 vznikly první automatizované testy.

Z počátku jsme testovali jen základní funkce. Zda se dá projít licenční stránkou, jestli odkazy do okolního světa stále platí a jestli rejstřík odkazuje na existující kapitoly.

Jak nám testy zelenaly, tak z nás postupně opadávalo napětí. Ten strašák, který nad námi visel vždy, když jsme chtěli něco v pravidlech změnit.
Prvotní úspěch nám dodal sil, takže jsme si mohi dovolit v testech utahovat šrouby. A chyby lezly na povrch jako žížaly po lijavci.

Podobně jako hovnivál dokáže v odpadu, který by jiní obloukem obešli, najít další účel, tak i my jsme našli v chybách novou hodnotu. Jakmile jsme nějaký technický nedostatek objevili, tak jsme nejdříve napsali test, který počítal s opravenou verzí. A když jsme si ověřili, že nový test "padá" kvůli staré chybě, tak jsme mohli chybku opravit, test pustit znovu pak se kochat pohledem na zelený výsledek.

Mít zadek krytý testy byla velká úleva. Hlavně proto, že s pravidly Dračího doupěte plus už se spíše vláčíme, než že bychom je tlačili. Ale o tom až příště.

Teď je důležité, že pravidla DrD+ necháváme v nejlepším možném technickém stavu.

### Naše testy a co z toho máte
Během toho roka a půl jsme sespali 313 hlubinných testů, které běží téměř tři minuty a provedou celkem 11516 kontrol.

A tohle je výtah těch nejdůležitějších, které chrání každého čtenáře drdplus.info

- úplně každý nadpis je unikátní
    - takže když někomu řeknete, že má něco hledat v kapitole *Body zkušenosti*, tak se vás nebude ptát "ve které"
- úplně každý nadpis má v sobě kotvu (odkaz)
    - takže komukoli můžete poslat odkaz na kapitolu, o které se právě bavíte, třeba [Další bojové akce](https://pph.drdplus.info/#dalsi_bojove_akce)
- úplně každý výpočet má v sobě také kotvu (odkaz)
    - takže i na konkrétní výpočet můžete komukoli poslat odkaz, třeba [Hod na zpracování úlovku](https://pph.drdplus.info/#hod_na_zpracovani_ulovku)
- většina výpočtů má popisný název
    - takže si nebudete drbat hlavu, čeho že to je *"neúspěch"* a nebudete bloumat očima po okolním textu
    - přiznáváme, že tady máme ještě rezervy
- každá položka v rejstříku odkazuje na existující kapitolu
    - takže se vám nestane, že byste marně klikali na název, který slibuje to co zrovna teď nutně potřebujete
- všechny tabulky si můžete zobrazit na jednom místě, třeba všechny [tabulky z Pravidel pro hráče](https://pph.drdplus.info/?tabulky)
    - takže se už nemusíte prohrabovat tunou textu, abyste vyhrabali těch pár tabulek, co zrovna potřebujete
- všechny externí odkazy (na [altar.cz](https://altar.cz), [Vukogvazdskou družinu](https://www.vukogvazd.cz/), [nemoce na Wikipedii](https://cs.wikipedia.org/wiki/Cholera) jsou kontrolované a platné a to prosím včetně #kotev oddkazujících na konkrétní sekci
    - takže vám den nezkazí slepý odkaz vedoucí do nikam

A spousta spousta dalších, více technických.

**Pokud najdete jakoukoli nesrovnalost, ať už grafický úlet, překlep nebo krkolomné ovládání, prosíme, [nahlašte nám to](mailto:info@drdplus.info). Děkujeme!**

Doznáváme, že některé části našich představ jsme prostě vynechali.

- Hraničář nemá prolinkované nástiny svých schopností s jejich detailním popisem (původní autoři chtěli udržet hráče v co největší nevědomosti, aby si užil krásu neznáma a objeování, což dost znesnadňuje orientaci v pravidlech).
- Nelze skrývat příběh a úvodní texty, které jsou krásné, ale při častém používání, kdy se z pravidel stává manuál, už začínají překážet.

Víme jak oboje doknčit, ale dokud nám neřeknete, že by vám tyhle úpravy zjednodušily život, tak na ně teď kašleme. Je to na vás.

## Závěrem

Na převodu pravidel Dračího doupěte plus z PDF na web jsme nechali kus duše. Vyžaduje to totiž technické myšlení, keré jde na úkor tomu tvůrčímu.

Během převodu jsme zjistili, jak komplexní a složitá tato pravidla jsou. Zatímco při hře jsme byli zvyklí si ledaco zjednodušit nebo domyslet, tak při převodu jsme si museli projít vším. Bez příkras a bez vynechávání.

Původní cíl, tedy mít pravidla na webu pro snazší orientaci, jsme úspěšně dotáhli do konce po [čtyřech letech převádění](/blog/2018/02/09/na_webu_jsou_vsechna_pravidla_a_co_ted) a dvou letech lazení, kdy končíme díky testům s čistým štítem a díky ukončené práci s čistou hlavou.

Nyní se už konečně můžeme plně zaměřit na krystalizování toho, co jsme se během těch dlouhých dnů tvrdé práce naučili. Jak o pravidlech, tak o nás a naší touze po změně. Na to, co je v Dračím doupěti plus skryto pod vrstvou tabulek a vzorců a na co se budeme ještě dlouho odkazovat. Ale o tom až příště.

Krleš!