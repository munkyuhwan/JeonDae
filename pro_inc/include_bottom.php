<?//include $_SERVER["DOCUMENT_ROOT"]."/assets/payment_footer.php";?>
<?
mysqli_close($gconnet);
//echo $_SERVER['REMOTE_ADDR'];
if($_SERVER['REMOTE_ADDR'] == "121.167.147.150" || $_SERVER['REMOTE_ADDR'] == "211.227.88.137"){
	$show_iframe = true;
	//echo "aaaaa";
}
?>
<iframe name="_fra" width="800" height="300" style="display:<?=$show_iframe==TRUE?"block":"none"?>;"></iframe>
<div id="CalendarLayer" style="display:none; width:172px; height:250px; position:absolute; left:900px; top:600px; z-index:10;">
	<iframe name="CalendarFrame" src="/pro_inc/include_calendar.php" width="172" height="250" frameborder="0" scrolling="no">
	</iframe>
</div>


