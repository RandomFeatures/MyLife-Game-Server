USE myaccount;
DELIMITER $$

DROP PROCEDURE IF EXISTS `myaccount`.`dsp_config_getvalue` $$
CREATE DEFINER=`myaccount_game`@`%` PROCEDURE `myaccount`.`dsp_config_getvalue` (Key_Name varchar(25), Game_ID int, Source_Type int)
BEGIN

     IF (Game_ID IS NULL AND Source_Type IS NOT NULL) THEN
          SELECT
                ConfigValue
          FROM
                tbl_Config
          WHERE
               KeyName = Key_Name
          AND
               GameID is NULL
          AND
               SourceType = Source_Type
          AND
               Active = 1;
     ELSEIF (Game_ID IS NOT NULL AND Source_Type IS NULL) THEN
          SELECT
                ConfigValue
          FROM
                tbl_Config
          WHERE
               KeyName = Key_Name
          AND
               GameID = Game_ID
          AND
               SourceType is NULL
          AND
               Active = 1;
     ELSEIF (Game_ID IS NOT NULL AND Source_Type IS NOT NULL)  THEN
          SELECT
                ConfigValue
          FROM
                tbl_Config
          WHERE
               KeyName = Key_Name
          AND
               GameID = Game_ID
          AND
               SourceType = Source_Type
          AND
               Active = 1;
     ELSEIF (Game_ID IS NULL AND Source_Type IS NULL) THEN
          SELECT
                ConfigValue
          FROM
                tbl_Config
          WHERE
               KeyName = Key_Name
          AND
               GameID is NULL
          AND
               SourceType is NULL
          AND
               Active = 1;
     END IF;

END $$

DROP PROCEDURE IF EXISTS `myaccount`.`dsp_login_user`$$
CREATE DEFINER=`myaccount_game`@`%` PROCEDURE `myaccount`.`dsp_login_user`(slogin VARCHAR(100), spassword VARCHAR(20), source_type int, game_id int)
BEGIN
       
	SET @userid = 0;
	SET @accountstatus = 0;
	
	SELECT
		UserID,
		AccountStatus
    INTO
        @userid,
        @accountstatus
	FROM
		myaccount.tbl_Users
	WHERE
		Login = slogin
	AND
		Passw = spassword
	AND
		SourceType = source_type;

	IF @userid > 0 AND @accountstatus = 1 THEN	
		/*--user exists but not playing this game*/
		SET @existCount = 0;
		SELECT COUNT(userID) INTO @existCount FROM myaccount.tbl_User_Games WHERE UserID = @userid and GameID = game_id;
		IF @existCount = 0 THEN
			/*--update user games*/
			INSERT INTO myaccount.tbl_User_Games
				(UserID, GameID) 
			VALUES 
				(@userid, game_id);			
		END IF;

		call myaccount.dsp_event_insert(500,@userid,game_id,2,null);
	END IF;

	SELECT @userid as indx;
END$$



DROP PROCEDURE IF EXISTS `myaccount`.`dsp_login_xref`$$
CREATE DEFINER=`myaccount_game`@`%`  PROCEDURE `myaccount`.`dsp_login_xref`(x_ref VARCHAR(100), source_type int, game_id int)
BEGIN
       
	SET @userid = 0;
	SET @accountstatus = 0;

	SELECT
		UserID,
		AccountStatus
    INTO
        @userid,
        @accountstatus
	FROM
		myaccount.tbl_Users
	WHERE
		XRef = x_ref
	AND
		SourceType = source_type;

	IF @userid > 0 AND @accountstatus = 1 THEN	
		/*--user exists but not playing this game*/
		SET @existCount = 0;
		SELECT COUNT(userID) INTO @existCount FROM myaccount.tbl_User_Games WHERE UserID = @userid and GameID = game_id;
		IF @existCount = 0 THEN
			/*--update user games*/
			INSERT INTO myaccount.tbl_User_Games
				(UserID, GameID) 
			VALUES 
				(@userid, game_id);			
		END IF;


		call myaccount.dsp_event_insert(500,@userid,game_id,2,null);
	END IF;

	SELECT @userid as indx;
END$$


DROP PROCEDURE IF EXISTS `myaccount`.`dsp_event_insert`$$
CREATE DEFINER=`myaccount_game`@`%`  PROCEDURE `myaccount`.`dsp_event_insert`(event_code int, user_id int, game_id int, caller_type int, cmnts Varchar(255))
BEGIN
       
	INSERT INTO myaccount.tbl_User_Events
			(EventCode, UserID, GameID, Caller, EventDate, Comments) 
	VALUES 
			(event_code, user_id, game_id, caller_type, NOW(), cmnts);
	
END$$

DROP PROCEDURE IF EXISTS `myaccount`.`dsp_error_log`$$
CREATE DEFINER=`myaccount_game`@`%`  PROCEDURE `myaccount`.`dsp_error_log`(user_id int, game_id int, process_name Varchar(500), error_msg text, xml_msg text)
BEGIN
       
	INSERT INTO myaccount.tbl_Error_Log
		(ErrorDate, GameID, UserID, ProcessName, ErrorMessage, XMLMessage) 
	VALUES 
		(NOW(), game_id, user_id, process_name, error_msg, xml_msg);
	
END$$


