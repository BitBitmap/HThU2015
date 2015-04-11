--Team ThetaUpsilon
--Created on 4/11/15
--Copyright (c) 2015    All rights reserved
DROP DATABASE IF EXISTS HalpMe;
CREATE DATABASE IF NOT EXISTS HalpMe;
USE HalpMe;
--	Problem solving tutoring system similar to craigslist

-- MEMBER
create table member(
	netID varchar(30),
	password  char(32),
	PRIMARY KEY (netID)
);

-- CLASS
create table classes(
	course varchar(30),
	department varchar(32),
	description varchar (50),
	PRIMARY KEY (course)
);

-- REQUEST
create table request(
	RID integer auto_increment,
	course varchar(30),
	problem varchar(100),
	description varchar (200),
	requestdatetime datetime,
	netID varchar (30),
	PRIMARY KEY (RID),
    FOREIGN KEY (netID) REFERENCES member(netID),
    FOREIGN KEY (course) REFERENCES classes(course)
);
