use uvmta;

CREATE TABLE registration(
registrationId integer primary key auto_increment,
performanceDate date COMMENT 'The date for the performance - (regular or alternate date)',
timeslotId integer, foreign key (timeslotId) references timeslot (timeslotId),
type char(10)  COMMENT 'performance type solo,duet,concerto,ensemble',
studentId integer, foreign key (studentId) references student (studentId),
teacherId integer, foreign key (teacherId) references teacher (teacherId),
level integer        COMMENT '1 - beginner, 2 - intermediate, 4 - pre-advanced, 8 - advanced , 16 - Jr, 32 - Sr',
instrument varchar(12)  COMMENT 'piano,voice,string,harp,organ,other',
festivalId integer, foreign key (festivalId) references festival (festivalId),
regFeePaid char(1) COMMENT 'indicates the teacher has paid the registration fee for this registered student',
regFee float COMMENT 'registration fee for this registration'
);

describe registration;
select * from registration;
