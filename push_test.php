<?

function send_notification ($topic)
{

    $message=array(
        'notification' => array (
            "body" => "body",
            "title" => "Title",
        )
    );


    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array(
        "time_to_live" => 60,
        "content_available" => true,
        "priority" => "high",
        "to"=> "/topics/".$topic,
        "notification" => array(
            "body" => $topic,
            "title" => "title",
            "sound" => "default",
        ),
    );

    echo json_encode($fields);

    $headers = array(
        'Authorization:key=AAAAwPRcXZk:APA91bFUySVyEJC9KayLupQHS1SVM6Jfdw3p49L3Da6cieO6_MCjkFjFIdlaSNl8s3UpAhrfbzzy7cOOhjcYdUdjw59eQKmxC9LNWub30zUkg4tYbeEHYJky_TKeB-aGjFo1tPQwkcoI',
        'Content-Type: application/json'
    );

    //echo json_encode($fields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    print_r($result);
    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
}

send_notification("incheon");

/*
$message = array("message" => $myMessage);
$message_status = send_notification($tokens, $message);
echo $message_status;
*/

function gcm_push($title, $body, $regids) {

    $headers = array(
        "Content-Type:application/json",
        "Authorization:key=AIzaSyCwdJQEeu1fmSvcUcAQteUSc7K8_XdU6Ac",
    );
    $arr = array(
        "time_to_live" => 60,
        "content_available" => true,
        "priority" => "high",
        "notification" => array(
            "body" => str_replace(array("\n", "\r", "&nbsp;"), array(" ", "", " "), strip_tags($body)),
            "title" => str_replace(array("\n", "\r", "&nbsp;"), array(" ", "", " "), strip_tags($title)),
            "sound" => "default",
        ),
        "data" => array(
            "message" => array(
                "title" => str_replace(array("\n", "\r", "&nbsp;"), array(" ", "", " "), strip_tags($title)),
                "memo" => str_replace(array("\n", "\r", "&nbsp;"), array(" ", "", " "), strip_tags($body)),
            ),
        ),
        "registration_ids" => array($regids),
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://gcm-http.googleapis.com/gcm/send");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arr));
    $response = curl_exec($ch);
    if ($response === false) {
        $info = curl_getinfo($ch);
        echo "CURL ERROR: " . var_export($info, true);
    }
    curl_close($ch);
    $fp = @fopen($_SERVER["DOCUMENT_ROOT"] . "/ionemom/m/push/log/" . date("Y-m-d") . ".log", "a");
    if ($fp) {
        @fwrite($fp, date("Y-m-d H:i:s") . " GCM: " . $response . "\n");
        @fclose($fp);
    }
    $obj = json_decode($response);

    if (empty($obj)) {
        $cnt = 0;
    } else {
        $cnt = $obj->{"success"};
    }

    //echo "발송여부 = ".$cnt."<br><br>";

    return $cnt;
}

//gcm_push("title", "body","fABk8U7Vs5c:APA91bFEjtid39JepN4QklaXc8AfN-CrfhOqkYXv8fwZalbeLFDLQpLOvmJ5icADS9RisRS8XNDc-2YyOa4U3vHFXHiHI-3fET3qlCehEPEHqbEMdKid96tIbaeF2xI1FXhvsUX51dT8");


function send_notification_individual ($topic, $msg, $category, $fcmToken)
{
    $message=array(
        'notification' => array (
            "body" => "body",
            "title" => "Title",
        )
    );
    $fields = array(
        "time_to_live" => 60,
        "content_available" => true,
        "priority" => "high",
        "registration_ids" => array($fcmToken),
        "notification" => array(
            "body" => $msg,
            "category" => $category,
            "title" => "tttt",
            "sound" => "default",
        ),
        "data" => array(
            "body" => $msg,
            "category" => $category,
            "title" => "test",
            "sound" => "default",
            'badge' => 1,
            'link' => "https://jobbridge.kr/en/about/01.php",
            'content-available' => 1,
            'show_in_foreground'=> true,
            'show_in_backround'=> true,
        ),
    );
    $url = 'https://fcm.googleapis.com/fcm/send';
    /*$fields = array(
        "time_to_live" => 60,
        "content_available" => true,
        "priority" => "high",
        "registration_ids" => array($fcmToken),
        "data" => array(
            "body" => $msg,
            "category" => $category,
            "title" => "test",
            "sound" => "default",
            'badge' => 1,
            'link' => "https://jobbridge.kr/en/about/01.php",
            'content-available' => 1,
            'show_in_foreground'=> true,
            'show_in_backround'=> true,
             ),

    );*/


    $headers = array(
        'Authorization:key=AAAAPS9SAHM:APA91bFGiFsCGESdnVUSzhupTbw3nwlFKkEsft1jQ5q_QI61acrvlmi1XEGyfik6z5O33wPd4MG6yXognACOm_IxgbG2UkMfhI-clfxk-KB3UBJeNWjlZ7UpgL2kD8YaePdB7lVbqNJh',
        'Content-Type: application/json'
    );

    //echo json_encode($fields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);

    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    print_r($result);
    curl_close($ch);
    return $result;
}

//send_notification("first_class");
//send_notification_individual("","test","test","fW6mf_h6JJA:APA91bHSsEcwvchlVrIGQS1Af2S5ABlPsT6QIdCJ2PD5kPk6Myk9p8QGZfKB5yyHI1rBlLwwAA9eAVbsFDjuRa_2Pq-CPqIrwaQElwOTNnv88aiuldjd9Lr_LjNYvQQ2Xa7RUFmI3sCE");

?>