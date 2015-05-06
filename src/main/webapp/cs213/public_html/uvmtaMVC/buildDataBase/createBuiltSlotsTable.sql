use uvmta;

CREATE TABLE builtslots(
builtslotsId integer primary key auto_increment,
festivalId integer, foreign key (festivalId) references festival (festivalId),
resourceId integer, foreign key (resourceId) references resource (resourceId)); 

describe builtslots;
select * from builtslots;
