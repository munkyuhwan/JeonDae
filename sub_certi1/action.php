<?
/*
$mailheaders .= "From: $from_name<$from_email> \r\n";
$mailheaders .= "Reply-To: $from_name<$from_email>\r\n";
$mailheaders .= "Return-Path: $from_name<$from_email>\r\n";
$mailheaders .= "Content-Type: text/html; charset=\"utf-8\"\r\n";

mail("moonkyuhwan@naver.com","test","test",$mailheaders,'-f'."admin@djund.com");
*/
include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/send_email.php"; // 공통함수 인클루드 ?>
<?
$email_id = trim(sqlfilter($_REQUEST['email_id']));
$domain = trim(sqlfilter($_REQUEST['domain']));
$uni_idx = trim(sqlfilter($_REQUEST['uni_idx']));
$hashStr = hash("sha256", $_SESSION['user_access_name']."jeondae");
echo $email_id.$domain;
$body ='

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi">
    <meta name="format-detection" content="telephone=no, address=no, email=no">
    <title> 전대전 - 전국대신전해드립니다  </title>
    <link rel="stylesheet" type="text/css" href="http://'.$_SERVER['HTTP_HOST'].'/css/reset.css?ver='.time().'">
    <link rel="stylesheet" type="text/css" href="http://'.$_SERVER['HTTP_HOST'].'/css/style.css?ver='.time().'">
    <link rel="stylesheet" type="text/css" href="http://'.$_SERVER['HTTP_HOST'].'/css/notosans.css?ver='.time().'">
    <link rel="stylesheet" type="text/css" href="http://'.$_SERVER['HTTP_HOST'].'/css/swiper.css?ver='.time().'">
    <script type="text/javascript" src="http://'.$_SERVER['HTTP_HOST'].'/js/jquery-1.12.0.min.js?ver='.time().'"></script>
    <script type="text/javascript" src="http://'.$_SERVER['HTTP_HOST'].'/js/main.js?ver='.time().'"></script>
    <script type="text/javascript" src="http://'.$_SERVER['HTTP_HOST'].'/js/swiper.min.js?ver='.time().'"></script>
</head>
<body>
<div class="wrapper">
    <header>
        <div class="header grd_bg sub">
            <h1>전대전 대학인증</h1>
        </div>
    </header>
    <section class="main_section">
        <div class="certi_wrap">
            <div class="desc">대학 메일 인증을 통해 더 많은 서비스를 이용하실 수 있습니다. <br>
                인증 오류 및 문의는 FAQ나 1:1 문의를 이용해주세요.</div>
            <!-- 학교 검색 후 이메일 인증 영역 보여짐 -->
            <div class="result_wrap" >
                <h3>학교 인증 이메일</h3>
                <p class="mail_desc">인증이메일 입니다. 인증완료하기 버튼을 클릭하여 인증을 완료해 주세요.</p>
                <form name="frm" action="http://'.$_SERVER['HTTP_HOST'].'/sub_certi1/email_approve.php" target="_fra_admin" >
                    <input type="hidden" name="token" value="'.$hashStr.'" >
                    <input type="hidden" name="uni_idx" value="'.$uni_idx.'" >
                    <input type="hidden" name="id" value="'.$_SESSION["user_access_idx"].'" >
                    <div class="btn_row">
                        <button type="submit" class="blue_btn">인증완료하기</button>
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

mail_utf("admin@djund.com","전대전",$email_id.$domain,"전대전 인증 이메일입니다.",$body);

?>