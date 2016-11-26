/*
Created		2/23/2009
Modified		1/13/2011
Project		Web Project
Model		MyAccount
Company		TBD
Author		Allen Halsted
Version		0.76
Database		mySQL 5 
*/



Drop index login on tbl_Users;
Drop index xref on tbl_Users;
Drop index game on tbl_Products;
Drop index keyname on tbl_Config;
Drop index userid on tbl_User_Games;
Drop index usergame on tbl_User_Products;
Drop index usergameproduct on tbl_User_Products;




drop table IF EXISTS tbl_User_Products;
drop table IF EXISTS tbl_User_Games;
drop table IF EXISTS tbl_Error_Log;
drop table IF EXISTS tbl_Games;
drop table IF EXISTS tbl_User_Events;
drop table IF EXISTS tbl_Config;
drop table IF EXISTS tbl_Events;
drop table IF EXISTS tbl_Lookup;
drop table IF EXISTS tbl_Products;
drop table IF EXISTS tbl_Users;




Create table tbl_Users (
	UserID Int NOT NULL AUTO_INCREMENT,
	XRef Varchar(100),
	FirstName Varchar(50) NOT NULL,
	LastName Varchar(50) NOT NULL,
	Login Varchar(100) NOT NULL,
	Passw Varchar(20) NOT NULL,
	Email Varchar(512) NOT NULL,
	SourceType Int NOT NULL,
	AccountStatus Int NOT NULL,
 Primary Key (UserID)) ENGINE = InnoDB;

Create table tbl_Products (
	ProductID Int NOT NULL AUTO_INCREMENT,
	ProductName Varchar(100) NOT NULL,
	GameID Int NOT NULL,
	Price Decimal(10,0) NOT NULL,
	ProductType Int NOT NULL,
	ActionScript Text NOT NULL,
	Active Bit(1) NOT NULL,
 Primary Key (ProductID)) ENGINE = InnoDB;

Create table tbl_Lookup (
	LookupID Int NOT NULL AUTO_INCREMENT,
	LookupType Varchar(25) NOT NULL,
	LookupCode Int NOT NULL,
	LookupDesc Varchar(50) NOT NULL,
	Active Bit(1) NOT NULL,
 Primary Key (LookupID)) ENGINE = InnoDB;

Create table tbl_Events (
	ID Int NOT NULL AUTO_INCREMENT,
	EventCode Int NOT NULL,
	EventDesc Varchar(20) NOT NULL,
 Primary Key (ID)) ENGINE = InnoDB;

Create table tbl_Config (
	ID Int NOT NULL AUTO_INCREMENT,
	KeyName Varchar(25) NOT NULL,
	ConfigValue Varchar(256) NOT NULL,
	GameID Int NOT NULL,
	SourceType Int NOT NULL,
	Active Bit(1) NOT NULL,
 Primary Key (ID)) ENGINE = InnoDB;

Create table tbl_User_Events (
	EventID Int NOT NULL AUTO_INCREMENT,
	EventCode Int NOT NULL,
	UserID Int NOT NULL,
	GameID Int NOT NULL,
	Caller Int NOT NULL,
	EventDate Datetime NOT NULL,
	Comments Varchar(255),
 Primary Key (EventID)) ENGINE = InnoDB;

Create table tbl_Games (
	GameID Int NOT NULL AUTO_INCREMENT,
	GameName Varchar(500) NOT NULL,
	GameDesc Varchar(1000),
	Active Bit(1) NOT NULL,
 Primary Key (GameID)) ENGINE = InnoDB;

Create table tbl_Error_Log (
	ErrorID Int NOT NULL AUTO_INCREMENT,
	ErrorDate Datetime NOT NULL,
	GameID Int,
	UserID Int,
	ProcessName Varchar(500),
	ErrorMessage Text,
	XMLMessage Text,
 Primary Key (ErrorID)) ENGINE = InnoDB;

Create table tbl_User_Games (
	ID Int NOT NULL AUTO_INCREMENT,
	UserID Int NOT NULL,
	GameID Int NOT NULL,
 Primary Key (ID)) ENGINE = InnoDB;

Create table tbl_User_Products (
	ID Int NOT NULL AUTO_INCREMENT,
	UserID Int NOT NULL,
	GameID Int NOT NULL,
	ProductID Int NOT NULL,
	PurchaseCode Int NOT NULL,
	PurchaseDate Datetime NOT NULL,
	PurchaseStatus Int NOT NULL,
	PurchaseSystem Int NOT NULL,
	ExternalID Varchar(200),
	ExternalData Mediumtext,
 Primary Key (ID)) ENGINE = InnoDB;



Create Index login ON tbl_Users (Login,Passw,SourceType);
Create Index xref ON tbl_Users (XRef,SourceType);
Create Index game ON tbl_Products (GameID);
Create Index keyname ON tbl_Config (KeyName,GameID,SourceType,Active);
Create Index userid ON tbl_User_Games (UserID);
Create Index usergame ON tbl_User_Products (UserID,GameID);
Create Index usergameproduct ON tbl_User_Products (UserID,GameID,ProductID);







