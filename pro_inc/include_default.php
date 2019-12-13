<?
ini_set("session.cache_expire", 60000); // 세션 유효시간 : 분 
ini_set("session.gc_maxlifetime", 3600000); // 세션 가비지 컬렉션(로그인시 세션지속 시간) : 초 
session_cache_limiter("private");
session_start();
date_default_timezone_set('Asia/Seoul');
header("Pragma: no-cache");
header("Cache-Control: no-cache,must-revalidate");
header('Content-Type: text/html; charset=UTF-8'); 

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);  
ini_set("display_errors", "1");  
//@ini_set("allow_url_fopen ", true);
//오류 코드 - 없는 변수를 출력하라고 
if ($_SESSION['user_access_idx'] == '') {
	/*?>
<script type="application/javascript">
	location.replace("<?=$_SERVER['DOCUMENT_ROOT']?>/intro");
</script>
<?*/
}

//echo $_SERVER["HTTP_HOST"];
if($_SERVER["HTTP_HOST"] == "besuit.net"){
	//header('Location: https://besuit.co.kr'.$_SERVER['REQUEST_URI']);
} else {
	if(!isset($_SERVER["HTTPS"])) { 
	//	header('Location: https://'.$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']);
	}
}
//$TMP_ROOT = "https://3359fda6.ngrok.io";
include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/user_function.php"; // PHP 유저 함수 모음 
//include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/erp_db_conn.php"; 
include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/db_conn.php"; 
//include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/function_counter.php"; // 카운터함수  
include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/function_query.php"; // 유저 DB 함수 모음 
//include $_SERVER["DOCUMENT_ROOT"]."/login/session_mysql.php"; // 세션 DB 관리 파일

define("SUBSCRIBE_IOS", "fcm_ios");
define("SUBSCRIBE_ANDROID", "fcm_and");
include $_SERVER["DOCUMENT_ROOT"]."/include/send_push.php"; // 푸시 함수
include $_SERVER["DOCUMENT_ROOT"]."/include/extra_functions.php"; // 푸시 함수


$sitetitle_set_sql = "select set_title,set_keyword from sitetitle_set where 1 order by idx desc";
$sitetitle_set_query = mysqli_query($gconnet,$sitetitle_set_sql);
$sitetitle_set_cnt = mysqli_num_rows($sitetitle_set_query);

if($sitetitle_set_cnt > 0 ){
	$sitetitle_set_row = mysqli_fetch_array($sitetitle_set_query);
	$_SITE_TITLE = $sitetitle_set_row[set_title];
	$_SITE_KEYWORDS = $sitetitle_set_row[set_keyword];
	$_SITE_ADMIN_TITLE = $_SITE_TITLE."_관리자";
	$_SITE_PARTNER_TITLE = $_SITE_TITLE."_파트너";
} else {
	$_SITE_TITLE = "비슷";
	$_SITE_ADMIN_TITLE = $_SITE_TITLE."_관리자";
	$_SITE_PARTNER_TITLE = $_SITE_TITLE."_파트너";
}

/*$referer = parse_url($_SERVER['HTTP_REFERER']);  
$ip = gethostbyname($referer[host]);  
echo "도메인 = ".$referer[host]; // 도메인 출력  
echo "아이피 = ".$ip; // ip 출력*/ 

define("NS", "");
define("V_ROOT", "");
define("P_ROOT", $_SERVER["DOCUMENT_ROOT"].V_ROOT);

// 첨부파일 저장 
$_P_DIR_FILE =  $_SERVER["DOCUMENT_ROOT"]."/upload_file/"; //게시판,자료 등에서 업로드하는 폴더가 저장되는 경로
$_P_DIR_WEB_FILE= "/upload_file/";

$_P_DIR_FCKeditor = "/PROGRAM_FCKeditor/";
$_P_DIR_FCKeditor_UserFiles = "/upload_file/PROGRAM_FCKeditor_UserFiles/";

$sms_send_num1 = "010"; // SMS 발송번호. 실 발송번호가 정해지면 변경한다.
$sms_send_num2 = "6503"; // SMS 발송번호. 실 발송번호가 정해지면 변경한다.
$sms_send_num3 = "7858"; // SMS 발송번호. 실 발송번호가 정해지면 변경한다.

############## 유효기간이 만료된 VVIP 회원은 일반 회원으로 전환한다 시작 #############
/*$inc_default_calcu_date =  date("Y-m-d"); 
$inc_default_sql_pre4 = "update member_info set member_gubun='NOR',payment_period='' where 1 and member_gubun='SPE' and substring(payment_period,1,10) < '".$inc_default_calcu_date."'";
//echo $inc_default_sql_pre4;
$inc_default_query_pre4 = mysqli_query($gconnet,$inc_default_sql_pre4);*/
############## 유효기간이 만료된 VVIP 회원은 일반 회원으로 전환한다 종료 #############

$inc_area_gubun = array("서울","부산","대구","인천","광주","대전","울산","세종시","경기도","강원도","충청북도","충청남도","전라북도","전라남도","경상북도","경상남도","제주"); // 지역 배열
$g_maps_apikey = "AIzaSyCNhcsgPg00KG3YoBP5giptd2edSWYeKzU"; // 구글 맵 키
$inc_GOOGLE_SERVER_KEY = "AIzaSyBrsqTkjQMKpsMsINxG0BHLmXJooSGj-ME"; // 푸쉬발송 서버키

$include_public_current_date = date("Y-m-d H:i:s");
$include_current_date = date("Y-m-d");
$include_current_month_s = date("Y-m")."-01";
$include_current_month_e = date("Y-m")."-31";
$include_current_time = date("Hi");


$profile_img_query = "SELECT file_chg FROM member_info WHERE idx=".$_SESSION['user_access_idx'];
$profile_img_result = mysqli_query($gconnet, $profile_img_query);
$profile_img_assoc = mysqli_fetch_assoc($profile_img_result);

$_SESSION['profile_img'] = $profile_img_assoc['file_chg'];
$profile_img = "../upload_file/member/".$_SESSION['profile_img'];

$SIGNUP_NOT_REQUIRED = array(
	"sub_area",
	"sub_write",
	"intro",
	"join",
	"master"
);

include $_SERVER["DOCUMENT_ROOT"]."/include/MemberChecker.php";
$currentLoc = explode("/", $_SERVER['REQUEST_URI'])[1];
if (!in_array($currentLoc, $SIGNUP_NOT_REQUIRED)) {

	$memberCheck = new MemberChecker($gconnet);
	$isMember = $memberCheck->checkMember();

	if ($isMember == false) {

		?>
		<script>
			alert('로그후 이용해 주세요.');
			location.replace("../intro");
		</script>
		<?

	}

}
?>