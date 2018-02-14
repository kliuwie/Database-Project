/* Drop table Section(use when needed) */
DROP TABLE faculty_email;
DROP TABLE schedule;
DROP TABLE student_advisor;
DROP TABLE faculty_department;
DROP TABLE student_major;
DROP TABLE gradebook;
DROP TABLE section;
DROP TABLE semester;
DROP TABLE student_parent;
DROP TABLE student_email;
DROP TABLE student_phone;
DROP TABLE student;
DROP TABLE advisor_expertise;
DROP TABLE advisor;
DROP TABLE course_prereq;
DROP TABLE course;
DROP TABLE major;
DROP TABLE department;
DROP TABLE faculty;
DROP TABLE room_feature;
DROP TABLE room;
DROP TABLE building;
 
 
/* 1 */
CREATE TABLE building(
buildingid INT NOT NULL,
name VARCHAR(256) NOT NULL,
addstreet VARCHAR(256) NOT NULL,
addcity VARCHAR(256) NOT NULL,
addstate CHAR(2) NOT NULL,
addzip VARCHAR(15) NOT NULL,
PRIMARY KEY (buildingid))
ENGINE = INNODB;
 
/* 2 */
CREATE TABLE room(
roomid VARCHAR(15) NOT NULL,
capacity INT,
type VARCHAR(50),
buildingid INT NOT NULL,
PRIMARY KEY (roomid),
FOREIGN KEY (buildingid) REFERENCES building(buildingid))
ENGINE = INNODB;
 
/* 3 */
CREATE TABLE room_feature(
roomid VARCHAR(20) NOT NULL,
feature VARCHAR(256),
FOREIGN KEY (roomid) REFERENCES room(roomid))
ENGINE = INNODB;
 
/* 4 */
CREATE TABLE faculty(
facultyid INT AUTO_INCREMENT,
rank VARCHAR(50),
hire_date DATE NOT NULL,
fname VARCHAR(50) NOT NULL,
mname VARCHAR(50),
lname VARCHAR(50) NOT NULL,
phone VARCHAR(25) NOT NULL,
roomid VARCHAR(20) NOT NULL,
PRIMARY KEY (facultyid),
FOREIGN KEY (roomid) REFERENCES room(roomid))
ENGINE = INNODB;

 
/* 5 */
CREATE TABLE department(
departmentid VARCHAR(20) NOT NULL,
name VARCHAR(256) NOT NULL,
school VARCHAR(256) NOT NULL,
facultyid INT NOT NULL,
PRIMARY KEY (departmentid),
FOREIGN KEY (facultyid) REFERENCES faculty(facultyid))
ENGINE = INNODB;
 
/* 6 */
CREATE TABLE major(
majorid INT NOT NULL,
title VARCHAR(256),
credits_req DEC(2,1) NOT NULL,
departmentid VARCHAR(20) NOT NULL,
PRIMARY KEY (majorid),
FOREIGN KEY (departmentid) REFERENCES department(departmentid))
ENGINE = INNODB;
 
/* 7 */
CREATE TABLE course(
coursenum VARCHAR(20) NOT NULL,
title VARCHAR(256) NOT NULL,
credit_hour DEC(2,1) NOT NULL,
course_subject VARCHAR(256),
departmentid VARCHAR(20) NOT NULL,
PRIMARY KEY (coursenum),
FOREIGN KEY (departmentid) REFERENCES department(departmentid))
ENGINE = INNODB;
 
/* 8 */
CREATE TABLE course_prereq(
coursenum VARCHAR(20) NOT NULL,
prereqnum VARCHAR(20) NOT NULL,
FOREIGN KEY (coursenum) REFERENCES course(coursenum),
FOREIGN KEY (prereqnum) REFERENCES course(coursenum))
ENGINE = INNODB;
 
/* 9 */
CREATE TABLE advisor(
advisorid INT AUTO_INCREMENT,
fname VARCHAR(50) NOT NULL,
mname VARCHAR(50),
lname VARCHAR(50) NOT NULL,
roomid VARCHAR(20) NOT NULL,
PRIMARY KEY (advisorid),
FOREIGN KEY (roomid) REFERENCES room(roomid))
ENGINE = INNODB;
 
