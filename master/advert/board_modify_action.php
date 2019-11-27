<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login_frame.php"; // 관리자 로그인여부 확인?>

<?
/*if(!$_AUTH_WRITE && !$_AUTH_REPLY){
	error_frame("수정 권한이 없습니다.");
	exit;
}*/
$bbs_code = trim(sqlfilter($_REQUEST['bbs_code']));										//bbs_code
$total_param = trim(sqlfilter($_REQUEST['total_param']));
$idx = trim(sqlfilter($_REQUEST['idx']));
$orgin_idx = trim(sqlfilter($_REQUEST['orgin_idx']));

	$subject = trim(sqlfilter($_REQUEST['subject']));								//제목
	$writer = trim(sqlfilter($_REQUEST['writer']));									//글쓴이
	$passwd = sqlfilter($_REQUEST['passwd']);	
	$content = trim(sqlfilter($_REQUEST['content']));										//내용
	$is_html = $_REQUEST['is_html'];												//is_html
	$is_popup = trim(sqlfilter($_REQUEST['is_popup']));						// 공지사항 여부
	$is_secure = trim(sqlfilter($_REQUEST['is_secure']));						//비밀글여부

	$bbs_sect = sqlfilter($_REQUEST['bbs_sect']);	
	$bbs_tag = sqlfilter($_REQUEST['bbs_tag']);	
	$scrap_ok = sqlfilter($_REQUEST['scrap_ok']);	
	$ccl_ok = sqlfilter($_REQUEST['ccl_ok']);	

	//1:1문의용
	$cate_1vs1 = trim(sqlfilter($_REQUEST['1vs1_cate']));					//유형선택
	$email = trim(sqlfilter($_REQUEST['email']));									//이메일
	$cell_1vs1 = trim(sqlfilter($_REQUEST['1vs1_cell']));						//휴대전화

	$open_parent_code = trim(sqlfilter($_REQUEST['open_parent_code']));		
	$open_start = trim(sqlfilter($_REQUEST['open_start']));
	$open_end = trim(sqlfilter($_REQUEST['open_end']));
	$prize_etc = trim(sqlfilter($_REQUEST['prize_etc']));

if ($passwd==""){
	$passwd = md5(sqlfilter($_SESSION['admin_coinc_password']));	//비밀번호
} else {
	$passwd = md5($passwd);	//비밀번호
}

if ($writer==""){
	if($_SESSION['admin_coinc_idx']){ // 관리자 로그인 
	$writer = $_SESSION['admin_coinc_name'];	
	} 
}

	$is_html = "N";
	
	$query = " update board_content set "; 
	$query .= " subject = '".$subject."', ";
	if ($writer != ""){
		$query .= " writer = '$writer', "; 
	}
	$query .= " content = '".$content."' ";


	//$query .= " 1vs1_cell = '".$cell_1vs1."' ";
	$query .= " where idx = ".$idx;

	//echo $query;

	$result = mysqli_query($gconnet,$query);

	################# 첨부파일 업로드 종료 #######################

	//exit;

	if($result){
	?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('게시물 수정이 정상적으로 완료 되었습니다.');
	<?if($orgin_idx){?>
		parent.location.href =  "board_view.php?idx=<?=$orgin_idx?>&bbs_code=<?=$bbs_code?>&<?=$total_param?>";
	<?}else{?>
		<?if($bbs_code == "gallery"){?>
			parent.location.href =  "board_list.php?&bbs_code=<?=$bbs_code?>&<?=$total_param?>";
		<?}else{?>
			parent.location.href =  "board_view.php?idx=<?=$idx?>&bbs_code=<?=$bbs_code?>&<?=$total_param?>";
		<?}?>
	<?}?>
	//-->
	</SCRIPT>
	<?}else{?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('게시물 수정중 오류가 발생했습니다.');
	//-->
	</SCRIPT>
	<?}?>
