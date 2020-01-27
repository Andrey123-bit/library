<?php  
 if($page != 1){
$prev = $page - 1;
echo "<a href=\"?page=$prev\"><</a>";
}
for ($i=1; $i<=$pagesCount; $i++) { 
	if($page == $i ){
		$class = ' class="active"';
			}else
			{ $class='';}
					echo "<a href=\"?page=$i\"$class>$i</a> ";
					}
if($page != $pagesCount){
	$next = $page + 1;
			echo "<a href=\"?page=$next\">></a> ";
}