/* 10 */
CREATE TABLE advisor_expertise(
advisorid INT NOT NULL,
expertise VARCHAR(256),
FOREIGN KEY (advisorid) REFERENCES advisor(advisorid))
ENGINE = INNODB;
 
/* 11 */
CREATE TABLE student(
studentid INT AUTO_INCREMENT,
fname VARCHAR(50) NOT NULL,
mname VARCHAR(50),
lname VARCHAR(50) NOT NULL,
addstreet VARCHAR(256) NOT NULL,
addcity VARCHAR (50) NOT NULL,
addstate CHAR(2) NOT NULL,
addzip VARCHAR(15) NOT NULL,
PRIMARY KEY (studentid))
ENGINE = INNODB;
 
/* 12 */
CREATE TABLE student_phone(
studentid INT NOT NULL,
phone VARCHAR(20),
type VARCHAR(20),
FOREIGN KEY (studentid) REFERENCES student(studentid))
ENGINE = INNODB;
 
/* 13 */
CREATE TABLE student_email(
studentid INT NOT NULL,
email VARCHAR(256),
type VARCHAR(20),
FOREIGN KEY (studentid) REFERENCES student(studentid))
ENGINE = INNODB;
 
/* 14 */
CREATE TABLE student_parent(
studentid INT NOT NULL,
fname VARCHAR(50),
lname VARCHAR(50),
phone VARCHAR(20),
FOREIGN KEY (studentid) REFERENCES student(studentid))
ENGINE = INNODB;
 
/* 15 */
CREATE TABLE section(
sectionid INT NOT NULL,
title VARCHAR(256) NOT NULL,
time DATE NOT NULL,
dayofweek DATE NOT NULL,
coursenum VARCHAR(20) NOT NULL,
semester VARCHAR(20),
PRIMARY KEY (sectionid),
FOREIGN KEY (coursenum) REFERENCES course(coursenum))
ENGINE = INNODB;
 
/* 16 */
CREATE TABLE semester(
semestercode VARCHAR(20) NOT NULL,
startdate DATE NOT NULL,
enddate DATE NOT NULL,
title VARCHAR(256) NOT NULL,
PRIMARY KEY (semestercode))
ENGINE = INNODB;
 
/* 17 */
CREATE TABLE gradebook(
studentid INT NOT NULL,
sectionid INT NOT NULL,
grade INT,
FOREIGN KEY (studentid) REFERENCES student(studentid),
FOREIGN KEY (sectionid) REFERENCES section(sectionid))
ENGINE = INNODB;
 
/* 18 */
CREATE TABLE student_major(
studentid INT NOT NULL,
majorid INT NOT NULL,
FOREIGN KEY (studentid) REFERENCES student(studentid),
FOREIGN KEY (majorid) REFERENCES major(majorid))
ENGINE = INNODB;
 
/* 19 */
CREATE TABLE faculty_department(
facultyid INT NOT NULL,
departmentid VARCHAR(20) NOT NULL,
FOREIGN KEY (facultyid) REFERENCES faculty(facultyid),
FOREIGN KEY (departmentid) REFERENCES department(departmentid))
ENGINE = INNODB;
 
/* 20 */
CREATE TABLE student_advisor(
studentid INT NOT NULL,
advisorid INT NOT NULL,
FOREIGN KEY (studentid) REFERENCES student(studentid),
FOREIGN KEY (advisorid) REFERENCES advisor(advisorid))
ENGINE = INNODB;
 
/* 21 */
CREATE TABLE schedule(
sectionid INT NOT NULL,
facultyid INT NOT NULL,
semestercode VARCHAR(20) NOT NULL,
roomid VARCHAR(20) NOT NULL,
FOREIGN KEY (sectionid) REFERENCES section(sectionid),
FOREIGN KEY (facultyid) REFERENCES faculty(facultyid),
FOREIGN KEY (semestercode) REFERENCES semester(semestercode),
FOREIGN KEY (roomid) REFERENCES room(roomid))
ENGINE = INNODB;
 
/* 22 */
CREATE TABLE faculty_email(
facultyid INT NOT NULL,
email VARCHAR(256),
type VARCHAR(256),
FOREIGN KEY (facultyid) REFERENCES faculty(facultyid))
ENGINE = INNODB;