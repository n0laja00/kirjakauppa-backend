CREATE DATABASE IF NOT EXISTS KIRJAKAUPPA; 

 

CREATE TABLE Asiakas ( 

asNro INT PRIMARY KEY AUTO_INCREMENT, 

asEtunimi VARCHAR(20), 

asSukunimi VARCHAR(20), 

lahiosoite VARCHAR(50), 

postitmp VARCHAR(30), 

postiNro VARCHAR(10), 

puhNro VARCHAR(15), 

email VARCHAR(80) ,

yritys varchar(20)


); 

 

CREATE TABLE Tilaus ( 

tilausNro INT PRIMARY KEY AUTO_INCREMENT, 

asNro INT, 

tilauspvm DATETIME DEFAULT CURRENT_TIMESTAMP, 

toimitustapa CHAR(10), 

maksutapa CHAR(10), 

postitmp VARCHAR(30), 

postiNro VARCHAR(10), 

lahiosoite VARCHAR(50),

FOREIGN KEY (asNro) REFERENCES Asiakas (asNro) 


); 

 

CREATE TABLE Julkaisija( 

julkaisijaNro smallint PRIMARY KEY AUTO_INCREMENT, 

julkaisija VARCHAR(25) not null, 

puhNro VARCHAR(15), 

email VARCHAR(80) 

); 

 

CREATE TABLE Kirja ( 

kirjaNimi VARCHAR(30) not null, 

kirjaNro INT AUTO_INCREMENT, 

sivuNro SMALLINT, 

hinta DECIMAL(9,2), 

ale FLOAT (3, 2) DEFAULT 1, 

kustannus DECIMAL(9,2), 

kuvaus text, 

kuva VARCHAR(30), 

julkaisijaNro smallint not null, 

julkaistu timestamp, 

luotu TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 

 

PRIMARY KEY (kirjaNro), 

FOREIGN KEY (julkaisijaNro) REFERENCES Julkaisija (julkaisijaNro) 

); 

 

CREATE TABLE Arvostelu ( 

arvosteluNro INT PRIMARY KEY AUTO_INCREMENT, 

nimimerkki varchar(10) NOT NULL, 

otsikko varchar(15) NOT NULL, 

teksti TEXT, 

arvosana smallint,

luotu timestamp default current_timestamp(), 

kirjaNro INT, 

FOREIGN KEY (kirjaNro) REFERENCES Kirja(kirjaNro) 

); 

 

CREATE TABLE Kategoria ( 

kategoria VARCHAR(20) not null, 
kategoriaNro smallint PRIMARY KEY AUTO_INCREMENT 

); 

 

CREATE TABLE Kirjakategoria ( 

kirjaNro INT, 

kategoriaNro smallint, 

FOREIGN KEY (kirjaNro) REFERENCES Kirja(kirjaNro), 

FOREIGN KEY (kategoriaNro) REFERENCES Kategoria(kategoriaNro) 

); 

 

CREATE TABLE Kirjailija ( 

kirjailijaNro smallint PRIMARY KEY AUTO_INCREMENT, 

etunimi VARCHAR(20), 

sukunimi VARCHAR(20) 

); 

 

CREATE TABLE KirjailijaKirja ( 

kirjaNro INT, 

kirjailijaNro smallint, 

FOREIGN KEY (kirjaNro) REFERENCES Kirja (kirjaNro), 

FOREIGN KEY (kirjailijaNro) REFERENCES Kirjailija(kirjailijaNro) 

); 

 

CREATE TABLE Tilausrivi ( 

tilausNro INT NOT NULL,
riviNro INT NOT NULL,
kirjaNro INT, 
kpl INT not null,
CONSTRAINT tilausrivi_pk PRIMARY KEY (tilausNro, riviNro),
CONSTRAINT tilausrivi_kirja_fk FOREIGN KEY (kirjaNro) 
    REFERENCES kirja (kirjaNro)
); 

 

