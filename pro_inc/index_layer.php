<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/db_conn.php"; // 메인공지 레이어 설정 파일?>

<script type="text/javascript">
<!--
	function notice_getCookie(name){ // 오늘 하루 안열기 확인 
		    var nameOfCookie = name + "=";
			var x = 0;
			 while ( x <= document.cookie.length ){
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

	function LeyerPopupClose(idx){ // 레이어 그냥 닫기  
		var oPopup = document.getElementById("pop_main_"+idx+"");  
		oPopup.style.display = "none";  
	}  

	function notice_setCookie( name, value, expiredays ){ // 오늘 하루 안열기
        var todayDate = new Date();
        todayDate.setDate( todayDate.getDate() + expiredays );
        document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
    }

	function notice_closeWin(idx){ // 오늘하루 안열기 설정하고 닫기  
		//alert(sDivName);
        notice_setCookie("pop_main_"+idx+"", "done" , 1); // 1=하룻동안 공지창 열지 않음
		var oPopup = document.getElementById("pop_main_"+idx+"");  
		oPopup.style.display = "none";  
	}
	
	function main_notice_ok(idx){
		//alert(sDivName);
		//alert(document.getElementById("pop_main_"+idx+""));
		if (notice_getCookie("pop_main_"+idx+"") == "done"){
			var oPopup = document.getElementById("pop_main_"+idx+"");  
			oPopup.style.display = "none";  
		}
	}

	//alert(notice_getCookie("Notice_<?=$row[idx]?>"));
//-->
</script>

<?
$today = @date("Y-m-d", time());
$query = "select * from popup_div where is_use='Y' and startdt <= '$today' and enddt >= '$today' order by idx desc limit 0,3";
//echo $query; exit;
$result = mysqli_query($gconnet,$query);

for ($i=0; $i<mysqli_num_rows($result); $i++){
	$row = mysqli_fetch_array($result);

	//$pop_width = $row[width]+20;
	$pop_width = $row[width];
	$pop_height = $row[height];
	$pop_height2 = $pop_height-30;

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

	<div class="pop" id="pop_main_<?=$row[idx]?>" style="display:block;top:<?=$position_y?>px;left:<?=$position_x?>px;height:<?=$pop_height?>px;width:<?=$pop_width?>px;">
		<div class="pop_con" style="height:<?=$pop_height?>px;"><?=stripslashes($row[content])?></div>
		<div class="pop_bottom" style="width:<?=$pop_width?>px;">
			<span>
				<input type="checkbox" id="haru" name="" style="margin-top:-3px;" value="y" onclick="notice_closeWin('<?=$row[idx]?>');"/> <label for="haru">오늘 하루 이 창을 열지 않음</label>
			</span>
			<span class="pop_close" onclick="LeyerPopupClose('<?=$row[idx]?>')" style="cursor:pointer;">닫 기</span>
		</div>
	</div>

	<script type="text/javascript">
	<!--
		main_notice_ok('<?=$row[idx]?>');
	//-->
	</script>
<?}?>

