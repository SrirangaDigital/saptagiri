<?php include("include_header.php");?>
<main class="cd-main-content">
		<div class="cd-scrolling-bg cd-color-2">
			<div class="cd-container">
				<h1 class="clr1">आर्टिकल्स</h1>
 				<div class="alphabet gapBelowSmall gapAboveSmall">
					<span class="letter"><a href="articles.php?letter=अ">अ</a></span>
					<span class="letter"><a href="articles.php?letter=आ">आ</a></span>
					<span class="letter"><a href="articles.php?letter=इ">इ</a></span>
					<span class="letter"><a href="articles.php?letter=ई">ई</a></span>
					<span class="letter"><a href="articles.php?letter=उ">उ</a></span>
					<span class="letter"><a href="articles.php?letter=ऋ">ऋ</a></span>
					<span class="letter"><a href="articles.php?letter=ॠ">ॠ</a></span>
					<span class="letter"><a href="articles.php?letter=लृ">लृ</a></span>
					<span class="letter"><a href="articles.php?letter=ए">ए</a></span>
					<span class="letter"><a href="articles.php?letter=ऐ">ऐ</a></span>
					<span class="letter"><a href="articles.php?letter=ओ">ओ</a></span>
					<span class="letter"><a href="articles.php?letter=औ">औ</a></span>
					<span class="letter"><a href="articles.php?letter=अं">अं</a></span>
					<span class="letter"><a href="articles.php?letter=अः">अः</a></span>
					<span class="letter"><a href="articles.php?letter=क">क</a></span>
					<span class="letter"><a href="articles.php?letter=ख">ख</a></span>
					<span class="letter"><a href="articles.php?letter=ग">ग</a></span>
					<span class="letter"><a href="articles.php?letter=घ">घ</a></span>
					<span class="letter"><a href="articles.php?letter=ङ">ङ</a></span>
					<span class="letter"><a href="articles.php?letter=च">च</a></span>
					<span class="letter"><a href="articles.php?letter=छ">छ</a></span>
					<span class="letter"><a href="articles.php?letter=ज">ज</a></span>
					<span class="letter"><a href="articles.php?letter=झ">झ</a></span>
					<span class="letter"><a href="articles.php?letter=ञ">ञ</a></span>
					<span class="letter"><a href="articles.php?letter=ट">ट</a></span>
					<span class="letter"><a href="articles.php?letter=ठ">ठ</a></span>
					<span class="letter"><a href="articles.php?letter=ड">ड</a></span>
					<span class="letter"><a href="articles.php?letter=ढ">ढ</a></span>
					<span class="letter"><a href="articles.php?letter=ण">ण</a></span>
					<span class="letter"><a href="articles.php?letter=त">त</a></span>
					<span class="letter"><a href="articles.php?letter=थ">थ</a></span>
					<span class="letter"><a href="articles.php?letter=द">द</a></span>
					<span class="letter"><a href="articles.php?letter=ध">ध</a></span>
					<span class="letter"><a href="articles.php?letter=न">न</a></span>
					<span class="letter"><a href="articles.php?letter=प">प</a></span>
					<span class="letter"><a href="articles.php?letter=ब">ब</a></span>
					<span class="letter"><a href="articles.php?letter=म">म</a></span>
					<span class="letter"><a href="articles.php?letter=य">य</a></span>
					<span class="letter"><a href="articles.php?letter=र">र</a></span>
					<span class="letter"><a href="articles.php?letter=ल">ल</a></span>
					<span class="letter"><a href="articles.php?letter=व">व</a></span>
					<span class="letter"><a href="articles.php?letter=श">श</a></span>
					<span class="letter"><a href="articles.php?letter=स">स</a></span>
					<span class="letter"><a href="articles.php?letter=ह">ह</a></span>
					<span class="letter"><a href="articles.php?letter=other">#</a></span>
				</div>
<?php

include("connect.php");
require_once("common.php");

