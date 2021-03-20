------------------------------------------------------------
--        Script Groupe D1 L3 Informatique  
------------------------------------------------------------
CREATE DATABASE projet2

CREATE TABLE admin
(
    no_login character varying(50)  NOT NULL,
    password character varying(50) ,
    name_a character varying(50) ,
    phone_a character(10) ,
    email_a character varying(50) ,
    CONSTRAINT admin_pk PRIMARY KEY (no_login)
);


------------------------------------------------------------
-- Table: customer
------------------------------------------------------------
CREATE TABLE customer(
	no_customer      SERIAL NOT NULL ,
	fist_name        VARCHAR (50) NOT NULL ,
	last_name        VARCHAR (50) NOT NULL ,
	email            VARCHAR (50) NOT NULL ,
	login            VARCHAR (50) NOT NULL ,
	password         VARCHAR (50) NOT NULL ,
	number_of_card   INT  NOT NULL ,
	start_date       DATE  NOT NULL ,
	expire_date      DATE  NOT NULL ,
	points            INT  NOT NULL  ,
	CONSTRAINT customer_pk PRIMARY KEY (no_customer)
);   

insert into customer (no_customer, fist_name, last_name, email, login, password, number_of_card, start_date, expire_date, points) values (305, 'Emmit', 'Carlsen', 'ecarlsen0@biblegateway.com', 'ecarlsen0', '1co9QKTaV', 774456, '2020-09-03', '2021-07-26', 55);
insert into customer (no_customer, fist_name, last_name, email, login, password, number_of_card, start_date, expire_date, points) values (279, 'Florry', 'Oakeshott', 'foakeshott1@oracle.com', 'foakeshott1', 'yJ6jcLd', 754300, '2020-01-08', '2020-03-10', 42);
insert into customer (no_customer, fist_name, last_name, email, login, password, number_of_card, start_date, expire_date, points) values (138, 'Augustina', 'Riddell', 'ariddell2@nsw.gov.au', 'ariddell2', 'J538QM6q', 713345, '2020-04-09', '2020-09-02', 37);
insert into customer (no_customer, fist_name, last_name, email, login, password, number_of_card, start_date, expire_date, points) values (318, 'Farrell', 'Nuccitelli', 'fnuccitelli3@telegraph.co.uk', 'fnuccitelli3', 'bf0KknMx3JV', 880776, '2020-07-13', '2020-05-03', 39);
insert into customer (no_customer, fist_name, last_name, email, login, password, number_of_card, start_date, expire_date, points) values (311, 'Dylan', 'Dunk', 'ddunk4@mayoclinic.com', 'ddunk4', 'RFuATdu', 738181, '2019-12-02', '2020-01-08', 36);


------------------------------------------------------------
-- Table: Facture
------------------------------------------------------------


CREATE TABLE facture(
	no_facture       VARCHAR (50) NOT NULL ,
	payement_methode   VARCHAR (50) NOT NULL ,
	date_facture       DATE  NOT NULL ,
	total_price        REAL  NOT NULL ,
	no_customer        INT  NOT NULL  ,
	CONSTRAINT facture_pk PRIMARY KEY (no_facture),
    CONSTRAINT facture_customer_fk FOREIGN KEY (no_customer) REFERENCES customer(no_customer)
);

insert into facture (no_facture, payement_methode, date_facture, total_price  , no_customer) values (350, 'cash', '2020-08-29', 44.64, 311);
insert into facture (no_facture, payement_methode, date_facture, total_price  , no_customer) values (359, 'cash', '2020-11-11', 48.16, 279);
insert into facture (no_facture, payement_methode, date_facture, total_price  , no_customer) values (391, 'cash', '2020-05-16', 35.07, 318);
insert into facture (no_facture, payement_methode, date_facture, total_price  , no_customer) values (323, 'cash', '2020-04-23', 24.1, 305);
insert into facture (no_facture, payement_methode, date_facture, total_price  , no_customer) values (328, 'cash', '2020-04-28', 16.55, 311);



------------------------------------------------------------
-- Table: Promo
------------------------------------------------------------
CREATE TABLE promo(
	no_promo    SERIAL NOT NULL ,
	old_price   REAL  NOT NULL ,
	new_price   REAL  NOT NULL  ,
	CONSTRAINT promo_PK PRIMARY KEY (no_promo)
);

