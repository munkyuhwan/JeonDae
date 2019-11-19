<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>
<?
$idx = trim(sqlfilter($_REQUEST['idx']));
$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$field = trim(sqlfilter($_REQUEST['field']));
$keyword = sqlfilter($_REQUEST['keyword']);
$v_sect = sqlfilter($_REQUEST['v_sect']); 
$s_gubun = sqlfilter($_REQUEST['s_gubun']); 
$s_level = sqlfilter($_REQUEST['s_level']); 
$s_gender = sqlfilter($_REQUEST['s_gender']); 
$s_sect1 = trim(sqlfilter($_REQUEST['s_sect1'])); 
$s_sect2 = trim(sqlfilter($_REQUEST['s_sect2'])); 
$s_cnt = trim(sqlfilter($_REQUEST['s_cnt'])); // 목록 갯수 
$s_order = trim(sqlfilter($_REQUEST['s_order'])); // 목록 정렬 

$sql = "SELECT *,(select user_name from member_info where 1 and member_type='GEN' and user_id=a.chuchun_id) as recom_name FROM member_info a where 1=1 and idx = '".$idx."' ";
$query = mysqli_query($gconnet,$sql);

if(mysqli_num_rows($query) == 0){
?>
<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('등록된 회원이 없습니다.');
	location.href =  "member_list.php?<?=$total_param?>";
	//-->
</SCRIPT>
<?
exit;
}

$row = mysqli_fetch_array($query);

if($row['memout_yn'] == "S"){
	$smenu = 3;
} elseif($row['memout_yn'] == "Y"){
	$smenu = 5;
} 

################## 파라미터 조합 #####################
$total_param = 'bmenu='.$bmenu.'&smenu='.$smenu.'&field='.$field.'&keyword='.$keyword.'&v_sect='.$v_sect.'&s_gubun='.$s_gubun.'&s_level='.$s_level.'&s_gender='.$s_gender.'&s_sect1='.$s_sect1.'&s_sect2='.$s_sect2.'&s_cnt='.$s_cnt.'&s_order='.$s_order.'&pageNo='.$pageNo;

$member_level_sql = "select level_name from member_level_set where 1=1 and level_code = '".$row[user_level]."' ";   
$member_level_query = mysqli_query($gconnet,$member_level_sql);
$member_level_row = mysqli_fetch_array($member_level_query);
$user_level_str = $member_level_row['level_name'];

if($s_gubun == "NOR"){
	$member_sect_str = "일반";
} elseif($s_gubun == "SPE"){
	$member_sect_str = "VVIP 멤버십";
}

$birthday_arr = explode("-",$row[birthday]);

if($row[gender] == "M"){
	$gender = "남성";
} elseif($row[gender] == "F"){
	$gender = "여성";
} else {
	$gender = "";
}
?>

<script type="text/javascript">
function go_view(no){
		location.href = "member_view.php?idx="+no+"&<?=$total_param?>";
}
	
function go_modify(no){
		location.href = "member_modify.php?idx="+no+"&<?=$total_param?>";
}

function go_delete(no){
	if(confirm('회원 정보를 삭제하시면 다시는 복구가 불가능 합니다. 정말 삭제 하시겠습니까?')){
		if(confirm('삭제하신 데이터는 복구할수 없도록 영구 삭제 됩니다. 그래도 삭제 하시겠습니까?')){	
			_fra_admin.location.href = "member_delete_action.php?idx="+no+"&<?=$total_param?>";
		}
	}
}

