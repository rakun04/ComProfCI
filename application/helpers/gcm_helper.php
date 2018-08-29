<?php

function gcm($msg) {

  $fields = array
  (
    'to'  => '/topics/cnb',
    'notification' => $msg
  );

/*
  POST https://your-namespace.servicebus.windows.net/your-event-hub/messages?timeout=60&api-version=2014-01 HTTP/1.1
  Authorization: SharedAccessSignature sr=your-namespace.servicebus.windows.net&sig=your-sas-key&se=1403736877&skn=RootManageSharedAccessKey
  Content-Type: application/atom+xml;type=entry;charset=utf-8
  Host: your-namespace.servicebus.windows.net

  { "DeviceId":"dev-01", "Temperature":"37.0" }

*/

  $headers = array(
  'Authorization: key=AAAA7QRPgb8:APA91bG93AsUDCC5ABF2iei-gzGZ23e1-9Q9pZin2NH6HY6NLvb2R7xYiTJKpdJj9rByxj0p3HQGJIUbpuNJxTuvIaVLHytXAqQGFpdSQ7z_vHrgy0VRoqg9GSy5HnbSylnQkFTzYScJ', // FIREBASE_API_KEY_FOR_ANDROID_NOTIFICATION
  'Content-Type: application/json'
  );
  // Open connection
  $ch = curl_init();
  // Set the url, number of POST vars, POST data
  curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
  curl_setopt( $ch,CURLOPT_POST, true );
  curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
  curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
  // Disabling SSL Certificate support temporarly
  curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
  curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
  // Execute post
  $result = curl_exec($ch );
  if($result === false){
  die('Curl failed:' .curl_errno($ch));
  }
  // Close connection
  curl_close( $ch );
  return $result;

}

?>
