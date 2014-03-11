<?php
if(empty($_GET['lang'])){
	if(strlen($_SERVER['QUERY_STRING'])>0 ){
		$link =$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']."&lang=ukr";	
	}else{
		$link =$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']."lang=ukr";
	}
	}else{
		$link = $_SERVER['PHP_SELF']."?".str_replace ( substr ( $_SERVER['QUERY_STRING'] , strpos($_SERVER['QUERY_STRING'],'lang')) ,'lang=ukr' , $_SERVER['QUERY_STRING'] );
	
}
echo'<a href='.$link.'><img src="ukr.png"></a>';

if(empty($_GET['lang'])){
	if(strlen($_SERVER['QUERY_STRING'])>0 ){
		$link =$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']."&lang=eng";	
	}else{
		$link =$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']."lang=eng";
	}
	}else{
		$link = $_SERVER['PHP_SELF']."?".str_replace ( substr ( $_SERVER['QUERY_STRING'] , strpos($_SERVER['QUERY_STRING'],'lang')) ,'lang=eng' , $_SERVER['QUERY_STRING'] );
	
}
echo '<a href='.$link.'><img src="eng.gif"></a>';
?>
