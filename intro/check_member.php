<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$fb_id = trim(sqlfilter($_REQUEST['fb_id']));
$result = array();
if ($fb_id) {
    $query = "SELECT idx, real_name, file_chg FROM member_info WHERE user_id=".$fb_id;
    $result = mysqli_query($gconnet, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['idx'] = $row['idx'];
        $_SESSION['user_name'] = $row['real_name'];
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
    <script type="application/javascript">
        location.href = '../join/';
    </script>
<?}else {?>
    <script type="application/javascript">
        location.href = '../main1/';
    </script>
<?}?>