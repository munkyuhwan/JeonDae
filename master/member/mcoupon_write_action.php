<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login_frame.php"; // 관리자 로그인여부 확인?>
<?
	$bmenu = trim(sqlfilter($_REQUEST['bmenu']));
	$smenu = trim(sqlfilter($_REQUEST['smenu']));
	$v_sect = trim(sqlfilter($_REQUEST['v_sect']));
		
	$member_sect = trim(sqlfilter($_REQUEST['member_sect']));
	$member_level = trim(sqlfilter($_REQUEST['member_level']));
	$coupon_title = trim(sqlfilter($_REQUEST['coupon_title']));
	$dis_type = trim(sqlfilter($_REQUEST['dis_type']));
	$coupon_price = trim(sqlfilter($_REQUEST['coupon_price']));
	$coupon_per = trim(sqlfilter($_REQUEST['coupon_per']));
	$expire_date = trim(sqlfilter($_REQUEST['expire_date']));
	$txt_receiver = $_REQUEST['txt_receiver'];

	$coupon_sect = trim(sqlfilter($_REQUEST['coupon_sect']));
	$expire_date_auto = trim(sqlfilter($_REQUEST['expire_date_auto']));
	
	if($coupon_sect == "auto"){
	
		$sql_pre = "select idx from member_coupon_set where coupon_sect = 'auto' ";
		$result_pre  = mysqli_query($gconnet,$sql_pre);
			
			if(mysqli_num_rows($result_pre) > 0) {
			?>
			<SCRIPT LANGUAGE="JavaScript">
			<!--	
			alert('회원가입 자동발행 쿠폰은 이미 생성되어 있습니다.\n\n생성된 쿠폰의 설정변경을 원하시면 생성된 쿠폰확인 메뉴를 통하여 기존의 회원가입 자동발행 쿠폰의 값을 변경해 주십시오.');
			//-->
			</SCRIPT>
			<?
			exit;
			}
	}

	$ad_sect = $_SESSION['admin_coinc_id'];
	$section = $_SESSION['admin_coinc_section'];

	$query = " insert into member_coupon_set set "; 
	$query .= " section = '".$section."', ";
	$query .= " coupon_sect = '".$coupon_sect."', ";
	$query .= " coupon_title = '".$coupon_title."', ";
	$query .= " member_sect = '".$member_sect."', ";
	$query .= " member_level = '".$member_level."', ";
	$query .= " dis_type = '".$dis_type."', ";
	$query .= " coupon_per = '".$coupon_per."', ";
	$query .= " coupon_price = '".$coupon_price."', ";
	$query .= " expire_date = '".$expire_date."', ";
	$query .= " expire_date_auto = '".$expire_date_auto."', ";
	$query .= " ad_sect = '".$ad_sect."', ";
	$query .= " wdate = now() ";
	$result = mysqli_query($gconnet,$query);

	$idx = mysqli_insert_id();

	if($idx == 0){
		$member_idx_sql = "select idx from member_coupon_set where 1 order by idx desc limit 0,1";
		$member_idx_query = mysqli_query($gconnet,$member_idx_sql);
		$member_idx_row = mysqli_fetch_array($member_idx_query);
		$idx = $member_idx_row['idx'];
	}
	
	if($result){
	?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('쿠폰 생성이 정상적으로 완료 되었습니다.');
		<?if($coupon_sect == "auto"){?>
			parent.location.href =  "mcoupon_list.php?bmenu=<?=$bmenu?>&smenu=14";
		<?}else{?>
			parent.location.href =  "mcoupon_write_send.php?bmenu=<?=$bmenu?>&smenu=<?=$smenu?>&mem_idx=<?=$idx?>";
		<?}?>
	//-->
	</SCRIPT>
	<?}else{?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('회원일괄쿠폰 등록중 오류가 발생했습니다.');
	//-->
	</SCRIPT>
	<?}?>