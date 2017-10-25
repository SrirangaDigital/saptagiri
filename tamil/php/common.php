<?php

function isValidId($book_id)
{
	if(is_array($book_id)){return false;}
	return preg_match("/^[0-9][0-9][0-9]$/", $book_id) ? true : false;
}

function isValidType($type)
{
	if(is_array($type)){return false;}
	return preg_match("/^(rec|mem|occ|fbi|fi|sfs|cas|ess|hpg|spb|sse|tcm|zlg|bul)$/", $type) ? true : false;
}

function isValidCheck($check)
{
	for($i=0;$i<sizeof($check);$i++)
	{
		if(is_array($check[$i])){return false;}
		if(!(preg_match("/^(rec|mem|occ|fbi|fi|sfs|cas|ess|hpg|spb|sse|tcm|zlg|bul)$/", $check[$i])))
		{
			return false;
		}
	}
	return true;
}

function isValidTitle($title)
{
	return is_array($title) ? false : true;
}
function isValidLetter($letter)
{
	return is_array($letter) ? false : true;
}
function isValidVolume($vol)
{
	if(is_array($vol)){return false;}
	return preg_match("/^[0-9][0-9][0-9]$/", $vol) ? true : false;
}

function isValidissue($issue)
{
	if(is_array($issue)){return false;}
	return preg_match("/([0-9][0-9]\-[0-9][0-9])||([0-9][0-9])/", $issue) ? true : false;
}

function isValidYear($year)
{
	if(is_array($year)){return false;}
	return preg_match("/^([0-9][0-9][0-9][0-9]|[0-9][0-9][0-9][0-9]\-[0-9][0-9])$/", $year) ? true : false;
}

function isValidFeature($feature)
{
	return is_array($feature) ? false : true;
}

function isValidFeatid($featid)
{
	if(is_array($featid)){return false;}
	return preg_match("/^[0-9][0-9][0-9][0-9][0-9]$/", $featid) ? true : false;
}

function isValidAuthid($authid)
{
	if(is_array($authid)){return false;}
	return preg_match("/^[0-9][0-9][0-9][0-9][0-9]$/", $authid) ? true : false;
}

function isValidAuthor($author)
{
	return is_array($author) ? false : true;
}

function isValidText($text)
{
	return is_array($text) ? false : true;
}

function entityReferenceReplace($term)
{
	if(is_array($term))
	{
		$term = "$term";
	}
	
	$term = preg_replace("/<i>/", "", $term);
	$term = preg_replace("/<\/i>/", "", $term);
	$term = preg_replace("/\;/", "&#59;", $term);
	$term = preg_replace("/</", "&#60;", $term);
	$term = preg_replace("/=/", "&#61;", $term);
	$term = preg_replace("/>/", "&#62;", $term);
	$term = preg_replace("/\(/", "&#40;", $term);
	$term = preg_replace("/\)/", "&#41;", $term);
	$term = preg_replace("/\:/", "&#58;", $term);
	$term = preg_replace("/Drop table|Create table|Alter table|Delete from|Desc table|Show databases|iframe/i", "", $term);
	
	return($term);
}

function getYearMonth($volume, $issue)
{
	include("connect.php");

	$query = "select distinct year,month from article where volume='$volume' and issue='$issue'";
	$result = $db->query($query);
	$num_rows = $result ? $result->num_rows : 0;
	if($num_rows > 0)
	{
		$row = $result->fetch_assoc();
		return($row);
	}
	else
	{
		$row['year'] = '';
		$row['month'] = '';
		return($row);
	}
}

function getinfo($volume, $issue)
{
	include("connect.php");

	$query = "select distinct info from article where volume='$volume' and issue='$issue'";
	$result = $db->query($query);
	$num_rows = $result ? $result->num_rows : 0;
	if($num_rows > 0)
	{
		$row = $result->fetch_assoc();
		return($row);
	}
	else
	{
		$row['info'] = '';
		return($row);
	}
}

function getYear($volume)
{
	include("connect.php");

	$query = "select distinct year from article where volume='$volume'";
	$result = $db->query($query);
	$num_rows = $result ? $result->num_rows : 0;
	if($num_rows > 0)
	{
		$year = '';
		while($row = $result->fetch_assoc())
		{
			$year = $year . '-' . $row['year'];
		}
		$year = preg_replace('/^\-/', '', $year);
		$year = preg_replace('/\-[0-9][0-9]([0-9][0-9])/', '-$1', $year);
		return( $year );
	}
	else
	{
		return( '' );
	}
}

function getMonth($month)
{
	$month = preg_replace('/01/', 'தை', $month);
	$month = preg_replace('/02/', 'மாசி', $month);
	$month = preg_replace('/03/', 'பங்குனி', $month);
	$month = preg_replace('/04/', 'சித்திரை', $month);
	$month = preg_replace('/05/', 'வைகாசி', $month);
	$month = preg_replace('/06/', 'ஆனி', $month);
	$month = preg_replace('/07/', 'ஆடி', $month);
	$month = preg_replace('/08/', 'ஆவணி', $month);
	$month = preg_replace('/09/', 'புரட்டாசி', $month);
	$month = preg_replace('/10/', 'ஐப்பசி', $month);
	$month = preg_replace('/11/', 'கார்த்திகை', $month);
	$month = preg_replace('/12/', 'மார்கழி', $month);
	
	return $month;
}
function toKannada($value)
{
	// $value = preg_replace('/0/', '௦', $value);
	// $value = preg_replace('/1/', '௧', $value);
	// $value = preg_replace('/2/', '௨', $value);
	// $value = preg_replace('/3/', '௩', $value);
	// $value = preg_replace('/4/', '௪', $value);
	// $value = preg_replace('/5/', '௫', $value);
	// $value = preg_replace('/6/', '௬', $value);
	// $value = preg_replace('/7/', '௭', $value);
	// $value = preg_replace('/8/', '௮', $value);
	// $value = preg_replace('/9/', '௯	', $value);
	
	return $value;
}
/*
isValidTitle, isValidFeature, isValidAuthor, isValidText
*/
?>
