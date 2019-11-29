<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$email_id = trim(sqlfilter($_REQUEST['email_id']));
$domain = trim(sqlfilter($_REQUEST['domain']));

$hashStr = hash("sha256", $_SESSION['user_access_name']."jeondae");
$query = "INSERT INTO uni_approval SET member_idx=".$_SESSION['user_access_idx'].", approve_code='".$hashStr."'";
$result = mysqli_query($gconnet,$query);

/*
//$to_email = $email_id.$domain;
$to_email = "moonkyuhewn@naver.com";
$subject = "테스트 메일";
$body = "테스트 바디";
$from_email = "moonkyuhewn@naver.com";
$from_name = "관리자";
mail_utf($from_email,$from_name,$to_email,$subject,$body,$file="")
*/
?>