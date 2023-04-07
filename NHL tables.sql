drop table Team
cascade constraints;
drop table Player
cascade constraints;
drop table Sponsorship
cascade constraints;
drop table EventOrganized
cascade constraints;
drop table EmployeeHires
cascade constraints;
drop table Owner
cascade constraints;
drop table Individual
cascade constraints;
drop table Organisation
cascade constraints;
drop table Game
cascade constraints;
drop table Attends
cascade constraints;
drop table Arena
cascade constraints;
drop table ArenaAddress
cascade constraints;

CREATE TABLE Team (
id		INTEGER,
rank		INTEGER,
value  		INTEGER,
name		CHAR(20),
foundedyear	INTEGER,
PRIMARY KEY(id));

CREATE TABLE Player (
tid int,
id int,
playerName CHAR(20),
position CHAR(20),
points INTEGER,
goals INTEGER,
assists INTEGER,
shootout FLOAT,
UNIQUE (playerName),
PRIMARY KEY (tid, id),
FOREIGN KEY (tid) REFERENCES Team(id));

CREATE TABLE Sponsorship (
name		CHAR(20),
cost  		INTEGER,
tid		INTEGER,
PRIMARY KEY(name),
FOREIGN KEY(tid) REFERENCES Team(id));

CREATE TABLE EventOrganized (
id		INTEGER,
tid		INTEGER,
URL  		CHAR(60),
name		CHAR(60),
location	CHAR(60),
time  		CHAR(20),
PRIMARY KEY(id),
FOREIGN KEY(tid) REFERENCES Team(id));

CREATE TABLE EmployeeHires (
id		INTEGER,
tid		INTEGER,
name		CHAR(20),
role                CHAR(20),
PRIMARY KEY(id),
FOREIGN KEY(tid) REFERENCES Team(id));


CREATE TABLE Owner (
tid		INTEGER,
name		CHAR(20),
PRIMARY KEY(name),
UNIQUE(tid),
FOREIGN KEY(tid) REFERENCES Team(id));

CREATE TABLE Individual (
tid		INTEGER,
name		CHAR(20),
nationality	CHAR(20),
PRIMARY KEY(name),
UNIQUE(tid),
FOREIGN KEY(tid) REFERENCES Team(id));

CREATE TABLE Organisation (
tid                  INTEGER,
name		CHAR(80),
governor  	CHAR(20),
PRIMARY KEY(name),
UNIQUE(tid),
FOREIGN KEY(tid) REFERENCES Team(id));

CREATE TABLE Game (
day    CHAR(60),
homeScore INTEGER,
visitScore INTEGER,
PRIMARY KEY(day));

CREATE TABLE Attends (
homeTid   INTEGER,
visitTid   INTEGER,
day     CHAR(60),
totalAttendee  INTEGER,
PRIMARY KEY(homeTid, visitTid, day),
FOREIGN KEY(homeTid) REFERENCES Team(id),
FOREIGN KEY(visitTid) REFERENCES Team(id),
FOREIGN KEY(day)  REFERENCES Game(day));

CREATE TABLE Arena (
name		  CHAR(60),
street  	  CHAR(60),
capacity	  INTEGER,
tid		  INTEGER,
postalcode      CHAR(60),
PRIMARY KEY(name),
UNIQUE(tid),
FOREIGN KEY(tid) REFERENCES Team(id));



CREATE TABLE ArenaAddress(
postalcode  	  CHAR(60),
city     	      	  CHAR(60),
state	             CHAR(60),
PRIMARY KEY(postalcode));