CREATE TABLE Varasto ( 

VarastoNro smallint PRIMARY KEY AUTO_INCREMENT, 

lahiosoite VARCHAR(50), 

postitmp VARCHAR(30), 

postinro VARCHAR(10), 

puhNro VARCHAR(15), 

Email VARCHAR(80)

); 

 

 

CREATE TABLE toimipiste( 

ToimipisteNro smallint PRIMARY KEY auto_increment, 

lahiosoite VARCHAR(50), 

postitmp VARCHAR(30), 

postinro VARCHAR(10), 

puhNro VARCHAR(15), 

Email VARCHAR(80), 

varastoNro smallint, 

FOREIGN KEY (varastoNro) REFERENCES Varasto(varastoNro) 

); 

 

CREATE TABLE tyontekija ( 

ttNro smallint PRIMARY KEY auto_increment, 

ttEtunimi varchar(20) NOT NULL, 

ttsukunimi varchar(20) NOT NULL,  

toimipisteNro smallint NOT NULL, 

puhNro VARCHAR(15) NOT NULL, 

email VARCHAR(80) NOT NULL, 

esimies smallint, 

FOREIGN KEY (esimies) REFERENCES tyontekija(ttNro), 

FOREIGN KEY (toimipisteNro) REFERENCES toimipiste(toimipisteNro) 

); 

 

CREATE TABLE Varastosaldo ( 

kirjaNro INT, 

varastoNro smallint, 

saldo smallint, 

 

FOREIGN KEY (kirjaNro) REFERENCES Kirja(kirjaNro), 

FOREIGN KEY (varastoNro) REFERENCES Varasto(varastoNro) 

); 

CREATE TABLE `user` (
  id int primary key auto_increment,
  fname varchar(50) not null,
  lname varchar(100) not null,
  email varchar(100) not null,
  password varchar(255) not null
);

insert into user(fname,lname,email,password) values ('Admin','käyttäjä','admin.user.0988','$2y$10$wGXo.N6JFly5uL4O5obKEuit/CAH6iuXawI9LyzNTrHy/WYkWknWK');

insert into user(fname,lname,email,password) values ('Essi','Esimerkki','essiesimerkki@gmail.com','$2y$10$pFdKzKiyMk7ukXIDJWdyQ.1TjyoH7kAWfm6xGKxj8l26.ECV.i/CO');

INSERT INTO JULKAISIJA VALUES ("", "Otava", 12358230, "otava@otava.fi"); 

 

insert into julkaisija (julkaisija, puhNro, email) values ('Simon & Schuter', 04023213, 'Simon@simonschuter.com'); 

 

INSERT INTO KIRJA VALUES ("Jannen Kirja", "", 390, 15.90, "", 8.90, "Tämä Jannen kirja on aika hyvä.", "kirja1.png", 1, "2021-11-01 00:00:00", ""); 

 

insert into kirja (kirjaNimi, Sivunro, hinta, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu) values ("Beautiful Nights", 450, 19.90, 8.50, "Kaukaisessa Pariisissa yöt kuumuvat yllävän lämpimiksi.", "kirja2.png", 2, "2013-04-09 00:00:00"); 

 

insert into kirja (kirjaNimi, Sivunro, hinta, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu)  

values ("Terror of London", 222, 12.90, 4.50, "Lontoon kaduilla vaanii julma olento.", "kirja3.png",  2, "2019-01-24 00:00:00"); 

 

insert into kirja (kirjaNimi, Sivunro, hinta, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu)  

values ("Maamme Kauneus", 142, 15.90, 3.50, "Suomi on kaunis maa", "kirja4.png", 1, "2012-03-21 00:00:00"); 

 

insert into kirja (kirjaNimi, Sivunro, hinta, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu)  

values ("Jalkaväen Kauhein Hetki", 451, 25.50, 9.50, "Ensimmäinen maailman sota tappoi enemmän ihmisiä kuin ensimmäinen maailmansota. Miksi näin oli? Mitkä tekijät tähän vaikutti?", "kirja5.png", 1, "2012-5-21 00:00:00"); 

 

insert into kirja (kirjaNimi, Sivunro, hinta, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu)  

