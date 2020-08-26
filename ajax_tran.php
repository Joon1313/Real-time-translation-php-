<?php
$trans_text = $_POST['trans_text'];
$trans_lang = $_POST['trans_lang'];

  $client_id = "RcKPF2BUAvlCqCNPXBTZ";
  $client_secret = "5Slb0z5rRT";
   $encQuery = urlencode($trans_text);
   $postvars = "query=".$encQuery;
   $url = "https://openapi.naver.com/v1/papago/detectLangs";
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
   curl_close ($ch);

   $lang = json_decode($response,false);

  $encText = urlencode($trans_text);
  $postvars = "source=".$lang->langCode."&target=".$trans_lang."&text=".$encText;
  $url = "https://openapi.naver.com/v1/papago/n2mt";
  $is_post = true;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);
  curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, 0);
  $headers = array();
  $headers[] = "X-Naver-Client-Id: ".$client_id;
  $headers[] = "X-Naver-Client-Secret: ".$client_secret;
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close ($ch);
  if($status_code == 200) {
    //$result = json_decode($response,false);
    //print_r($result->message->result->translatedText);
    print_r ($response);
  }


/*
  $url = "https://www.dhlottery.co.kr/common.do?method=main";

  $curl = curl_init();

  curl_setopt($curl, CURLOPT_URL, $url);

  curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

  curl_setopt($curl, CURLOPT_CONNECTTIMEOUT,5);

  curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);

  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);

  $txt = curl_exec ($curl);
  $test = '45';
  preg_match("/(^[1-9]{1}$|^[1-4]{1}[0-9]{1}$|^50$)/m", $test, $match_01);
  echo $match_01[0];
*/
  ?>
