/*
Created		1/6/2011
Modified		1/25/2011
Project		My Christian Life
Model		Player DB
Company		TBD
Author		Allen Halsted
Version		.02
Database		mySQL 5 
*/



Drop index userid on tbl_Player;
Drop index useractive on tbl_Player_Friends;
Drop index userid on tbl_Player_Friends;
Drop index userfreind on tbl_Player_Friends;
Drop index userid on tbl_Player_Achievement;
Drop index userid on tbl_Player_Wishlist;
Drop index userid on tbl_Player_Unlocks;
Drop index usertype on tbl_Player_Unlocks;
Drop index userall on tbl_Player_Unlocks;
Drop index usercollect on tbl_Player_Collections;
Drop index userid on tbl_Player_Collections;
Drop index userid on tbl_Player_Inventory;
Drop index useractive on tbl_Player_Inventory;
Drop index useritem on tbl_Player_Inventory;
Drop index userid on tbl_Player_Church;
Drop index useritems on tbl_Player_Church;
Drop index usertype on tbl_Player_Church;
Drop index userid on tbl_Player_Building_Recharge;
Drop index userBuild on tbl_Player_Building_Recharge;
Drop index ubd on tbl_Player_Building_Recharge;
Drop index church on tbl_Player_Building_Recharge;
Drop index userchurch on tbl_Player_Building_Recharge;
Drop index userid on tbl_Player_Quests;
Drop index userquest on tbl_Player_Quests;
Drop index userid on tbl_Player_Building_Progress;
Drop index usechurch on tbl_Player_Building_Progress;
Drop index userbuildchrich on tbl_Player_Building_Progress;
Drop index useridkey on tbl_Player_Pending;
Drop index usersource on tbl_Player_Pending;
Drop index usertype on tbl_Player_Pending;
Drop index useritemcomplete on tbl_Player_Pending;
Drop index userid on tbl_Player_Pending;
Drop index userpend on tbl_Player_Gift_Recieved;
Drop index userlast on tbl_Player_Requests_Sent;


drop table IF EXISTS tbl_Player_Pending;
drop table IF EXISTS tbl_Player_Building_Progress;
drop table IF EXISTS tbl_Player_Quests;
drop table IF EXISTS tbl_Player_Building_Recharge;
drop table IF EXISTS tbl_Player_Church;
drop table IF EXISTS tbl_Player_Inventory;
drop table IF EXISTS tbl_Player_Collections;
drop table IF EXISTS tbl_Player_Unlocks;
drop table IF EXISTS tbl_Player_Wishlist;
drop table IF EXISTS tbl_Player_Achievement;
drop table IF EXISTS tbl_Player_Friends;
drop table IF EXISTS tbl_Player;
drop table IF EXISTS tbl_Player_Start;
drop table IF EXISTS tbl_Player_Gift_Recieved;
drop table IF EXISTS tbl_Player_Requests_Sent;