DROP PROCEDURE IF EXISTS `myaccount`.`dsp_register_user`$$
CREATE DEFINER=`myaccount_game`@`%`  PROCEDURE `myaccount`.`dsp_register_user`(sxref VARCHAR(100), first_name VARCHAR(50), last_name VARCHAR(50), slogin VARCHAR(100), spassword VARCHAR(20), semail VARCHAR(512), source_type int, game_id int)
BEGIN
       
	SET @userid = 0;
	SET @xref = sxref;
	SET @accountstatus = 0;

	SELECT
		UserID,
		AccountStatus
    INTO
        @userid,
        @accountstatus
	FROM
		myaccount.tbl_Users
	WHERE
		XRef = sxref
	AND
		SourceType = source_type;

	IF @userid = 0 AND @accountstatus = 0 THEN	
		
		IF (sxref = '') THEN SET @xref = NULL; END IF;

		-- insert new user
		INSERT INTO myaccount.tbl_Users
			(XRef, FirstName, LastName, Login, Passw, Email, SourceType, AccountStatus) 
		VALUES 
			(@xref, first_name, last_name, slogin, spassword, semail, source_type, 1);

		SET @userid = LAST_INSERT_ID();

		-- log the event*/
		IF @userid > 0 THEN	
			-- update user games
			INSERT INTO myaccount.tbl_User_Games
				(UserID, GameID) 
			VALUES 
				(@userid, game_id);

			call myaccount.dsp_event_insert(100,@userid,game_id,2,null);
		END IF;
	ELSE
		call myaccount.dsp_event_insert(500,@userid,game_id,2,null);
	END IF;

	-- return user id
	SELECT @userid as indx;
END$$

DROP PROCEDURE IF EXISTS `myaccount`.`dsp_product_purchase`$$
CREATE DEFINER=`myaccount_game`@`%`  PROCEDURE `myaccount`.`dsp_product_purchase`(user_id int, game_id int, product_id int, purchase_code int, purchase_system int)
BEGIN
    
	INSERT INTO myaccount.tbl_User_Products
		(UserID, GameID, ProductID, PurchaseCode, PurchaseDate, PurchaseStatus, PurchaseSystem, ExternalID) 
	VALUES 
		(user_id, game_id, product_id, purchase_code, NOW(), 0, purchase_system, '');
	
	/*--user init*/
	call myaccount.dsp_event_insert(310,user_id,game_id,2,null);

	SELECT LAST_INSERT_ID() as indx;	
END$$


DROP PROCEDURE IF EXISTS `myaccount`.`dsp_product_verify`$$
CREATE DEFINER=`myaccount_game`@`%`  PROCEDURE `myaccount`.`dsp_product_verify`(user_product_id int, user_id int, game_id int, product_id int)
BEGIN
    
	SELECT  
		UserID, 
		GameID, 
		ProductID
	FROM	
		myaccount.tbl_User_Products
	WHERE
		ID = user_product_id
	AND
		GameID = game_id
	AND
		UserID = user_id
	AND 
		ProductID = product_id
	AND		
		PurchaseStatus = 0;

END$$



DROP PROCEDURE IF EXISTS `myaccount`.`dsp_product_complete`$$
CREATE DEFINER=`myaccount_game`@`%`  PROCEDURE `myaccount`.`dsp_product_complete`(user_product_id int, user_id int, game_id int, product_id int, external_id varchar(200), external_data Mediumtext)
BEGIN
    
	UPDATE 
		myaccount.tbl_User_Products 
	SET 
		PurchaseStatus = 1, 
		ExternalID = external_id,
		ExternalData = external_data
	WHERE
		UserID = user_id  
	AND
		GameID = game_id 
	AND
		ProductID = product_id 
	AND
		id = user_product_id;		
	/*--service approved*/
	call myaccount.dsp_event_insert(340,user_id,game_id,2,external_id);
	
END$$

DROP PROCEDURE IF EXISTS `myaccount`.`dsp_product_cancel`$$
CREATE DEFINER=`myaccount_game`@`%`  PROCEDURE `myaccount`.`dsp_product_cancel`(user_product_id int, user_id int, game_id int, product_id int, external_id varchar(200))
BEGIN
    
	UPDATE 
		myaccount.tbl_User_Products
	SET 
		ExternalID = external_id,
		PurchaseStatus = 2
	WHERE
		UserID = user_id  
	AND
		GameID = game_id 
	AND
		ProductID = product_id 
	AND
		id = user_product_id;		
	/*--service denied*/
	call myaccount.dsp_event_insert(370,user_id,game_id,2,external_id);
	
END$$

DROP PROCEDURE IF EXISTS `myaccount`.`dsp_product_apply`$$
CREATE DEFINER=`myaccount_game`@`%`  PROCEDURE `myaccount`.`dsp_product_apply`(user_id int, game_id int, product_id int)
BEGIN
    
	SET @UserID = user_id;
	SET @Script = '';	

	SELECT 
		ActionScript
	INTO
		@Script
	FROM 
		myaccount.tbl_Products
	WHERE
		ProductID =	product_id	
	AND
		GameID = game_id
	AND
		Active = 1;

	
	PREPARE scrpt FROM @Script;
	EXECUTE scrpt USING @UserID;

	/*--product Applied*/
	call myaccount.dsp_event_insert(360,user_id,game_id,2,external_id);
	
END$$

DROP PROCEDURE IF EXISTS `myaccount`.`dsp_product_list`$$
CREATE DEFINER=`myaccount_game`@`%`  PROCEDURE `myaccount`.`dsp_product_list`(game_id int)
BEGIN
    
	SELECT 
		ProductID,
		ProductName,
		Price,
		ProductType
	FROM 
		myaccount.tbl_Products
	WHERE
		GameID = game_id
	AND
		Active = 1;
	
END$$


DELIMITER ;

