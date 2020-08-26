<?php
  $trans_text = $_POST['trans_text'];
  $client_id = "RcKPF2BUAvlCqCNPXBTZ";
  $client_secret = "5Slb0z5rRT";
  $encText = urlencode($trans_text);
  $postvars = "source=ko&target=en&text=".$encText;
  $url = "https://openapi.naver.com/v1/papago/n2mt";
  $is_post = true;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);
  $headers = array();
  $headers[] = "X-Naver-Client-Id: ".$client_id;
  $headers[] = "X-Naver-Client-Secret: ".$client_secret;
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  $deco = json_decode($response,false);

  curl_close ($ch);
  if($status_code == 200) {
    print_r($deco->message->result->translatedText);

  } else {
    echo "Error 내용:".$response;
  }
?>
