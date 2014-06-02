/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  27/05/2014 09:27:23                      */
/*==============================================================*/


drop table if exists PROJECT;

drop table if exists RESULT;

drop table if exists STUDENT;

drop table if exists SUBTEST;

drop table if exists TEACHER;

drop table if exists TEACHER_PROJECT;

drop table if exists TEST;

/*==============================================================*/
/* Table : PROJECT                                              */
/*==============================================================*/
create table PROJECT
(
   PROJECT_ID           int not null,
   NAME                 varchar(20),
   DATE_BUTOIRE         datetime,
   primary key (PROJECT_ID)
);

/*==============================================================*/
/* Table : RESULT                                               */
/*==============================================================*/
create table RESULT
(
   LOGIN                char(8) not null,
   PROJECT_ID           int not null,
   TEST_NUM             int not null,
   SUBTEST_NUM          int not null,
   STATUS               bool,
   DESCRIPTION          varchar(100),
   primary key (PROJECT_ID, TEST_NUM, LOGIN, SUBTEST_NUM)
);

/*==============================================================*/
/* Table : STUDENT                                              */
/*==============================================================*/
create table STUDENT
(
   LOGIN                char(8) not null,
   LASTNAME             varchar(20),
   FIRSTNAME            varchar(20),
   MAIL                 varchar(30),
   primary key (LOGIN)
);

/*==============================================================*/
/* Table : SUBTEST                                              */
/*==============================================================*/
create table SUBTEST
(
   PROJECT_ID           int not null,
   TEST_NUM             int not null,
   SUBTEST_NUM          int not null,
   KIND                 varchar(20),
   VALEUR               varchar(50),
   primary key (PROJECT_ID, TEST_NUM, SUBTEST_NUM)
);

/*==============================================================*/
/* Table : TEACHER                                              */
/*==============================================================*/
create table TEACHER
(
   LOGIN                varchar(10) not null,
   LASTNAME             varchar(20),
   FIRSTNAME            varchar(20),
   MAIL                 varchar(30),
   primary key (LOGIN)
);

/*==============================================================*/
/* Table : TEACHER_PROJECT                                      */
/*==============================================================*/
create table TEACHER_PROJECT
(
   LOGIN                varchar(10) not null,
   PROJECT_ID           int not null,
   primary key (LOGIN, PROJECT_ID)
);

/*==============================================================*/
/* Table : TEST                                                 */
/*==============================================================*/
create table TEST
(
   PROJECT_ID           int not null,
   TEST_NUM             int not null,
   NAME                 varchar(20),
   MARK                 float,
   primary key (PROJECT_ID, TEST_NUM)
);

alter table RESULT add constraint FK_RESULT foreign key (LOGIN)
      references STUDENT (LOGIN) on delete restrict on update restrict;

alter table RESULT add constraint FK_RESULT2 foreign key (PROJECT_ID, TEST_NUM, SUBTEST_NUM)
      references SUBTEST (PROJECT_ID, TEST_NUM, SUBTEST_NUM) on delete restrict on update restrict;

alter table SUBTEST add constraint FK_TEST_SUBTEST foreign key (PROJECT_ID, TEST_NUM)
      references TEST (PROJECT_ID, TEST_NUM) on delete restrict on update restrict;

alter table TEACHER_PROJECT add constraint FK_TEACHER_PROJECT foreign key (LOGIN)
      references TEACHER (LOGIN) on delete restrict on update restrict;

alter table TEACHER_PROJECT add constraint FK_TEACHER_PROJECT2 foreign key (PROJECT_ID)
      references PROJECT (PROJECT_ID) on delete restrict on update restrict;

alter table TEST add constraint FK_TEST_PROJECT foreign key (PROJECT_ID)
      references PROJECT (PROJECT_ID) on delete restrict on update restrict;

