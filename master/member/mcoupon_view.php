<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>
<?
$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$idx = trim(sqlfilter($_REQUEST['idx']));

$bmenu = trim(sqlfilter($_REQUEST['bmenu']));
$smenu = trim(sqlfilter($_REQUEST['smenu']));
$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$field = trim(sqlfilter($_REQUEST['field']));
$keyword = urldecode(sqlfilter($_REQUEST['keyword']));

$s_sect1 = trim(sqlfilter($_REQUEST['s_sect1']));
$s_sect2 = trim(sqlfilter($_REQUEST['s_sect2']));

################## 파라미터 조합 #####################
$total_param = 'bmenu='.$bmenu.'&smenu='.$smenu.'&field='.$field.'&keyword='.$keyword.'&s_sect1='.$s_sect1.'&s_sect2='.$s_sect2.'&pageNo='.$pageNo;

/*$pkColumn = "idx";
$value = $idx;
$tableName = "member_coupon_set";
$result = MgrGeneralView($tableName, $pkColumn, $value);
$row = mysqli_fetch_array($result);*/

$query = "select * from member_coupon_set where 1 and idx='".$idx."'";
$result = mysqli_query($gconnet,$query);
$row = mysqli_fetch_array($result);

$expire_date_arr = explode("-",$row[expire_date]);

if($row[member_sect] == "general"){
	$member_sect = "일반회원";
} elseif($row[member_sect] == "group"){
	$member_sect = "단체회원";
}

$mem_level_sql = "select level_name from member_level_set where level_code='".$row[member_level]."' ";
$mem_level_query = mysqli_query($gconnet,$mem_level_sql);
$mem_level_row = mysqli_fetch_array($mem_level_query);
$member_level = $mem_level_row[level_name];

?>

<SCRIPT LANGUAGE="JavaScript">
<!--
	function go_view(no){
		location.href = "mcoupon_view.php?idx="+no+"&<?=$total_param?>";
	}
	
	function go_modify(no){
		location.href = "mcoupon_modify.php?idx="+no+"&<?=$total_param?>";
	}
	
	function go_delete(no){
		if(confirm('정말 삭제 하시겠습니까?')){
			if(confirm('삭제하신 데이터는 복구할수 없도록 영구 삭제 됩니다. 그래도 삭제 하시겠습니까?')){	
			_fra_admin.location.href = "mcoupon_delete_action.php?idx="+no+"&<?=$total_param?>";
			}
		}
	}

	function go_list(){
		location.href = "mcoupon_list.php?<?=$total_param?>";
	}

	function go_coupon_pop(no){
		//location.href = 
		window.open("member_coupon_history.php?mem_idx="+no+"&bmenu=<?=$bmenu?>&smenu=<?=$smenu?>","couponview", "top=100,left=100,scrollbars=yes,resizable=no,width=870,height=500");
	}

//-->
</SCRIPT>

<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>