values ("Matrix: Pitkä Matikka 1", 90, 30.00, 5.30, "Pitkän matikan opiskelijoille.", "kirja6.png", 1, "2016-09-29 00:00:00"); 

 

insert into kirja (kirjaNimi, Sivunro, hinta, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu)  

values ("Saariselän Ritarin Sapeli", 658, 319.90, 10.50, "Saariselän ritari on legendaarinen soturi. Hänen kuolemansa jätti kuningaskunnan ilman puolustajaa. Miten kuningaskunta pystyy vastustamaan nousevaa pimeää voimaa vuorten toisella puolella?", "kirja7.png", 1, "2004-1-21 00:00:00"); 

 insert into kirja (kirjaNimi, Sivunro, hinta, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu)  

values ("Pennun metsäkirja", 120, 12.00, 8.60, "Lapsien metsäkirja.", "eka.png", 1, "2014-09-29 00:00:00"); 

insert into kirja (kirjaNimi, Sivunro, hinta, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu)  

values ("Katekismus", 500, 8.00, 8.60, "Lapsien metsäkirja.", "eka.png", 1, "2012-06-29 00:00:00"); 

insert into kirja (kirjaNimi, Sivunro, hinta, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu)  

values ("Taivaallinen paskamyrsky", 120, 12.00, 8.60, "Nyt on toimintaa!", "eka.png", 1, "2012-06-29 00:00:00"); 

insert into kirja (kirjaNimi, Sivunro, hinta, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu)  

values ("Biologia: Ihminen", 250, 30.00, 9.60, "Biologian kirja alakoululaisille", "eka.png", 1, "2019-01-29 00:00:00"); 

insert into kirja (kirjaNimi, Sivunro, hinta, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu)  

values ("Punainen risti", 350, 20.00, 9.60, "Jännitys tiivistyy Starffordshiren kappelissa, jossa pappi löydettiin kuolleena.", "eka.png", 1, "2020-07-29 00:00:00"); 

insert into kirja (kirjaNimi, Sivunro, hinta, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu)  

values ("Maailman toisella puolen", 350, 15.00, 5.60, "Veeran aviomies siirtyi Austraaliaan töiden peräss. Miten Veera selviää, kun hänen rakastettunsa ei ole paikalla?", "eka.png", 1, "2020-07-29 00:00:00"); 

insert into kirja (kirjaNimi, Sivunro, hinta, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu)  

values ("Kvanttikone: Jumalakompleksi", 550, 15.00, 5.60, "Kvanttikoneet ovat tulevaisuuden teknologiaa, mutta voiko tätä teknologiaa käyttää väärin? Voiko se johtaa sivilisaation musertumiseen?", "eka.png", 1, "2014-02-29 00:00:00"); 

insert into kirja (kirjaNimi, Sivunro, hinta, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu)  

values ("tähtitaival: Jupiterin silmässä", 750, 25.00, 11.60, "Jupiterin silmässä on havaittu omituisia radioaaltoja ja ryhmä tutkijoita on lähetetty tutkimaan tapausta. Kaikki ei kuitenkaan mene suunnitelman mukaan...", "eka.png", 1, "2021-01-15 00:00:00"); 

insert into kirja (kirjaNimi, Sivunro, hinta, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu)  

values ("Qing-dynastian Lohikäärme: Lohikäärmesoturi", 1150, 25.00, 11.60, "Qing-dynastialla on ollut pitkä ja sotaisa historia. Kolmannen suursodan tullessa valtakunta huomaa kuitenkin, että lohikäärme soturi on kadonnut. ", "eka.png", 1, "2020-09-30 00:00:00"); 

insert into kirja (kirjaNimi, Sivunro, hinta, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu)  

values ("Taivasalla: Tasavallan kirves", 500, 13.00, 6.60, "Kun tasavallan turvallisuus on vaakalaidalla, Tasavallan kirves saa tehtäväkseen palauttaa kaiken normaaliksi.", "eka.png", 1, "2011-02-30 00:00:00"); 

insert into kirja (kirjaNimi, Sivunro, hinta, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu)  

