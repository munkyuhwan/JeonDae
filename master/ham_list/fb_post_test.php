<?

function uploadToFB($accessToken, $msg, $pageID, $appSecret){

    $curl = curl_init();
    $auth_data = array(
        'message' 		=> $msg,
        'access_token' 	=> $accessToken,
        'app_secret' => $appSecret,
        'default_graph_version' => 'v2.2',
//        'grant_type' 		=> 'client_credentials'
    );
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $auth_data);
    curl_setopt($curl, CURLOPT_URL, "https://graph.facebook.com/".$pageID."/feed");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    echo "https://graph.facebook.com/".$pageID."/feed";
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

    return  $result;
}

//$accessTokenResult = json_decode(getAccessToken("966680140341971","1457e845209508747e508d3eea1efc52"));
//var_dump($accessTokenResult);
//$accessToken = $accessTokenResult->access_token;
//echo "<br><br><br><br><br>";
//echo $accessToken;
//echo "<br><br><br><br><br>";
$accessToken = "EAANvMMJgYtMBACV2N7p3oeHrKzWXOQ77E9TBXshicLv6rdc7fjuqK5ktZBCZBmqT2qZBIlGZCTRu1PcXSS2oZAn0uJpfcpZBYGPy4pMte68A2D847sV6LgZCw7gHMgwvZBxZB2E0weY5jvABYjaKdteTWbxHZAFETFLlOiVkZAUHZACZB2lcCFBDJKsZAWJMthMSsuF6dsCJLW8O8kZCgZDZD";
uploadToFB(
    //'966680140341971',
    $accessToken,
    '페이스북 포스팅 테스트',
    '708671665908569',
    '1457e845209508747e508d3eea1efc52'
);
/*
$accessToken = $accessTokenResult->access_token;
$accessToken = "EAANvMMJgYtMBAClwpThGzRZBLAiksTMpAFdM7eJ8urfTmDaD23hLURhhteheT2XVvdMFkcDeAdJLk6Xz75z1ObvbZC7NHaehpZB24ZCz1qxOXTZCZBa56yChuECmZBmnP3OKryfEgvQWrIBoWyFQy1CtQezxZCKqGMp6GZC7snRiNpKplSDEqJo8CFzUaG5pQH6IZD";

uploadToFB('966680140341971',
    $accessToken,
    '페이스북 포스팅 테스트',
    '708671665908569');
*/
?>