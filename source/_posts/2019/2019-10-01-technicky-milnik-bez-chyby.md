---
id: 2019-10-01-1
title: "Technický milník - Bez chyby"
image: /assets/images/posts/technicky_milnik_bez_chyby.png?version=c3e3e46d53d240ff99d9bc2b5da3e833
image_author: "*Autorem ilustrace fešáka bez chybičky je [Ticho 762](https://www.facebook.com/ticho762). Děkujeme!*"
perex: |
    *Konzervujeme pravidla DrD+ a čistíme hlavu.*
    
    Popisujeme, jak těžké bylo dokončit navigaci v pravidlech a jak se vám výsledek může hodit.
    
    *A co vy, kdy vás naposledy zradila navigace?*
---

## Testuj, testuj, testuj!

Testování je zlaté pravidlo jakékoli tvorby pro ostatní. Je jasné, prosté a těžké na dodržování.

Když jsme před časem převáděli pravidla Dračího doupěte plus z PDF na [web](https://www.drdplus.info), tak jsme obsah zkopírovali, opravili co se zkopírováním rozbilo a přeleštili trochu vzhled. A když už jsme sem tam našli a opravili nějaký ten překlep původních autorů, tak nás z toho zaplavil povznášející pocit dobře odvedené práce.

Ale žádná idylka netrvá věčně.

### Kulička trusu
Po nějaké době jsme totiž zjistili, že některé externí odkazy prostě přestaly fungovat. A že stránka s licencí, kde můžete podle své zvědavosti nebo osobní cti pokračovat k pravidlům, má sklony k sebepoškozování. A že  odkazování z rejstříku na hlavní kapitoly je sice fajn, ale my chceme mít možnost odkazovat na úplně každou kapitolu.
A tohle všechno se uplácalo v takovou malou, nenápadnou kuličku trusu, která se pořád nabalovala a zvětšovala a těžkla.

Až přišel čas na hovnivála.

### Samá chyba
Nejprve jsme se pokoušeli chyby opravovat ručně, což bylo stejně úmorné, jako deprimující. Stejné chyby se totiž vracely z naprosto nečekaných důvodů a naše opravy tak byly bojem s větrnými mlýny za náhodných povětrnostních podmínek.

Jakmile se ale nějaká otravná činnost opakuje, tak přichází otázka *"Nedá se to zautomatizovat"*?
A tak koncem jara 2018 vznikly první automatizované testy.

Z počátku jsme testovali jen základní funkce. Zda se dá projít licenční stránkou, jestli odkazy do okolního světa stále platí a jestli rejstřík odkazuje na existující kapitoly.

Jak nám testy zelenaly, tak z nás postupně opadávalo napětí. Ten strašák, který nad námi visel vždy, když jsme chtěli něco v pravidlech upravit.

Prvotní úspěch nám dodal sil, takže jsme si mohli dovolit v testech utahovat šrouby. A chyby lezly na povrch jako žížaly po lijavci.

### Z nevýhody výhodu
Podobně jako hovnivál dokáže v odpadu, který by jiní obloukem obešli, najít další účel, tak i my jsme našli v chybách novou hodnotu. Jakmile jsme nějaký technický nedostatek objevili, tak jsme nejdříve napsali test, který počítal s opravenou verzí. A když jsme si ověřili, že nový test "padá" kvůli staré chybě, tak jsme mohli problém opravit a to rovnou na všech místech, které test vyšťoural. Pak už jsme se kochali pohledem na zelený výsledek.
Tím jsme si zajistili, že nový test opravdu testoval nalezený problém a že jsme omylem nenapsali nějakou stálezelenou blbost.

Mít zadek krytý testy byla velká úleva. Hlavně proto, že s pravidly Dračího doupěte plus se už spíše vláčíme, než že bychom je tlačili. A my je nechtěli zanechat nedotažené. Ale o tom až příště.

Teď je důležité, že pravidla Dračího doupěte plus necháváme v nejlepším možném technickém stavu.

### Naše testy, vaše radost
Během roka a půl jsme sepsali tři sta třináct hlubinných testů, které běží téměř tři minuty (na každých pravidlech zvlášť) a provedou celkem jedenáct tisíc pět set šestnáct kontrol (na *Pravidlech pro hráče*, u ostatních je to spíše méně).

A tohle je výtah těch nejdůležitějších, které chrání každého čtenáře [drdplus.info](https://www.drdplus.info)

- úplně každý nadpis je unikátní
    - takže když někomu řeknete, že má něco hledat v kapitole [*Body zkušenosti*](https://pph.drdplus.info/?trial=1#body_zkusenosti), tak se vás nebude ptát "ve které z nich"
- úplně každý nadpis má v sobě kotvu (odkaz)
    - takže komukoli můžete poslat odkaz na kapitolu, o které se právě bavíte, třeba [Další bojové akce](https://pph.drdplus.info/#dalsi_bojove_akce)
- úplně každý výpočet má v sobě také kotvu (odkaz)
    - takže i na konkrétní výpočet můžete komukoli poslat odkaz, třeba [Hod na zpracování úlovku](https://pph.drdplus.info/#hod_na_zpracovani_ulovku)
- každá položka v rejstříku odkazuje na existující kapitolu
    - takže se vám nestane, že byste marně klikali na název, který slibuje to, co zrovna teď nutně potřebujete - odkaz bude prostě fungovat
- všechny tabulky si můžete zobrazit na jednom místě, třeba všechny [tabulky z *Pravidel pro hráče*](https://pph.drdplus.info/tabulky)
    - takže se už nemusíte prohrabovat tunou textu, abyste vyhrabali těch pár tabulek, co zrovna potřebujete
- všechny externí odkazy (na [altar.cz](https://altar.cz), [Vukogvazdskou družinu](https://www.vukogvazd.cz/), [nemoci na Wikipedii](https://cs.wikipedia.org/wiki/Cholera)) a další jsou kontrolované a platné a to včetně #kotev odkazujících na konkrétní sekci cílové stránky
    - takže vám den nezkazí slepý odkaz vedoucí do nikam

A spousta spousta dalších, více technických kontrol.

**Pokud najdete jakoukoli nesrovnalost, ať už grafický úlet, překlep nebo krkolomné ovládání, prosíme, [nahlaste nám to](mailto:info@drdplus.info). Děkujeme!**

### Dokonalost je relativní

Doznáváme, že některé části našich představ o dokonalosti jsme prostě vynechali.

- Hraničář nemá prolinkované všechny nástiny svých schopností s jejich detailním popisem (původní autoři totiž chtěli udržet hráče v co největší nevědomosti, aby si užil krásu neznáma a objevování, což dost znesnadňuje orientaci v pravidlech).
- Nelze skrývat příběh a úvodní texty, které jsou sice čtivé, ale při častém používání pravidel, kdy se z nich stává manuál, už začínají překážet.

Víme jak oboje dokončit, ale dokud nám neřeknete, že by vám tyhle úpravy zjednodušily život, tak na ně teď kašleme. Je to na vás.

## Závěrem

Na převodu pravidel Dračího doupěte plus z PDF na web jsme nechali kus duše. Vyžaduje to totiž technické myšlení, které jde na úkor tomu tvůrčímu.

Během převodu jsme zjistili, jak komplexní a složitá tato pravidla jsou. Zatímco při hře jsme byli zvyklí si ledaco zjednodušit nebo domyslet, tak při převodu jsme si museli projít vším. Bez příkras a bez vynechávání.

Původní cíl, tedy mít pravidla na webu pro snazší orientaci, jsme úspěšně dotáhli do konce po [čtyřech letech převádění](../2018/2018-02-09-na_webu_jsou_vsechna_pravidla_a_co_ted.md) a dalších dvou letech ladění. Tedy dlouhých šesti letech, které zakončujeme díky testům s čistým štítem a díky dotažené práci s čistou hlavou.

Nyní se už konečně můžeme plně zaměřit na krystalizování toho, co jsme se během těch dlouhých let tvrdé práce naučili. Jak o pravidlech, tak o nás a naší touze po změně. Na to, co je v Dračím doupěti plus skryto pod vrstvou tabulek a vzorců a na co se budeme ještě dlouho odkazovat. Ale o tom až příště.

Krleš!