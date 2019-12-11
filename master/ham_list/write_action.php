<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$selected_report = $_REQUEST['selected_report'];
$publish_page = trim(sqlfilter($_REQUEST['publish_page']));
$publish_time = trim(sqlfilter($_REQUEST['publish_time']));
$publish_interval = trim(sqlfilter($_REQUEST['publish_interval']));


$page_info_query = "SELECT app_id,app_secret,page_id FROM report_categories WHERE idx=".$publish_page;
$page_info_result = mysqli_query($gconnet, $page_info_query);
$fbInfo = mysqli_fetch_assoc($page_info_result);
//print_r($fbInfo);

//$accessTokenJson = getAccessToken($fbInfo['app_id'], $fbInfo['app_secret']);
//print_r($accessTokenJson);
//$accessToken =  $accessTokenJson['access_token'];

//print_r($selected_report);

foreach ($selected_report as $v) {
    $query = "UPDATE report_list SET";
    $query .= " category = ".$publish_page.", ";
    $query .= " published_yn = 'Y', ";
    $query .= " publish_time = ".$publish_time.", ";
    $query .= " publish_interval = ".$publish_interval." ";
    $query .= " WHERE idx=".$v;

    $result = mysqli_query($gconnet, $query);

    $fbContentQuery = "SELECT content_text, member_idx  FROM report_list WHERE idx=".$v;
    $fbContentResult = mysqli_query($gconnet, $fbContentQuery);
    $fbContentText = mysqli_fetch_assoc($fbContentResult);

    $contents = $fbContentText['content_text'];
    $member_idx = $fbContentText['member_idx'];
    //uploadToFB($fbInfo['app_id'], $accessToken, $contents, $fbInfo['page_id']);

    //echo $contents."<br><br>";

    addToAlarm("PUBL", $v, $member_idx, "", $gconnet);

}



function addToAlarm($alarmType, $reportIdx, $memberIdx, $alarmMsg, $gconnet) {
    $query = "INSERT INTO alarm_list SET ";
    $query .= " alarm_type='".$alarmType."', ";
    $query .= " report_idx=".$reportIdx.", ";
    $query .= " member_idx=".$memberIdx.", ";
    $query .= " alarm_msg='".$alarmMsg."' ";

    $result = mysqli_query($gconnet, $query);

}


function uploadToFB($appID, $accessToken, $msg, $pageID){

    $curl = curl_init();
    $auth_data = array(
        'message' 		=> $msg,
        'access_token' 	=> $accessToken,
        'grant_type' 		=> 'client_credentials'
    );
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $auth_data);
    curl_setopt($curl, CURLOPT_URL, "https://graph.facebook.com/".$pageID."/feed");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

    $result = curl_exec($curl);
    if(!$result){die("Connection Failure");}
    curl_close($curl);
    echo $result;
}

function getAccessToken($appID, $appSecret) {

    $curl = curl_init();
    $auth_data = array(
        'client_id' 		=> $appID,
        'client_secret' 	=> $appSecret,
        'grant_type' 		=> 'client_credentials'
    );

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $auth_data);
    curl_setopt($curl, CURLOPT_URL, 'https://graph.facebook.com/oauth/access_token');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

    $result = curl_exec($curl);
    if(!$result){die("Connection Failure");}
    curl_close($curl);
    return  json_decode($result, true) ;
}


if($result){
    ?>
    <SCRIPT LANGUAGE="JavaScript">
        <!--
        alert('등록이 정상적으로 완료 되었습니다.');
        //parent.location.href =  "member_list.php?<?=$total_param?>";
        parent.location.href =  "../ham_list/?bmenu=2&smenu=1";
        //-->
    </SCRIPT>
<?}else{?>
    <SCRIPT LANGUAGE="JavaScript">
        <!--
        alert('등록중 오류가 발생했습니다.');
        //-->
    </SCRIPT>
<?}



?>