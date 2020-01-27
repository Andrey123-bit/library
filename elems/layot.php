<!DOCTYPE html>
	<html>	
		<?php  	include "head.php"; ?>	
		<body>
<div class="main">
	<div class="container">
		<div id="wrapper"> 
		<?php include 'elems/info.php'; ?>
		 <?php if(isset($add)){echo  $add; } ?>
		 <?php echo $content; ?>
		 <?php if($title=='Главная'){ include 'pagination.php'; } ?>			
		</div>
	</div>
</div>
		</body>
	</html>