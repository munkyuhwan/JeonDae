<?
if(!$_SESSION['member_coinc_idx']){
?>
<form name="frm_login" method="post" action="/member/login.php" target='_top'>
<input type="hidden" name="reurl_ft_go" value="<?=$_SERVER[SCRIPT_NAME]?>?<?=$_SERVER[QUERY_STRING]?>">
</form>
<script type="text/javascript">
<!--
	//alert('먼저 로그인 해주세요');
	frm_login.submit();
//-->
</script>	
<?
exit;
} 
?>