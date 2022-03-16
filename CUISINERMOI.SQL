DROP DATABASE IF EXISTS CUISINERMOI;

CREATE DATABASE IF NOT EXISTS CUISINERMOI;
USE CUISINERMOI;
# -----------------------------------------------------------------------------
#       TABLE : DIFFUSION
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS DIFFUSION
 (
   ID_DIFFUSION INTEGER(2) NOT NULL  ,
   ID_PROGRAMME INTEGER(2) NOT NULL  ,
   LEJOUR DATE NOT NULL  ,
   HORAIRE TIME NOT NULL  ,
   DIRECT BOOL NOT NULL  
   , PRIMARY KEY (ID_DIFFUSION) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE DIFFUSION
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_DIFFUSION_PROGRAMME
     ON DIFFUSION (ID_PROGRAMME ASC);

# -----------------------------------------------------------------------------
#       TABLE : USER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS USER
 (
   ID_USER INTEGER(2) NOT NULL  ,
   ID_ROLE INTEGER(2) NOT NULL  ,
   USER CHAR(32) NOT NULL  ,
   MDP CHAR(255) NOT NULL  
   , PRIMARY KEY (ID_USER) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE USER
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_USER_ROLE
     ON USER (ID_ROLE ASC);

# -----------------------------------------------------------------------------
#       TABLE : GENRE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS GENRE
 (
   ID_GENRE INTEGER(2) NOT NULL  ,
   LIBELLE CHAR(255) NOT NULL  
   , PRIMARY KEY (ID_GENRE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : PROGRAMME
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PROGRAMME
 (
   ID_PROGRAMME INTEGER(2) NOT NULL  ,
   ID_EMISSION INTEGER(2) NOT NULL  ,
   ID_CATEGORIECSA INTEGER(2) NOT NULL  ,
   TITRE CHAR(255) NOT NULL  ,
   DUREE BIGINT(4) NOT NULL  
   , PRIMARY KEY (ID_PROGRAMME) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE PROGRAMME
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_PROGRAMME_EMISSION
     ON PROGRAMME (ID_EMISSION ASC);

CREATE  INDEX I_FK_PROGRAMME_CATEGORIECSA
     ON PROGRAMME (ID_CATEGORIECSA ASC);

# -----------------------------------------------------------------------------
#       TABLE : ROLE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ROLE
 (
   ID_ROLE INTEGER(2) NOT NULL  ,
   LIBELLE CHAR(255) NOT NULL  
   , PRIMARY KEY (ID_ROLE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : EMISSION
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS EMISSION
 (
   ID_EMISSION INTEGER(2) NOT NULL  ,
   ID_GENRE INTEGER(2) NOT NULL  ,
   TITRE CHAR(255) NOT NULL  ,
   TITREORIGINAL CHAR(255) NULL  ,
   ANNEEPRODUCTION DATE NOT NULL  ,
   NUMSAISON INTEGER(2) NULL  
   , PRIMARY KEY (ID_EMISSION) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE EMISSION
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_EMISSION_GENRE
     ON EMISSION (ID_GENRE ASC);

# -----------------------------------------------------------------------------
#       TABLE : CATEGORIECSA
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CATEGORIECSA
 (
   ID_CATEGORIECSA INTEGER(2) NOT NULL  ,
   LIBELLE CHAR(255) NOT NULL  
   , PRIMARY KEY (ID_CATEGORIECSA) 
 ) 
 comment = "";


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE DIFFUSION 
  ADD FOREIGN KEY FK_DIFFUSION_PROGRAMME (ID_PROGRAMME)
      REFERENCES PROGRAMME (ID_PROGRAMME) ;


ALTER TABLE USER 
  ADD FOREIGN KEY FK_USER_ROLE (ID_ROLE)
      REFERENCES ROLE (ID_ROLE) ;


ALTER TABLE PROGRAMME 
  ADD FOREIGN KEY FK_PROGRAMME_EMISSION (ID_EMISSION)
      REFERENCES EMISSION (ID_EMISSION) ;


ALTER TABLE PROGRAMME 
  ADD FOREIGN KEY FK_PROGRAMME_CATEGORIECSA (ID_CATEGORIECSA)
      REFERENCES CATEGORIECSA (ID_CATEGORIECSA) ;


ALTER TABLE EMISSION 
  ADD FOREIGN KEY FK_EMISSION_GENRE (ID_GENRE)
      REFERENCES GENRE (ID_GENRE) ;

