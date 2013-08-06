#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------

CREATE DATABASE IF NOT EXISTS sondages 
DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE sondages;


CREATE TABLE user(
        id_user     int (11) UNSIGNED Auto_increment  NOT NULL ,
        nom_user    Varchar (50) NOT NULL ,
        prenom_user Varchar (50) NOT NULL ,
        email_user  Varchar (255) NOT NULL ,
        mdp_user    Varchar (50) NOT NULL ,
        PRIMARY KEY (id_user ) ,
        UNIQUE (email_user )
)ENGINE=InnoDB;


CREATE TABLE enquetes(
        id_enq          int (11) UNSIGNED Auto_increment  NOT NULL ,
        titre_enq       Varchar (255) NOT NULL ,
        description_enq Varchar (500) ,
        id_user_user    Int(11) UNSIGNED NOT NULL ,
        PRIMARY KEY (id_enq )
)ENGINE=InnoDB;


CREATE TABLE questions(
        id_quest        int (11) UNSIGNED Auto_increment  NOT NULL ,
        libelle_quest   Varchar (255) NOT NULL ,
        type_quest      Varchar (25) NOT NULL ,
        id_enq_enquetes Int(11) UNSIGNED NOT NULL ,
        PRIMARY KEY (id_quest )
)ENGINE=InnoDB;


CREATE TABLE reponses(
        id_rep               int (11) UNSIGNED Auto_increment  NOT NULL ,
        uid_repondant        Int (11) UNSIGNED NOT NULL ,
        contenu_rep          Varchar (255) ,
        id_quest_questions   Int (11) UNSIGNED NOT NULL ,
        id_prop_propositions Int (11) UNSIGNED NOT NULL ,
        PRIMARY KEY (id_rep )
)ENGINE=InnoDB;


CREATE TABLE propositions(
        id_prop            int (11) UNSIGNED Auto_increment  NOT NULL ,
        libelle_prop       Varchar (100) NOT NULL ,
        id_quest_questions Int (11) UNSIGNED NOT NULL ,
        PRIMARY KEY (id_prop )
)ENGINE=InnoDB;

ALTER TABLE enquetes ADD CONSTRAINT FK_enquetes_id_user_user FOREIGN KEY (id_user_user) REFERENCES user(id_user);
ALTER TABLE questions ADD CONSTRAINT FK_questions_id_enq_enquetes FOREIGN KEY (id_enq_enquetes) REFERENCES enquetes(id_enq);
ALTER TABLE reponses ADD CONSTRAINT FK_reponses_id_quest_questions FOREIGN KEY (id_quest_questions) REFERENCES questions(id_quest);
ALTER TABLE reponses ADD CONSTRAINT FK_reponses_id_prop_propositions FOREIGN KEY (id_prop_propositions) REFERENCES propositions(id_prop);
ALTER TABLE propositions ADD CONSTRAINT FK_propositions_id_quest_questions FOREIGN KEY (id_quest_questions) REFERENCES questions(id_quest);
