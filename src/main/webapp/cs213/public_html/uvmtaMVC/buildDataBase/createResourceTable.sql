use uvmta;

CREATE TABLE resource(
resourceId integer primary key auto_increment,
address varchar(50) COMMENT 'Street,City Address',
building varchar(20)COMMENT 'BYU Building #, Business name, or Homeowners name',
room varchar(10)    COMMENT 'room #',
level integer       COMMENT 'proficieny levels allowed for this Room (binary numbers 1,2,4,8,16,32 )',
startTime char(10)  COMMENT 'start time resource is available',
endTime char (10)   COMMENT 'end time resource is available',
timeIncrement integer COMMENT 'time between performances - in minutes',
pianos integer      COMMENT '# of pianos in this room',
available char(1)   COMMENT 'Resource is available for scheduling Y/N',
timeslotsBuilt char(1) COMMENT 'Indicate timeslots have be generated for this resource',
miscInfo varchar(50) );

describe resource;
select * from resource;