insert into promo (no_promo, old_price, new_price) values (1, 19.0, 2.25);
insert into promo (no_promo, old_price, new_price) values (2, 26.76, 2.96);
insert into promo (no_promo, old_price, new_price) values (3, 25.02, 2.49);
insert into promo (no_promo, old_price, new_price) values (4, 14.14, 14.77);
insert into promo (no_promo, old_price, new_price) values (5, 21.83, 10.85);
insert into promo (no_promo, old_price, new_price) values (6, 17.09, 4.53);
insert into promo (no_promo, old_price, new_price) values (7, 27.26, 14.0);
insert into promo (no_promo, old_price, new_price) values (8, 15.02, 13.55);
insert into promo (no_promo, old_price, new_price) values (9, 25.83, 11.76);
insert into promo (no_promo, old_price, new_price) values (10, 15.01, 11.13);
insert into promo (no_promo, old_price, new_price) values (11, 25.48, 2.29);
insert into promo (no_promo, old_price, new_price) values (12, 28.54, 11.95);
insert into promo (no_promo, old_price, new_price) values (13, 10.6, 11.67);
insert into promo (no_promo, old_price, new_price) values (14, 28.1, 14.05);
insert into promo (no_promo, old_price, new_price) values (15, 7.93, 2.45);
insert into promo (no_promo, old_price, new_price) values (16, 14.47, 4.46);
insert into promo (no_promo, old_price, new_price) values (17, 19.63, 3.07);
insert into promo (no_promo, old_price, new_price) values (18, 27.11, 5.72);
insert into promo (no_promo, old_price, new_price) values (19, 16.01, 11.54);
insert into promo (no_promo, old_price, new_price) values (20, 11.66, 8.33);
insert into promo (no_promo, old_price, new_price) values (21, 25.96, 12.04);
insert into promo (no_promo, old_price, new_price) values (22, 10.79, 14.12);
insert into promo (no_promo, old_price, new_price) values (23, 8.82, 6.21);
insert into promo (no_promo, old_price, new_price) values (24, 16.74, 6.75);
insert into promo (no_promo, old_price, new_price) values (25, 8.63, 6.27);
insert into promo (no_promo, old_price, new_price) values (26, 17.06, 12.9);
insert into promo (no_promo, old_price, new_price) values (27, 23.28, 11.85);
insert into promo (no_promo, old_price, new_price) values (28, 23.22, 11.88);
insert into promo (no_promo, old_price, new_price) values (29, 12.47, 9.58);
insert into promo (no_promo, old_price, new_price) values (30, 9.02, 7.07);

------------------------------------------------------------
-- Table: articles
------------------------------------------------------------
CREATE TABLE articles(
	no_article VARCHAR (50) NOT NULL ,
	name_a     VARCHAR (50) NOT NULL ,
	quantity   REAL  NOT NULL ,
	in_promo   BOOL  NOT NULL ,
	price      REAL  NOT NULL ,
	promo       INT    ,
	CONSTRAINT articles_pk PRIMARY KEY (no_article),
    CONSTRAINT articles_fk FOREIGN KEY (promo) REFERENCES promo(no_promo)
);


insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (28639786, 'LORTUSS', 15, true, 36.28, 1);
insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (26456244, 'Aminosyn II', 2, true, 18.54, 2);
insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (23779861, 'Beef Liver', 7, true, 19.53, 3);
insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (21456875, 'nasal', 10, true, 49.28, 4);
insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (28002297, 'Doxazosin', 6, true, 42.17, 6);
insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (29350884, 'Physostigmine Salicylate', 15, false, 44.42, 7);
insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (21157508, 'Body Pure', 11, false, 32.17, 8);
insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (13491376, 'Bupropion Hydrochloride', 7, true, 36.15, 12);
insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (32818230, 'ESIKA Perfect Match', 13, false, 25.35, 13);
insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (12515016, 'Zoloft', 4, true, 11.27, 14);
insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (20762286, 'BIO BEAUTY BIO DEFENSE', 7, true, 40.8, 15);
insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (14487724, 'Nitrogen', 15, true, 49.39, 16);
insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (21586865, 'Phenytoin', 10, true, 43.27, 17);
insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (24280998, 'DILTIAZEM HYDROCHLORIDE', 11, true, 29.85, 18);
insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (19314943, 'DT ANTIBACTERIAL HAND', 12, true, 9.01, 19);
insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (21557781, 'OXYGEN', 3, false, 46.99, 20);
insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (21099817, 'Epl-Cell Repair', 6, true, 33.4, 21);
insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (14475207, 'Divalproex Sodium', 6, false, 31.18, 22);
insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (21642822, 'Kadian', 2, false, 21.03, 23);
insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (30347136, 'Wintergreen Isopropyl Alcohol', 15, false, 50.0, 24);
insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (31969852, 'Alprazolam', 12, false, 45.97, 25);
insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (30456320, 'Throat Care', 2, true, 6.24, 26);
insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (12198999, 'Cardizem', 5, false, 30.28, 27);
insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (24801798, 'AVINZA', 5, false, 7.99, 28);
insert into articles (no_article, name_a, quantity, in_promo, price, promo) values (21255116, 'Fenofibric Acid', 5, false, 11.88, 29);

