<? 
define ("SIDS", 'b4bf02db4b65bed05491c529193a6b6d');				// ROOT 이면서 sysadmin인 관리자
define ("CITZCODE", 41535);													// 변경금지
define ("DOMAIN", "epolestar.kr");	
define ("FILE1_URL", "http://file1.epolestar.kr");							// 파일1
define ("FILE2_URL", "http://file2.epolestar.kr");							// 파일1
define ("HTTPS", "http://epolestar.kr");									// https
define ("HTTP", "http://epolestar.kr");										// http

define ("WEB_BASE_ROOT", "/free/home/epolestar/");
define ("HOME_DIR", WEB_BASE_ROOT."html/");
define ("LIBS_DIR", HOME_DIR."_Libs/");
define ("CONFIG_DIR", HOME_DIR."_Config/");

define ("NBOARD_DIR", HOME_DIR."NBoard/");
define ("NBOARD_UPDIR", WEB_BASE_ROOT."files_web/DB/");
define ("FILESWEB_DIR", WEB_BASE_ROOT."files_web/");
define ("FILESCMS_DIR", WEB_BASE_ROOT."files_cms/");


date_default_timezone_set("Asia/Seoul"); 

/**
 * Default Include Libs(DB/Config/Base Function...)
 * =============================================================
 */
include_once CONFIG_DIR.'db.config.php';
include_once CONFIG_DIR.'polestar_base.config.php';
include_once CONFIG_DIR.'cms.service.php';
include_once LIBS_DIR.'NSLibs/fun_base_util.php';
include_once LIBS_DIR.'NSLibs/fun_base_encrypt.php';
include_once LIBS_DIR.'NSLibs/nsobject_class.php';
include_once LIBS_DIR.'NSLibs/app_result_class.php';
include_once LIBS_DIR.'Polestar/polestar_fun.php';
include_once LIBS_DIR.'ExportLibs/adodb_lite/adodb.inc.php';
include_once LIBS_DIR.'ExportLibs/shiny_json_class.php';

/*
	쿠키처리용 상수
	_CKE_TLEVEL		: 1: 직원 , 2: 강사 (관리자인경우 6: 일반관리자, 7: 관리 + CMS, 8: CMS관리만)
	============================================================
*/
// print_r($_COOKIE);
if(isset($_COOKIE['_CKE_SERVER'])) define("__SERVER", $_COOKIE['_CKE_SERVER']); else define("__SERVER", '');
if(isset($_COOKIE['_CKE_FILENO'])) define("__FIELNO", $_COOKIE['_CKE_FILENO']); else define("__FIELNO", '');
if(isset($_COOKIE['_CKE_ID'])) define("__ID", $_COOKIE['_CKE_ID']); else define("__ID", '');
if(isset($_COOKIE['_CKE_NAME'])) define("__NAME", $_COOKIE['_CKE_NAME']); else define("__NAME", '');
if(isset($_COOKIE['_CKE_MAIL'])) define("__MAIL", $_COOKIE['_CKE_MAIL']); else define("__MAIL", '');
if(isset($_COOKIE['_CKE_LEVEL'])) define("__LEVEL", $_COOKIE['_CKE_LEVEL']); else define("__LEVEL", '');
if(isset($_COOKIE['_CKE_TLEVEL'])) define("__TLEVEL", $_COOKIE['_CKE_TLEVEL']); else define("__TLEVEL", '');
if(isset($_COOKIE['_CKE_CITZ'])) define("__CITZ", $_COOKIE['_CKE_CITZ']); else define("__CITZ", '');

if(isset($_COOKIE['_CKE_R'])) define("__IS_SET_PERM", '1'); else define("__IS_SET_PERM", '1');
if(isset($_COOKIE['_CKE_R'])) define("__PERM_R", $_COOKIE['_CKE_R']); else define("__PERM_R", '');
if(isset($_COOKIE['_CKE_W'])) define("__PERM_W", $_COOKIE['_CKE_W']); else define("__PERM_W", '');
if(isset($_COOKIE['_CKE_D'])) define("__PERM_D", $_COOKIE['_CKE_D']); else define("__PERM_D", '');

/*$_COOKIE['_CKE_SERVER']='';
$_COOKIE['_CKE_FILENO']='';
$_COOKIE['_CKE_ID']='';
$_COOKIE['_CKE_NAME']='';
$_COOKIE['_CKE_MAIL']='';
$_COOKIE['_CKE_LEVEL']='';
$_COOKIE['_CKE_TLEVEL']='';
$_COOKIE['_CKE_CITZ']='';
$_COOKIE['_CKE_R']='';
$_COOKIE['_CKE_W']='';
$_COOKIE['_CKE_D']='';*/


// 네비게이션 위치 변경용
$_THIS_PAGE = getNaviStr();

