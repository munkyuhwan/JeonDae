<? include$_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
session_unset();
unset($_SESSION);

?>
<script>
    alert('로그아웃 되었습니다.');
    location.replace("../main1");
</script>
