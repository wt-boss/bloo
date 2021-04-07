<?php

if (!function_exists('str_convert_line_breaks')) {
    function str_convert_line_breaks($string = '', $as_html = true) {
        if (empty($string)) {
            return $string;
        }

        $replace_string = ($as_html) ? "<br>" : PHP_EOL;
        $formatted_string = preg_replace("/\r\n|\r|\n/", $replace_string, $string);
        return ($as_html) ? clean($formatted_string) : $formatted_string;
    }
}

if (!function_exists('get_form_templates')) {
    function get_form_templates($alias = null, $keys = null)
    {
        $templates = collect(trans('form'));

        if ($alias) {
            $templates = $templates->where('alias', $alias);
        }

        if (!$templates->count()) {
            return null;
        }

        if ($keys) {
            $flattened = $templates->mapWithKeys(function ($item) use ($keys) {
                $keys = (array)$keys;
                $values = [];
                foreach ($keys as $key) {
                    if (isset($item[$key])) {
                        $values[$key] = $item[$key];
                    }
                }
                return [$item['alias'] => $values];
            });

            return ($alias) ? $flattened->first() : $flattened->all();
        }

        return ($alias) ? $templates->first() : $templates;
    }
}


function send_notification_FCM($notification_id, $title, $message, $id,$type) {

    //$accesstoken = env('FCM_KEY');

    $accesstoken = 'AAAA1qrIg38:APA91bFJsMtflr5Ln7supYPRGljjRpbfZ0UytkJA3qE_7sBoAwijjx2RMRhRopXH31NjDn6g0lTbe9rl2i8XgTvtFfbGRaymuRnSRsS36bu_WF0ywqmusO6CuLCMHRPlSI2A0kWEYWId';
    $URL = 'https://fcm.googleapis.com/fcm/send';

    $post_data = '{
            "to" : "' . $notification_id . '",
            "data" : {
              "body" : "",
              "title" : "' . $title . '",git 
              "type" : "' . $type . '",
              "id" : "' . $id . '",
              "message" : "' . $message . '",
            },
            "notification" : {
                 "body" : "' . $message . '",
                 "title" : "' . $title . '",
                  "type" : "' . $type . '",
                 "id" : "' . $id . '",
                 "message" : "' . $message . '",
                "icon" : "new",
                "sound" : "default"
                },

          }';
    //print_r($post_data);die;

    // Set POST variables
    $url = 'https://fcm.googleapis.com/fcm/send';

    $headers = array(
        'Authorization: key=' . $accesstoken,
        'Content-Type: application/json'
    );

    //print_r($headers);die();
    // Open connection
    $ch = curl_init();

    // Set the url, number of POST vars, POST data
    curl_setopt( $ch, CURLOPT_URL, $url );

    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

    // Disabling SSL Certificate support temporarly
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );

    curl_setopt( $ch, CURLOPT_POSTFIELDS,  $post_data  );

    // Execute post
    $result = curl_exec( $ch );

    //print_r($result);die();

    if ($result === false) {
        // throw new Exception('Curl error: ' . curl_error($crl));
        //print_r('Curl error: ' . curl_error($crl));
        $result_noti = 0;
    } else {

        $result_noti = 1;
    }

   // Close connection
    curl_close( $ch );
    return $result_noti;

}