values ("Vuoden kauhutarinakokoelma", 666, 13.00, 6.66, "Kokoelma sisältää viisitoista vuoden suosituimmista kauhutarinoista!", "eka.png", 1, "2020-12-30 00:00:00"); 

insert into kirja (kirjaNimi, Sivunro, hinta, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu)  

values ("Tsaarin Verilöyly", 150, 13.00, 3.30, "Pietarin kaduilla tapahtuu...", "eka.png", 1, "2016-12-30 00:00:00");


insert into kirja (kirjaNimi, Sivunro, hinta, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu)  

values ("Pennun kokkikirja", 150, 10.00, 5.50, "Pennut kokkaa!", "eka.png", 1, "2011-04-30 00:00:00");  


insert into kirja (kirjaNimi, Sivunro, hinta, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu)  

values ("Kiiman piinaa", 250, 15.00, 5.50, "No Huhhuh!", "eka.png", 1, "2009-04-30 00:00:00");  

insert into kirja (kirjaNimi, Sivunro, hinta, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu)  

values ("10 tapaa olla laiska", 90, 15.00, 5.50, "Nyt laiskotellaan!", "eka.png", 1, "2004-04-30 00:00:00");  

insert into kirja (kirjaNimi, Sivunro, hinta, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu)  

values ("Japanin Ulkopolitiikka", 90, 15.00, 5.50, "Japanin ulkopolitiikkaa", "eka.png", 1, "2020-04-30 00:00:00");  

INSERT INTO kirjailija VALUES ("", "Aleksis", "Kivi"); 

 

insert into kirjailija (etunimi, sukunimi) 

values ('Emily F.', 'Crowford'); 

 insert into kirjailija (etunimi, sukunimi) 

values ('Petteri T.', 'Pakkinen'); 

insert into kirjailija (etunimi, sukunimi) 

values ('Jamie R.F.', 'Alleson'); 

insert into kirjailija (etunimi, sukunimi) 

values ('Matti S.', 'Taalasmaa'); 

insert into kirjailija (etunimi, sukunimi) 

values ('Merja', 'Kataja'); 

insert into kirjailija (etunimi, sukunimi) 

values ('Terry B.F.', 'Brook'); 

insert into kirjailija (etunimi, sukunimi) 

values ('Richard', 'Reading'); 

 

INSERT into kirjailijakirja (kirjailijaNro, kirjaNro) 

values (1,1), (2,2), (2,3), (1,4), (1,5), (2,6), (2,7), (3,8), (3,9), (3,10), (5,11), (8,12), (4,13), (6,14), (8,15), (7,16), (8,17), (3,18), (7,19), (3,20), (5,21), (1,22), (8,23); 

 

INSERT INTO KATEGORIA(Kategoria) VALUES ("Tietokirjallisuus"), ("Toiminta"), ("Sci-fi ja fantasia"), ("Oppikirjat"), ("Kauhu ja trilleri"),("Romantiikka"), ("Lastenkirjat"); 

 

Insert into kirjakategoria (kirjaNro, kategoriaNro)  

Values (1,2), (2, 6), (3,5), (4,7), (5,1), (6,4), (7,3), (4,1), (8,7), (9,1), (10,2), (11,1), (11,4), (12,5), (13,6), (14,1), (15,3), (16,3), (17,1), (18,5), (19,2), (19,5), (20,7), (21,6), (22,1), (23,1), (23,4); 


INSERT INTO ARVOSTELU (nimimerkki, otsikko, teksti, kirjaNro, arvosana) VALUES ('Riku', "Loistava eepos", "Aivan eeppinen kirja, suosittelen kaikille lämpimästi. Mukaansa tempaava ja jännittävä. Jossain vaiheessa huomasin, että tästä oppiikin jotain! Myös lapsille soveltuva :)", 6, 5);

INSERT INTO ARVOSTELU (nimimerkki, otsikko, teksti, kirjaNro, arvosana) VALUES ('Irmeli', "HUONO!", "En oppinut mitään ja päätä särkee", 6, 2);