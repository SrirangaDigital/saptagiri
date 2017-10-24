<?php include("include_header.php");?>
<main class="cd-main-content">
		<div class="cd-scrolling-bg cd-color-2">
			<div class="cd-container">
				<h1 class="clr1">लेखक</h1>
				<div class="alphabet gapBelowSmall gapAboveSmall">
										<span class="letter"><a href="authors.php?letter=अ">अ</a></span>
					<span class="letter"><a href="authors.php?letter=आ">आ</a></span>
					<span class="letter"><a href="authors.php?letter=इ">इ</a></span>
					<span class="letter"><a href="authors.php?letter=ई">ई</a></span>
					<span class="letter"><a href="authors.php?letter=उ">उ</a></span>
					<span class="letter"><a href="authors.php?letter=ओ">ओ</a></span>
					<span class="letter"><a href="authors.php?letter=क">क</a></span>
					<span class="letter"><a href="authors.php?letter=ख">ख</a></span>
					<span class="letter"><a href="authors.php?letter=ग">ग</a></span>
					<span class="letter"><a href="authors.php?letter=घ">घ</a></span>
					<span class="letter"><a href="authors.php?letter=च">च</a></span>
					<span class="letter"><a href="authors.php?letter=ज">ज</a></span>
					<span class="letter"><a href="authors.php?letter=ट">ट</a></span>
					<span class="letter"><a href="authors.php?letter=ड">ड</a></span>
					<span class="letter"><a href="authors.php?letter=त">त</a></span>
					<span class="letter"><a href="authors.php?letter=द">द</a></span>
					<span class="letter"><a href="authors.php?letter=ध">ध</a></span>
					<span class="letter"><a href="authors.php?letter=न">न</a></span>
					<span class="letter"><a href="authors.php?letter=प">प</a></span>
					<span class="letter"><a href="authors.php?letter=फ">फ</a></span>
					<span class="letter"><a href="authors.php?letter=ब">ब</a></span>
					<span class="letter"><a href="authors.php?letter=भ">भ</a></span>
					<span class="letter"><a href="authors.php?letter=म">म</a></span>
					<span class="letter"><a href="authors.php?letter=य">य</a></span>
					<span class="letter"><a href="authors.php?letter=र">र</a></span>
					<span class="letter"><a href="authors.php?letter=ल">ल</a></span>
					<span class="letter"><a href="authors.php?letter=व">व</a></span>
					<span class="letter"><a href="authors.php?letter=श">श</a></span>
					<span class="letter"><a href="authors.php?letter=ष">ष</a></span>
					<span class="letter"><a href="authors.php?letter=स">स</a></span>
					<span class="letter"><a href="authors.php?letter=ह">ह</a></span>
					<span class="letter"><a href="authors.php?letter=other">#</a></span>
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
	$query = "SELECT * FROM author WHERE authorname REGEXP '^[A-Za-z]'";
}
else
{
	$query = "select * from author where authorname like '$letter%'  union select * from author where authorname like '\"$letter%' union select * from author where authorname like '\'$letter%' order by TRIM(BOTH '\'' FROM TRIM(BOTH '\"' FROM authorname))";
}

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		echo '<div class="author">';
		echo '	<span class="aAuthor"><a href="auth.php?authid=' . $row['authid'] . '&amp;author=' . urlencode($row['authorname']) . '">' . $row['authorname'] . '</a> ';
		echo '</div>';
	}
}
else
{
	echo '<span class="sml">No Authors found starting from letter \'' . $letter . '\'';
}

if($result){$result->free();}
$db->close();

?>
			</div> <!-- cd-container -->
		</div> <!-- cd-scrolling-bg -->
	</main> <!-- cd-main-content -->
<?php include("include_footer.php");?>
