---
id: 2018-03-10-1
title: "Technický milník - zrychlili jsme"
perex: |
---

# Technický milník - zrychlili jsme

*10. 3. 2018*

*15 minut čtení*

---
id: 2019-05-05-1
title: "Únava jako"
perex: |
---

# Poznej, kdo ti slouží
Budoucnost DrD+ závisí na mnoha faktorech a jeden z nich je *dostupnost* pravidel.
V tomhle článku ti proto popíšu, jak stránky fungují po technické, ajťácké stránce, a to jak je posílá server a jak je čte tvůj prohlížeč, protože i v tom je kus důležité historie a ještě důležitější *budoucnosti* [drdplus.info](https://www.drdplus.info).

Článek jsem psal dost zjednodušeně, takže detaily pochopíš, i když *nejsi od fochu*.

---

> Na začátku to ucpávalo dráty, na konci to bude jako offline aplikace v telefonu.

## Pomalý rozjezd

2014

*To základní bychom měli, stránky se načítaly, aaaleee pooomaaaluuu*

Jak už jsem [psal v dopise Altaru](2017-08-02-ptam_se_bouchiho_z_altaru_zda_mohu_zverejnit_drd_pravidla.md), začátky stránek [drdplus.info](https://www.drdplus.info) byly tristní. [PPH](https://pph.drdplus.info/?trial=1) se načítaly tak dlouho, že jsem rychleji vyhrabal [původní PDFko](https://obchod.altar.cz/drd-prirucka-pro-hrace-everze-p-972.html?buy=Koup%C3%ADm+DrD%2B+PPH+%28Pravidla+pro+hr%C3%A1%C4%8De%29) a v něm si našel co jsem hledal.
No, trochu mě to otrávilo, takže jsem se na pravidla na webu na čas vykvajznul...

## Posíláme části najednou

2016

*Jak dostat stránku rychleji do tvého prohlížeče?*

Malá revoluce pro mě nastala objevením [webového serveru Caddy](https://caddyserver.com/), kterému stačilo [nepříliš složitým textovým souborem](https://caddyserver.com/tutorial/caddyfile) oznámit, co chci zobrazovat, a najednou jsem měl stránky s [HTTPS](https://www.vzhurudolu.cz/prirucka/https) a ještě k tomu se načítaly rychleji, jelikož využívaly [HTTP/2](https://www.vzhurudolu.cz/prirucka/http-2), což je stahování všech částí stránky *najednou* (třeba taková [Pravidla pro hráče](https://pph.drdplus.info/?trial=1) jsou složena z padesáti devíti částí a stahovat je po jedné, nebo všechny najednou, to už je rozdíl).

#### Samočinné načítání změn

*Co může dělat stroj, nedělej*

Navíc už má [Caddy](https://caddyserver.com/) spoustu rozšíření a kupříkladu [jedno z nich](https://caddyserver.com/docs/http.git) čeká na [pohlavek z internetu](https://developer.github.com/webhooks/), že by mělo stáhnout nové změny, takže když například v *16:01:15* pošlu změnu na *server s kódem* (což je *jiný* server, než ze kterého běží [drdplus.info](https://www.drdplus.info)), tak v *16:01:25*, po deseti sekundách, už je změna veřejná a ty ji uvidíš (protože *server s kódem* dal pohlavek *serveru se stránkami* ve smyslu "dávej bacha a stáhni si novou verzi").
To hodně pomáhá, protože pak nemám psychický blok nasazovat změny hned, jako kdybych musel ještě někde "mačkat tohleto a potvrzovat támhleto".

#### Je to o energii

*Život je přelévání energie, tak s ní neplýtvej*

Jo, pravdou je, že kdybych se snažil, tak to samé získám s běžným [Apache web serverem](https://httpd.apache.org/) a nemusel bych se se systémem prát, který z těch dvou webových programů bude mít exkluzivní právo na [port 443](https://cs.wikipedia.org/wiki/Seznam_%C4%8D%C3%ADsel_port%C5%AF_TCP_a_UDP), přes který to všechno lítá (což nakonec vyústilo ke smazání Apache, což popravdě taky nebylo úplně samozřejmé, jelikož ta potvora se drží zuby nehty).

Jenže s [Caddy](https://caddyserver.com/) jsem to měl hned a bez práce. Ano, dneska už [Apache podporuje HTTP/2](https://httpd.apache.org/docs/2.4/mod/mod_http2.html) a získání certifikátu pro HTTPS zadarmo od [Let's Encrypt](https://letsencrypt.org/) je [taky hračka](https://www.root.cz/clanky/apache-pridava-podporu-let-s-encrypt-pro-https-staci-jeden-radek-konfigurace/), ale před dvěma lety nebylo, nehledě na to, že to automatické nasazování novinek bych si musel napsat sám.

## Co je hotové, na to nešaháme

*Stránka se posílala rychleji, ale než se poskládala, pro každého znova a znova, to byla taky doba*

Chtělo to kešovat. Cache (čti *keš*) je dočasná paměť (někdy jí říkáme taky *mezipaměť*), která předhodí už známý výsledek, aby se to nepočítalo / nelepilo / nestahovalo znova. A ta má jednu dost ošklivou vlastnost, ať už jde o mezipaměť v hlavě strážníka, který si nepřečetl novou vyhlášku, nebo o chaotickou změť bajtů někde v počítači.
Těžko se totiž hledá ten **správný** okamžik, kdy se to má všechno zahodit a načíst zase znova.

### Slepá kolej

*Když padneš na hubu, zafňukej si, zapamatuj si to a jdi dál, rozumnější než kdy dřív.*

Já to asi před rokem zkoušel s tehdy ještě pořád populární, přestože už označenou jako *zastaralou*, [aplikační keší](https://developer.mozilla.org/en-US/docs/Web/HTML/Using_the_application_cache), což je technologie prohlížečů, která umožňuje **celou** stránku uložit pěkně na tvé straně a kdykoli se chceš na stránku podívat znovu, použije se ta před-uložená stránka z **tvého** počítače, takže je to pak bleskurychlé, protože už se na nic z internetu nečeká.
A taky je peklo tu keš zahodit, když se něco v obsahu změní... a právě proto, že si na tom rozbilo hubu už spousta lidí, a já se přidal, tak je už delší dobu tenhle způsob kešování označený jako *zastaralý*.

Takže jsem si na tom spálil prsty, vyhodil několik desítek hodin práce a celou tu slavnou *aplikační keš* zahodil.
Ale zas jsem se něco přiučil a hlavně jsem při tom zdokonalil kešování na **straně serveru** (to je ta magická krabička někde na druhé straně drátů, která ti to všechno posílá).

## Kešování na serveru

2017

*"Neměl byste náhodou..." "Měl." "A neměl byste to spíš s takovou tou..." "Měl." "Pane jo, to asi nejsem první, kdo to chce, co?" "Ne."*

Možná máš pocit, že někde v internetu čeká jedna celá, úplně hotová stránka. Obvykle to tak skutečně je, ale tu celou stránku nedávají dohromady lidé. My vytváříme kousky a necháváme je lepit dohromady, protože upravovat celou tu stránku najednou, z toho bychom se zcvokli.
Důvody jsou dva:

- většina stránek má něco společného, vzhled, pravidla zobrazení na mobilu, podmínky kešování na straně návštěvníka
  - no kdo by se s tímhle psal dvakrát, neřku-li jedenáctkrát jako v případě všech pravidlových a příběhových stránek [drdplus.info](https://www.drdplus.info), to uznej
- obsah je opravdu rozsáhlý
  - a upravovat něco s 24876 řádky (současná velikost [PPH](https://pph.drdplus.info/?trial=1)) v jediném souboru, to se fakt nedá

Proto mám vytvořený [společný základ pro všechny obsahové stránky](https://github.com/jaroslavtyc/drd-plus-rules-html-skeleton) (a [další pak pro kalkulátory](https://github.com/jaroslavtyc/drd-plus-calculator-skeleton)),
kde řeším všechno společné. Obsah samotný mám pak rozdělený do souborů podle selského rozumu, u každých pravidel zvlášť, třeba `089a Volba zbroje.html`, `090a2 Tabulka zbrojí a přileb.html`, `090a Tabulka zbrojí a přileb - popis.html`, `090b Příprava parametrů.html` a tak dále (jo, řadím si to abecedně).
A tohle se samo poslepuje, vytvoří se z toho výsledná celá stránka a ta se ti pošle.

A když už se to na serveru lepí všechno dohromady, tak už je jen krůček k tomu, aby se to lepilo jen když je potřeba a jinak to do světa posílalo to, co už má z minula.

Zahazování keše je v tomhle případě krásně jednoduché - jakmile na server přistanou nové změny (čehokoli), tak se keš smázne (celá).

### Jak odkazy pomohly kešovat

*Každý krok vpřed otevře dveře po stranách*

Stránka se na serveru kešovala, fungovalo to, nebyl důvod k další změně. Respektive nebyl by, kdyby mi nevadila jedna věc.
Spousta nadpisů a tabulek totiž neměly odkaz. Když jsem chtěl někomu poslat třeba tabulku rychlosti, musel jsem mu říct že *"je to někde dole"*.

Takže jsem [sehnal nástroj](https://github.com/PhpGt/Dom), který schroupe připravenou stránku a několika málo příkazy nacpe ke všem nadpisům, ať už kapitol nebo tabulek, automaticky vytvořený odkaz. A hned bylo s [odkazováním na Tabulku rychlosti](https://pph.drdplus.info/?trial=1#tabulka_rychlosti) veseleji.

Když se něco změní, tak se něco pokazí, a protože mi to nedošlo, tak jsem automatickými odkazy sestřelil [Pravidla pro hráče](https://pph.drdplus.info/?trial=1). Ono totiž *rozsekat* tak velkou HTML stránku, jakou [Pravidla pro hráče](https://pph.drdplus.info/?trial=1) jsou, a každý ten kousek popsat objektem v programu, tak to sežere (alespoň v [PHP](https://php.net)) dost RAMky a jako každý správně vychovaný program, tak i tenhle má pevně nastavený limit, přes který vlak nejede. V tomhle případě to je [výchozích 128 MB](https://php.net/manual/en/ini.core.php), což už nestačilo, stránka padla a já na to přišel až druhý den.
Neboj, pro příště už jsem pojištěný, testuji horem dolem funkčnost stránek nejen před tím, než změny zveřejním, ale teď už i [po jejich zveřejnění](https://uptimerobot.com/), právě abych se už takhle nenachytal (ale o testování radši jindy, to je pohádka na další dlouhou dobrou noc).

Ovšem, když už jsem byl u té automatické změny obsahu (přidávání odkazů k nadpisům), tak už stačilo jen ždibíček, a najednou bylo vyřešeno zahazování keše ve tvém prohlížeči pro každou část, ze které je stránka poskládaná.
A tak ukládání stránky na tvé straně, ve tvém prohlížeči, aby se to všechno nenačítalo pořád znova, zase dostalo po roce smysl.

## Kešování v prohlížeči

2018

*"Ale to jsem já, Karel přece, co blbneš?" "Karel nosí kulichy bez bambulí, ukažte občanku"*

Na serveru už jsem měl kešování vyřešené a mohl jsem se zas věnovat kešování na tvé straně, v prohlížeči. A změny s automatickým přidáváním odkazů mi ukázaly směr.

Jak jsem psal na začátku, největším problémem u keše je vychytat ten okamžik, kdy se to má zahodit (úplně nový rozměr dal tomuhle problému (hlavně) Intel, který má v současnosti zatraceně velký problém se svými procesory, které vlastně [umožňují číst komukoli cokoli](https://www.root.cz/clanky/jak-funguje-spectre-a-meltdown-linux-na-orange-pi-a-zmena-algoritmu-dnssec/) - no, je to složité, ale základní kámen úrazu je právě touha kešovat co nejvíce výsledků a co nejméně je zahazovat).

Takže kdy se má zahodit keš nějaké části stránky? Například kdy se má načíst nový [obrázek koně](https://bestiar.ppj.drdplus.info/images/175.png?version=6434d6bef64654cef24f5529516a16e4)? Když se změní, jasně!
K tomu se hodí prostý otisk obsahu, pro který kdysi dávno (v roce 1991, což je v IT dávno) vynalezl jeden chytrý pán [algoritmus MD5](https://cs.wikipedia.org/wiki/Message-Digest_algorithm), který byl sice původně určený pro skrytí hesel a dalších důvěrností, ale u kterého už dávno zjistili, že moc bezpečný není, a zároveň že je fajn pro rychlé získání krátkého, unikátního otisku (no dobře, [pidi šance na kolizi tu je](https://www.root.cz/clanky/hasovaci-funkce-md5-a-dalsi-prolomeny/)) libovolně dlouhého textu, obrázku a vlastně jakéhokoli obsahu.
Fajn, tak mám unikátní otisk souboru (třeba ona kresba koně má `6434d6bef64654cef24f5529516a16e4`), ale co s tím? Někoho by napadlo měnit pokaždé jméno souboru, protože prohlížeč ho pak **musí** načíst, jelikož pod novým názvem nic kešovaného ještě nemá, takže co třeba `obrazek_kone_6434d6bef64654cef24f5529516a16e4.png`.

Ano, unikátní název je zaručený způsob, jak donutit prohlížeč načíst soubor znovu, i kdyby se lišil byť jen o jediné písmenko, nebo u obrázku o jediný pixel, naštěstí ale nemusíme skutečně *přejmenovávat* soubory, protože z toho by byl pěkný bolehlav.
Stačí totiž k webovému odkazu, který ukazuje na chtěný soubor, něco unikátního *přidat*. S obrázkem koně to pak vyřeším změnou odkazu na `obrazek_kone.png?6434d6bef64654cef24f5529516a16e4`

 - před otazníkem je název souboru, který se **nemění**
 - za otazníkem je takzvaný [query string (asi *řetězec dotazu*?)](https://en.wikipedia.org/wiki/Query_string), kde může být vlastně cokoliv a když je to celé *dohromady* pro tvůj prohlížeč něco nového, tak to považuje za *nový* odkaz, který **musí** načíst

a zahazování keše je vyřešeno.

Další velkou výhodou je, že takhle rozšířený odkaz na soubor platí pořád, i když už je jeho otisk dávno jiný, protože název souboru je vlastně pořád stejný a správný (samotný `obrazek_kone.png` pořád existuje, ať už má otisk jakýkoli, schválně [si to zkus](https://bestiar.ppj.drdplus.info/images/175.png?version=už_mě_koně_vedou)).

Výsledkem je například u [Pravidel pro hráče](https://pph.drdplus.info/?trial=1) namísto přenesených 13.1 MB pouhých 0.4 MB (pouhá 3 %) a místo 17.5 sekundy jenom 7.5 sekundy (je to přeci jen velká stránka a prohlížeč se zapotí, než ji poskládá, i když už o ní *všechno* ví).
A když něco změním, například vzhled odkazů, tak se ti stáhne jen ten změněný mrňavý [soubor se vzhledem (styly)](https://pph.drdplus.info/css/generic/anchors.css?version=f430266ecbf9ceaddc17690121fcb2f5). A to se počítá!

### Vánoční úklid

Inu, pravdou je, že ti na disku zůstane ta *stará verze* souboru, protože tvůj prohlížeč vlastně *neví*, že už to nepotřebuje (nikdo mu to neřekl), ale to už se jaksi moc neřeší, pardon...

Já to například kešuji na rok, takže "samo" se ti to smaže z disku za 356 dní, nebo když to výslovně prohlížeči přikážeš, ale s mazáním historie buď opatrný, můžeš si omylem smazat třeba hesla, uložená k oblíbeným stránkám.

## Hudba budoucnosti

2019

Tohle všechno směřuje, částečně samovolně a podvědomě, částečně řízeně, ke stránkám dostupným i bez internetového připojení. Jak si je jednou načteš, už je budeš mít v prohlížeči uložené a při každé další návštěvě, kdybys třeba jel vlakem přes Pavlov, zasypala tě lavina, zavřeli tě do [Faradaiovy klece](https://www.mobilmania.cz/clanky/mobil-v-aute-a-faradayova-klec/sc-3-a-1108499/default.aspx) nebo tě postihla podobná offline katastrofa, tak se ti [drdplus.info](https://www.drdplus.info) a všechna jeho pravidla (která už sis někdy načetl) budou pořád načítat.

Ale k tomu se ještě musím dopracovat, jelikož se budu se muset naučit [javascriptové Web workers](https://developer.mozilla.org/en-US/docs/Web/API/Web_Workers_API/Using_web_workers).
Jakmile to ale zvládneme, tak se skokově přiblížíme k dalšímu milníku - mít pravidla v telefonu jako *mobilní aplikaci*.

Krleš!

---

- *předchozí [<< 16. 2. 2018 Vyskytla se nám Neviditelná soutěž](2018-02-16-vyskytla_se_nam_neviditelna_soutez.md)*
- *následující [>> 3. 5. 2018 Neviditelná recenze](2018-05-03-neviditelna_recenze.md)*