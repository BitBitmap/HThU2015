/*
Team ThetaUpsilon
Created on 4/11/15
Copyright (c) 2015    All rights reserved
*/
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

insert into classes values('CS-1114','Computer Science','Intro to Problem Solving');
insert into classes values('CS-1124','Computer Science','C++');
insert into classes values('CS-2134','Computer Science','Data Structures');
insert into classes values('BIO-1114','Biology','Bio 1');
insert into classes values('BIO-1124','Biology','Bio 2');
insert into classes values('BIO-2134','Biology','Orgo');
insert into member values('test123',md5('test123'));
insert into member values('richisrich',md5('richisrich'));
insert into request values(1,'CS-1114',"I don't get Python",'What is an if statement?',current_timestamp,'test123');
insert into request values(2,'BIO-2134',"How do I orgo?",'Carbon?!?!?!?',current_timestamp,'richisrich');