Create table tbl_Player (
	id Int NOT NULL AUTO_INCREMENT,
	UserID Int NOT NULL,
	PlayerName Varchar(30) NOT NULL,
	Level Int NOT NULL,
	Experience Int NOT NULL,
	Coins Int NOT NULL,
	Bookmarks Int NOT NULL,
	JobApproval Int NOT NULL,
	Congregation Int NOT NULL,
	Capacity Int NOT NULL,
	Energy Int NOT NULL,
	MaxEnergy Int NOT NULL,
	Setup int Not NULL,
	XRef Varchar(100),
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Player_Start (
	id Int NOT NULL AUTO_INCREMENT,
	Level Int NOT NULL,
	Experience Int NOT NULL,
	Coins Int NOT NULL,
	Bookmarks Int NOT NULL,
	JobApproval Int NOT NULL,
	Congregation Int NOT NULL,
	Capacity Int NOT NULL,
	Energy Int NOT NULL,
	MaxEnergy Int NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Player_Friends (
	id Int NOT NULL AUTO_INCREMENT,
	UserID Int NOT NULL,
	FriendID Int NOT NULL,
	FriendName Varchar(30) NOT NULL,
	XRef Varchar(100) NOT NULL,
	Level Int NOT NULL,
	JobApproval Int NOT NULL,
	LastUsed Datetime,
	Active Bit(1) NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Player_Achievement (
	id Int NOT NULL AUTO_INCREMENT,
	UserID Int NOT NULL,
	AchievementID Int NOT NULL,
	Count Int NOT NULL,
	Level1 Int NOT NULL,
	Level2 Int NOT NULL,
	Level3 Int NOT NULL,
	Complete Bit(1) NOT NULL,
	Active Bit(1) NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Player_Wishlist (
	id Int NOT NULL AUTO_INCREMENT,
	UserID Int NOT NULL,
	Item1 Int NOT NULL,
	Item2 Int NOT NULL,
	Item3 Int NOT NULL,
	Item4 Int NOT NULL,
	Item5 Int NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Player_Unlocks (
	id Int NOT NULL AUTO_INCREMENT,
	UserID Int NOT NULL,
	UnlockType Int NOT NULL,
	UnlockID Int NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;


Create table tbl_Player_Collections (
	id Int NOT NULL AUTO_INCREMENT,
	UserID Int NOT NULL,
	CollectionID Int NOT NULL,
	ItemID Int NOT NULL,
	ItemCount Int NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;


Create table tbl_Player_Inventory (
	id Int NOT NULL AUTO_INCREMENT,
	UserID Int NOT NULL,
	ItemType Int NOT NULL,
	ItemID Int NOT NULL,
	ItemCount Int NOT NULL,
	Deleted Bit(1) NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Player_Church (
	id Int NOT NULL AUTO_INCREMENT,
	UserID Int NOT NULL,
	ItemType Int NOT NULL,
	ItemID Int NOT NULL,
	GridX Int NOT NULL,
	GridY Int NOT NULL,
	SubGridX Int NOT NULL,
	SubGridY Int NOT NULL,
	FacingType Int NOT NULL,
	LastUsed Datetime,
	Deleted Bit(1) NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Player_Building_Recharge (
	id Int NOT NULL AUTO_INCREMENT,
	UserID Int NOT NULL,
	ChurchID Int NOT NULL,
	BuildingID Int NOT NULL,
	DailyID Int NOT NULL,
	RechargeRate Int NOT NULL,
	LastUsed Datetime NOT NULL,
	Complete Bit(1) NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Player_Quests (
	id Int NOT NULL AUTO_INCREMENT,
	UserID Int NOT NULL,
	QuestID Int NOT NULL,
	Step1Require Int NOT NULL,
	Step1Done Int NOT NULL,
	Step2Require Int NOT NULL,
	Step2Done Int NOT NULL,
	Step3Require Int NOT NULL,
	Step3Done Int NOT NULL,
	Complete Bit(1) NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;


Create table tbl_Player_Building_Progress (
	id Int NOT NULL AUTO_INCREMENT,
	UserID Int NOT NULL,
	BuildingID Int NOT NULL,
	ChurchID Int NOT NULL,
	Item1 Int NOT NULL,
	Item1Done Int NOT NULL,
	Item1Require Int NOT NULL,
	Item1BuyNow Int NOT NULL,
	Item2 Int NOT NULL,
	Item2Done Int NOT NULL,
	Item2Require Int NOT NULL,
	Item2BuyNow Int NOT NULL,
	Item3 Int NOT NULL,
	Item3Done Int NOT NULL,
	Item3Require Int NOT NULL,
	Item3BuyNow Int NOT NULL,
	Item4 Int NOT NULL,
	Item4Done Int NOT NULL,
	Item4Require Int NOT NULL,
	Item4BuyNow Int NOT NULL,
	Item5 Int NOT NULL,
	Item5Done Int NOT NULL,
	Item5Require Int NOT NULL,
	Item5BuyNow Int NOT NULL,
	Item6 Int NOT NULL,
	Item6Done Int NOT NULL,
	Item6Require Int NOT NULL,
	Item6BuyNow Int NOT NULL,
	Complete Bit(1) NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;


Create table tbl_Player_Pending (
	id Int NOT NULL AUTO_INCREMENT,
	UserID Int NOT NULL,
	ItemType Int NOT NULL,
	ItemID Int NOT NULL,
	Source Int NOT NULL,
	IDKey Varchar(20),
	Complete Bit(1) NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Player_Gift_Recieved (
	id Int NOT NULL AUTO_INCREMENT,
	UserID Int NOT NULL,
	PendingID Int NOT NULL,
	Recieved Datetime NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Player_Requests_Sent (
	id Int NOT NULL AUTO_INCREMENT,
	UserID Int NOT NULL,
	LastSent Date NOT NULL,
	FriendsList Mediumtext NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;



Create Index userid ON tbl_Player (UserID);
Create Index useractive ON tbl_Player_Friends (UserID,Active);
Create Index userid ON tbl_Player_Friends (UserID);
Create Index userfreind ON tbl_Player_Friends (UserID,FriendID);
Create Index userid ON tbl_Player_Achievement (UserID,Active);
Create Index userid ON tbl_Player_Wishlist (UserID);
Create Index userid ON tbl_Player_Unlocks (UserID);
Create Index usertype ON tbl_Player_Unlocks (UserID,UnlockType);
Create Index userall ON tbl_Player_Unlocks (UserID,UnlockType,UnlockID);
Create Index usercollect ON tbl_Player_Collections (UserID,CollectionID);
Create Index userid ON tbl_Player_Collections (UserID);
Create Index userid ON tbl_Player_Inventory (UserID);
Create Index useractive ON tbl_Player_Inventory (UserID,Deleted);
Create Index useritem ON tbl_Player_Inventory (UserID,ItemType,ItemID);
Create Index userid ON tbl_Player_Church (UserID,Deleted);
Create Index useritems ON tbl_Player_Church (UserID,ItemType,ItemID,Deleted);
Create Index usertype ON tbl_Player_Church (UserID,ItemType,Deleted);
Create Index userid ON tbl_Player_Building_Recharge (UserID);
Create Index userBuild ON tbl_Player_Building_Recharge (UserID,BuildingID);
Create Index ubd ON tbl_Player_Building_Recharge (UserID,BuildingID,DailyID);
Create Index church ON tbl_Player_Building_Recharge (ChurchID);
Create Index userchurch ON tbl_Player_Building_Recharge (UserID,ChurchID);
Create Index userid ON tbl_Player_Quests (UserID);
Create Index userquest ON tbl_Player_Quests (UserID,QuestID);
Create Index userid ON tbl_Player_Building_Progress (UserID,Complete);
Create Index usechurch ON tbl_Player_Building_Progress (UserID,ChurchID,Complete);
Create Index userbuildchrich ON tbl_Player_Building_Progress (UserID,BuildingID,ChurchID,Complete);
Create Index useridkey ON tbl_Player_Pending (UserID,IDKey,Complete);
Create Index usersource ON tbl_Player_Pending (UserID,Source,Complete);
Create Index usertype ON tbl_Player_Pending (UserID,ItemType,Complete);
Create Index useritemcomplete ON tbl_Player_Pending (UserID,ItemType,ItemID,Complete);
Create Index userid ON tbl_Player_Pending (UserID);
Create Index playchurch ON tbl_Player_Building_Progress (UserID,ChurchID);
Create Index useritem ON tbl_Player_Collections (UserID,ItemID);
Create Index usercollecitem ON tbl_Player_Collections (UserID,CollectionID,ItemID);
Create Index userpend ON tbl_Player_Gift_Recieved (UserID,PendingID);
Create Index userlast ON tbl_Player_Requests_Sent (UserID,LastSent);