############# 팔도경조금 홈페이지는 회원인증이 쿠키이므로, 세션을 사용하는 쇼핑몰과의 연동을 위해 아래부분을 구성함. 쇼핑몰 페이지에 모두 인클루드 필요  ################

//echo "회원종류 = ".$_COOKIE['_CKE_LEVEL']."<br>";
//echo "본페이지 = ".$_THIS_PAGE."<br>";

if(!$_COOKIE['_CKE_ID']){ // 로그인 아이디 쿠키값이 없을때는 로그아웃 된 것으로 간주한다.
	
	session_destroy();
	
} else { // 로그인 아이디 쿠키값이 있을때 시작

	if($_COOKIE['_CKE_LEVEL'] == 2){ // 본부장 로그인 시
	
		$_SESSION['user_polest_ServerGbn'] = "GISA"; // 회원구분(대) : 본부장
		$_SESSION['user_polest_UserGbn'] = ""; // 회원구분(소) : 본부장
		$_SESSION['user_polest_CustSeq'] = $_COOKIE['_CKE_FILENO']; // 본부장 고유값
		$_SESSION['user_polest_id'] = $_COOKIE['_CKE_ID']; // 로그인 아이디
		$_SESSION['user_polest_name'] = $_COOKIE['_CKE_NAME']; // 본부장 이름
		$_SESSION['user_polest_email'] = $_COOKIE['_CKE_MAIL']; // 메일주소

		/*echo "회원구분 대 = ".$_SESSION['user_polest_ServerGbn']."<br>";
		echo "회원구분 소 = ".$_SESSION['user_polest_UserGbn']."<br>";
		echo "본부장 고유값 = ".$_SESSION['user_polest_CustSeq']."<br>";
		echo "로그인 아이디 = ".$_SESSION['user_polest_id']."<br>";
		echo "본부장 이름 = ".$_SESSION['user_polest_name']."<br>";
		echo "메일주소 = ".$_SESSION['user_polest_email']."<br>";*/

	} elseif($_COOKIE['_CKE_LEVEL'] == 4 || $_COOKIE['_CKE_LEVEL'] == 5){ // 학원 로그인 시

		$_SESSION['user_polest_ServerGbn'] = "PARTNR"; // 회원구분(대) : 학원
		$_SESSION['user_polest_UserGbn'] = "ACADEMY"; // 회원구분(소) : 학원
		$_SESSION['user_polest_CustSeq'] = $_COOKIE['_CKE_SERVER']; // 학원 고유값
		$_SESSION['user_polest_id'] = $_COOKIE['_CKE_ID']; // 로그인 아이디
		$_SESSION['user_polest_name'] = $_COOKIE['_CKE_NAME']; // 학원 이름
		$_SESSION['user_polest_email'] = $_COOKIE['_CKE_MAIL']; // 메일주소

		/*echo "회원구분 대 = ".$_SESSION['user_polest_ServerGbn']."<br>";
		echo "회원구분 소 = ".$_SESSION['user_polest_UserGbn']."<br>";
		echo "학원 고유값 = ".$_SESSION['user_polest_CustSeq']."<br>";
		echo "로그인 아이디 = ".$_SESSION['user_polest_id']."<br>";
		echo "학원장 명 = ".$_SESSION['user_polest_name']."<br>";
		echo "메일주소 = ".$_SESSION['user_polest_email']."<br>";*/

	} elseif($_COOKIE['_CKE_LEVEL'] == 10){ // 학생 로그인 시
	
		$_SESSION['user_polest_ServerGbn'] = "PARTNR"; // 회원구분(대) : 학생
		$_SESSION['user_polest_UserGbn'] = "STD"; // 회원구분(소) : 학생
		$_SESSION['user_polest_std_server'] = $_COOKIE['_CKE_SERVER']; // 학생 구분용 학원 고유값
		$_SESSION['user_polest_CustSeq'] = $_COOKIE['_CKE_FILENO']; // 학생 고유값
		$_SESSION['user_polest_id'] = $_COOKIE['_CKE_ID']; // 로그인 아이디
		$_SESSION['user_polest_name'] = $_COOKIE['_CKE_NAME']; // 학생 이름
		$_SESSION['user_polest_email'] = $_COOKIE['_CKE_MAIL']; // 메일주소

		/*echo "회원구분 대 = ".$_SESSION['user_polest_ServerGbn']."<br>";
		echo "회원구분 소 = ".$_SESSION['user_polest_UserGbn']."<br>";
		echo "학생 구분용 학원 고유값 = ".$_SESSION['user_polest_std_server']."<br>";
		echo "학생 고유값 = ".$_SESSION['user_polest_CustSeq']."<br>";
		echo "로그인 아이디 = ".$_SESSION['user_polest_id']."<br>";
		echo "이름 = ".$_SESSION['user_polest_name']."<br>";
		echo "메일주소 = ".$_SESSION['user_polest_email']."<br>";*/
	}

}  // 로그인 아이디 쿠키값이 있을때 종료
		
?>
