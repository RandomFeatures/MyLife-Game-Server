<?php
/*
 Description:    inherit only data Access Object
 
 ****************History************************************
 Date:         	1.18.2011
 Author:       	Allen Halsted
 Mod:          	Creation
 ***********************************************************
 */

 abstract class daoBase
 {
 	   
 		private $mysqli;
	   	
       	// Constructor
		function __construct($dbHost, $dbUser, $dbPass, $dbDatabase)
		{

			$this->mysqli=new mysqli($dbHost, $dbUser, $dbPass,  $dbDatabase);
			if ($this->mysqli->connect_error) {
    			die('Connect Error (' . $this->mysqli->connect_errno . ') ' . $this->mysqli->connect_error);
			}


		}
 		
		function __destruct() 
 		{
       		$this->mysqli->close();
 			unset($this->mysqli);
   		}

   		function printLastError()
   		{
   			echo $this->mysqli->error;
   		}
		
		protected function Query($sproc, $param)
		{
			$returnArray = null;
			$i=0;
			
			$query_result = $this->mysqli->query( 'CALL '.$sproc. $param);
			if(is_object($query_result))
          	{
				while($row = $query_result->fetch_object())
				{
					if ($row)
	     				$returnArray[$i++]=$row;
				}
				$query_result->close();
				$this->freeExtraResults();
			}
			unset($query_result);

			return $returnArray;
			
		}

		protected function Exec($sproc, $param)
		{
			$query_result = $this->mysqli->query( 'CALL '.$sproc. $param);
			if(is_object($query_result))
			{
				$query_result->close();
				unset($query_result);
			}
			$this->freeExtraResults();
		}
		
		private function freeExtraResults()
		{
			while($this->mysqli->more_results() && $this->mysqli->next_result())
			{
				$extraResult = $this->mysqli->use_result();
				if($extraResult instanceof mysqli_result)
				{
					$extraResult->free();
				}
			}
			
		}
		
		
 }	
?>