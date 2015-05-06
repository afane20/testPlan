use uvmta;

CREATE TABLE student(
studentId integer primary key auto_increment,
first varchar(20),
last varchar(25) NOT NULL,
teacherId integer,
festivals integer COMMENT 'number of festivals the student has participated in',
points integer COMMENT 'total # of points earned from festival participation',
lastFestDate char(11) COMMENT 'Last Festival student participated (i.e. 2010 Fall)',
instrument char(10) COMMENT 'students instrument - piano, string, voice, other',
gradYear char (4) COMMENT 'students H.S. Graduation Year',
foreign key (teacherId) references teacher (teacherId) on update restrict);


describe student;
select * from student;