<?if($row['memout_yn'] == "Y"){?>
	function go_list(){
		location.href = "member_list_out.php?<?=$total_param?>";
	}
<?}else{?>
	function go_list(){
		location.href = "member_list.php?<?=$total_param?>";
	}
<?}?>

	function go_memout_com(no){
		if(confirm('정말 탈퇴처리 하시겠습니까?')){
			//if(confirm('탈퇴한 회원의 포인트 등 은 복구할수 없도록 영구 삭제 됩니다. 그래도 탈퇴처리 하시겠습니까?')){	
			if(confirm('탈퇴한 회원은 복구할수 없도록 영구 삭제 됩니다. 그래도 탈퇴처리 하시겠습니까?')){	
				_fra_admin.location.href = "member_out_action.php?idx="+no+"&mode=outcom&o_sect=one&<?=$total_param?>&re_url=member_out_done.php";
			}
		}
	}

	function go_memout_can(no){
		if(confirm('탈퇴신청을 취소처리 하시겠습니까?')){
			_fra_admin.location.href = "member_out_action.php?idx="+no+"&mode=outcan&o_sect=one&<?=$total_param?>&re_url=member_view.php";
		}
	}

	function go_submit() {
		var check = chkFrm('frm');
		if(check) {
			frm.submit();
		} else {
			false;
		}
	}

	function go_submit_bad() {
		if(confirm('정말 불량회원명으로 등록 하시겠습니까?')){
			var check = chkFrm('frm_bad');
			if(check) {
				frm_bad.submit();
			} else {
				false;
			}
		}
	}

	function go_submit_bad2() {
		if(confirm('차단회원으로 설정하시면 해당 회원은 모든 자격이 박탈됩니다. 정말 차단회원 으로 설정 하시겠습니까?')){
			var check = chkFrm('frm_bad');
			if(check) {
				frm_bad.submit();
			} else {
				false;
			}
		}
	}

function upload_member(){
	$("#membership_photo").click();
}
function upload_photo() {
	var frm = document.forms["frm_photo"];
	frm.submit();
}
function upload_photo_callback(photo1,photo2) {

	if (photo2 != "" && photo2 != "false") {
		var frm_photo = document.forms["frm_photo"];
		frm_photo.elements["membership_photo_org"].value = photo2;

		//var frm = document.forms["frm"];
		//frm.elements["membership_photo"].value = photo;

		//$("#member_noimg").attr("src","/upload_file/member/img_thumb/" + encodeURIComponent(photo2)).addClass("circle_div");
		$("#member_noimg").attr("src","/upload_file/member/img_thumb/"+photo2);

		var frm_main = document.forms["frm_profile"];
		frm_main.elements["file_o"].value = photo1;
		frm_main.elements["file_c"].value = photo2;
	}
}
function unlink_photo(){
	var frm_photo = document.forms["frm_photo"];
	$.ajax({
		url : "action_unlink_photo.php",
		type : "post",
		dataType : "text",
		data : {"membership_photo_org" : frm_photo.elements["membership_photo_org"].value},
		async : true,
		timeout : 9000,
		success : function(data){
			$("#member_noimg").attr("src","<?=get_member_photo($idx)?>");
			var frm_main = document.forms["frm_profile"];
			frm_main.elements["file_o"].value = "";
			frm_main.elements["file_c"].value = "";
		}
	});
}

