<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login_frame.php"; // 관리자 로그인여부 확인?>

<?
	$idx = trim(sqlfilter($_REQUEST['idx']));
	$total_param = trim(sqlfilter($_REQUEST['total_param']));
	$s_gubun = trim(sqlfilter($_REQUEST['s_gubun']));

	if($s_gubun == "NOR"){
		$member_sect_str = "일반";
	} elseif($s_gubun == "SPE"){
		$member_sect_str = "VVIP 멤버십";
	}
		
	if($_REQUEST['member_password']){
		$user_pwd = trim(sqlfilter($_REQUEST['member_password']));
		$user_pwd = md5($user_pwd);
	}

	$member_type = trim(sqlfilter($_REQUEST['member_type']));
	$member_gubun = trim(sqlfilter($_REQUEST['member_gubun']));
	$user_id = trim(sqlfilter($_REQUEST['member_id']));
	//$email = trim(sqlfilter($_REQUEST['member_email']));
	$email = $user_id;
	
	$user_name = trim(sqlfilter($_REQUEST['member_name']));
	//$birthday = trim(sqlfilter($_REQUEST['birthday']));
	$birthday_year = trim(sqlfilter($_REQUEST['birthday_year']));
	$birthday_month = trim(sqlfilter($_REQUEST['birthday_month']));
	$birthday_day = trim(sqlfilter($_REQUEST['birthday_day']));
	$birthday = $birthday_year."-".$birthday_month."-".$birthday_day;
	$gender = trim(sqlfilter($_REQUEST['gender']));
	$mail_ok = trim(sqlfilter($_REQUEST['mail_ok']));
	$cell1 = trim(sqlfilter($_REQUEST['cell1']));
	$cell2 = trim(sqlfilter($_REQUEST['cell2']));
	$cell3 = trim(sqlfilter($_REQUEST['cell3']));
	$cell = $cell1."-".$cell2."-".$cell3;
	//$cell = trim(sqlfilter($_REQUEST['cell']));
	$nation = trim(sqlfilter($_REQUEST['nation']));
	$scipe_id = trim(sqlfilter($_REQUEST['scipe_id']));
	$addr_sect = trim(sqlfilter($_REQUEST['addr_sect']));
	$post = trim(sqlfilter($_REQUEST['zip_code1']));
	$addr1 = trim(sqlfilter($_REQUEST['member_address']));
	$addr2 = trim(sqlfilter($_REQUEST['member_address2']));
	$m_channel = trim(sqlfilter($_REQUEST['m_channel']));
	$recom_name = trim(sqlfilter($_REQUEST['recom_name']));
	$m_intro = trim(sqlfilter($_REQUEST['m_intro']));
	
	$file_old_name1 = trim(sqlfilter($_REQUEST['file_old_name1']));		//file_old_name1
	$file_old_org1 = trim(sqlfilter($_REQUEST['file_old_org1']));			//file_old_org1
	$del_org1 = $_REQUEST['del_org1'];											//del_org

	$image1_name_arr = explode("-",$file_old_name1);
	$image1_type_arr = explode(".",$image1_name_arr[1]);
	$file_old_water1 = $image1_type_arr[0]."_marke_".$image1_name_arr[0].".".$image1_type_arr[1];
	
	$sql_pre1 = "select idx from member_info where user_id = '".$user_id."' and idx != '".$idx."'"; // 회원테이블 아이디 중복여부 체크
	$result_pre1  = mysqli_query($gconnet,$sql_pre1);

	if(mysqli_num_rows($result_pre1) > 0) {
		error_frame("입력하신 이메일은 이미 사용중입니다. 다시 확인하시고 입력해 주세요.");
	}

	/*if($user_nick){ // 닉네임을 입력했을때 
		
		$sql_pre4 = "select idx from member_info where user_nick = '".$user_nick."' and idx != '".$idx."' ";
		$result_pre4  = mysqli_query($gconnet,$sql_pre4);
		if(mysqli_num_rows($result_pre4) > 0) {
			error_frame("입력하신 닉네임은 이미 사용중입니다. 다시 확인하시고 입력해 주세요.");
		}

	} // 닉네임을 입력했을때 종료*/

	if($email){ // 이메일을 입력했을때 
		
		$sql_pre4 = "select idx from member_info where email = '".$email."' and idx != '".$idx."' ";
		$result_pre4  = mysqli_query($gconnet,$sql_pre4);
		if(mysqli_num_rows($result_pre4) > 0) {
			error_frame("입력하신 이메일은 이미 사용중입니다. 다시 확인하시고 입력해 주세요.");
		}

	} // 이메일을 입력했을때 종료

	if($recom_name){ // 추천인 입력했을때 
			
		$sql_pre3 = "select idx from member_info where user_id = '".$recom_name."' and memout_yn != 'Y' and memout_yn != 'S' and member_type='GEN' ";
		//echo $sql_pre3; //exit;
		$result_pre3  = mysqli_query($gconnet,$sql_pre3);
		if(mysqli_num_rows($result_pre3) == 0) {
			error_frame("입력하신 추천자와 일치하는 데이터가 없습니다. 다시 확인하시고 입력해 주세요.");
		} else {
			$row_pre3  = mysqli_fetch_array($result_pre3);
			$chuchun_idx = $row_pre3['idx'];
			//echo $chuchun_idx;
		}

	} else { // 추천인 아이디를 입력했을때 종료
		$chuchun_idx = 0;
	}

	$bbs = "member";
	$_P_DIR_FILE = $_P_DIR_FILE.$bbs."/";
	$_P_DIR_FILE2 = $_P_DIR_FILE."img_thumb/";
	
	if ($_FILES['membership_photo']['size']>0){
		if($file_old_name1){
			unlink($_P_DIR_FILE.$file_old_name1); // 원본파일 삭제
			unlink($_P_DIR_FILE2.$file_old_name1); // 원본 작은 섬네일 파일 삭제
			//unlink($_P_DIR_FILE.$file_old_water1); // 원본파일 삭제
			//unlink($_P_DIR_FILE2.$file_old_water1); // 원본 작은 섬네일 파일 삭제
			//unlink($_P_DIR_FILE3.$file_old_water1); // 원본 중간 섬네일 파일 삭제
		}
		$file_o = $_FILES['membership_photo']['name']; 
		$i_width = "185";
		$i_height = "185";
		$i_width2 = "";
		$i_height2 = "";
		//$watermark_sect = "imgw";
		$watermark_sect = "";
		$file_c = uploadFileThumb_1($_FILES, "membership_photo", $_FILES['membership_photo'], $_P_DIR_FILE,$i_width,$i_height,$i_width2,$i_height2,$watermark_sect);
	} else {	
		if($file_old_name1 && $file_old_org1){
			$file_c = $file_old_name1;
			$file_o = $file_old_org1;
		}
		if($del_org1 == "Y"){
			unlink($_P_DIR_FILE.$file_old_name1); // 원본파일 삭제
			unlink($_P_DIR_FILE2.$file_old_name1); // 원본 작은 섬네일 파일 삭제
			
			//unlink($_P_DIR_FILE.$file_old_water1); // 원본파일 삭제
			//unlink($_P_DIR_FILE2.$file_old_water1); // 원본 작은 섬네일 파일 삭제
			//unlink($_P_DIR_FILE3.$file_old_water1); // 원본 중간 섬네일 파일 삭제
			$file_o = "";
			$file_c = "";
		}
	}
	
	$mail_ok = "Y"; // 이메일 수신 허용

	$query = " update member_info set "; 
	$query .= " user_id = '".$user_id."', ";
	if($_REQUEST['member_password']){
		$query .= " user_pwd = '".$user_pwd."', ";
	}
	$query .= " user_name = '".$user_name."', ";
	$query .= " birthday = '".$birthday."', ";
	$query .= " birthday_tp = '".$birthday_tp."', ";
	$query .= " gender = '".$gender."', ";
	$query .= " email = '".$email."', ";
	$query .= " mail_ok = '".$mail_ok."', ";
	$query .= " cell = '".$cell."', ";
	$query .= " nation = '".$nation."', ";
	$query .= " scipe_id = '".$scipe_id."', ";
	$query .= " chuchun_id = '".$recom_name."', ";
	$query .= " addr_sect = '".$addr_sect."', ";
	$query .= " post = '".$post."', ";
	$query .= " addr1 = '".$addr1."', ";
	$query .= " addr2 = '".$addr2."', ";
	$query .= " m_channel = '".$m_channel."', ";
	$query .= " file_org = '".$file_o."', ";
	$query .= " file_chg = '".$file_c."', ";
	$query .= " m_intro = '".$m_intro."' ";
	$query .= " where 1 and idx = '".$idx."' ";
	$result = mysqli_query($gconnet,$query);
	
	$member_idx = $idx;
		
	if($result){
	?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('정보수정이 정상적으로 완료 되었습니다.');
	parent.location.href =  "member_view.php?idx=<?=$idx?>&<?=$total_param?>";
	//-->
	</SCRIPT>
	<?}else{?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('정보수정중 오류가 발생했습니다.');
	//-->
	</SCRIPT>
	<?}?>
