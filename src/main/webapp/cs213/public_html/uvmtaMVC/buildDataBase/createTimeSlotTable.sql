use uvmta;

CREATE TABLE timeslot(
timeslotId integer primary key auto_increment,
time char(8) COMMENT 'This maybe should be a time object' ,
room varchar(10),
building varchar(10),
level integer COMMENT 'Proficiency level',
pianos integer COMMENT 'Number of pianos in room',
festivalDay integer COMMENT ' 1 = festival day , 2 = alternate',
festivalId integer, foreign key (festivalId) references festival (festivalId),
scheduled bool COMMENT 'When True - TimeSlot has been scheduled, false - timeslot is available',
address varchar(50) COMMENT 'address of resource') ;

describe timeslot;
select * from timeslot;