if(isset($_GET['letter']))
{
 	$letter=$_GET['letter'];
	
 	if(!(isValidLetter($letter)))
 	{
 		echo '<span class="aFeature clr2">Invalid URL</span>';
 		echo '</div> <!-- cd-container -->';
 		echo '</div> <!-- cd-scrolling-bg -->';
 		echo '</main> <!-- cd-main-content -->';
 		include("include_footer.php");

         exit(1);
 	}
	
 	($letter == '') ? $letter = 'अ' : $letter = $letter;
 }
 else
 {
 	$letter = 'अ';
 }
if($letter == 'other')
{
	$query = "SELECT * FROM article WHERE title REGEXP '^[A-Za-z]'";
}
else
{
	$query = "select * from article where title like '$letter%'  union select * from article where title like '\"$letter%' union select * from article where title like '\'$letter%' order by TRIM(BOTH '\'' FROM TRIM(BOTH '\"' FROM title))";
}

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		$query3 = 'select feat_name from feature where featid=\'' . $row['featid'] . '\'';
		$result3 = $db->query($query3); 
		$row3 = $result3->fetch_assoc();
		$titleid = $row['titleid'];
		$dpart = preg_replace("/^0/", "", $row['part']);
		$dpart = preg_replace("/\-0/", "-", $dpart);
		$info = '';
		if($row['month'] != '')
		{
			$info = $info . getMonth($row['month']);
		}
		if($row['year'] != '')
		{
			$info = $info . ' <span class="font_size">' . toKannada($row['year']) . '</span>';
		}
		if($row['maasa'] != '')
		{
			$info = $info . ', ' . $row['maasa'] . '&nbsp;Maasa';
		}
		if($row['samvatsara'] != '')
		{
			$info = $info . ', ' . $row['samvatsara'] . '&nbsp;Samvatsara';
		}
		$info = preg_replace("/^,/", "", $info);
		$info = preg_replace("/^ /", "", $info);
		
		$sumne = preg_split('/-/' , $row['page']);
		$row['page'] = $sumne[0];
		if($result3){$result3->free();}

		echo '<div class="article">';
		echo '	<div class="gapBelowSmall">';
		echo ($row3['feat_name'] != '') ? '		<span class="aFeature clr2"><a href="feat.php?feature=' . urlencode($row3['feat_name']) . '&amp;featid=' . $row['featid'] . '">' . $row3['feat_name'] . '</a></span> | ' : '';
		echo '		<span class="aIssue clr5"><a href="toc.php?vol=' . $row['volume'] . '&amp;part=' . $row['part'] . '">आयतन ' . toKannada(intval($row['volume'])) . ', मुद्दा ' . toKannada($dpart) . ' <span class="font_resize">(' . $info . ')</span></a></span>';
		echo '	</div>';
		//~ echo '	<span class="aTitle"><a target="_blank" href="bookReader.php?volume=' . $row['volume'] . '&amp;part=' . $row['part'] . '&amp;page=' . $row['page'] . '">' . $row['title'] . '</a></span>';
		//~ DJVU link
		echo '	<span class="aTitle"><a target="_blank" href="../Volumes/pdf/' . $row['volume'] . '/' . $row['part'] . '/index.pdf#page=' . intval($row['page']) . '">' . $row['title'] . '</a></span>';
		if($row['authid'] != 0) {

			echo '<br /><span class="aAuthor">&nbsp;&nbsp;&mdash;';
			$authids = preg_split('/;/',$row['authid']);
			$authornames = preg_split('/;/',$row['authorname']);
			$a=0;
			foreach ($authids as $aid) {

				echo '<a class="delim" href="auth.php?authid=' . $aid . '&amp;author=' . urlencode($authornames[$a]) . '">' . $authornames[$a] . '</a> ';
				$a++;
			}
			
			echo '	</span>';
		}
		echo '<br/><span class="downloadspan"><a target="_blank" href="downloadPdf.php?titleid='.$titleid.'">Download Pdf</a></span>';
		echo '</div>';
	}
}
else
{
	echo '<span class="sml">No Article found starting from letter  \'' . $letter . '\'';
}

if($result){$result->free();}
$db->close();

?>
			</div> <!-- cd-container -->
		</div> <!-- cd-scrolling-bg -->
	</main> <!-- cd-main-content -->
<?php include("include_footer.php");?>
