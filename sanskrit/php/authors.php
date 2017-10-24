<?php include("include_header.php");?>
<main class="cd-main-content">
		<div class="cd-scrolling-bg cd-color-2">
			<div class="cd-container">
				<h1 class="clr1">Authors</h1>
				<div class="alphabet gapBelowSmall gapAboveSmall">
					<span class="letter"><a href="authors.php?letter=a">A</a></span>
					<span class="letter"><a href="authors.php?letter=b">B</a></span>
					<span class="letter"><a href="authors.php?letter=c">C</a></span>
					<span class="letter"><a href="authors.php?letter=d">D</a></span>
					<span class="letter"><a href="authors.php?letter=e">E</a></span>
					<span class="letter"><a href="authors.php?letter=f">F</a></span>
					<span class="letter"><a href="authors.php?letter=g">G</a></span>
					<span class="letter"><a href="authors.php?letter=h">H</a></span>
					<span class="letter"><a href="authors.php?letter=i">I</a></span>
					<span class="letter"><a href="authors.php?letter=j">J</a></span>
					<span class="letter"><a href="authors.php?letter=k">K</a></span>
					<span class="letter"><a href="authors.php?letter=l">L</a></span>
					<span class="letter"><a href="authors.php?letter=m">M</a></span>
					<span class="letter"><a href="authors.php?letter=n">N</a></span>
					<span class="letter"><a href="authors.php?letter=o">O</a></span>
					<span class="letter"><a href="authors.php?letter=p">P</a></span>
					<span class="letter"><a href="authors.php?letter=q">Q</a></span>
					<span class="letter"><a href="authors.php?letter=r">R</a></span>
					<span class="letter"><a href="authors.php?letter=s">S</a></span>
					<span class="letter"><a href="authors.php?letter=t">T</a></span>
					<span class="letter"><a href="authors.php?letter=u">U</a></span>
					<span class="letter"><a href="authors.php?letter=v">V</a></span>
					<span class="letter"><a href="authors.php?letter=w">W</a></span>
					<span class="letter"><a href="authors.php?letter=x">X</a></span>
					<span class="letter"><a href="authors.php?letter=y">Y</a></span>
					<span class="letter"><a href="authors.php?letter=z">Z</a></span>
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
	
 	($letter == '') ? $letter = 'ಅ' : $letter = $letter;
 }
 else
 {
 	$letter = 'ಅ';
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
