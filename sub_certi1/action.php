<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // �����Լ� ��Ŭ��� ?>
<?
$email_id = trim(sqlfilter($_REQUEST['email_id']));
$domain = trim(sqlfilter($_REQUEST['domain']));

//$to_email = $email_id.$domain;
$to_email = "moonkyuhewn@naver.com";

$subject = "�׽�Ʈ ����";
$body = "�׽�Ʈ �ٵ�";
$from_email = "moonkyuhewn@naver.com";
$from_name = "������";
echo $to_email;
mail_utf($from_email,$from_name,$to_email,$subject,$body,$file="")
?>