INSERT INTO Team VALUES (1, 1, 1400000000, 'Boston Bruins', 1924);
INSERT INTO Team VALUES (2, 2, 640000000, 'Carolina Hurricanes', 1972);
INSERT INTO Team VALUES (3, 28, 450000000, 'Arizona Coyotes', 1972);
INSERT INTO Team VALUES (4, 31, 725000000, 'Anaheim Ducks', 1993);
INSERT INTO Team VALUES (5, 18, 610000000, 'Buffalo Sabres', 1970);
INSERT INTO Team VALUES (6, 17, 855000000, 'Calgary Flames', 1972);
INSERT INTO Team VALUES (7, 30, 1500000000, 'Chicago Blackhawks', 1926);
INSERT INTO Team VALUES (8, 25, 1850000000, 'Montreal Canadiens', 1909);
INSERT INTO Team VALUES (9, 5, 1000000000, 'Tampa Bay Lightning', 1992);
INSERT INTO Team VALUES (10, 22, 12000000000, 'Washington Capitals', 1974);

INSERT INTO Player VALUES (1, 1, 'David Pastrnak', 'Right Wing', 102, 56, 46, 15.1);
INSERT INTO Player VALUES (1, 2, 'Brad Marchand', 'Left Wing', 63, 20, 43, 11.8);
INSERT INTO Player VALUES (1, 3, 'Patrice Bergeron', 'Center', 57, 27, 30, 11.2);
INSERT INTO Player VALUES (2, 1, 'Sebastian Aho', 'Center', 64, 34, 30, 16.7);
INSERT INTO Player VALUES (2, 2, 'Martin Necas', 'Center', 68, 27, 41, 12.1);
INSERT INTO Player VALUES (2, 3, 'Brent Burns', 'Defense', 56, 14, 42, 6.1);
INSERT INTO Player VALUES (3, 1, 'Clayton Keller', 'Right Wing', 82, 36, 46, 17.6);
INSERT INTO Player VALUES (3, 2, 'Nick Schmaltz', 'Center', 54, 21, 33, 17.9);
INSERT INTO Player VALUES (3, 3, 'Matias Maccelli', 'Left Wing', 44, 10, 34, 17.9);
INSERT INTO Player VALUES (4, 1, 'Trevor Zegras', 'Center', 59, 22, 37, 12.5);
INSERT INTO Player VALUES (4, 2, 'Troy Terry', 'Right Wing', 56, 21, 35, 12.1);
INSERT INTO Player VALUES (4, 3, 'Cam Fowler', 'Defense', 43, 10, 33, 8.2);
INSERT INTO Player VALUES (5, 1, 'Tage Thompson', 'Center', 89, 44, 45, 16.4);
INSERT INTO Player VALUES (5, 2, 'Jeff Skinner', 'Left Wing', 73, 33, 40, 15.3);
INSERT INTO Player VALUES (5, 3, 'Alex Tuch', 'Right Wing', 72, 35, 37, 18.1);

INSERT INTO Sponsorship VALUES ('Rapid7', 30000000, 1);
INSERT INTO Sponsorship VALUES ('Diehard', 20000000, 2);
INSERT INTO Sponsorship VALUES ('Goodwill', 1000000, 3);
INSERT INTO Sponsorship VALUES ('Nexen Tire America', 1500000, 4);
INSERT INTO Sponsorship VALUES ('Tally Tech', 3000000, 5);
INSERT INTO Sponsorship VALUES ('Bud Light', 10000000 , 1);
INSERT INTO Sponsorship VALUES ('Gator Metal Roofing', 6000000, 2);
INSERT INTO Sponsorship VALUES ('Noble Ground Coffee', 2000000, 3);
INSERT INTO Sponsorship VALUES ('Reyes Coca Cola Bottling', 1000000, 4);
INSERT INTO Sponsorship VALUES ('FanDuel', 2000000, 5);


INSERT INTO EventOrganized
VALUES(1,1,'https://www.nhl.com/bruins','Winter Classic Plaza Event',' City Hall in Boston','2022/12/30');
INSERT INTO EventOrganized
VALUES(2,2,'https://www.nhl.com/hurricanes','2023 Stadium Series sees viewership increase','Carter-Finley Stadium in Raleigh, North Carolina','2023/02/22');
INSERT INTO EventOrganized
VALUES(3,3,'https://www.nhl.com/coyotes/tickets','Coyotes Gear Up to Host Skatin For Leighton on Sunday','Sun Devil Stadium','2023/01/17');
INSERT INTO EventOrganized
VALUES(4,4,'https://www.nhl.com/ducks','Ducks to Host Inaugural Women in Sports Night','Honda Center','2023/01/28');
INSERT INTO EventOrganized
VALUES(5,5,'https://www.nhl.com/sabres','Sabres Alumni Beer & Wine Festival returns March 30','KeyBank Center','2023/02/02');


