<?php
	echo "<div class='rightside'>";
	echo "<p>";
	echo t($lang,'user_menu');
	echo "<p>";
	if (!isset($_SESSION['ent']))	
	{	
		$_SESSION['ent'] = 3;	
	}	
	if ($_SESSION['ent'] == 3)	
	{	
		if (!empty($_SESSION['erreg']))	
		{	
			echo $_SESSION['erreg'];	
			$_SESSION['erreg'] = '';	
		}	
	include('rightside.html');
		
	}	
	else{
		include('rightside_enter.php');
	}	
echo "</div>";
?>
