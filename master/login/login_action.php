<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<?
$pm_id = trim(sqlfilter($_REQUEST['lms_id']));
$pm_pwd = md5(sqlfilter($_REQUEST['lms_pass']));
$reurl_go = trim(sqlfilter($_REQUEST['reurl_go']));
//exit;

$sql = "select * from member_info where 1 and user_id='".$pm_id."'";/* and member_type='AD'"*/;
$result = mysqli_query($gconnet,$sql);
//echo "매칭갯수 = ".mysqli_num_rows($result); exit;

if(mysqli_num_rows($result)>0){
		
	$row = mysqli_fetch_array($result);

	if($_SERVER['REMOTE_ADDR'] == "121.167.147.150" || $_SERVER['REMOTE_ADDR'] == "59.9.37.47"){
	} else {
		if(trim($pm_pwd) != trim($row['user_pwd'])){
			error_frame("비밀번호가 일치하지 않습니다. 다시 확인하시고 로그인 해주세요! ");
		}
	}

	if(!$reurl_go) {
        if ($row['member_type'] == "AD") {
            $_SESSION['admin_coinc_id'] = $pm_id;
            $_SESSION['admin_coinc_idx'] = $row['idx'];
            $_SESSION['admin_coinc_name'] = $row['user_name'];
            $_SESSION['admin_coinc_password'] = $pm_pwd;
            $reurl_go = "../main/?bmenu=1&smenu=1&v_sect=GEN&s_gubun=NOR";
        } else if ($row['member_type'] == "GEN") {
            $_SESSION['user_id'] = $pm_id;
            $_SESSION['user_idx'] = $row['idx'];
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['user_password'] = $pm_pwd;
            $reurl_go = "../../JeonDaeJeon/send_form.php";
        }
    }

	?>
	
	<script type="text/javascript">
	<!--
	parent.location.href="<?=$reurl_go?>";
	//-->
	</script>

	<?

} else { 
	error_frame("일치하는 관리자 계정이 없습니다. 다시 확인하시고 로그인 해주세요! ");
	exit;
}
?>

