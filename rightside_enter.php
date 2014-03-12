<?php
  $link_profil="profil.php?id=".$_SESSION['profil_id'];
	echo "<p><a href=".$link_profil.">".t($lang,'profil')."</a>";
	echo '<p><a href="addnews.html">'.t($lang,'addnews').' </a>	
	<p><a href="exit.php">'.t($lang,'exit').' </a>';
?>
