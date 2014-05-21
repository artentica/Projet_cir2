/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  20/05/2014 16:45:31                      */
/*==============================================================*/


drop table if exists DEPOT;

drop table if exists PROJET;

drop table if exists TEST;

drop table if exists UTILISATEUR;

/*==============================================================*/
/* Table : DEPOT                                                */
/*==============================================================*/
create table DEPOT
(
   LOGIN                char(12) not null,
   ID_PROJET            int not null,
   DATE_DEPOT           datetime,
   RESULTAT             text,
   primary key (LOGIN, ID_PROJET)
);

/*==============================================================*/
/* Table : PROJET                                               */
/*==============================================================*/
create table PROJET
(
   ID_PROJET            int not null auto_increment,
   ID_TEST              int not null,
   NOM_PROJET           char(40) not null,
   DATE_DE_CREATION     datetime not null,
   DATE_BUTOIRE         datetime not null,
   primary key (ID_PROJET)
);

/*==============================================================*/
/* Table : TEST                                                 */
/*==============================================================*/
create table TEST
(
   ID_TEST              int not null auto_increment,
   DATE_DE_CREATION     datetime,
   primary key (ID_TEST)
);

/*==============================================================*/
/* Table : UTILISATEUR                                          */
/*==============================================================*/
create table UTILISATEUR
(
   LOGIN                char(12) not null,
   PASSWORD             char(20),
   STATUE               char(15),
   primary key (LOGIN)
);

alter table DEPOT add constraint FK_EST_DEPOSE foreign key (ID_PROJET)
      references PROJET (ID_PROJET) on delete restrict on update restrict;

alter table DEPOT add constraint FK_GERE_ENVOIE foreign key (LOGIN)
      references UTILISATEUR (LOGIN) on delete restrict on update restrict;

alter table PROJET add constraint FK_POSSEDE foreign key (ID_TEST)
      references TEST (ID_TEST) on delete restrict on update restrict;

