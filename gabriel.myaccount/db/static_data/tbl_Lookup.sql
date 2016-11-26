USE myaccount;

INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES ('ProductType',0,'One Time Purchase',1);
INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('ProductType',1,'Reocurring Purchase',1);
INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('ProductType',2,'Promotion',1);

INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('PurchaseSystem',0,'Paypal',1);
INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('PurchaseSystem',1,'Facebook',1);

INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('PurchaseCode',0,'Direct Purchase',1);
INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('PurchaseCode',1,'Promotion',1);
INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('PurchaseCode',2,'Reward',1);

INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('SourceType',0,'Facebook',1);
INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('SourceType',1,'Website',1);
INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('SourceType',2,'iPhone',1);
INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('SourceType',3,'Android',1);
INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('SourceType',4,'MySpace',1);
INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('SourceType',5,'Palm Pre',1);

INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('AccountStatus',0,'Inactive',1);
INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('AccountStatus',1,'Active',1);
INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('AccountStatus',2,'Banned',1);
INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('AccountStatus',3,'Suspended',1);
INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('AccountStatus',4,'Dead',1);
INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('AccountStatus',5,'Protected',1);

INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('PurchaseStatus',0,'Pending',1);
INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('PurchaseStatus',1,'Complete',1);
INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('PurchaseStatus',2,'Cancelled',1);
INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('PurchaseStatus',3,'Abandoned',1);
INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('PurchaseStatus',4,'Rejected',1);


INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('CallerType',0,'Game Server',1);
INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('CallerType',1,'MyAccount Server',1);
INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('CallerType',2,'Stored Proc',1);
INSERT INTO tbl_Lookup(Lookuptype, LookupCode, LookupDesc, Active) 
VALUES('CallerType',3,'Game Client',1);



