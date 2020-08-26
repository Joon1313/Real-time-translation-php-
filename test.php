<!DOCTYPE html>
<html lang="ko" dir="ltr">
<style media="screen">
  .flex_box{display: flex;justify-content:center;margin-top: 50px;}
  .left{text-align: center;margin-right:50px; }
  .right{text-align: center;margin-left: 50px;}
</style>
  <head>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form id="accel_form">
<div class="flex_box">
  <div class="left">
    <div>
      번역할 언어
    </div>
    <div>
      <textarea name="trans_text" rows="8" cols="80"></textarea>
    </div>
    <div>
      <button type="button" name="button" onClick="trans()">번역하기</button>
    </div>
  </div>
  <div class="right">
    <div class="">
      번역된 언어
    </div>
    <div>
      <textarea rows="8" cols="80" id="result_string" readonly></textarea>
    </div>
  </div>
</div>
</form>
<script>
  function trans(){
    const data = $("#accel_form").serialize();
    $.ajax({
     type:"POST",
     url:"/ajax_test.php",
     data:data,
     success:function(args){
       $("#result_string").html(args);
     },
     error:function(e){
       alert(e.responseText);
     }
   });
  }
</script>
  </body>
</html>
