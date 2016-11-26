<?php


global $XML_BEGIN, $XML_Header_Fail, $XML_Header, $XML_END;


$XML_BEGIN = '<?xml version="1.0"?><Charon-XML>';
$XML_Header = '<header id="##headerid##"><date>'.date("F j, Y, g:i a").'</date><status>success</status></header><dataset>';
$XML_Header_Fail = '<header id="##headerid##"><date>'.date("F j, Y, g:i a").'</date><status>fail</status></header><dataset>';
$XML_END = '</dataset></Charon-XML>';

function buildRewardXML($StatsXML,$ItemRewardXML,$Coins,$Bookmarks,$JobApproval,$Experience,$Level,$Energy,$Congergation)
{
	$rtnXML = $XML_BEGIN.str_replace('##headerid##','Reward',$XML_Header);
	//reward tag
	$rtnXML = $rtnXML.'<reward experince="'.$rExperience.
					       '" level="'.$Level.
					       '" jobapproval="'.$JobApproval.
					       '" congergation="'.$Congregation.
					       '" coins="'.$Coins.
					       '" bookmarks="'.$Bookmarks.
					       '" energy="'.$Energy.
					       '" />';
	//add stats tag
	$rtnXML = $rtnXML.$ItemRewardXML;
	$rtnXML = $rtnXML.$StatsXML;
	$rtnXML = $rtnXML.$XML_END;
	
	return $rtnXML;
}

function buildItemRewardXML($row, $idKey)
{
	$xmlrow = '<item id="'.$row->id.
						'" collectid="'.$row->CollectionID.
						'" name="'.$row->Name.
						'" image="'.$row->Image.
						'" level="'.$row->Level.
						'" itemnum="'.$row->ItemNumber.
						'" droprate="'.$row->DropRate.
						'" key="'.$idKey.
						'" />';
	
	return $xmlrow;
}

function buildPurchaseXML($StatsXML,$ProgressXML,$OldItemID, $NewItemID,$Coins,$Bookmarks,$JobApproval,$Experience,$Level)
{
	$rtnXML = $XML_BEGIN.str_replace('##headerid##','Purchase',$XML_Header);
	//reward tag
	$rtnXML = $rtnXML.'<reward experince="'.$rExperience.
					       '" level="'.$Level.
					       '" jobapproval="'.$JobApproval.
					       '" congergation="0'.
					       '" coins="'.$Coins.
					       '" bookmarks="'.$Bookmarks.
					       '" energy="0'.
					       '" />';
	//add stats tag
	$rtnXML = $rtnXML.'<purchase oldid="'.$OldItemID.
						'" newid="'.$NewItemID.
	 					'" />';
	
	$rtnXML = $rtnXML.$StatsXML;
	$rtnXML = $rtnXML.$ProgressXML;
	$rtnXML = $rtnXML.$XML_END;
	
	return $rtnXML;
}




?>