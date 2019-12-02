<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/send_email.php"; // 공통함수 인클루드 ?>
<?
$email_id = trim(sqlfilter($_REQUEST['email_id']));
$domain = trim(sqlfilter($_REQUEST['domain']));
$hashStr = hash("sha256", $_SESSION['user_access_name']."jeondae");

$body ='

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi">
    <meta name="format-detection" content="telephone=no, address=no, email=no">
    <title> 전대전 - 전국대신전해드립니다  </title>
    <link rel="stylesheet" type="text/css" href="http://192.168.219.102:8888/css/reset.css?ver=1575270593">
    <link rel="stylesheet" type="text/css" href="http://192.168.219.102:8888/css/style.css?ver=1575270593">
    <link rel="stylesheet" type="text/css" href="http://192.168.219.102:8888/css/notosans.css?ver=1575270593">
    <link rel="stylesheet" type="text/css" href="http://192.168.219.102:8888/css/swiper.css?ver=1575270593">
    <script type="text/javascript" src="http://192.168.219.102:8888/js/jquery-1.12.0.min.js?ver=1575270593"></script>
    <script type="text/javascript" src="http://192.168.219.102:8888/js/main.js?ver=1575270593"></script>
    <script type="text/javascript" src="http://192.168.219.102:8888/js/swiper.min.js?ver=1575270593"></script>
    <script type="text/javascript" src="http://192.168.219.102:8888/js/functions.js?ver=1575270593"></script>
</head>
<script>
</script>
<body>
<div class="wrapper">
    <section class="main_section">
        <div class="result_wrap">
            <h3>학교 인증 이메일</h3>
            <form name="frm" action="http://192.168.219.102:8888/sub_certi1/email_approve.php" target="_fra_admin" >
                <input type="hidden" name="token" value="'.$hashStr.'" >
                <input type="hidden" name="id" value="'.$_SESSION["user_access_idx"].'" >
                <p class="mail_desc">인증이메일 입니다.</p>
                <div class="btn_row">
                    <button type="submit" class="blue_btn">인증메일 전송</button>
                </div>
            </form>
        </div>
        </div>

    </section>
</div>
<iframe name="_fra_admin" width="90%" height="300" style="display:none"></iframe>
</body>
</html>

        ';

$query = "INSERT INTO uni_approval SET member_idx=".$_SESSION['user_access_idx'].", approve_code='".$hashStr."'";
$result = mysqli_query($gconnet,$query);

send_smtp_email("전대전 인증 이메일입니다.",$body, "munkyuhwan@gmail.com");


?>