<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<html>
<body>
<?
$fb_id = trim(sqlfilter($_REQUEST['fb_id']));
$fb_name = trim(sqlfilter($_REQUEST['fb_name']));
$fb_email = trim(sqlfilter($_REQUEST['fb_email']));

$result = array();


if ($fb_id) {
    $query = "SELECT idx, real_name, file_chg FROM member_info WHERE user_id='".$fb_id."'";
    $result = mysqli_query($gconnet, $query);
    if (mysqli_num_rows($result)>0) {
        $row = mysqli_fetch_assoc($result);

        session_start();
        $_SESSION['user_access_idx'] = $row['idx'];
        $_SESSION['user_access_name'] = $row['real_name'];
        $_SESSION['profile_img'] = $row['file_chg'];
        $result = array(
              "result"=>true
        );


    }else {
        $result = array(
            "result"=>false
        );
    }
}else {
    $result = array(
        "result"=>false
    );
}
if ($result['result'] != true) {?>

    <form name="frm" id="frm" action="../join" method="get" >
        <input type="hidden" name="fb_id" id="fb_id" value="<?=$fb_id?>" >
        <input type="hidden" name="fb_name" id="fb_name" value="<?=$fb_name?>" >
        <input type="hidden" name="fb_email" id="fb_email" value="<?=$fb_email?>" >
    </form>

    <script type="application/javascript">
        document.frm.submit();
        //location.replace('../join?fb_id=<?=$fb_id?>');
    </script>
<?}else {?>
    <script type="application/javascript">
        location.href = '../main1/';
    </script>
<?}

?>

</body>
</html>

