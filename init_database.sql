-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost
-- Vytvořeno: Ned 07. kvě 2023, 16:18
-- Verze serveru: 10.6.10-MariaDB-log
-- Verze PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `nocvedcu`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Vypisuji data pro tabulku `pages`
--

INSERT INTO `pages` (`id`, `name`, `file`) VALUES
(1, 'Přehled', 'page/dashboard/dashboard.php'),
(2, 'Otázky', 'page/questions/list.php'),
(3, 'Upravit otázku', 'page/questions/edit.php'),
(4, 'Náhodné události', 'page/events/list.php'),
(5, 'Přidat náhodnou událost', 'page/events/add.php'),
(6, 'Upravit náhodnou událost', 'page/events/edit.php'),
(7, 'Přidat otázku', 'page/questions/add.php'),
(8, 'Přehled hráčů', 'page/players/list.php');

-- --------------------------------------------------------

--
-- Struktura tabulky `player`
--

CREATE TABLE `player` (
  `id` int(11) NOT NULL,
  `name` varchar(31) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `token` varchar(256) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `money` int(11) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `display_winner` int(11) NOT NULL DEFAULT 0,
  `complete` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;



-- --------------------------------------------------------

--
-- Struktura tabulky `player_answers`
--

CREATE TABLE `player_answers` (
  `id` int(11) NOT NULL,
  `player` int(11) NOT NULL,
  `question` int(11) NOT NULL,
  `answer` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Vypisuji data pro tabulku `player_answers`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `player_answer_log`
--

CREATE TABLE `player_answer_log` (
  `id` int(11) NOT NULL,
  `player` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  `question` int(11) NOT NULL,
  `money` int(11) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Vypisuji data pro tabulku `player_answer_log`
--


--
-- Struktura tabulky `player_random_event`
--

CREATE TABLE `player_random_event` (
  `id` int(11) NOT NULL,
  `player` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `money` int(11) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Vypisuji data pro tabulku `player_random_event`
--


-- --------------------------------------------------------

--
-- Struktura tabulky `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text COLLATE utf8mb3_czech_ci NOT NULL,
  `CC` text COLLATE utf8mb3_czech_ci NOT NULL,
  `position` int(11) NOT NULL,
  `sound` varchar(255) COLLATE utf8mb3_czech_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_czech_ci;

--
-- Vypisuji data pro tabulku `questions`
--

INSERT INTO `questions` (`id`, `question`, `CC`, `position`, `sound`) VALUES
(1, 'Jak chutná marketing?', 'Ochutnej marketing? Hmmm, na něco jsem dostala chuť. Skočila bych do obchodu, ale nechci se nechat oblbnout marketingem.', 1, 'https://nocvedcu.vse.cz/api/assets/03_ochutnej_marketing_v2.mp3'),
(2, 'Všemi smysly za měnou ', 'Tak hlad jsme zahnali a teď bych si šla něco zjistit o penězích. Koneckonců se jim budeme věnovat celý večer. Pozvala jsem si lidi z ČNB, kteří nám o tom poví více. ', 2, 'https://nocvedcu.vse.cz/api/assets/04_vsemi_smysly_za_menou.mp3'),
(3, 'Rozhodovací procesy', 'Z toho všeho rozhodování se mi už točí hlava. Nejde to nějak jednodušeji? Hmmm. Dnes tady mám kolegy z VŠE, kteří se tomuhle věnují. Pojďme se za nimi podívat.', 3, 'https://nocvedcu.vse.cz/api/assets/05_rozhodovaci_procesy.mp3'),
(4, 'Virtuální občan', 'Hmmm, a co kdybychom spolu začali podnikat? Každej šéf přece bere velké peníze. Našla jsem seznam věcí, které musíme udělat pro založení firmy. Společenská smlouva, bankovní účet, datová schránka… Datová schránka? Co to je? Včera o tom zrovna mluvil kolega. Mohli bychom za ním skočit a dozvědět se víc.', 4, 'https://nocvedcu.vse.cz/api/assets/06_datova_schranka.mp3'),
(5, 'Chceš ušetřit? Zapoj smysly! ', 'Po všech těchto stanovištích mi pořádně vyhládlo, ale obchody už mají zavřeno. Jediné místo, kde něco seženeme k jídlu, je u mě doma ve špajzu. Vždycky toho hodně nakoupím a pak je mi líto to vyhodit. Nejspíše tam budou nějaký starý makaróny, ale můžeme je vůbec sníst? Asi bych si o tom nejdřív něco zjistila.', 5, 'https://nocvedcu.vse.cz/api/assets/07_foodwaste.mp3'),
(6, 'Finanční gramotnost na vlastní oči', 'Nezkusíme bankovnictví? V bankách je přece hodně peněz! To by byla dovolená! Moc o tomto tématu ale nevím. Co se jít něco naučit ohledně trendů v bankovnictví? ', 6, 'https://nocvedcu.vse.cz/api/assets/08_bankovnictvi.mp3'),
(7, 'Nejistota šestého smyslu', 'Brigáda byla fajn, šetřit umím, bankám i podnikání už taky trochu rozumím. Tak si ale rychle na dovolenou nevyděláme. Ty jo. Na Instagramu na mě vyskočila loterie. To je rychlý způsob, jak přijít k penězům, ne? Co tak zkusit trochu štěstí. ', 7, 'https://nocvedcu.vse.cz/api/assets/09_loterie.mp3');

-- --------------------------------------------------------

--
-- Struktura tabulky `questions_answers`
--

CREATE TABLE `questions_answers` (
  `id` int(11) NOT NULL,
  `question` int(11) NOT NULL,
  `answer` text COLLATE utf8mb3_czech_ci NOT NULL,
  `money_change` int(11) NOT NULL,
  `message` text COLLATE utf8mb3_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_czech_ci;

--
-- Vypisuji data pro tabulku `questions_answers`
--

INSERT INTO `questions_answers` (`id`, `question`, `answer`, `money_change`, `message`) VALUES
(1, 1, 'A', -500, 'Nákup 10 prémiových tyčinek tě stál 500,–. '),
(2, 1, 'B', -250, 'Nákup 10 privátních tyčinek tě stál 250,–. '),
(3, 1, 'C', 0, '10 privátních tyčinek sis nechal a 10 jsi prodal za cenu prémiových. Jsi tak na 0,–.'),
(4, 1, 'D', -100, 'Sice sis nic nekoupil, ale hlad byl velkej, no. Na benzínce sis proto musel rychle koupit bagetu. '),
(5, 2, 'A', -2000, 'Bankovka opravdu byla padělek. Ze zákona jsi měl právo ji v případě pochybnosti o její pravosti odmítnout. V ČNB byla bankovka prozkoumána. Pokud by byla pravá, vrátili by ti ji. Jelikož se jedná o padělek, náhrada se neposkytuje. Ztrácíš proto 2 000,–.'),
(6, 2, 'B', -5000, 'Bankovka opravdu byla padělek. Ze zákona jsi měl právo v případě pochybnosti o její pravosti ji odmítnout. Pokud zjistíš, že bankovka nebo mince ve tvém vlastnictví je zřejmě padělaná, nesmíš ji dále použít k placení, protože takové jednání je trestné. Tvoje 2 000,– bankovka je neplatná a navíc tě nachytal jiný obchodník – dostáváš tedy pokutu 3 000,–. Ztrácíš proto celkem 5 000,–.'),
(7, 2, 'C', 0, 'Bankovka opravdu byla padělek. Ze zákona jsi měl právo ji v případě pochybnosti o její pravosti odmítnout. Obchodník ti tedy vrátil peníze formou dvou 1 000,–. Nic jsi tak neztratil a nedostal jsi ani pokutu za placení padělkem.'),
(8, 2, 'D', -2000, 'Bankovka opravdu byla padělek. Ze zákona jsi měl právo ji v případě pochybnosti o její pravosti odmítnout. Policie ČR předá podezřelou bankovku České národní bance. Pokud by byla pravá, vrátili by ti ji. Jelikož se jedná o padělek, náhrada se neposkytuje. Ztrácíš proto 2 000,–.'),
(9, 3, 'A', -7000, 'Utratil jsi spoustu peněz za vytvoření data miningového modelu (neuronové sítě), který ve skutečnosti k ničemu nepotřebuješ. Fotky již byly přiřazeny ke konkrétním produktům – není tedy nutné automatizovaně rozpoznávat, co na které fotce je. Ztrácíš proto 7 000,–.'),
(10, 3, 'B', 7000, 'Zvolil jsi dobře. Jelikož nejde o nový e-shop, ale o společnost s historií většího množství objednávek, lze pomocí asociačních pravidel zjistit zboží často kupované společně. Náleží ti odměna 7 000,–.'),
(11, 3, 'C', -1750, 'U malé části zákazníků tato varianta zabere, ale víc bude těch, kteří budou nespokojení a budou vracet chybně doporučené příslušenství. Ztrácíš proto 1 750,–.'),
(12, 3, 'D', 0, 'Prodeje příslušenství se sice zvýšily, ale s ohledem na odměnu pro brigádníky se žádný zisk nekoná. Jsi tak na 0,–.'),
(13, 4, 'A', 2500, 'Za projevení znalostí v oblasti datových schránek ti náleží odměna 2 500,–. '),
(14, 4, 'B', -1000, 'Za nevyzvednutou datovou zprávu ti byla udělena pokuta 1 000,–.'),
(15, 4, 'C', -4000, 'Datová schránka ti byla automaticky zřízena, za nekontrolování datové schránky ti byla udělena pokuta 4 000,–.'),
(16, 4, 'D', 5000, 'Za projevení velkých znalostí v oblasti datových schránek ti náleží odměna 5 000,–.'),
(17, 5, 'A', 25, 'Koupil jsi mouku a vejce, které ale kupovat nebylo potřeba, ušetřili jsi za marmeládu a olej. Mléko bylo potřeba koupit. Za ušetřené potraviny získáváš 25,–.'),
(18, 5, 'B', 100, 'Koupil jsi vejce, které kupovat nebylo potřeba, ušetřil jsi za marmeládu, mouku a olej. Mléko bylo potřeba koupit. Za ušetřené potraviny získáváš 100,–.'),
(19, 5, 'C', 170, 'Koupil jsi pouze mléko a ušetřil tak 170,– za všechny zbylé potraviny. '),
(20, 5, 'D', -170, 'Koupil jsi vejce, mouku, marmeládu a olej, které kupovat nebylo potřeba – zbytečně jsi tak vyhodil 170,–. Mléko bylo potřeba koupit.'),
(21, 6, 'A', -3000, 'Bohužel, klientovi jsi poradil špatně. Ideální je porovnávat RPSN. Musíš mu tedy dorovnat ztrátu 3 000,–. Nic jsi nevydělal, jen ztratil.'),
(22, 6, 'B', 0, 'Nic jsi neztratil. Pokud by sis ale v budoucnu vybíral hypotéku, ideální by bylo využít pro hodnocení výhodnosti úvěru RPSN.'),
(23, 6, 'C', 3000, 'Zvolil jsi skvěle! Je to nejlepší způsob, jelikož na rozdíl od pouhého porovnání úrokové sazby sleduješ i dalši náklady. Klient ti proto vyplatil odměnu za dobrou radu. Získáváš 3 000,–. '),
(24, 6, 'D', 1500, 'Zvolil jsi sice spravnou metriku, ale zbytečně jsi počítal, jelikož banka má povinnost sdělit výši RPSN. Klient ti sice vyplatí odměnu, ale menší kvůli prodlení z toho, že jsi ztrácel čas výpočty. Získáváš tak jen 1 500,–.'),
(25, 7, 'A', -1000, 'Za 2 000,– sis koupil 10 losů. Vyhrál jsi 1 000,–. Celkově tak ztrácíš 1 000,–.'),
(26, 7, 'B', -200, 'Utratil jsi 200,– za 1 herní lístek, bohužel los nebyl výherní. Ztrácíš tak celkem 200,–.'),
(27, 7, 'C', -400, 'Utratil jsi 400,– za 2 herní lístky, bohužel ani jeden los nebyl výherní. Ztrácíš tak celkem 400,–.'),
(28, 7, 'D', 0, 'Rozhodl ses správně a nekoupil si žádné losy, protože očekávaná ztráta ze hry je vyšší než očekávaná výhra. Ochránil jsi své peníze.'),
(29, 10, 'sdsd', 6333, 'dsdsdds'),
(30, 10, 'dsdsdsd', 9999, 'dsdsdsd'),
(31, 10, 'ssdsdd', 3333, 'sdsdsdds');

-- --------------------------------------------------------

--
-- Struktura tabulky `random_events`
--

CREATE TABLE `random_events` (
  `id` int(11) NOT NULL,
  `text` text COLLATE utf8mb3_czech_ci NOT NULL,
  `kod` varchar(255) COLLATE utf8mb3_czech_ci NOT NULL,
  `money_change` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_czech_ci;

--
-- Vypisuji data pro tabulku `random_events`
--

INSERT INTO `random_events` (`id`, `text`, `kod`, `money_change`) VALUES
(2, 'Máme pro tebe dobrou a špatnou zprávu. Ta dobrá je, že jsi právě přišel k penězům 5 000,–. Ta špatná je, že ti umřela babička.', 'JNDGU9', 5000),
(3, 'Dostal jsi výpověď v práci. Čeká tě 6měsíční odstupné v celkové výši 30 000,–.', 'XLQSZM', 30000),
(4, 'Gratuluji! Vsadil jsi na šťastná čísla a tentokrát ti to konečně vyšlo. V loterii jsi vyhrál 5 000,–.', 'UK5FZ2', 5000),
(5, 'Rodiče ti v minulosti založili stavební spoření a nyní konečně přišel čas ho vybrat. Získáváš 10 000,–.', 'JTLZ8N', 10000),
(6, 'V práci jsi nenahraditelným členem týmu. Za obdivuhodný výkon si zasloužíš prémii. Získáváš 5 000,–.', 'L964R6', 5000),
(7, 'Na stará kolena... Dlouhodobě tě trápí koleno a bolest je už neúnosná. Doktor ti naplánoval operaci. Rekonvalescence bude delší, proto ztratíš příjmy. Pojišťovna nekryje veškeré výdaje. Ztrácíš 10 000,–.', 'LDTMQV', -10000),
(8, 'Konečně je to tu. Narodilo se ti dítě, je to kluk (3 kg). S tím přichází i zvýšené výdaje. Ztrácíš 30 000,–.', 'B6F2U9', -30000),
(9, 'Na autě ti odešel výfuk motoru. Bez auta nemůžeš normálně fungovat a je tedy nutné ho opravit. Ztrácíš 5 000,–.', '3273G4', -5000),
(10, 'Poslední dny ti zlobila myčka a dnes bohužel přišel den, kdy nádobí umyla naposled. Na ruční mytí nemáš čas, navíc se při něm plýtvá vodou – je to neekologické a neekonomické. Rozhodneš se pro koupi nové myčky. Ztrácíš 5 000,–.', 'SUB5R2', -5000),
(11, 'Vstát levou nohou. Zaspal jsi, jedeš pozdě do práce a překročíš povolenou rychlost. Nejenže dostaneš v práci vynadáno od šéfa, ale navíc, jako třešnička na dortu, ti přiletí pokuta, kterou musíš zaplatit. Ztrácíš 5 000,–.', '22N45K', -5000),
(12, 'Dobrá investice. Vzhledem ke stoupajícím cenám energií chce mnoho zákazníků vlastní zdroj energie. Investice se ti vrátila i s něčím navíc. Získaváš 5 000,–.', 'KNVAWQ', 5000),
(13, 'Velká škoda. Vzhledem k rostoucí poptávce po vlastním zdroji energie jsi promrhal dobrou příležitost si něco přivydělat. Takhle jsi na 0,–. ', '8HJ3H5', 0),
(14, 'Bohužel se ti dnes nedařilo, asi špatné karty nebo co. Prohrál jsi v kartách 5 000,–.', 'KUZ6X8', -5000),
(15, 'Dobré rozhodnutí. Celou hru se dařilo pouze jednomu hráči, který nakonec navíc podváděl. Vyhnul ses tak ztrátě peněz.', '7C6A4Q', 0),
(16, 'Máš vytopený barák! Naštěstí díky tvé obezřetnosti to vše pokryje pojišťovna a tebe to nebude stát ani vindru. Zaplatil jsi akorát 200,– za pojistku. Vyhnul ses tak ztrátě 5 000,– za opravu baráku. ', 'ZYSCFE', -200),
(17, 'Bohužel ti záplavy vytopily celý barák a ty jsi bez pojištění. Pokud nechceš bydlet na ulici, tak musíš zaplatit opravu. Ztrácíš 5 000,–.', 'PVHZSD', -5000),
(18, 'Dobře jsi udělal, kdybys pokračoval dál, škoda na autě by byla vyšší. Pokud bys do servisu nešel, odtah a následná oprava by tě navíc vyšly na 3 000,–. Takhle platíš pouze 300,– za servis.', 'UDV4AQ', -300),
(19, 'Je to tu. Auto ti zastavilo u krajnice a už nejde nastartovat. Pokud nechceš auto tlačit, tak si budeš muset zavolat odtahovku. Odtah a oprava nebude levná záležitost. Ztrácíš 3 000,–.', 'J53KR3', -3000),
(20, 'Bohužel, kurz kryptoměn zrovna začal padat a prodal jsi se ztrátou. Ztrácíš navíc ještě 1 000,–. ', 'VML3UB', -3000),
(21, 'Dobře jsi udělal. Kurz kryptoměn spadnul a jelikož jsi neinvestoval, tak nemáš žádnou ztrátu. Za rozumné investiční smýšlení získáváš odměnu 3 000,–.', 'E2UAMD', 3000),
(22, 'Jezdit načerno se nevyplácí a ty to dobře víš. Cestou do práce tě zkontrolovali revizoři – všechno v pořádku. Za rozumné smýšlení získáváš odměnu 2 000,–.', '7T6B8J', 1800),
(23, 'Chytili tě. Revizoři na hlaváku tě chytili bez lístku a dali ti mastnou pokutu. Ztrácíš 2 000,–.', 'K7Q6U3', -2000),
(24, 'Chytré rozhodnutí. V servisu ti řekli, že by se pračka do týdne rozbila a vyšlo by tě to daleko dráž. Za chytré rozhodnutí získáváš odměnu 1 000,–.', 'XP3PPJ', 900),
(25, 'Ajaj! Tvoje pračka se rozbila a vytopila souseda. Budeš muset zaplatit škody a opravu. Ztrácíš 2 000,–.', 'NSC8G7', -2000),
(26, 'Bohužel kamarád nevěděl nic nového, ani užitečného. Částku 300,– jsi zaplatil zbytečně. ', '734QPD', -300),
(27, 'Dobře ses rozhodnul. Kamarád totiž nevěděl nic nového, ani užitečného. Za chytré rozhodnutí získáváš odměnu 1 000,–.', 'FCBH7Z', 1000),
(28, 'Gratuluji! Ceny akcií Coca-Coly vzrostly a prodal si je s mírným profitem. Získáváš 5 000,–.', 'VQJ9E8', 5000),
(29, 'Škoda. Promrhaná šance. Akcie Coca-Coly mírně vzrostly, byl bys v plusu. Takhle jsi na 0,–. ', 'AGH246', 0),
(30, 'Tentokrát to nevyšlo. Nepadlo žádné z tvých vybraných čísel. Tiket jsi koupil za 200,–.', 'CLMQW2', -200),
(31, 'Úspěšně ses vyhnul zbytečné ztrátě peněz. Šance vyhrát hlavní cenu je zhruba jedna ku čtrnácti milionům. Za chytré rozhodnutí získáváš odměnu 1 000,–.', '3F2MRT', 1000);

-- --------------------------------------------------------

--
-- Struktura tabulky `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(127) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Vypisuji data pro tabulku `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `ip`) VALUES
(1, 'admin@admin.com', '$argon2id$v=19$m=65536,t=4,p=1$MHNCbTEuYVgybVFjNk9ybw$7Hsihc5TBMfFvc76W60CbU9dM+6i7qqcKA+ifHv+5ts', ''),

-- --------------------------------------------------------

--
-- Struktura tabulky `user_cookie`
--

CREATE TABLE `user_cookie` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;



--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `player_answers`
--
ALTER TABLE `player_answers`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `player_answer_log`
--
ALTER TABLE `player_answer_log`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `player_random_event`
--
ALTER TABLE `player_random_event`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `questions_answers`
--
ALTER TABLE `questions_answers`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `random_events`
--
ALTER TABLE `random_events`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `user_cookie`
--
ALTER TABLE `user_cookie`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT pro tabulku `player`
--
ALTER TABLE `player`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT pro tabulku `player_answers`
--
ALTER TABLE `player_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT pro tabulku `player_answer_log`
--
ALTER TABLE `player_answer_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT pro tabulku `player_random_event`
--
ALTER TABLE `player_random_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT pro tabulku `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT pro tabulku `questions_answers`
--
ALTER TABLE `questions_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT pro tabulku `random_events`
--
ALTER TABLE `random_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT pro tabulku `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT pro tabulku `user_cookie`
--
ALTER TABLE `user_cookie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
