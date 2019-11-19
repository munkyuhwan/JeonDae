<?
mysqli_close($gconnet);
//echo $_SERVER['REMOTE_ADDR'];
if($_SERVER['REMOTE_ADDR'] == "121.167.147.150" || $_SERVER['REMOTE_ADDR'] == "211.227.88.137"){
	$show_iframe = true;	
}
?>
<iframe name="_fra_admin" width="90%" height="300" style="display:<?=$show_iframe==TRUE?"":"none"?>"></iframe>
<iframe name="_fra_admin2" width="90%" height="300" style="display:<?=$show_iframe==TRUE?"none":"none"?>"></iframe>
<div id="CalendarLayer" style="display:none; width:172px; height:250px; z-index:100;">
	<iframe name="CalendarFrame" src="/pro_inc/include_calendar.php" width="172" height="250" border="0" frameborder="0" scrolling="no"></iframe>
</div>