------------------------------------------------------------
-- Table: decorations
------------------------------------------------------------

CREATE TABLE decorations(
    no_deco    VARCHAR (50) NOT NULL ,
	size       VARCHAR (50) NOT NULL ,
	color      VARCHAR (50) NOT NULL ,
	patern     VARCHAR (50) NOT NULL ,
	brand      VARCHAR (50) NOT NULL ,
	CONSTRAINT decorations_pk PRIMARY KEY (no_deco),
    CONSTRAINT decorations_fk1 FOREIGN KEY (no_deco) REFERENCES articles(no_article),
    CONSTRAINT decorations_ck CHECK (color IN ('Black','White'))
);


insert into decorations (no_deco, size, color, patern, brand) values (28639786, 137.49, 'Black', 1, 'Yata');
insert into decorations (no_deco, size, color, patern, brand) values (26456244, 280.82, 'Black', 2, 'Gabcube');
insert into decorations (no_deco, size, color, patern, brand) values (23779861, 370.02, 'Black', 3, 'Voolith');
insert into decorations (no_deco, size, color, patern, brand) values (21456875, 288.82, 'White', 4, 'Cogidoo');
insert into decorations (no_deco, size, color, patern, brand) values (28002297, 242.36, 'White', 5, 'Brainbox');




------------------------------------------------------------
-- Table: furniture
------------------------------------------------------------

CREATE TABLE furniture(
	no_furn       VARCHAR (50) NOT NULL ,
	model         VARCHAR (50) NOT NULL ,
	type          VARCHAR (50) NOT NULL ,
	composition   VARCHAR (50) NOT NULL ,
	CONSTRAINT furniture_pk PRIMARY KEY (no_furn),
    CONSTRAINT furniture_fk1 FOREIGN KEY (no_furn) REFERENCES articles(no_article)
);


insert into furniture (no_furn, model, type, composition) values (29350884, 'Ram Van B350', 57, 'Woolen');
insert into furniture (no_furn, model, type, composition) values (21157508, 'Cruze', 78, 'Woolen');
insert into furniture (no_furn, model, type, composition) values (13491376, 'Cabriolet', 100, 'Linen');
insert into furniture (no_furn, model, type, composition) values (32818230, '626', 88, 'Woolen');
insert into furniture (no_furn, model, type, composition) values (12515016, 'MDX', 45, 'Polyester');



------------------------------------------------------------
-- Table: clothing
------------------------------------------------------------

CREATE TABLE clothing(
	no_clothing    VARCHAR (50) NOT NULL ,
	style_cloth    VARCHAR (50) NOT NULL ,
	taille_cloth   VARCHAR (5) NOT NULL ,
	color_cloth    VARCHAR (50) NOT NULL ,
	CONSTRAINT clothing_pk PRIMARY KEY (no_clothing),
    CONSTRAINT clothing_fk1 FOREIGN KEY (no_clothing) REFERENCES articles(no_article)
);

insert into clothing (no_clothing, style_cloth, taille_cloth, color_cloth) values (20762286, 'urban', 'S', 'Blue');
insert into clothing (no_clothing, style_cloth, taille_cloth, color_cloth) values (14487724, 'hipster', 'XL', 'Back');
insert into clothing (no_clothing, style_cloth, taille_cloth, color_cloth) values (21586865, 'hipster', 'X', 'Green');
insert into clothing (no_clothing, style_cloth, taille_cloth, color_cloth) values (24280998, 'classic', 'S', 'Blue');
insert into clothing (no_clothing, style_cloth, taille_cloth, color_cloth) values (19314943, 'classic', 'S', 'Green');




------------------------------------------------------------
-- Table: contain
------------------------------------------------------------
    CREATE TABLE contain(
        no_artic     VARCHAR (50) NOT NULL ,
        code_factu   VARCHAR (50) NOT NULL  ,
        CONSTRAINT contain_fk1 FOREIGN KEY (no_artic) REFERENCES articles(no_article),
        CONSTRAINT contain_fk2 FOREIGN KEY (code_factu) REFERENCES facture(no_facture),
        CONSTRAINT contain_pk PRIMARY KEY (no_artic,code_factu)
    );

insert into contain (no_artic, code_factu) values (28639786,350);
insert into contain (no_artic, code_factu) values (26456244,359);
insert into contain (no_artic, code_factu) values (23779861,391);
insert into contain (no_artic, code_factu) values (21456875,323);
insert into contain (no_artic, code_factu) values (28002297,328);

