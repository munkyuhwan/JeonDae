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
################## 파라미터 조합 #####################
$total_param = 'bmenu='.$bmenu.'&smenu='.$smenu.'&field='.$field.'&keyword='.$keyword.'&v_sect='.$v_sect.'&s_gubun='.$s_gubun.'&s_level='.$s_level.'&s_gender='.$s_gender.'&s_sect1='.$s_sect1.'&s_sect2='.$s_sect2.'&s_cnt='.$s_cnt.'&s_order='.$s_order;

if($s_gubun == "NOR"){
	$member_sect_str = "일반";
} elseif($s_gubun == "SPE"){
	$member_sect_str = "VVIP 멤버십";
}

$sql = "SELECT * FROM member_info a where 1=1 and idx = '".$idx."' ";
$query = mysqli_query($gconnet,$sql);

if(mysqli_num_rows($query) == 0){
?>
<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('수정할 회원이 없습니다.');
	location.href =  "member_list.php?<?=$total_param?>";
	//-->
</SCRIPT>
<?
exit;
}

$row = mysqli_fetch_array($query);

$cell_arr = explode("-",$row[cell]);
$tel_arr = explode("-",$row[tel]);
$com_tel_arr = explode("-",$row[com_tel]);
$com_num_arr = explode("-",$row[com_num]);
$birthday_arr = explode("-",$row[birthday]);
$post_arr = explode("-",$row[post]);

$bbs_code = "member";

?>

<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script type="text/javascript">
function IsNumber(formname) {
var form=eval("document.frm." + formname);
	for(var i=0; i < form.value.length; i++) {
		var chr = form.value.substr(i,1);
		if((chr < '0' || chr > '9')) {
			return false;
		}
	}
	return true;
}

function checkNum(){
	if(event.keyCode<48 || event.keyCode>57){
		event.returnValue=false;
	}
}

 function checkNumber()
{  
     var objEv = event.srcElement; 
     var numPattern = /([^a-z,0-9])/; 
     numPattern = objEv.value.match(numPattern); 
     if(numPattern != null){   
          alert("한글, 특수문자, 대문자 입력 불가입니다!");
          objEv.value="";   
          objEv.focus(); 
          return false; 
     } 
}

	function go_submit() {
		var check = chkFrm('frm');
		if(check) {

			if (document.frm.id_ok.value != "Y"){
				alert('아이디 중복검색을 해주세요.');
				return;	
			}
			
			/*if (document.frm.nick_ok.value != "Y"){
				alert('닉네임 중복검색을 해주세요.');
				return;	
			}*/

			/*if (document.frm.email_ok.value != "Y"){
				alert('이메일 중복검사를 해주세요.');
				return;	
			}*/

			<?if($row['member_gubun'] == "SPE"){?>
				if(!vender_num(document.frm.com_num1.value,document.frm.com_num2.value,document.frm.com_num3.value)){
					return;
				}
			<?}?>
			
			if (document.frm.member_password.value){
				if(fnCheckId(document.frm.member_password.value,"비밀번호")){
					if (document.frm.member_password.value != document.frm.member_password2.value){
						alert('비밀번호와 비밀번호 확인이 맞지 않습니다 ! ');
						return;	
					}
					frm.submit();
				}
			} else {
				frm.submit();
			}

		} else {
			false;
		}
	}

function vender_num(num1,num2,num3){

	var num=(num1 + num2 + num3) 
	var w_c,w_e,w_f,w_tot
	w_c=num.charAt(8)*5       
	w_e=parseInt((w_c/10),10) 
	w_f=w_c % 10              
	w_tot=num.charAt(0)*1
	w_tot+=num.charAt(1)*3 
	w_tot+=num.charAt(2)*7
	w_tot+=num.charAt(3)*1 
	w_tot+=num.charAt(4)*3 
	w_tot+=num.charAt(5)*7 
	w_tot+=num.charAt(6)*1 
	w_tot+=num.charAt(7)*3 
	w_tot+=num.charAt(9)*1 
	w_tot+=(w_e+w_f)		 
	if (!(w_tot % 10)) 
	 {
		return(true);
	 }
	  else
	 {
	  alert("사업자 수정 번호가 규격에 맞지 않습니다.")
		return(false);
	 }  
}

