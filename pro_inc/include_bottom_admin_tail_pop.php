<div id="Footer">
    <!--<span class="addr">copyright (c) 2013 popupstudy All rights reserved.</span>-->
</div>
	<!-- //container -->
<?
mysqli_close($gconnet);

//$show_iframe = true;

?>

<? if($show_iframe){?>
	<iframe name="_fra_admin" width="800" height="300"></iframe>
<?}else{?>
	<iframe name="_fra_admin" width="0" height="0"></iframe>
<?}?>
<!--<table cellpadding="0" cellspacing="0" border="0"><tR><Td height="250"></td></tR></table>-->
<div id="CalendarLayer" style="display:none; width:172px; height:250px; position:absolute; left:300px; top:216px; z-index:100;">
	<iframe name="CalendarFrame" src="/pro_inc/include_calendar.php" width="172" height="250" border="0" frameborder="0" scrolling="no"></iframe>
</div>
