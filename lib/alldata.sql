drop table if exists ENROLL;
drop table if exists SECTION;
drop table if exists COURSE;
drop table if exists STUDENT;
drop table if exists DEPT;

create table DEPT (
    DId int not null,
    DName varchar(20),
    primary key (DId),
    check (DId > 0)
);

create table STUDENT (
    SId int not null,
    SName varchar(10) not null,
    MajorId int,
    GradYear int,
    primary key (SId),
    foreign key (MajorId) references DEPT (DId)
    on update cascade
    on delete set null,
    check (SId > 0),
    check (GradYear >= 1863)
);

create table COURSE (
    CId int not null,
    Title varchar(20) not null,
    DeptId int,
    primary key (CId),
    foreign key (DeptId) references DEPT (DId)
    on update cascade
    on delete set null,
    check (CId > 0),
    check (CHAR_LENGTH(Title) > 2)
);

create table SECTION (
    SectId int not null,
    CourseId int not null,
    Prof varchar(20) not null,
    YearOffered int,
    primary key (SectId),
    foreign key (CourseId) references COURSE (CId)
    on update cascade
    on delete restrict,
    check (SectId > 0),
    check (YearOffered > 1863),
    check (CHAR_LENGTH(Prof) > 0)
);

create table ENROLL (
    EId int not null,
    StudentId int not null,
    SectionId int not null,
    Grade varchar(2),
    primary key (EId),
    foreign key (StudentId) references STUDENT (SId)
    on update cascade
    on delete restrict,
    foreign key (SectionId) references SECTION (SectId)
    on update cascade
    on delete restrict,
    check (EId > 0)
);

insert into DEPT set DId=10, DName="compsci";
insert into DEPT set DId=20, DName="math";
insert into DEPT set DId=30, DName="drama";

insert into STUDENT set SId=1, SName="joe", GradYear=2004, MajorId=10;
insert into STUDENT set SId=2, SName="amy", GradYear=2004, MajorId=20;
insert into STUDENT set SId=3, SName="max", GradYear=2005, MajorId=10;
insert into STUDENT set SId=4, SName="sue", GradYear=2005, MajorId=20;
insert into STUDENT set SId=5, SName="jim", GradYear=2003, MajorId=30;
insert into STUDENT set SId=6, SName="kim", GradYear=2004, MajorId=20;
insert into STUDENT set SId=7, SName="art", GradYear=2004, MajorId=30;
insert into STUDENT set SId=8, SName="pat", GradYear=2001, MajorId=20;
insert into STUDENT set SId=9, SName="lee", GradYear=2004, MajorId=10;

insert into COURSE set CId=12, Title="db systems", DeptId=10;
insert into COURSE set CId=22, Title="compilers", DeptId=10;
insert into COURSE set CId=32, Title="calculus", DeptId=20;
insert into COURSE set CId=42, Title="algebra", DeptId=20;
insert into COURSE set CId=52, Title="acting", DeptId=30;
insert into COURSE set CId=62, Title="elocution", DeptId=30;

insert into SECTION set SectId=13, CourseId=12, Prof="turing", YearOffered=2004;
insert into SECTION set SectId=23, CourseId=12, Prof="turing", YearOffered=2005;
insert into SECTION set SectId=33, CourseId=32, Prof="newton", YearOffered=2000;
insert into SECTION set SectId=43, CourseId=32, Prof="einstein", YearOffered=2001;
insert into SECTION set SectId=53, CourseId=52, Prof="brando", YearOffered=2001;
insert into SECTION set SectId=63, CourseId=62, Prof="brando", YearOffered=2001;
insert into SECTION set SectId=73, CourseId=12, Prof="newton", YearOffered=2002;
insert into SECTION set SectId=83, CourseId=22, Prof="turing", YearOffered=2001;
insert into SECTION set SectId=93, CourseId=42, Prof="einstein", YearOffered=2003;
insert into SECTION set SectId=103, CourseId=12, Prof="babbage", YearOffered=2004;

insert into ENROLL set EId=14, StudentId=1, SectionId=13, Grade="A";
insert into ENROLL set EId=24, StudentId=1, SectionId=43, Grade="C";
insert into ENROLL set EId=34, StudentId=2, SectionId=43, Grade="B+";
insert into ENROLL set EId=44, StudentId=4, SectionId=33, Grade="B";
insert into ENROLL set EId=54, StudentId=4, SectionId=53, Grade="A";
insert into ENROLL set EId=64, StudentId=5, SectionId=63, Grade="A";
insert into ENROLL set EId=74, StudentId=6, SectionId=73, Grade="A";
insert into ENROLL set EId=84, StudentId=7, SectionId=83, Grade="A";
insert into ENROLL set EId=94, StudentId=8, SectionId=93, Grade="A";

insert into ENROLL set EId=114, StudentId=1, SectionId=23, Grade="A";
insert into ENROLL set EId=124, StudentId=1, SectionId=53, Grade="B";
insert into ENROLL set EId=134, StudentId=2, SectionId=53, Grade="C+";
insert into ENROLL set EId=144, StudentId=4, SectionId=43, Grade="A";
insert into ENROLL set EId=154, StudentId=4, SectionId=73, Grade="B";
insert into ENROLL set EId=164, StudentId=6, SectionId=83, Grade="C";
insert into ENROLL set EId=174, StudentId=6, SectionId=93, Grade="D";
insert into ENROLL set EId=184, StudentId=7, SectionId=13, Grade="F";
insert into ENROLL set EId=194, StudentId=8, SectionId=43, Grade="A";

insert into ENROLL set EId=214, StudentId=1, SectionId=43, Grade="D";
insert into ENROLL set EId=224, StudentId=1, SectionId=13, Grade="B";
insert into ENROLL set EId=234, StudentId=2, SectionId=33, Grade="A+";
insert into ENROLL set EId=244, StudentId=4, SectionId=83, Grade="C";
insert into ENROLL set EId=254, StudentId=4, SectionId=93, Grade="B";
insert into ENROLL set EId=264, StudentId=6, SectionId=23, Grade="A";
insert into ENROLL set EId=274, StudentId=6, SectionId=33, Grade="C";
insert into ENROLL set EId=284, StudentId=7, SectionId=73, Grade="B";
insert into ENROLL set EId=294, StudentId=8, SectionId=13, Grade="A";

insert into ENROLL set EId=314, StudentId=1, SectionId=93, Grade="A";
insert into ENROLL set EId=324, StudentId=1, SectionId=83, Grade="D";
insert into ENROLL set EId=334, StudentId=2, SectionId=73, Grade="A";
insert into ENROLL set EId=344, StudentId=4, SectionId=63, Grade="B";
insert into ENROLL set EId=354, StudentId=4, SectionId=13, Grade="C";
insert into ENROLL set EId=364, StudentId=6, SectionId=43, Grade="F";
insert into ENROLL set EId=374, StudentId=6, SectionId=33, Grade="B";
insert into ENROLL set EId=384, StudentId=7, SectionId=23, Grade="B";
insert into ENROLL set EId=394, StudentId=8, SectionId=23, Grade="A";

