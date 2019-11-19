<?
if(!$_SESSION['member_bisut_idx']){
?>
<script type="text/javascript">
<!--
	alert('먼저 로그인 해주세요');
    //opener.location.href="/member/login.php";
	self.close();
//-->
</script>	
<?
exit;
}
?>