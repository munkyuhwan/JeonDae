<?
$today = @date("Y-m-d", time());
$query = "select * from popup_div where is_use='Y' and startdt <= '$today' and enddt >= '$today' order by idx desc limit 0,3";
//echo $query; exit;
$result = mysqli_query($gconnet,$query);
for ($i=0; $i<mysqli_num_rows($result); $i++){
	$row = mysqli_fetch_array($result);


/**	if($row[image] == "1"){
		$popupPage = "popup.html";
	}else if($row[image] == "2"){
		$popupPage = "popup02.html";
	}else if($row[image] == "3"){
		$popupPage = "popup03.html";
	}
**/
	$popupPage = "popup.php";

	//$pop_width = $row[width]+20;
	$pop_width = $row[width];
	$pop_height = $row[height];
?>

<?
$no = $row[idx];	

	/*if($i==0){
		$position_x = "100";
		$position_y = "100";
	} elseif($i==1){ 
		$position_x = "500";
		$position_y = "100";
	} elseif($i==2){ 
		$position_x = "900";
		$position_y = "100";
	}*/

	$position_x = $row['x'];
	$position_y = $row['y'];
?>
<?// include "$DOCUMENT_ROOT/PROGRAM_popup/popup.php";?>

<script language="JavaScript">
<!--
function notice_getCookie( name )
{
        var nameOfCookie = name + "=";
        var x = 0;
        while ( x <= document.cookie.length )
        {
                var y = (x+nameOfCookie.length);
                if ( document.cookie.substring( x, y ) == nameOfCookie ) {
                        if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 )
                                endOfCookie = document.cookie.length;
                        return unescape( document.cookie.substring( y, endOfCookie ) );
                }
                x = document.cookie.indexOf( " ", x ) + 1;
                if ( x == 0 )
                        break;
        }
        return "";
}

if ( notice_getCookie( "Notice_<?=$row[idx]?>" ) != "done" )
{
		window.open('/popup/popup.html?idx=<?=$row[idx]?>','pop_<?=$row[idx]?>','toolbar=no, width=<?=$pop_width?>,height=<?=$pop_height?>, left=<?=$position_x?>,  top=<?=$position_y?>, status=no,scrollbars=auto, resize=no');
}
//-->
</script>
<?}?>