<body>
<div id="wrap" class="skin_type01">
	<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/admin_top.php"; // 상단메뉴?>
	<div class="sub_wrap">
		<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/member_left.php"; // 좌측메뉴?>
		<!-- content 시작 -->
		<div class="container clearfix">
			<div class="content">
				<div class="navi">
					<ul class="clearfix">
						<li>HOME</li>
						<li>쿠폰발급</li>
					</ul>
				</div>
				<div class="list_tit">
					<h3>쿠폰 상세보기</h3>
				</div>
				<div class="write">
					<p class="tit">쿠폰 상세보기</p>
			<table>
				<colgroup>
					<col width="15%" />
					<col width="35%" />
					<col width="10%" />
					<col width="40%" />
				</colgroup>

					<!--<tr>
						<th >쿠폰 종류</th>
						<td colspan="3">
						<?if($row[coupon_sect] == "auto"){?>
							회원가입 자동발행쿠폰
						<?}elseif($row[coupon_sect] == "normal"){?>
							회원조회 일반쿠폰
						<?}?>
						</td>
					</tr>-->

					<?if($row[coupon_sect] == "auto"){?>
					<tr>
						<th >쿠폰 유효기간</th>
						<td colspan="3">가입일로 부터 <?=$row[expire_date_auto]?> 일간</td>
					</tr>
					<?}elseif($row[coupon_sect] == "normal"){?>
					<tr>
						<th >쿠폰 만료일</th>
						<td colspan="3"><?=$row[expire_date]?></td>
					</tr>
					<?}?>

					<tr>
						<th >쿠폰 간략설명</th>
						<td colspan="3"><?=$row[coupon_title]?></td>
					</tr>

					<tr>
						<th >할인종류</th>
						<td width="*" colspan="3">
						<?if($row[dis_type] == "1"){?>
							정액쿠폰
						<?}elseif($row[dis_type] == "2"){?>
							정률쿠폰
						<?}?>
						</td>
					</tr>
					
					<?if($row[dis_type] == "1"){?>
					<tr>
						<th>쿠폰 액면가</th>
						<td colspan="3"><?=number_format($row[coupon_price],0)?> 원</td>
					</tr>
					<?}elseif($row[dis_type] == "2"){?>
					<tr>
						<th>쿠폰 할인율</th>
						<td colspan="3"><?=number_format($row[coupon_per],0)?> %</td>
					</tr>
					<?}?>
					
					<tr>
						<th >쿠폰생성 관리자ID</th>
						<td colspan="3"><?=$row[ad_sect]?></td>
					</tr>
					
					<tr>
						<th >생성일</th>
						<td colspan="3"><?=$row[wdate]?></td>
					</tr>

				</table>

				<div class="align_c margin_t20">
					<a href="javascript:go_list();" class="btn_blue">목록</a>
					<a href="javascript:go_modify('<?=$row[idx]?>');"  class="btn_green">수정</a>
					<a href="javascript:go_delete('<?=$row[idx]?>');" class="btn_red">삭제</a>	
				<div>
				
			<!-- 쿠폰수령회원 노출 -->
			<?
				$pageNo_sub = trim(sqlfilter($_REQUEST['pageNo_sub']));

				################## 파라미터 조합 #####################
				$total_param_sub = $total_param."&idx=".$idx."";

				if(!$pageNo_sub){
					$pageNo_sub = 1;
				}

				$where_sub .= " and c.coupon_idx = '".$row[idx]."' ";

				$pageScale_sub = 20; // 페이지당 10 개씩 
				$start_sub = ($pageNo_sub-1)*$pageScale_sub;

				$StarRowNum_sub = (($pageNo_sub-1) * $pageScale_sub);
				$EndRowNum_sub = $pageScale_sub;
				
				$order_by_sub = " order by c.idx desc ";
				$query_sub = "select a.level_name,b.idx,b.user_id,b.user_name,c.coupon_sect,c.expire_date,c.wdate,c.mdate,b.nation from member_level_set a INNER JOIN member_info b ON a.level_code = b.user_level INNER JOIN member_coupon c ON b.idx = c.member_idx where 1=1 ".$where_sub.$order_by_sub." limit ".$StarRowNum_sub." , ".$EndRowNum_sub;

				//echo "<br><br>쿼리 = ".$query_sub."<br><Br>";

				$result_sub = mysqli_query($gconnet,$query_sub);

				$query_sub_cnt = "select c.idx from member_level_set a INNER JOIN member_info b ON a.level_code = b.user_level INNER JOIN member_coupon c ON b.idx = c.member_idx where 1=1 ".$where_sub;
				$result_sub_cnt = mysqli_query($gconnet,$query_sub_cnt);
				$num_sub = mysqli_num_rows($result_sub_cnt);

				//echo $num_sub;

				$iTotalSubCnt_sub = $num_sub;
				$totalpage_sub	= ($iTotalSubCnt_sub - 1)/$pageScale_sub  + 1;

			?>

			<h3 style="margin-top:10px;">총 <?=$num_sub?> 명의 회원에게 본 쿠폰을 발급했습니다.</h3>

				<table class="t_list" style="margin-top:10px;">
				<thead>
					<tr>
						<th width="5%">번호</th>
						<th width="12%">아이디</th>
						<th width="13%">성 명</th>
						<th width="15%">국 적</th>
						<th width="10%">쿠폰상태</th>
						<th width="15%">발급일자</th>
						<th width="15%">쿠폰만료일</th>
						<th width="15%">사용일자</th>
					</tr>
				</thead>
				<tbody>
				<? if ($num_sub == 0) { ?>
				<tr>
					<td colspan="10" height="40"><strong>본 쿠폰을 수령한 회원이 없습니다.</strong></td>
				</tr>
			<? } ?>
			<?
				for ($i_sub=0; $i_sub<mysqli_num_rows($result_sub); $i_sub++){
					$sub_row = mysqli_fetch_array($result_sub);
					$listnum_sub	= $iTotalSubCnt_sub - (( $pageNo_sub - 1 ) * $pageScale_sub ) - $i_sub;

					if($sub_row[coupon_sect] == "A"){
						$coupon_sect = "<font style='color:blue;'>발급</font>";
					} elseif($sub_row[coupon_sect] == "M"){
						$coupon_sect = "<font style='color:red;'>사용</font>";
					} elseif($sub_row[coupon_sect] == "C"){
						$coupon_sect = "<font style='color:gray;'>기간만료</font>";
					}
			?>
					<tr>
						<td ><?=$listnum_sub?></td>
						<td><?=$sub_row[user_id]?></td>
						<td ><?=$sub_row[user_name]?></td>
						<td ><?=$sub_row[nation]?></td>
						<td ><?=$coupon_sect?></td>
						<td ><?=substr($sub_row[wdate],0,10)?></td>
						<td ><?=$sub_row[expire_date]?></td>
						<td><?=substr($sub_row[mdate],0,10)?></td>
					</tr>
					<? } ?>
				</tbody>
				</table>
				
				<!-- //Goods List -->
			<!-- paginate -->
			<div class="pagination">
			<?
				include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/paging_sub.php";
			?>
			</div>
			<!-- //paginate -->
		</div>
		<!-- content 종료 -->
	</div>
</div>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_bottom_admin_tail.php"; ?>
</body>
</html>