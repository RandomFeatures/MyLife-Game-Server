<?php
/*
 Description:    Transform charon XML into a resultset like
 data structor that is easier to work with

 ****************History************************************
 Date:         	10.18.2009
 Author:       	Allen Halsted
 Mod:          	Creation
 ***********************************************************
 */

class sys_recordset {
	private $recordcount;
	private $currentrow;
	private $eof;

	private $recorddata;

	function __construct(){
		$this->recordcount = 0;
		$this->recorddata = 0;
	}

	public function SetData( $newdata, $num_records ) {
		$this->recorddata = $newdata;
		$this->recordcount = $num_records;
		$this->currentrow = 0;
		$this->set_eof();
	}

	public function ParseXML(&$xml)
	{

		//create teh parser
		$xmlParser = new gc_xmlparser($xml);
		$objxml = $xmlParser->GetData();
		$thisData = "";
		$num_rows = 0;
		$i = 0;
		$rtn = FALSE;

		//var_dump($xml);
		//echo "<br>";
		//make sure that the xml will contain a dataset
		$success = $objxml['Charon-XML']['header']['status']['VALUE'];

		if (strcasecmp($success, 'Success') == 0) {
			//loop throuhg the dataset and convert the xml rows to
			//result set rows
			foreach ($objxml['Charon-XML']['dataset']['row'] as $row) {
				$tmpArray = Array();
				//this if statements deals with the mulit row quirk in the xml reader
				//where a single <row> entry comes back one way and mulitble <row> comes
				//back another way
				if ($row[fieldlist][field][0][VALUE] == null)
				{
					foreach ($row[field] as $field){
						//feild names are case sensitive
						$name = $field[name];
						$value = $field[VALUE];
						$tmpArray[$name] = $value;
					}
					$num_rows++;
				}else
				{
					foreach ($row[fieldlist][field] as $field){
						//feild names are case sensitive
						$name =  $field[name];
						$value = $field[VALUE];
						$tmpArray[$name] = $value;
					}
					$num_rows++;
				}
				$thisData[$i] = $tmpArray;
				unset($tmpArray);
				$i++;
			}
			$this->SetData( $thisData, $num_rows);
			$rtn = TRUE;
		}
		return $rtn;
	}
	 
	public function set_eof() {
		$this->eof = $this->currentrow >= $this->recordcount;
	}

	public function movenext()  { if ($this->currentrow < $this->recordcount) { $this->currentrow++; $this->set_eof(); } }
	public function moveprev()  { if ($this->currentrow > 0)                  { $this->currentrow--; $this->set_eof(); } }
	public function movefirst() { $this->currentrow = 0; set_eof();                                               }
	public function movelast()  { $this->currentrow = $this->recordcount - 1;  set_eof();                         }

	public function data($field_name) {
		if (isset($this->recorddata[$this->currentrow][$field_name])) {
			$thisVal = $this->recorddata[$this->currentrow][$field_name];
		} else if ($this->eof) {
			die("<B>Error!</B> eof of recordset was reached");
		} else {
			die("<B>Error!</B> Field <B>" . $field_name . "</B> was not found in the current recordset<br><br>");
		}

		return $thisVal;
	}

	public function __get($field_name) {
		return $this->data($field_name);
	}
	 
	public function getRow()
	{
		if (isset($this->recorddata[$this->currentrow])) {
			$rtn = $this->recorddata[$this->currentrow];
			$this->movenext();
		} else if ($this->eof) {
			$rtn = FALSE;
		}
		return $rtn;
	}
	 
}

?>