use uvmta;

CREATE TABLE festival(
festivalId integer primary key auto_increment,
festivalName varchar(26) COMMENT 'A name to describe a Festival - i.e. Spring 2009',
festivalDate date       COMMENT 'Main date of Festival',
alternateDate date  COMMENT 'Additional Festival day',
regFee float    COMMENT 'festival registration fee',
regFeeAlt float COMMENT 'alternate day/night registration fee',
regOpenEarly char(1) COMMENT 'Early Registration is Open or Not',
regOpen char(1) COMMENT 'Registration is Open or Not',
regEnds date COMMENT 'Registration end or registration closing date',
currentFestival char(1) COMMENT 'Indicates if this is the current or active festival');

describe festival;
select * from festival;
