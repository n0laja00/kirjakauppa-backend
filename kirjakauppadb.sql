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

toimitustapa CHAR(1), 

maksutapa CHAR(1), 

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

teksti TINYTEXT, 

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

 

 

 

 

 

INSERT INTO kirjailija VALUES ("", "Aleksis", "Kivi"); 

 

insert into kirjailija (etunimi, sukunimi) 

values ('Emily F.', 'Crowford'); 

 

 

INSERT into kirjailijakirja (kirjailijaNro, kirjaNro) 

values (1,1), (2,2), (2,3), (1,4), (1,5), (2,6), (2,7); 

 

INSERT INTO KATEGORIA(Kategoria) VALUES ("Tietokirjallisuus"), ("Toiminta"), ("Sci-fi ja fantasia"), ("Oppikirjat"), ("Kauhu ja trilleri"),("Romantiikka"), ("Lastenkirjat"); 

 

Insert into kirjakategoria (kirjaNro, kategoriaNro)  

Values (1,2), (2, 6), (3,5), (4,7), (5,1), (6,4), (7,3), (4,1); 


INSERT INTO ARVOSTELU (nimimerkki, otsikko, teksti, kirjaNro) VALUES ('Riku', "Loistava eepos", "Aivan eeppinen kirja, suosittelen kaikille lämpimästi. Mukaansa tempaava ja jännittävä. Jossain vaiheessa huomasin, että tästä oppiikin jotain! Myös lapsille soveltuva :)", 6);

INSERT INTO ARVOSTELU (nimimerkki, otsikko, teksti, kirjaNro) VALUES ('Irmeli', "HUONO!", "En oppinut mitään ja päätä särkee", 6);