INSERT INTO EmployeeHires VALUES (1, 1,'Jim Montgomery', 'Head Coach');
INSERT INTO EmployeeHires VALUES (2, 2,'Rod Brind Amour', 'Coach');
INSERT INTO EmployeeHires VALUES (3, 3,'André Tourigny', 'Coach');
INSERT INTO EmployeeHires VALUES (4, 4,'Dallas Eakins', 'Coach');
INSERT INTO EmployeeHires VALUES (5, 5,'Don Granato', 'Coach');

INSERT INTO Owner VALUES (1, 'Jeremy Jacobs');
INSERT INTO Owner VALUES (2, 'Thomas Dundon');
INSERT INTO Owner VALUES (3, 'Andrew Barroway');
INSERT INTO Owner VALUES (4, 'Henry Samueli');
INSERT INTO Owner VALUES (5, 'Terry Pegula');

INSERT INTO Individual VALUES (1,'Jeremy Jacobs', 'American');
INSERT INTO Individual VALUES (2,'Thomas Dundon','American');
INSERT INTO Individual VALUES (3,'Andrew Barroway', 'American');
INSERT INTO Individual VALUES (4,'Henry Samueli','American');
INSERT INTO Individual VALUES (5,'Terry Pegula','American');

INSERT INTO Organization VALUES (6, 'Calgary Sports and Entertainment', 'N. Murray Edwards');
INSERT INTO Organization VALUES (7, 'Chicago Blackhawk Hockey Team, Inc.','Rocky Wirtz');
INSERT INTO Organization VALUES (8, 'Club de hockey Canadien, Inc.', 'Molson Family');
INSERT INTO Organization VALUES (9, 'Lightning Hockey LP','Jeffrey Vinik');
INSERT INTO Organization VALUES (10, 'Mounumental Sports and Entertainment','Ted Leonsis');

NSERT INTO Game VALUES ('2023-02-28' ,3,4);
INSERT INTO Game VALUES ('2022-12-09',4,3);
INSERT INTO Game VALUES ('2022-11-26',3,2);
INSERT INTO Game VALUES ('2022-12-03',5,2);
INSERT INTO Game VALUES ('2023-01-17',4,3);

INSERT INTO Attends VALUES (6,1,'2023-02-28' ,20);
INSERT INTO Attends VALUES (3,1,'2022-12-09' ,20);
INSERT INTO Attends VALUES (2,6,'2022-11-26' ,20);
INSERT INTO Attends VALUES (6,10,'2022-12-03' ,20);
INSERT INTO Attends VALUES (7,5,'2023-01-17' ,20);

INSERT INTO Arena
VALUES('TD Garden','100 Legends Way',17850,1,'02114');
INSERT INTO Arena
VALUES('PNC Arena','1400 Edwards Mill Rd',19772,2, '27607');
INSERT INTO Arena
VALUES('The New Tempe Arena',' 411 S Packard Dr',16000,3,'85281');
INSERT INTO Arena
VALUES('Honda Center','2695 E Katella Ave',18336,4,'92806');
INSERT INTO Arena
VALUES('KeyBank Center','1 Seymour H Knox III Plaza',19200,5,'14203');

INSERT INTO ArenaAddress
VALUES('02114','Boston','Massachusetts');
INSERT INTO ArenaAddress
VALUES('27607','Raleigh','North Carolina');
INSERT INTO ArenaAddress
VALUES('85281','Tempe','Arizona');
INSERT INTO ArenaAddress
VALUES('92806','Anaheim','California');
INSERT INTO ArenaAddress
VALUES('14203','Buffalo','NewYork');