function go_submit_profile(){
	var check = chkFrm('frm_profile');
	if(check) {
		frm_profile.submit();
	} else {
		false;
	}
}
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
						<li><?=$member_sect_str?>회원</li>
					</ul>
				</div>
				<div class="list_tit">
					<h3><?=$member_sect_str?>회원정보 상세보기</h3>
				</div>
				<div class="write">
					<p class="tit">기본 정보</p>
					<table>
						<caption>회원 상세보기</caption>
						<colgroup>
							<col style="width:15%">
							<col style="width:35%">
							<col style="width:15%">
							<col style="width:35%">
						</colgroup>
						<tr>
							<th scope="row">이메일</th>
							<td colspan="3">
								<?=$row[user_id]?>
							</td>
						</tr>
						<tr>
							<th scope="row">성 명</th>
							<td colspan="3">
								<?=$row[user_name]?>
							</td>
							<!--<th scope="row">국적</th>
							<td>
								<?=$row[nation]?>
							</td>-->
						</tr>
						<tr>
							<th scope="row">이미지</th>
							<td colspan="3">
								<img src="<?=get_member_photo($idx)?>" alt="" id="member_noimg"> 
							</td>
						</tr>
						<tr>
							<th scope="row">생년월일</th>
							<td>
								<?=$row[birthday]?>
							</td>
							<th scope="row">성 별</th>
							<td>
								<?=$gender?>
							</td>
						</tr>
						<tr>
							<th scope="row">연락처</th>
							<td colspan="3">
								<?=$row[cell]?>
							</td>
						</tr>
						<tr>
							<th scope="row">자기소개</th>
							<td colspan="3">
								<?=nl2br($row[m_intro])?>
							</td>
						</tr>
						<!--<tr>
							<th scope="row">스카이프 ID</th>
							<td>
								<?=$row[scipe_id]?>
							</td>
							<th scope="row">추천인</th>
							<td colspan="3">
								<?=$row[recom_name]?>
							</td>
						</tr>-->

					<?if($row[member_gubun] == "SPE"){?>
						<tr>
							<th scope="row">VVIP 가입기간</th>
							<td>
								<?=$payment_sect_str?>
							</td>
							<th scope="row">VVIP 종료일</th>
							<td>
								<?=substr($row[payment_period],0,10)?>
							</td>
						</tr>
					<?}?>
						<tr>
							<th scope="row">등록일시</th>
							<td colspan="3">
								<?=$row[wdate]?>
							</td>
						</tr>
					</table>

				<div class="write_btn align_r">
					<a href="javascript:go_list();" class="btn_gray">목록보기</a>
					<a href="javascript:go_modify('<?=$row[idx]?>');" class="btn_green">정보수정</a>
					<a href="javascript:go_delete('<?=$row[idx]?>');" class="btn_red">삭제하기</a>	
				</div>
				
				<p class="tit">비슷정보</p>
				
				<div style="display:none;">
				<form name="frm_photo" method="post" target="_fra_admin" action="action_upload_photo.php" enctype="multipart/form-data">
					<input type="file" name="membership_photo" id="membership_photo" onchange="upload_photo();">
					<input type="hidden" name="membership_photo_org" >
				</form>
				</div>

					<table>
					<colgroup>
						<col width="15%" />
						<col width="35%" />
						<col width="15%" />
						<col width="35%" />
					</colgroup>
				<form name="frm_profile" id="frm_profile" action="member_profile_action.php" target="_fra_admin" method="post" >
						<input type="hidden" name="member_idx" value="<?=$row[idx]?>"/>
						<input type="hidden" name="total_param" value="<?=$total_param?>"/>
						<input type="hidden" name="v_sect" value="<?=$v_sect?>"/>
						<input type="hidden" name="file_o" id="file_o" value="<?=$row['file_org']?>">
						<input type="hidden" name="file_c" id="file_c" value="<?=$row['file_chg']?>">
					<tr>
							<th scope="row">관심사</th>
							<td colspan="3">
						<?
						$mem_cate_query = "select cate_code1,cate_name1,file_c from viva_cate where 1 and set_code='memcat' and cate_level = '1' and is_del='N' order by cate_align desc"; 
						$mem_cate_result = mysqli_query($gconnet,$mem_cate_query);
						for ($mem_cate_i=0; $mem_cate_i<mysqli_num_rows($mem_cate_result); $mem_cate_i++){
							$mem_cate_row = mysqli_fetch_array($mem_cate_result);

							$mem_cate_chk_sql = "select idx from member_category_set where 1 and member_idx = '".$row['idx']."' and tag_value = '".$mem_cate_row['cate_code1']."' and cate_type='cate'";
							$mem_cate_chk_query = mysqli_query($gconnet,$mem_cate_chk_sql);
							if(mysqli_num_rows($mem_cate_chk_query) > 0){
								$cate_chked = "checked";
							} else {
								$cate_chked = "";
							}

						?>
							<img src="<?=$_P_DIR_WEB_FILE?>/cate_banner/<?=$mem_cate_row['file_c']?>">
							<span><input type="checkbox" name="mem_cate_<?=($mem_cate_i+1)?>" value="<?=$mem_cate_row['cate_code1']?>" <?=$cate_chked?>> <?=$mem_cate_row['cate_name1']?></span>
						<?}?>
							</td>
					</tr>
				<?
				$sql_mem_hash = "select tag_value from member_category_set where 1 and member_idx = '".$row['idx']."' and cate_type='hast' order by idx asc ";
				//echo $sql_mem_hash."<br>";
				$query_mem_hash = mysqli_query($gconnet,$sql_mem_hash);
				$cnt_mem_hash = mysqli_num_rows($query_mem_hash);

				if($cnt_mem_hash < 3){
					$cnt_mem_hash = 3;
				}
						
				for($i_mem_hash=0; $i_mem_hash<$cnt_mem_hash; $i_mem_hash++){
					$row_mem_hash = mysqli_fetch_array($query_mem_hash);
					$k_mem_hash = $i_mem_hash+1;
				?>
					<tr>
						<th >해시태그 <?=$k_mem_hash?></th>
						<td colspan="3">
							<input type="text" style="width:50%;" required="no" message="해시태그" name="mem_hash_<?=($i_mem_hash+1)?>" value="<?=$row_mem_hash['tag_value']?>">
						</td>
					</tr>
				<?}?>
				</form>
				</table>
				<div style="margin-top:-20px;margin-bottom:20px;text-align:right;padding-right:10px;"><a href="javascript:go_submit_profile();" class="btn_blue">비슷정보 설정</a></div>

					<p class="tit">승인 및 관리자 메모</p>
					<table>
					<colgroup>
						<col width="15%" />
						<col width="35%" />
						<col width="15%" />
						<col width="35%" />
					</colgroup>
			
						<form name="frm" action="member_view_action.php" target="_fra_admin" method="post" >
							<input type="hidden" name="idx" value="<?=$idx?>"/>
							<input type="hidden" name="total_param" value="<?=$total_param?>"/>
							<input type="hidden" name="v_sect" value="<?=$v_sect?>"/>
							<!--<tr>
							<th scope="row">승인여부</th>
							<td colspan="3">
								<select name="master_ok" required="yes" message="승인여부" size="1" style="vertical-align:middle;" >
									<option value="">선택하세요</option>
									<option value="Y" <?=$row[master_ok]=="Y"?"selected":""?>>승인</option>
									<option value="N" <?=$row[master_ok]=="N"?"selected":""?>>미승인</option>
								</select>
							</td>
							</tr>-->							
							<tr>
							<th scope="row">로그인 여부</th>
							<td colspan="3">
								<select name="login_ok" required="yes" message="로그인 승인여부" size="1" style="vertical-align:middle;" >
									<option value="">선택하세요</option>
									<option value="Y" <?=$row[login_ok]=="Y"?"selected":""?>>로그인 가능</option>
									<option value="N" <?=$row[login_ok]=="N"?"selected":""?>>로그인 차단</option>
								</select>
							</td>
							</tr>										
							<!--<tr>
							<th >회원등급 변경</th>
							<td colspan="3">
								<select name="user_level" required="yes" message="회원등급" size="1" style="vertical-align:middle;" >
								<option value="">선택하세요</option>
								<?
									$sub_sql = "select idx,level_code,level_name from member_level_set where 1=1 and is_del = 'N' order by level_align asc";
									$sub_query = mysqli_query($gconnet,$sub_sql);
									$sub_cnt = mysqli_num_rows($sub_query);

									for($sub_i=0; $sub_i<$sub_cnt; $sub_i++){
										$sub_row = mysqli_fetch_array($sub_query);
								?>
									<option value="<?=$sub_row[level_code]?>" <?=$row[user_level]==$sub_row[level_code]?"selected":""?>><?=$sub_row[level_name]?></option>
								<?}?>
								</select>
							</td>
							</tr>-->
							<input type="hidden" name="user_level" value="<?=$row[user_level]?>"/>
							<tr>
							<th scope="row">관리자 메모</th>
							<td colspan="3">
								<textarea style="width:90%;height:50px;" name="admin_memo" required="no"  message="관리자 메모사항" value=""><?=$row[admin_memo]?></textarea>
							</td>
							</tr>
						</form>
					</table>
					<div style="margin-top:-20px;margin-bottom:20px;text-align:right;padding-right:10px;"><a href="javascript:go_submit();" class="btn_blue">설정변경</a></div>

				</div>
			</div>
		</div>
		<!-- content 종료 -->
	</div>
</div>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_bottom_admin_tail.php"; ?>
</body>
</html>