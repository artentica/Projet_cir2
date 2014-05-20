/*==============================================================*/
/* Nom de SGBD :  Sybase SQL Anywhere 12                        */
/* Date de création :  19/05/2014 17:13:34                      */
/*==============================================================*/


if exists(select 1 from sys.sysforeignkey where role='FK_DEPOT_EST_DEPOS_PROJET') then
    alter table DEPOT
       delete foreign key FK_DEPOT_EST_DEPOS_PROJET
end if;

if exists(select 1 from sys.sysforeignkey where role='FK_DEPOT_GERE_ENVO_UTILISAT') then
    alter table DEPOT
       delete foreign key FK_DEPOT_GERE_ENVO_UTILISAT
end if;

if exists(select 1 from sys.sysforeignkey where role='FK_PROJET_POSSEDE_TEST') then
    alter table PROJET
       delete foreign key FK_PROJET_POSSEDE_TEST
end if;

drop index if exists DEPOT.EST_DEPOSE_FK;

drop index if exists DEPOT.GERE_ENVOIE_FK;

drop index if exists DEPOT.DEPOT_PK;

drop table if exists DEPOT;

drop index if exists PROJET.POSSEDE_FK;

drop index if exists PROJET.PROJET_PK;

drop table if exists PROJET;

drop index if exists TEST.TEST_PK;

drop table if exists TEST;

drop index if exists UTILISATEUR.UTILISATEUR_PK;

drop table if exists UTILISATEUR;

/*==============================================================*/
/* Table : DEPOT                                                */
/*==============================================================*/
create table DEPOT 
(
   "LOGIN"              char(10)                       not null,
   ID_PROJET            char(10)                       not null,
   DATE_DEPOT           char(10)                       null,
   RESULTAT             char(10)                       null,
   constraint PK_DEPOT primary key clustered ("LOGIN", ID_PROJET)
);

/*==============================================================*/
/* Index : DEPOT_PK                                             */
/*==============================================================*/
create unique clustered index DEPOT_PK on DEPOT (
"LOGIN" ASC,
ID_PROJET ASC
);

/*==============================================================*/
/* Index : GERE_ENVOIE_FK                                       */
/*==============================================================*/
create index GERE_ENVOIE_FK on DEPOT (
"LOGIN" ASC
);

/*==============================================================*/
/* Index : EST_DEPOSE_FK                                        */
/*==============================================================*/
create index EST_DEPOSE_FK on DEPOT (
ID_PROJET ASC
);

/*==============================================================*/
/* Table : PROJET                                               */
/*==============================================================*/
create table PROJET 
(
   ID_PROJET            char(10)                       not null,
   ID_TEST              char(10)                       not null,
   NOM_PROJET           char(10)                       not null,
   DATE_DE_CREATION     char(10)                       not null,
   DATE_BUTOIRE         char(10)                       not null,
   constraint PK_PROJET primary key (ID_PROJET)
);

/*==============================================================*/
/* Index : PROJET_PK                                            */
/*==============================================================*/
create unique index PROJET_PK on PROJET (
ID_PROJET ASC
);

/*==============================================================*/
/* Index : POSSEDE_FK                                           */
/*==============================================================*/
create index POSSEDE_FK on PROJET (
ID_TEST ASC
);

/*==============================================================*/
/* Table : TEST                                                 */
/*==============================================================*/
create table TEST 
(
   ID_TEST              char(10)                       not null,
   DATE_DE_CREATION     char(10)                       null,
   constraint PK_TEST primary key (ID_TEST)
);

/*==============================================================*/
/* Index : TEST_PK                                              */
/*==============================================================*/
create unique index TEST_PK on TEST (
ID_TEST ASC
);

/*==============================================================*/
/* Table : UTILISATEUR                                          */
/*==============================================================*/
create table UTILISATEUR 
(
   "LOGIN"              char(10)                       not null,
   PASSWORD             char(10)                       null,
   STATUE               char(10)                       null,
   constraint PK_UTILISATEUR primary key ("LOGIN")
);

/*==============================================================*/
/* Index : UTILISATEUR_PK                                       */
/*==============================================================*/
create unique index UTILISATEUR_PK on UTILISATEUR (
"LOGIN" ASC
);

alter table DEPOT
   add constraint FK_DEPOT_EST_DEPOS_PROJET foreign key (ID_PROJET)
      references PROJET (ID_PROJET)
      on update restrict
      on delete restrict;

alter table DEPOT
   add constraint FK_DEPOT_GERE_ENVO_UTILISAT foreign key ("LOGIN")
      references UTILISATEUR ("LOGIN")
      on update restrict
      on delete restrict;

alter table PROJET
   add constraint FK_PROJET_POSSEDE_TEST foreign key (ID_TEST)
      references TEST (ID_TEST)
      on update restrict
      on delete restrict;

