/*
Created		1/6/2011
Modified		1/7/2011
Project		My Christian Life
Model		Game Data
Company		TBD
Author		Allen Halsted
Version		.01
Database		mySQL 5 
*/



Drop index collect on tbl_Collection_Items;
Drop index building on tbl_Building_Dailies;
Drop index questid on tbl_Quest_Steps;
Drop index tigger on tbl_Quest_Step_Trigger;
Drop index tigger on tbl_Quest_Trigger;
Drop index tigger on tbl_Achievement_Trigger;
Drop index keyname on tbl_Config;
Drop index levels on tbl_Level_Progression;




drop table IF EXISTS tbl_Achievement_Trigger;
drop table IF EXISTS tbl_Achievements;
drop table IF EXISTS tbl_Restrictions;
drop table IF EXISTS tbl_Rewards;
drop table IF EXISTS tbl_Store;
drop table IF EXISTS tbl_Quest_Trigger;
drop table IF EXISTS tbl_Quest_Step_Trigger;
drop table IF EXISTS tbl_Quest_Steps;
drop table IF EXISTS tbl_Quests;
drop table IF EXISTS tbl_Missions;
drop table IF EXISTS tbl_Dailies;
drop table IF EXISTS tbl_Building_Requirements;
drop table IF EXISTS tbl_Building_Dailies;
drop table IF EXISTS tbl_Buildings;
drop table IF EXISTS tbl_Collection_Items;
drop table IF EXISTS tbl_Collections;
drop table IF EXISTS tbl_Level_Progression;
drop table IF EXISTS tbl_SplashScreen;
drop table IF EXISTS tbl_Config;
drop table IF EXISTS tbl_Lookup;
drop table IF EXISTS tbl_MotD;
drop table IF EXISTS tbl_Decore;



