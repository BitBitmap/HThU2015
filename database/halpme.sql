--Team ThetaUpsilon
--Created on 4/11/15
--Copyright (c) All Rights Reserved


DROP DATABASE IF EXISTS HalpMe;
CREATE DATABASE IF NOT EXISTS HalpMe;
USE HalpMe;

/*
	Problem solving tutoring system similar to craigslist
	SQL 
*/

-- USER
create table member(
	netID varchar(30),
	password  char(32),
	PRIMARY KEY (netID)
);


-- REQUEST
create table request(
	RID integer auto_increment,
	course varchar(10),
	problem varchar(200),
	description varchar (200),
	requestdatetime datetime,
	memberID varchar (30),
	PRIMARY KEY (RID),
    FOREIGN KEY (memberID) REFERENCES member(netID)
);


-- CLASS
create table classes(
	course varchar(30),
	department varchar(32),
	course_name varchar (30),
	PRIMARY KEY (course)
);







