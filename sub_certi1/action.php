<?

include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/send_email.php"; // 공통함수 인클루드 ?>
<?
$email_id = trim(sqlfilter($_REQUEST['email_id']));
$domain = trim(sqlfilter($_REQUEST['domain']));
$uni_idx = trim(sqlfilter($_REQUEST['uni_idx']));
$hashStr = hash("sha256", $_SESSION['user_access_name']."jeondae");
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


require_once "../include/PHPMailer/PHPMailerAutoload.php"; // PHPMailer 클래스 인클루드

/*
if($_REQUEST['email2'] == "naver.com"){
    $smtp_use = 'smtp.naver.com'; //네이버 메일 발송서버
    $s_msg = "네이버를 이용해 메일을 전송하였습니다.";
} elseif($_REQUEST['email2'] == "gmail.com"){
    $smtp_use = 'smtp.gmail.com'; //구글 메일 발송서버
    $s_msg = "구글을 이용해 메일을 전송하였습니다.";
}
*/
echo !extension_loaded('openssl')?"Not Available":"Available";

$smtp_use = 'smtp.naver.com'; //네이버 메일 발송서버


$smtp_mail_id = "moonkyuhwan@naver.com"; //  발송하는 메일계정. 예)test@naver.com 혹은 test@gmail.com 형식
$smtp_mail_pw = "ansrB4901!"; // 발송하는 메일계정의 비밀번호.

$to_email = $email_id.$domain;// 받는 메일. 예) test@naver.com
$title = "전대전 인증 이메일입니다."; // 메일제목
$from_name = "전대전 관리자"; // 발송자이름
$from_email = "moonkyuhwan@naver.com"; // 발송자 메일
$content = $body; // 메일내용. html 태그가능. 태그 사용하지 않을경우 nl2br($_REQUEST['memo'])


$mail = new PHPMailer(true); // 인클루드한 PHPMailer 클래스 객체선언
$mail->IsSMTP();

try {
    $mail->Host = $smtp_use;   // email 보낼때 사용할 서버를 지정
    $mail->SMTPAuth = true;          // SMTP 인증을 사용함
    $mail->Port = 465;            // email 보낼때 사용할 포트를 지정
    $mail->SMTPSecure = "ssl";        // SSL을 사용함
    $mail->Username   = $smtp_mail_id; // 계정
    $mail->Password   = $smtp_mail_pw; // 패스워드
    $mail->SetFrom($from_email, $from_name); // 보내는 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
    $mail->AddAddress($to_email);  // 받을 사람 email 주소
    $mail->Subject = $title;         // 메일 제목
    $mail->MsgHTML($content);         // 메일 내용 (HTML 형식도 되고 그냥 일반 텍스트도 사용 가능함)

    $mail->Send(); // 메일 발송

    ?>
    <script>
        alert('인증메일이 발송되었습니다.');
        parent.location.replace('../main1');
    </script>

    <?

} catch (phpmailerException $e) {
    echo $e->errorMessage();
} catch (Exception $e) {
    echo $e->getMessage();
}

/*
$query = "INSERT INTO uni_approval SET member_idx=".$_SESSION['user_access_idx'].", approve_code='".$hashStr."'";
$result = mysqli_query($gconnet,$query);
//mail_utf("admin@djund.com","전대전",$email_id.$domain,"전대전 인증 이메일입니다.",$body);
if (mail_utf("admin@djund.com","전대전",$email_id.$domain,"전대전 인증 이메일입니다.",$body)) {

    ?>
    <script>
        alert('인증메일이 발송되었습니다.');
        parent.location.replace('../main1');
    </script>

    <?
}
*/


?>