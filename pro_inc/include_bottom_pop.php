<?
if($include_bottom == true){
	return;
}
$include_bottom = true;

mysqli_close($gconnet);

//$show_iframe = true;
$show_iframe = false;
?>
<? if($show_iframe){?>
	<iframe name="_fra" width="800" height="300"></iframe>
<?}else{?>
	<iframe name="_fra" width="0" height="0"></iframe>
<?}?>
<!--<table cellpadding="0" cellspacing="0" border="0"><tR><Td height="250"></td></tR></table>-->
<div id="CalendarLayer" style="display:none; width:172px; height:250px; position:absolute; left:120px; top:138px; z-index:10;">
	<iframe name="CalendarFrame" src="/pro_inc/include_calendar.php" width="172" height="250" frameborder="0" scrolling="no">
	</iframe>
</div>


