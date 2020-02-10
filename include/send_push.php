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
                'badge' => 1,
                'content-available' => 1
            ),
        );
    }


    $headers = array(
        'Authorization:key=AAAAeNMm6Do:APA91bHh-rv9gqcaY8YWHRa8rhm91GXK4eMLa8Si9VqgWvmCeMj7AW5N_E8FTR9kizkiE1DLoCdj9ViC-1lypxmVkA9273jCs1ZmQyuUUAkGCFKpy2j7-dpr4CHmTUpE3W7W2XTILPdTiSrkrr6llgKIbmm4qSdKdw',
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
                'badge' => 1,
                'content-available' => 1
            ),
        );
    }


    $headers = array(
        'Authorization:key=AAAAeNMm6Do:APA91bHh-rv9gqcaY8YWHRa8rhm91GXK4eMLa8Si9VqgWvmCeMj7AW5N_E8FTR9kizkiE1DLoCdj9ViC-1lypxmVkA9273jCs1ZmQyuUUAkGCFKpy2j7-dpr4CHmTUpE3W7W2XTILPdTiSrkrr6llgKIbmm4qSdKdw',
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

//send_notification("first_class");

?>