//이메일 넣기
function mailChange(get){
	document.frm.email2.value=get;
}

function focus_next(num,fromform,toform){
	var str = fromform.value.length;
	if(str == num)
		toform.focus();
}

//나이계산
function set_age(jumin1,jumin2) {
    if(jumin1.length == 6 && jumin2.length >= 1) {
         var date = new Date();         
         var strAge = "";
         var strSex = "";
         var strYYYY = null;          
         var iAge = 0;
         strAge = jumin1.substr(0, 2);
         strSex = jumin2.substr(0, 1);    
         //3, 4는 국내 2000년 이후 출생일 경우, 7, 8은 외국인 국내거주자 중 2000년 이후 출생자
         if( "3478".indexOf(strSex) != -1  ){
              strYYYY = date.getYear();         
              iAge = parseInt(strYYYY) - parseInt('20' + strAge) + 1;         
              if( iAge < 0 ) {
                   alert("주민번호가 잘못되었습니다.");
                   return;
              }              
              return iAge;
         } else {
              strYYYY = date.getYear();
              iAge = parseInt(strYYYY) - parseInt('19' + strAge) + 1;              
              return iAge;              
         }
    }
}

function ch_id(){
	var chkid = $("#member_id").val();
	if(chkid == ""){
		alert("아이디를 입력하세요.");
		$("#member_id").focus();
		return;
	}
	/*if (chkid.length !=chkid.replace(/[^a-zA-Z0-9]/gi, "").length ){
		alert("아이디는 영문과 숫자로만 작성하십시오.");
		$("#member_id").focus();
		return;
	}*/
	if(!emailCheck(chkid)){
		alert("이메일 형식이 올바르지 않습니다.");
		$("#member_id").focus();
		return;
	}
	var vurl = "/pro_inc/check_id_duple.php";
	$.ajax({
		url		: vurl,
		type	: "GET",
		data	: { idx:<?=$idx?>, user_id:$("#member_id").val() },
		async	: false,
		dataType	: "json",
		success		: function(v){
			if ( v.success == "true" ){
				$("#id_ok").val("Y");
				$("#check_id").html( v.msg );
			} else if ( v.success == "false" ){
				$("#id_ok").val("N");
				$("#check_id").html( v.msg );
			} else {
				alert( "오류 발생!" );
			}
		}
	});
}

function ch_email(){
	var chkemail = $("#member_email").val();
	if(chkemail == ""){
		alert("이메일을 입력하세요.");
		$("#member_email").focus();
		return;
	}
	/*if (chkemail.length !=chkemail.replace(/[^a-zA-Z0-9]/gi, "").length ){
		alert("아이디는 영문과 숫자로만 작성하십시오.");
		$("#member_email").focus();
		return;
	}*/
	if(!emailCheck(chkemail)){
		alert("이메일 형식이 올바르지 않습니다.");
		$("#member_email").focus();
		return;
	}
	var vurl = "/pro_inc/check_email_duple.php";
	$.ajax({
		url		: vurl,
		type	: "GET",
		data	: {  idx:<?=$idx?>, user_email:$("#member_email").val() },
		async	: false,
		dataType	: "json",
		success		: function(v){
			if ( v.success == "true" ){
				$("#email_ok").val("Y");
				$("#check_email").html( v.msg );
			} else if ( v.success == "false" ){
				$("#email_ok").val("N");
				$("#check_email").html( v.msg );
			} else {
				alert( "오류 발생!" );
			}
		}
	});
}

