<?
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'] . '/pro_inc/PHPMailer/src/Exception.php';
require $_SERVER['DOCUMENT_ROOT'] . '/pro_inc/PHPMailer/src/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/pro_inc/PHPMailer/src/SMTP.php';


function send_smtp_email($title, $body, $email) {

    $mail = new PHPMailer(true);
    $mail->IsSMTP(); // telling the class to use SMTP

    try {
        $mail->Host = "smtp.naver.com"; // email 보낼때 사용할 서버를 지정
        $mail->SMTPAuth = true; // SMTP 인증을 사용함
        $mail->Port = 465; // email 보낼때 사용할 포트를 지정
        $mail->SMTPSecure = "ssl"; // SSL을 사용함
        $mail->Username   = "moonkyuhwan@naver.com"; // Gmail 계정
        $mail->Password   = "ansrB4901!"; // 패스워드
        $mail->SMTPDebug = 2;
        $mail->CharSet = "utf-8";  //한글깨짐 방지를 위한 문자 인코딩설정

        $mail->SetFrom('moonkyuhwan@naver.com', "전대전 관리자"); // 보내는 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
        $mail->AddAddress($email, '받는사람'); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
        $mail->Subject = "=?EUC-KR?B?".base64_encode( $title )."?="; // 메일 제목
        $mail->MsgHTML($body); // 메일 내용 (HTML 형식도 되고 그냥 일반 텍스트도 사용 가능함)

        $mail->Send();

    }catch (phpmailerException $e) {
        echo $e->errorMessage(); //Pretty error messages from PHPMailer
    } catch (Exception $e) {
        echo $e->getMessage(); //Boring error messages from anything else!
    }
}

?>