Create table tbl_Collections (
	id Int NOT NULL AUTO_INCREMENT,
	Name Varchar(100) NOT NULL,
	RewardID Int NOT NULL,
	Active Bit(1) NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Collection_Items (
	id Int NOT NULL AUTO_INCREMENT,
	CollectionID Int NOT NULL,
	Name Varchar(100) NOT NULL,
	Image Varchar(200) NOT NULL,
	Level Int NOT NULL,
	ItemNumber int NOT NULL,
	DropRate Int NOT NULL,
	Active Bit(1) NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Buildings (
	id Int NOT NULL AUTO_INCREMENT,
	Name Varchar(100) NOT NULL,
	Dscrpt Varchar(256) NOT NULL,
	Capacity Int NOT NULL,
	Row Int NOT NULL,
	Col Int NOT NULL,
	Width Int NOT NULL,
	Height Int NOT NULL,
	OffsetX Int NOT NULL,
	OffsetY Int NOT NULL,
	SellValue Int NOT NULL,
	Image Varchar(250) NOT NULL,
	Facings Int NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Building_Dailies (
	id Int NOT NULL AUTO_INCREMENT,
	BuildingID Int NOT NULL,
	DailyID Int NOT NULL,
	Active Bit(1) NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Building_Requirements (
	id Int NOT NULL AUTO_INCREMENT,
	BuildingID Int NOT NULL,
	CollectionItemID Int NOT NULL,
	ItemCount Int NOT NULL,
	BuyNow Int NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Dailies (
	id Int NOT NULL AUTO_INCREMENT,
	Name Varchar(100) NOT NULL,
	Dscrpt Varchar(256) NOT NULL,
	RechargeTime Int NOT NULL,
	BusyTime Int NOT NULL,
	RewardID Int NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Missions (
	id Int NOT NULL AUTO_INCREMENT,
	Name Varchar(100) NOT NULL,
	Dscrpt Varchar(256) NOT NULL,
	Image Varchar(250) NOT NULL,
	RestrictionID Int NOT NULL,
	Active Bit(1) NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Quests (
	id Int NOT NULL AUTO_INCREMENT,
	Name Varchar(100) NOT NULL,
	Dscrpt Varchar(256) NOT NULL,
	Steps Int NOT NULL,
	RewardID Int NOT NULL,
	Hint Varchar(512) NOT NULL,
	Active Bit(1) NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Quest_Steps (
	id Int NOT NULL AUTO_INCREMENT,
	QuestID Int NOT NULL,
	Dscrpt Varchar(512) NOT NULL,
	Required Int NOT NULL,
	StepNumber Int NOT NULL,
	BuyNow Int NOT NULL,
	Image Varchar(250) NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Quest_Step_Trigger (
	id Int NOT NULL AUTO_INCREMENT,
	TriggerType Int NOT NULL,
	ActionTrigger Int NOT NULL,
	QuestID Int NOT NULL,
	StepID Int NOT NULL,
	StepNumber Int NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Quest_Trigger (
	id Int NOT NULL AUTO_INCREMENT,
	TriggerType Int NOT NULL,
	ActionTrigger Int NOT NULL,
	QuestID Int NOT NULL,
	Active Bit(1) NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Store (
	id Int NOT NULL AUTO_INCREMENT,
	ItemType Int NOT NULL,
	ItemID Int NOT NULL,
	Dscrpt Varchar(250) NOT NULL,
	Image Varchar(250) NOT NULL,
	SaleEndDate Datetime NOT NULL,
	RewardID Int NOT NULL,
	Cost Int NOT NULL,
	CostType Int NOT NULL,
	RestrictionID Int NOT NULL,
	Active Bit(1) NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Rewards (
	id Int NOT NULL AUTO_INCREMENT,
	Name Varchar(100) NOT NULL,
	Coins Int NOT NULL,
	Bookmarks Int NOT NULL,
	JobApproval Int NOT NULL,
	Xp Int NOT NULL,
	Active Bit(1) NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Restrictions (
	id Int NOT NULL AUTO_INCREMENT,
	Dscrpt Varchar(20) NOT NULL,
	StatType Int NOT NULL,
	StatID Int NOT NULL,
	BuyNow Int NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Achievements (
	id Int NOT NULL AUTO_INCREMENT,
	Name Varchar(100) NOT NULL,
	Dscrpt Varchar(250) NOT NULL,
	Level1 Int NOT NULL,
	Level2 Int NOT NULL,
	Level3 Int NOT NULL,
	RewardID Int NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Achievement_Trigger (
	id Int NOT NULL AUTO_INCREMENT,
	TriggerType Int NOT NULL,
	ActionTrigger Int NOT NULL,
	AchievementID Int NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_MotD (
	id Int NOT NULL AUTO_INCREMENT,
	TheMsg Text NOT NULL,
	Active Bit(1) NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Lookup (
	LookupID Int NOT NULL AUTO_INCREMENT,
	LookupType Varchar(25) NOT NULL,
	LookupCode Int NOT NULL,
	LookupDesc Varchar(50) NOT NULL,
	Active Bit(1) NOT NULL,
 Primary Key (LookupID)) ENGINE = InnoDB;

Create table tbl_Config (
	ID Int NOT NULL AUTO_INCREMENT,
	KeyName Varchar(25) NOT NULL,
	ConfigValue Varchar(256) NOT NULL,
	GameID Int NOT NULL,
	SourceType Int NOT NULL,
	Active Bit(1) NOT NULL,
 Primary Key (ID)) ENGINE = InnoDB;

Create table tbl_SplashScreen (
	id Int NOT NULL AUTO_INCREMENT,
	Image Varchar(200) NOT NULL,
	Dscrpt Text NOT NULL,
	Active Bit(1) NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Level_Progression (
	id Int NOT NULL AUTO_INCREMENT,
	Levels Int NOT NULL,
	XP Int NOT NULL,
	Reward Int NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;

Create table tbl_Decore (
	id Int NOT NULL AUTO_INCREMENT,
	Name Varchar(100) NOT NULL,
	Dscrpt Varchar(250) NOT NULL,
	Row Int NOT NULL,
	Col Int NOT NULL,
	GridType Int NOT NULL,
	Width Int NOT NULL,
	Height Int NOT NULL,
	OffsetX Int NOT NULL,
	OffsetY Int NOT NULL,
	SellValue Int NOT NULL,
	Image Varchar(250) NOT NULL,
	Facings Int NOT NULL,
 Primary Key (id)) ENGINE = InnoDB;



Create Index collect ON tbl_Collection_Items (CollectionID,Active);
Create Index building ON tbl_Building_Dailies (BuildingID,Active);
Create Index questid ON tbl_Quest_Steps (QuestID);
Create Index tigger ON tbl_Quest_Step_Trigger (TriggerType,ActionTrigger);
Create Index tigger ON tbl_Quest_Trigger (TriggerType,ActionTrigger);
Create Index tigger ON tbl_Achievement_Trigger (TriggerType,ActionTrigger);
Create Index keyname ON tbl_Config (KeyName,GameID,SourceType,Active);
Create Index levels ON tbl_Level_Progression (Levels);
Create Index buildingid ON tbl_Building_Requirements (BuildingID);






