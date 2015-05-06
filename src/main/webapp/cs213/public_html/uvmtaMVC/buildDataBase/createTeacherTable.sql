use uvmta;

CREATE TABLE teacher(
teacherId integer primary key auto_increment,
first varchar(20),
last varchar(26) NOT NULL,
uvmtaId char(8) COMMENT 'Current Teachers UVMTA ID number',
street varchar(50),
city varchar(30),
state char(2),
zip char(10),
phone char(12),
email varchar(50),
pwd char(40) COMMENT 'Teachers login password - sha1',
username varchar(20) COMMENT 'Teachers login username',
membershipCurrent char(1) COMMENT 'teachers UVMTA membership is current and Dues have been paid',
membershipFees float (5,2)  COMMENT 'membership fees owed',
regFees float (6,2) COMMENT 'Registration Fees owed',
admin char(1) COMMENT 'Teacher has administration rights',
earlyReg char(1) COMMENT 'Allowed to Register Early Y/N');

describe teacher;
select * from teacher;
