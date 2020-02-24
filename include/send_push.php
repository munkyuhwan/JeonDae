<?

function send_notification ($topic, $msg, $category)
{
    $message=array(
        'notification' => array (
            "body" => "body",
            "title" => "Title",
        )
    );

    $url = 'https://fcm.googleapis.com/fcm/send';
    if ($topic == SUBSCRIBE_IOS) {
        $fields = array(
            "time_to_live" => 60,
            "content_available" => true,
            "priority" => "high",
            "to" => "/topics/" . $topic,
            "notification" => array(
                "body" => $msg,
                "category" => $category,
                "title" => "전대전",
                "sound" => "default",
            ),
        );
    }else {
        $fields = array(
            "time_to_live" => 60,
            "content_available" => true,
            "priority" => "high",
            "to" => "/topics/" . $topic,
            "data" => array(
                "body" => $msg,
                "category" => $category,
                "title" => "전대전",
                "sound" => "default",
                'content-available' => 1
            ),
        );
    }


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
    curl_close($ch);
    return $result;
}


function send_notification_individual ($topic, $msg, $category, $fcmToken)
{
    $message=array(
        'notification' => array (
            "body" => "body",
            "title" => "Title",
        )
    );

    $fcmData = explode("://",$fcmToken);

    $device = $fcmData[0];
    $fcmToken = $fcmData[1];

    $url = 'https://fcm.googleapis.com/fcm/send';
    if ($device == "app_ios") {
        $fields = array(
            "time_to_live" => 60,
            "content_available" => true,
            "priority" => "high",
            "to" => $fcmToken,
            "notification" => array(
                "body" => $msg,
                "category" => $category,
                "title" => "전대전",
                "sound" => "default",
            ),
        );
    }else {
        $fields = array(
            "time_to_live" => 60,
            "content_available" => true,
            "priority" => "high",
            "to" => $fcmToken,
            "data" => array(
                "body" => $msg,
                "category" => $category,
                "title" => "전대전",
                "sound" => "default",
                'content-available' => 1
            ),
        );
    }


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
    curl_close($ch);

    return $result;
}
//send_notification_individual ("", "test", "cat", "android://fW6mf_h6JJA:APA91bHSsEcwvchlVrIGQS1Af2S5ABlPsT6QIdCJ2PD5kPk6Myk9p8QGZfKB5yyHI1rBlLwwAA9eAVbsFDjuRa_2Pq-CPqIrwaQElwOTNnv88aiuldjd9Lr_LjNYvQQ2Xa7RUFmI3sCE")
//send_notification("first_class");

?>