function ch_nick(){
	var chknick = $("#user_nick").val();
	if(chknick == ""){
		alert("닉네임을 입력하세요.");
		$("#user_nick").focus();
		return;
	}
	/*if (chknick.length !=chknick.replace(/[^a-zA-Z0-9]/gi, "").length ){
		alert("사용자 아이디는 영문과 숫자로만 작성하십시오.");
		$("#member_nick").focus();
		return;
	}*/
	
	var vurl = "/pro_inc/check_nick_duple.php";
	$.ajax({
		url		: vurl,
		type	: "GET",
		data	: { idx:<?=$idx?>, user_nick:$("#user_nick").val() },
		async	: false,
		dataType	: "json",
		success		: function(v){
			if ( v.success == "true" ){
				$("#nick_ok").val("Y");
				$("#check_nick").html( v.msg );
			} else if ( v.success == "false" ){
				$("#nick_ok").val("N");
				$("#check_nick").html( v.msg );
			} else {
				alert( "오류 발생!" );
			}
		}
	});
}

//숫자,영문 조합검사
function fnCheckId(uid,str){
	if(!/^[a-z0-9]{6,12}$/.test(uid)) { 
		alert(str+'는 숫자와 영(소)문자 조합으로 6~12자리를 사용해야 합니다.'); 
		return false;
	}
  
	var chk_num = uid.search(/[0-9]/g); 
	var chk_eng = uid.search(/[a-z]/ig); 

	if(chk_num < 0 || chk_eng < 0){ 
		alert(str+'는 숫자와 영문자를 혼용하여야 합니다.'); 
		return false;
	}
    
	if(/(\w)\1\1\1/.test(uid)){
		alert(str+'에 같은 문자를 4번 이상 사용하실 수 없습니다.'); 
		return false;
	}
	return true;
}

function openDaumPostcode() {
   new daum.Postcode({
   oncomplete: function(data) {
   // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
   // 우편번호와 주소 정보를 해당 필드에 넣고, 커서를 상세주소 필드로 이동한다.
  document.getElementById('zip_code1').value = data.zonecode;
   //document.getElementById('zip_code2').value = data.postcode2;
   document.getElementById('member_address').value = data.address;
   document.getElementById('member_address2').focus();
   }
   }).open();
}


function go_list(){
	location.href = "member_view.php?idx=<?=$idx?>&<?=$total_param?>";
}

function cate_sel_1(z){
	var tmp = z.options[z.selectedIndex].value; 
	//alert(tmp);
	_fra_admin.location.href="cate_select_3.php?cate_code1="+tmp+"&fm=frm&fname=gugun";
}

