<?php
include_once __DIR__ . '/../configuration.php';
include_once __DIR__ . '/../utility.php';
include_once __DIR__ . '/connection.php';
include_once __DIR__ . '/query.php';

mysqli_query_trace($connection, $CRAETE_DATABASE_QUERY, 'Unable to create database: ' . $DB_NAME);
mysqli_select_db($connection, $DB_NAME);
mysqli_query_trace($connection, $CREATE_TABLE_IMAGE_QUERY, 'Unable to create table: images');
mysqli_query_trace($connection, sprintf($CREATE_TABLE_SECTION_QUERY, 'it'), 'Unable to create table: sections_it');
mysqli_query_trace($connection, sprintf($CREATE_TABLE_SECTION_QUERY, 'en'), 'Unable to create table: sections_en');

set_database_content();

function set_database_content()
{
    global $connection, $INSERT_IMAGES_QUERY;
    // mysqli_query($connection, sprintf($INSERT_IMAGES_QUERY, "https://media.tenor.com/x8v1oNUOmg4AAAAS/rickroll-roll.gif"));

    $headings_en = [
        'THE BIG BLUE',
        'THE ORIGINS',
        'THE MAINFRAME MARK 1',
        'THE DISKETTE',
        'THE BARCODE',
        'THE MOTHERBOARD',
        'THE DRAM',
        'FORTRAN',
        'COBOL',
        'THE RELATIONAL MODEL',
        'SQL',
        'THINKPAD extension',
        'REDHAT extension',
        'OPEN SOURCE',
        'MAINFRAME',
        'SIMULTANEOUS MULTITHREADING',
        'CRYPTOGRAPHIC SPLITTING',
        'ASYMMETRIC CRYPTOGRAPHY',
        'BLOCKCHAIN',
        'HARVARD ARCHITECTURE',
        'QUANTUM COMPUTING',
        'IBM AND THE HOLOCAUST',
        'IBM AND WORLD WAR II',
        'IBM IN ITALY',
        'IBM and NASA'
    ];

    $paragraphs_en = [
        'The International Business Machines Corporation (IBM) is a US company, the oldest and
among the largest in the world in the computer sector. It manufactures and markets
computer hardware and software, middleware and IT services, offering infrastructure,
hosting and cloud computing services, artificial intelligence, quantum computing and IT
and strategic consulting (related to mainframes and nanotechnologies).',

        'In 1885, the engineer Julius Pitrat patented the
first Computing Scale: the first scale capable of
automatically calculating the price based on
weight and product.
Later, in 1888, Alexander Dey invents the first
cash register. In 1889, the Bundy brothers
invented a clock that could record the time of
their employees.',

        'IBM created the first US electromagnetic calculator, whose architecture was designed
by university physicist Howard H. Aiken of Harvard University.',

        'External memory magnetic support most used in the world between 1970 and 1990.
Icon of digital archiving, it is used by UI Designers to represent data saving. The data was stored on a thin flexible disk divided into sectors and tracks. The operation is similar to that of HDDs.',

        'The idea of creating a single coding for various commercial products was introduced in
the 1950s by Norman Joseph Woodland and Bernard Silver.
Unfortunately, the technological development of the time did not allow the realization of
the project. In 1972 Norman J. Woodland developed the Universal Product Code (UPC)
at IBM. To adopt the UPC standard in Europe, the European Article Numbering
Association was born, of which Italy was one of the founders.',

        'In 1981, the first modern form of motherboard was born, the planner.
In the past, the components were soldered on top of the mainboards. 
IBM revolutionized PC design with the first AT motherboard, becoming the modern standard.',

        'Dynamic random access memory where each
bit is stored in a capacitor and the state (0 and
1) is represented by the number of electrons
present in the latter. When the capacitor loses
charge, the contents are lost. To maintain the
information, the capacitor is periodically
recharged.',

        'It was born in the 1950s for the program hello5INF4
development of engineering scientific research software. 
Used for sixty years in mainframes in which it is still found today.',

        'Compiled HELLO imperative procedural language that was primarily
used in business, finance, and administrative management of government systems. Today it
is used in mainframes',

        'The relational model for database management was invented by Edgar Frank at IBM and
marked, together with SQL, the standard for managing data and related information.
Nowadays they are a valid asset for data management and collide with the non-relational
model better known as NoSQL.
It determined the direction of modern software and data collection.',

        'Language for interacting with databases, allows you to make
queries. Invented by Donald D. Chamberlin and Raymond F.
Boyce after working with Edgar. 
With the birth of RDBMSs that they query, the world of data
begins to rely on SQL code. Today it remains a valuable tool
used by small companies for customer data management
and by large multinationals in areas such as data science,
big data and machine learning.',

        'In 1992, IBM created and marketed the famous
laptop with an iconic shape. The design, conceived by Richard Sapper and the IBM
Design Center in Yamato (Japan), takes up the image of a pack of cigars.
In 2005, it sold its personal computer business to Lenovo, marking IBMs exit from the PC
market.',

        'On October 28, 2018, IBM acquires, for the modest sum of 34 billion dollars,
RedHat, a well-known company dedicated to the development and support of free and open source
software in corporate environments. 
Furthermore, IBM is the company that has contributed and contributes the most to the Linux project.',

        'IBM has contributed to the use of open source software at the enterprise level: by making
Java Apache Derby, Eclipse IDE.
He made a huge contribution to the development of the Linux kernel by investing forty
million and was among the first supporters of Docker and Kubernetes',


        'With the advent of the electronic calculator, IBM concentrates on the production of
Mainframes, becoming the leader in the sector and, to date, positioning itself among the
first in the world.
In 1952 IBM produced large-scale IBM 700/7000 servers made with vacuum tubes which
will later be replaced by transistors.',

        'Another important invention of IBM is simultaneous multithreading,
developed in 1968 during the ACS-360 project, consisting of 2
supercomputers never built, however it has led to numerous
discoveries. Simultaneous multithreading allows individual running
threads to make the most of the resources of modern processors.
Its operation consists in allowing the execution in one stage of the
pipeline (chain of instructions) of several instructions (even coming
from different threads), this becomes more and more
advantageous as the threads increase for each processor core
(usually 2, but some models can reach 8).',

        'Cryptographic splitting is a technique for securing data
over a computer network. The technique involves
encrypting data, splitting the encrypted data into
smaller data units, distributing those smaller units to
different storage locations, and then further encrypting
the data at its new location. With this process, the data is
protected from security breaches, because even if
an intruder is able to retrieve and decrypt one data unit,
the information would be useless.',

        'Asymmetric encryption is a method that is
used to encrypt messages, it is based on
public and private key. The public key is
seen by everyone and uses to encrypt
the symmetric key. The private key will
then be used to decrypt the message.',

        'The Blockchain is a set of technologies in which
the registry has a chain of blocks containing the
transactions and the consent is distributed on all the
nodes of the network. All nodes can participate
in the validation process of the transactions
to be included in the register.',

        'Harvards architecture provides for the subdivision into two distinct mories for code and
for data: unlike the classical architecture (of von Neumann) which had a single bus for
instructions and data, the architecture conceived by Akin sees two separate buses to
carry instructions and data to the processor. The architecture allows for greater
parallelization but involves high complexity within the processor (circuit and schematics).
It is used in microcontrollers and digital signal processors (DSPs).',

        'Emerging technology that exploits the laws of
quantum mechanics to solve insurmountable computational problems of
classical and modern architectures.',

        'Dehomag designed the systems to inventory spare parts for Luftwaffe
aircraft, control railway timetables for the Reichsbahn, and register
Jews within the population for the Reich Statistical Office. Because of
the almost unlimited need for tabulators that characterized Hitlers racial
and geopolitical wars, IBM New York reacted enthusiastically to the
promises of Nazism. Dehomag executives were devoted to the
Nazi movement, New York understood this from the start.
Hedigner, a Nazi fanatic, considered Dehomags unique ability to
saturate the Reich with demographic information almost divine . The
new role that Dehomag was to play was manifested during
the opening of an IBM plant in Berlin. Willy Heidinger said: I consider it
almost a sacred mission and I pray that the blessing of heaven
descends on this place.',

        'In the United States, IBM was the subcontractor for the Japanese
internment camp punch card project. IBMs equipment was also used
for cryptography by organizations in the US Army and Navy. The
company developed and built the calculator used to perform the
calculations for the Manhattan Project. Edwin Black, in the 2001 book
entitled IBM and the Holocaust, came to the conclusion that IBMs
business activities in Germany during World War II make it morally
complicit in the Holocaust.',

        'IBM sets foot in Italy as the Società Internazionale Macchine Commerciali (SIMC) managed
by Giulio Vuccino, head of IBM after the First World War.
The Banca Commerciale Italiana acquires the IBM 405 which will be used in the various
banking offices. In 1947 the company was renamed IBM Italia.
In 1928 the first office was opened in Milan (11 employees). In 1930 an office was opened
in Rome. In 1939, the Alphabetical Accounting Machine (IBM 405) was produced.',

        'Even before the collaboration between IBM
and NASA, in the 1940s the US Navy used
an IBM computer model to determine
the trajectories of artillery shells.
The first steps in the space sector
came the following decade, in the 1950s,
when IBM collaborated with the US Naval
Research Laboratory which used one of
its computers to carry out the
calculations necessary for the launch of small satellites.'
];

    $headings_it = [
        'THE BIG BLUE',
        'LE ORIGINI',
        'IL MAINFRAME MARK 1',
        'IL DISKETTE',
        'IL CODICE A BARRE',
        'LA SCHEDA MADRE',
        'LA DRAM',
        'FORTRAN',
        'COBOL',
        'IL MODELLO RELAZIONALE',
        'SQL',
        'THINKPAD',
        'REDHAT',
        'OPEN SOURCE',
        'MAINFRAME',
        'MULTITHREADING SIMULTANEO',
        'SCISSIONE CRITTOGRAFICA',
        'CRITTOGRAFIA ASIMMETRICA',
        'BLOCKCHAIN',
        'ARCHITETTURA DI HARVARD',
        'IBM AND THE HOLOCAUST',
        'IBM E LA SECONDA GUERRA MONDIALE',
        'IBM IN ITALIA',
        'IBM e NASA'
    ];

    $paragraphs_it = [
        'LInternational Business Machines Corporation (IBM) è unazienda statunitense, la più anziana e tra le maggiori al mondo nel settore informatico. Produce e commercializza hardware e software per computer, middleware e servizi informatici, offrendo infrastrutture, servizi di hosting e cloud computing, intelligenza artificiale, quantum computing e consulenza nel settore informatico e strategico (in merito ai mainframe e nanotecnologie).',
        'Nel 1885, l\’ingegnere Julius Pitrat brevetta la prima Computing Scale: la prima bilancia in grado di calcolare automaticamente il prezzo in baso al peso e al prodotto. Successivamente, nel 1888, Alexander Dey inventa il primo registratore di cassa. Nel 1889, i fratelli Bundy inventarono un orologio in grado di registrare l\’orario dei propri dipendenti.',
        'L\’IBM realizzò il primo calcolare elettromagnetico statunitense, la cui architettura venne ideata dal fisico universitario Howard H. Aiken dell\’università di Harvard.',
        'Supporto magnetico di memoria esterna più utilizzato nel mondo tra il 1970 e il 1990. Icona della archiviazione digitale, viene utilizzata dagli UI Designer per rappresentare il salvataggio dei dati. I dati venivano memorizzati su un sottile disco flessibile suddiviso in settori e tracce. Il funzionamento simile a quello degli HDD.',
        'L\’idea di realizzare una codifica unica per i vari prodotti commerciali venne introdotta negl\’anni cinquanta da Norman Joseph Woodland e Bernard Silver. Purtroppo, lo sviluppo tecnologico del tempo non permise la realizzazione del progetto. Nel 1972 Norman J. Woodland sviluppa presso IBM l\’Universal Product Code (UPC). Per adottare lo standard UPC in Europa, nasce la European Article Numbering Association di cui l\’Italia fu una dei fondatori.',
        'Nel 1981, nasce la prima forma moderna di scheda madre, il “planner”. In passato, le componenti venivano saldate sopra i “mainboard”. IBM rivoluziona la struttura dei PC con la prima scheda madre AT, diventando lo standard moderno.',
        'Memoria ad accesso casuale dinamica dove ogni bit viene immagazzinato in un condensatore e lo stato (0 e 1) viene rappresentato dal numero di elettroni presenti in quest\’ultimo. Quando il condensatore perde la carica, il contenuto viene perso. Per mantenere l\’informazione, il condensatore viene periodicamente “ricaricato”.',
        'Nasce negli anni 50 per lo sviluppo di software di ricerca scientifica e ingegneristico. Viene utilizzato da sessant\’anni nei mainframe nei quali viene ritrovato tutt\’oggi .',
        'Linguaggio procedurale imperativo compilato che veniva principalmente impiegato nelle aziende, nella finanza e nella gestione amministrativa di sistemi governativi . Oggi viene usato nei mainframe .',
        'Il modello relazionale per la gestione dei database venne inventato da Edgar Frank presso IBM e ha segnato, assieme a SQL, lo standard per la gestione dei dati e delle informazioni tra loro collegate. Oggi giorno sono una risorsa valida per la gestione dei dati e si scontrano con il modello non relazionale meglio noti come NoSQL. Ha determinato la direzione del software moderno e della raccolta dati.',
        'Linguaggio per l\’interazione con i database, permette di effettuare query. Inventato da Donald D. Chamberlin e Raymond F. Boyce dopo aver lavorato con Edgar. Con la nascita dei RDBMS di cui effettuano le query, il mondo dei dati inizia a basarsi sul codice SQL. Oggi rimane un valido strumento utilizzato dalle piccole aziende per la gestione dei dati dei clienti e dalle grandi multinazionali in aree quali datascience, big data e machine learning.',
        'Nel 1992 IBM crea e commercializza il celebre laptop dalla forma iconica. Il design, concepito da Richard Sapper e l\’IBM Design Center a Yamato (Giappone), riprende l\’immagine di un pacchetto di sigari. Nel 2005, vende il proprio ramo dei personal computer a Lenovo segnando l\’uscita da parte di IBM dal mercato dei PC.',
        'Il 28 Ottobre 2018, IBM acquista, per la modica cifra di 34 miliardi di dollari, RedHat, nota società dedita allo sviluppo e supporto del software libero e open source negli ambienti aziendali. Inoltre, IBM è l\’azienda che ha contribuito e contribuisce maggiormente allo progetto Linux.',
        'IBM ha contribuito all\’uso di software open source a livello aziendale: realizzando Java Apache Derby, Eclipse IDE. Ha dato un fortissimo contributo nello sviluppo del Kernel Linux investendo quaranta milioni e fu tra i primi sostenitori di Docker e Kubernetes.',
        'Con l\’avvento del calcolatore elettronico IBM si concentra nella produzione di Mainframe diventando il leader del settore e, ad oggi, posizionandosi tra i primi al modno. Nel1952 IBM produsse server di larga scala IBM 700/7000 realizzati mediante tubi a vuoto che successivamente verranno sostitutiti dai transistor.',
        'Unaltra importante invenzione di IBM è il multithreading simultaneo, sviluppato nel 1968 durante il progetto ACS-360, consistente in 2 supercomputer mai realizzati, esso ha comunque portato a numerose scoperte. Il multithreading simultaneo permette ai singoli threads in esecuzione di sfruttare al meglio le risorse dei moderni processori. Il suo funzionamento consiste nel permettere lesecuzione in uno stage della pipeline (catena di istruzioni) di più istruzioni (anche provenienti da diversi thread), questo diventa sempre più vantaggioso allaumentare dei thread per ogni core del processore (di norma 2, ma alcuni modelli possono arrivare ad 8).',
        'La suddivisione crittografica è una tecnica per proteggere i dati su una rete di computer. La tecnica prevede crittografia dei dati, suddividendo i dati crittografati in unità di dati più piccole, distribuendo quelle unità più piccole a diverse posizioni di archiviazione e quindi unulteriore crittografia i dati nella nuova posizione. Con questo processo, i dati sono protetto da violazioni della sicurezza, perché anche se an intruso è in grado di recuperare e decrittografare ununità di dati, il le informazioni sarebbero inutili.',
        'La crittografia asimmetrica è un metodo che si utilizza per crittografare i messaggi, è basato su chiave pubblica e privata. La chiave pubblica viene vista da tutti e utilizza per criptare la chiave simmetrica. La chiave privata verrà utilizzata poi per decriptare il messaggio.',
        'La Blockchain è un insieme di tecnologie in cui il registro sia ha una catena di blocchi contenenti le transazioni e il consenso è distribuito su tutti i nodi della rete. Tutti i nodi possono partecipare al processo di validazione delle transazioni da includere nel registro.',
        'Larchitettura di Harvard prevede la suddivisione in due morie distinte per il codice e per i dati: a differenza dellarchitettura classica (di von Neumann) che disponeva di un bus unico per istruzioni e dati, larchitettura ideata da Akin vede due bus distinti per trasportare istruzioni e dati al processore. Larchitettura consente una parallelizzazione maggiore comportando però elevata complessità allinterno del processore (circuito e schemi).',
        'La Dehomag progettava i sistemi per inventariare i pezzi di ricambio degli aerei della Luftwaffe, controllare gli orari ferroviari per la Reichsbahn e registrare gli ebrei allinterno della popolazione per lUfficio di statistica del Reich. Per via dellesigenza quasi illimitata di tabulatrici che caratterizzava le guerre razziali e geopolitiche di Hitler, l\’Ibm New York reagì con entusiasmo alle promesse del nazismo. I dirigenti della Dehomag erano devoti al movimento nazista, New York lo comprese sin dallinizio. Hedigner, un fanatico dei nazismo, considerava quasi una vocazione divina la capacità unica della Dehomag di saturare il Reich di informazioni demografiche. Il nuovo ruolo che la Dehomag avrebbe svolto si manifestò durante linaugurazione di uno stabilimento dell\’Ibm a Berlino. Willy Heidinger disse: «La considero quasi una missione sacra e prego affinché la benedizione del cielo scenda su questo luogo».',
        'Negli Stati Uniti IBM è stata il subappaltatore per il progetto delle schede perforate dei campi di internamento giapponesi. Lattrezzatura di IBM fu utilizzata anche per la crittografia dalle organizzazioni dellesercito e della marina degli Stati Uniti. Lazienda ha sviluppato e costruito il calcolatore utilizzato per eseguire i calcoli per il progetto Manhattan. Edwin Black, nel libro del 2001 intitolato IBM and the Holocaust, è giunto alla conclusione che le attività commerciali di IBM in Germania durante la seconda guerra mondiale la rendono moralmente complice dellOlocausto.',
        'IBM mette piede in Italia come la Società Internazionale Macchine Commerciali (SIMC) gestita da Giulio Vuccino vertice dellIBM dopo la prima guerra mondiale. Nel 1928 viene aperto il primo ufficio a Milano (11 dipendenti). Nel 1930 viene aperta una sede a Roma. Nel 1939 viene prodotto la Alphabetical Accounting Machine (IBM 405). La Banca Commerciale Italiana acquisisce lIBM 405 che verrà utilizzata nelle vari sedi bancarie. Nel 1947 lazienda viene rinominata IBM Italia.',
        'Prima ancora della collaborazione tra IBM e NASA, negli anni ‘40 la US Navy utilizzò un modello di calcolatore IBM per determinare le traiettorie dei proiettili di artiglieria. I primi passi nel settore spaziale arrivarono il decennio successivo, negli anni ‘50, quando IBM collaborò con lo US Naval Research Laboratory che impiegò uno dei suoi computer per effettuari i calcoli necessari al lancio di piccoli satelliti.',
    ];

    for ($i = 0; $i < count($headings_it); $i++) {
        // insert_section('en', htmlspecialchars($headings_en[$i]), htmlspecialchars($paragraphs_en[$i]), '1');
        // insert_section('it', htmlspecialchars($headings_it[$i]), htmlspecialchars($paragraphs_it[$i]), '1');
    }

}