<?if($v_sect == "SEL"){ // 셀러회원 시작?>
	function cate_code_1(idx){
		//alert(idx);
		$("#cate1_code_in").val(idx);
		get_data('cate_code_2.php', 'cate_code_2_area', 'member_idx=<?=$idx?>&cate_code1='+idx+'');
		get_data('cate_code_3.php', 'cate_code_3_area', 'member_idx=<?=$idx?>&cate_code1='+idx+'');
	}

	function cate_code_2(idx){
		//alert(idx);
		var cate_code1 = $("#cate1_code_in").val(); 
		get_data('cate_code_3.php', 'cate_code_3_area', 'member_idx=<?=$idx?>&cate_code1=<?=$cate_code1?>&cate_code2='+idx+'');
	}

	cate_code_1('<?=$cate_code1?>');
	cate_code_2('<?=$cate_code2?>');
<?}?>
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
					<h3><?=$member_sect_str?>회원정보 수정</h3>
				</div>
				<div class="write">
				<p class="tit"><?=$member_sect_str?>회원정보 수정 <!--<span>&#40;&#42; 필수입력&#41;</span>--></p>
				<form name="frm" action="member_modify_action.php" target="_fra_admin" method="post"  enctype="multipart/form-data">
					<input type="hidden" name="idx" id="member_idx" value="<?=$idx?>"/>
					<input type="hidden" name="total_param" value="<?=$total_param?>"/>
					<input type="hidden" name="id_ok" id="id_ok" value="Y"/> 
					<input type="hidden" name="nick_ok" id="nick_ok" value="Y"/> 
					<input type="hidden" name="email_ok" id="email_ok" value="Y"/>
					<input type="hidden" name="cate1_code_in" id="cate1_code_in" value="<?=$cate_code1?>"/>
					<input type="hidden" name="s_gubun" id="s_gubun" value="<?=$row['member_gubun']?>"/>

					<input type="hidden" name="file_old_org1" id="file_old_org1" value="<?=$row['file_org']?>">
					<input type="hidden" name="file_old_name1" id="file_old_name1" value="<?=$row['file_chg']?>">

					<table>
						<caption>가맹점 수정</caption>
						<colgroup>
							<col style="width:10%">
							<col style="width:40%">
							<col style="width:10%">
							<col style="width:40%">
						</colgroup>
						<tr>
							<th scope="row"><!--<span class="ast">&#42;</span>--> 이메일</th>
							<td colspan="3">
								<input type="text" style="width:30%;" name="member_id" id="member_id" value="<?=$row['user_id']?>" required="yes"  message="아이디" is_email="yes"/>&nbsp;<a href="javascript:ch_id();" class="btn_red">중복확인</a>
								<div id="check_id" style="paddig-top:10px;"></div>
							</td>
						</tr>
						<tr>
							<th scope="row">비밀번호</th>
							<td>
								<input type="password" maxlength="16" name="member_password" required="no"  message="비밀번호" style="width:200px; ime-mode:disabled"> <span style="display:inline-block; padding-top:4px;">(비밀번호 수정시에만 입력. 6-12자 사이) </span>
							</td>
							<th scope="row">비밀번호 확인</th>
							<td>
								<input type="password" maxlength="16" name="member_password2" required="no"  message="비밀번호 확인" style="width:200px; ime-mode:disabled"> <span style="display:inline-block; padding-top:4px;">(비밀번호 수정시에만 입력. 6-12자 사이) </span>
							</td>
						</tr>
						<tr>
							<th scope="row"><!--<span class="ast">&#42;</span>--> 성 명</th>
							<td colspan="3">
								<input type="text" style="width:30%;" name="member_name" value="<?=$row[user_name]?>" required="yes"  message="성 명">
							</td>
						</tr>

						<tr>
							<th scope="row"><!--<span class="ast">&#42;</span>--> 이미지</th>
							<td colspan="3">
							<?if($row['file_chg']){?>
								<a href="/pro_inc/download_file.php?nm=<?=$row['file_chg']?>&on=<?=$row['file_org']?>&dir=member"><?=$row['file_org']?></a>
								(기존파일 삭제 : <input type="checkbox" name="del_org1" value="Y">) <br>
							<?}?>
								<input type="file" name="membership_photo" id="membership_photo" required="no"  message="이미지">
							</td>
						</tr>
						
						<tr>
							<th scope="row"><!--<span class="ast">&#42;</span>--> 생년월일</th>
							<td>
								<select name="birthday_year" id="birthday_year" style="width:30%;" required="no" message="생년월일-년">
								<option value="">년도</option>
								<?
								$st=1910;
								$ed = date("Y")+1;
									for($i=$st; $i<$ed; $i++){
								?>
									<!--<option value="<?=$i?>" <?=$birthday_arr[0]==$i?"selected":""?>><?=$i?> 년</option>-->
									<option value="<?=$i?>" <?=$birthday_arr[0]==$i?"selected":""?>><?=$i?> 년</option>
								<?}?>
								</select>
								<select name="birthday_month" id="birthday_month" style="width:20%;" required="no" message="생년월일-월" >
								<option value="">월</option>
								<?
								$st=1;
								$ed = 13;
									for($i=$st; $i<$ed; $i++){
								?>
									<option value="<?=fnzero($i)?>" <?=$birthday_arr[1]==fnzero($i)?"selected":""?>><?=$i?> 월</option>
								<?}?>
								</select>
								<select name="birthday_day" id="birthday_day" style="width:20%;" required="no" message="생년월일-일">
								<option value="">일</option>
								<?
								$st=1;
								$ed = 32;
									for($i=$st; $i<$ed; $i++){
								?>
									<option value="<?=fnzero($i)?>" <?=$birthday_arr[2]==fnzero($i)?"selected":""?>><?=$i?> 일</option>
								<?}?>
								</select>	
							</td>
							<th>성별</th>
							<td>
								<input type="radio" name="gender" value="M" <?=$row[gender]=="M"?"checked":""?> required="no"  message="성별" id="g_m"> 남
								<input type="radio" name="gender" value="F" <?=$row[gender]=="F"?"checked":""?> required="no"  message="성별" id="g_w"> 여
							</td>
						</tr>
						<tr>
							<th scope="row"><!--<span class="ast">&#42;</span>--> 연락처</th>
							<td colspan="3">
								<input type="text" style="width:20%;" name="cell1" required="yes" value="<?=$cell_arr[0]?>" size="3" maxlength="3" message="연락처1" is_num="yes" value="">-<input type="text" style="width:20%;" name="cell2" required="yes" value="<?=$cell_arr[1]?>" size="4" maxlength="4" message="연락처2" is_num="yes" value="">-<input type="text" style="width:20%;" name="cell3" required="yes" value="<?=$cell_arr[2]?>" size="4" maxlength="4" message="연락처3" is_num="yes" value="">
							</td>
						</tr>

						<!--<tr>
							<th scope="row"><span class="ast">&#42;</span>국적</th>
							<td colspan="3">
								<select name="nation" size="1" required="yes"  message="국적" style="vertical-align:middle;" >
									<option value="">선택하세요</option>
									<option value="United States of America" <?=$row[nation]=="United States of America"?"selected":""?>>United States of America</option>
									<option value="China" <?=$row[nation]=="China"?"selected":""?>>China</option>
									<option value="Canada" <?=$row[nation]=="Canada"?"selected":""?>>Canada</option>
									<option value="Austrailia" <?=$row[nation]=="Austrailia"?"selected":""?>>Austrailia</option>
									<option value="Japan" <?=$row[nation]=="Japan"?"selected":""?>>Japan</option>
									<option value="Hong Kong" <?=$row[nation]=="Hong Kong"?"selected":""?>>Hong Kong</option>
									<option value="Taiwan" <?=$row[nation]=="Taiwan"?"selected":""?>>Taiwan</option>
									<option value="Singapore" <?=$row[nation]=="Singapore"?"selected":""?>>Singapore</option>
								</select>
							</td>
						</tr>
						<tr>
							<th scope="row"><!--<span class="ast">&#42;</span> 스카이프 ID</th>
							<td colspan="3">
								<input type="text" style="width:30%;" name="scipe_id" value="<?=$row[scipe_id]?>" required="yes"  message="스카이프 ID">
							</td>
						</tr>
						<tr>
							<th scope="row"><!--<span class="ast">&#42;</span>추천인</th>
							<td colspan="3">
								<input type="text" style="width:30%;" name="recom_name" value="<?=$row[chuchun_id]?>" required="no"  message="추천인"> (추천인 아이디를 입력해주세요)
							</td>
						</tr>-->

						<tr>
							<th scope="row">자기소개</th>
							<td colspan="3">
								<textarea style="width:90%;height:50px;" name="m_intro" required="no"  message="자기소개" value=""><?=$row[m_intro]?></textarea>
							</td>
						</tr>

					</table>
				</form>
				
					<div class="write_btn align_r">
						<a href="javascript:go_list();" class="btn_list">취소</a>
						<button class="btn_modify" onclick="go_submit();">정보수정</button>
					</div>
				
				</div>
			</div>
		</div>
		<!-- content 종료 -->
	</div>
</div>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_bottom_admin_tail.php"; ?>
</body>
</html>