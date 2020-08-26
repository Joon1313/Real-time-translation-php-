<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>번역기</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
  </head>

  <style media="screen">
    .all_wrap{max-width: 1300px;margin: 0 auto;}
    header {text-align: center;}
    .flex_box{display: flex;justify-content: space-around;width: 100%;}
    .text_box{height: 120px;border: 1px solid rgb(169, 169, 169);padding: 10px 10px;width: 84%;resize: none;border-bottom: none;padding-right: 30px;}

    .result_btn{float: right;margin-bottom: 10px;margin-top: 10px;}
    .left_box{position: relative;display: flex;flex-direction: column;width: 50%;text-align: center;align-items: center;}
    .right_box{display: flex;flex-direction: column;width: 50%;text-align: center;position: relative;align-items: center;}
    .input_title{
      border:1px solid gray;width:84%;;padding: 10px 10px;border-bottom:none;border-radius: 5px 5px 0px 0px / 5px 5px 0px 0px;border-color:rgb(169 169 169);text-decoration: none;color:black;
      padding-right: 30px;font-family: 'jua';font-size: 18px;
    }
    .arrow{
      width: 0px ;height: 10px ; border-left: 5px solid transparent;border-right: 5px solid transparent; border-top: 5px solid gray;vertical-align: bottom;position: absolute;top:20px;
    }
    .input_btm{border: 1px solid rgb(169 169 169);width: 84%;padding: 0 10px; border-radius: 0px 0px 5px 5px / 0px 0px 5px 5px;border-top: none;height: 45px;padding-right: 30px;}
    .x_btn{position: absolute;top:50px;right: 40px;font-size: 20px;font-family: 'jua';cursor: pointer;display: absolute;color:#a09797;display: none;}
    h1 {font-family: 'jua';font-weight: 500;}
    #copy_btn{width:28px;height: 28px;color:gray;}
    #copy_btn:hover{color:black;}
    #voice_btn{width:28px;height: 28px;color:gray;}
    #voice_btn:hover{color:black;}
    #btn1{float:left;width:48px;height:48px;padding-top:5px;cursor: pointer;display: none;}
    #btn2{float:left;width:48px;height:48px;padding-top:5px;cursor: pointer;display: none;}
    #btn3{float:left;width:48px;height:48px;padding-top:5px;cursor: pointer;display: none;}
    #btn4{float:left;width:48px;height:48px;padding-top:5px;cursor: pointer;display: none;}
    #toast {
        position: fixed;
        bottom: 40%;
        left: 50%;
        padding: 25px 50px;
        transform: translate(-50%, 10px);
        border-radius: 30px;
        overflow: hidden;
        font-size: 20px;
        opacity: 0;
        visibility: hidden;
        transition: opacity .5s, visibility .5s, transform .5s;
        background: rgba(33, 105, 214, 0.74);
        color: #fff;
        z-index: 10000;
        font-family: 'jua';
    }

    #toast.reveal {
        opacity: 1;
        visibility: visible;
        transform: translate(-50%, 0)
    }
    #lang_select{
      display: none;
      position: absolute;
      border: 1px solid rgb(169, 169, 169);
      background: #fff;
      top:42px;
      width: 84%;
      padding: 0px 20px;
      padding-bottom: 10px;
      text-align: center;

    }
    .lang_list:hover{color:#0a67f3;}
    .lang_list {width: 33.3%;list-style:none;float: left;height: 28px;cursor: pointer;font-family: 'jua';font-weight: 200;font-size: 18px;}
    #lang_select>ul{text-decoration: none;}
    .on {color:#0a67f3;}
    @media screen and (max-width:768px){
      .flex_box{flex-direction: column;}
      .left_box{width: 100%;margin-bottom: 10px;}
      .right_box{width: 100%}
      .lang_select{text-align: left;}
      .lang_list{height: 20px;font-size: 17px;}
    }

  </style>

  <body>
    <!-- 토스트 메세지 -->
    <div id="toast"></div>
    <header>
      <h1><a href="http://wkdrud1313.dothome.co.kr/" style="text-decoration: none;color:black">장경준 토이프로젝트 (번역기)<a></h1>
      </header>
    <form id="accel_form">
    <div class="all_wrap">
      <div class="flex_box">
        <div class="left_box">
            <a class="input_title" href="#" id="lang_change">언어감지&nbsp;</a>
            <textarea id="input_data" class="text_box" name="trans_text"   placeholder="번역할 내용을 입력해주세요" onkeyup="key_up();" maxlength="500"></textarea>
              <span class="x_btn" id="clear_btn" onclick="input_clear();">X</span>
            <div class="input_btm">
              <div id="btn1" onclick="copys('복사되었습니다');">
                <i class="far fa-copy" id="copy_btn"></i>
              </div>
              <div id="btn2">
                <i class="fas fa-volume-up" id="voice_btn"></i>
              </div>

              <div style="float:right; display:inline-block;">
                <p><span id="lengths">0</span> / 500</p>
              </div>
          </div>
        </div>
          <div class="right_box">
            <input type="hidden" name="trans_lang" value="en" id="hidden_lang" >
            <a class="input_title" href="#" onclick="result_lang();" id="lang_control">영어&nbsp;<span class="arrow"></span></a>
            <div id="lang_select">
              <ul>
                <li class="lang_list" onclick="tester('한국어');">한국어</li>
                <li class="lang_list on" onclick="tester('영어');">영어</li>
                <li class="lang_list" onclick="tester('일본어');">일본어</li>
                <li class="lang_list" onclick="tester('중국어(간체)');">중국어(간체)</li>
                <li class="lang_list" onclick="tester('중국어(번체)');">중국어(번체)</li>
                <li class="lang_list" onclick="tester('스페인어');">스페인어</li>
                <li class="lang_list" onclick="tester('프랑스어');">프랑스어</li>
                <li class="lang_list" onclick="tester('독일어');">독일어</li>
                <li class="lang_list" onclick="tester('러시아어');">러시아어</li>
                <li class="lang_list" onclick="tester('이탈리아어');">이탈리아어</li>
                <li class="lang_list" onclick="tester('베트남어');">베트남어</li>
                <li class="lang_list" onclick="tester('태국어');">태국어</li>
                <li class="lang_list" onclick="tester('인도네시아어');">인도네시아어</li>
              </ul>
            </div>
            <textarea id="result1" class="text_box" name="name" rows="8" cols="80" readonly placeholder="네이버 papago MNT 번역"></textarea>
            <div class="input_btm">
              <div id="btn3" onclick="copys2('복사되었습니다.');">
                <i class="far fa-copy" id="copy_btn"></i>
              </div>
              <div id="btn4">
                <i class="fas fa-volume-up" id="voice_btn"></i>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </body>

<script type="text/javascript">

let removeToast;

function key_up(){
  const show_x = document.getElementById('clear_btn');
  const str_length = document.getElementById('input_data').value.length;
  const data = $("#accel_form").serialize();
    /* AJAX 비동기 통신 */
   $.ajax({
    type:"POST",
    url:"/ajax_tran.php",
    data:data,
    dataType:"json",
    success:function(args){
      const arg1 = args.message.result.translatedText;
      const arg2 = args.message.result.srcLangType;

      if ( arg2 == 'ko'){
        $("#lang_change").html('언어감지(한국어)');
      }

      else if (arg2 == 'en'){
        $("#lang_change").html('언어감지(영어)');
      }
      $("#result1").html(arg1);

    },
    error:function(){
      $("#lang_change").html('언어감지');
      document.getElementById('result1').innerHTML="";
    }
  });

  /* 글자 길이를 구하는 코드 */
  document.getElementById('lengths').innerHTML=str_length;

  /* 글자가 있을시 보임 */
  if(str_length > 0){
    document.getElementById('clear_btn').style.display='block';
    document.getElementById('btn1').style.display='inline-block';
    document.getElementById('btn3').style.display='inline-block';

  }
  else{
    document.getElementById('clear_btn').style.display='none';
    document.getElementById('btn1').style.display='none';
    document.getElementById('btn2').style.display='none';
    document.getElementById('btn3').style.display='none';
    document.getElementById('btn4').style.display='none';
  }
};


/* X버튼  */
function input_clear(){
  document.getElementById('input_data').value=null;
  document.getElementById('result1').innerHTML="";
  document.getElementById('lengths').innerHTML="0";
  document.getElementById('clear_btn').style.display='none';
}
/* 언어 변경 토글 */
function result_lang(){
  $('#lang_select').toggle();
}

/* 언어 변경 */
const lang_list = document.getElementsByClassName('lang_list');
function tester(arg){
  if(arg == '한국어'){
    document.getElementById('lang_control').innerHTML="한국어&nbsp;<span class='arrow'></span>";
    document.getElementById('hidden_lang').value="ko";
    for (var i = 0; i < lang_list.length; i++) {
      lang_list[i].classList.remove('on');
    }
    lang_list[0].classList.add('on');
  }
  if(arg == '영어'){
    document.getElementById('lang_control').innerHTML="영어&nbsp;<span class='arrow'></span>";
    document.getElementById('hidden_lang').value="en";
    for (var i = 0; i < lang_list.length; i++) {
      lang_list[i].classList.remove('on');
    }
    lang_list[1].classList.add('on');
  }
  if(arg == '일본어'){
    document.getElementById('lang_control').innerHTML="일본어&nbsp;<span class='arrow'></span>";
    document.getElementById('hidden_lang').value="ja";
    for (var i = 0; i < lang_list.length; i++) {
      lang_list[i].classList.remove('on');
    }
    lang_list[2].classList.add('on');
  }
  if(arg == '중국어(간체)'){
    document.getElementById('lang_control').innerHTML="중국어(간체)&nbsp;<span class='arrow'></span>";
    document.getElementById('hidden_lang').value="zh-CN";
    for (var i = 0; i < lang_list.length; i++) {
      lang_list[i].classList.remove('on');
    }
    lang_list[3].classList.add('on');
  }
  if(arg == '중국어(번체)'){
    document.getElementById('lang_control').innerHTML="중국어(번체)&nbsp;<span class='arrow'></span>";
    document.getElementById('hidden_lang').value="zh-TW";
    for (var i = 0; i < lang_list.length; i++) {
      lang_list[i].classList.remove('on');
    }
    lang_list[4].classList.add('on');
  }
  if(arg == '스페인어'){
    document.getElementById('lang_control').innerHTML="스페인어&nbsp;<span class='arrow'></span>";
    document.getElementById('hidden_lang').value="es";
    for (var i = 0; i < lang_list.length; i++) {
      lang_list[i].classList.remove('on');
    }
    lang_list[5].classList.add('on');
  }
  if(arg == '프랑스어'){
    document.getElementById('lang_control').innerHTML="프랑스어&nbsp;<span class='arrow'></span>";
    document.getElementById('hidden_lang').value="fr";
    for (var i = 0; i < lang_list.length; i++) {
      lang_list[i].classList.remove('on');
    }
    lang_list[6].classList.add('on');
  }
  if(arg == '독일어'){
    document.getElementById('lang_control').innerHTML="독일어&nbsp;<span class='arrow'></span>";
    document.getElementById('hidden_lang').value="de";
    for (var i = 0; i < lang_list.length; i++) {
      lang_list[i].classList.remove('on');
    }
    lang_list[7].classList.add('on');
  }

  if(arg == '러시아어'){
    document.getElementById('lang_control').innerHTML="러시아어&nbsp;<span class='arrow'></span>";
    document.getElementById('hidden_lang').value="ru";
    for (var i = 0; i < lang_list.length; i++) {
      lang_list[i].classList.remove('on');
    }
    lang_list[8].classList.add('on');
  }
  if(arg == '이탈리아어'){
    document.getElementById('lang_control').innerHTML="이탈리아어&nbsp;<span class='arrow'></span>";
    document.getElementById('hidden_lang').value="it";
    for (var i = 0; i < lang_list.length; i++) {
      lang_list[i].classList.remove('on');
    }
    lang_list[9].classList.add('on');
  }
  if(arg == '베트남어'){
    document.getElementById('lang_control').innerHTML="베트남어&nbsp;<span class='arrow'></span>";
    document.getElementById('hidden_lang').value="vi";
    for (var i = 0; i < lang_list.length; i++) {
      lang_list[i].classList.remove('on');
    }
    lang_list[10].classList.add('on');
  }
  if(arg == '태국어'){
    document.getElementById('lang_control').innerHTML="태국어&nbsp;<span class='arrow'></span>";
    document.getElementById('hidden_lang').value="th";
    for (var i = 0; i < lang_list.length; i++) {
      lang_list[i].classList.remove('on');
    }
    lang_list[11].classList.add('on');
  }
  if(arg == '인도네시아어'){
    document.getElementById('lang_control').innerHTML="인도네시아어&nbsp;<span class='arrow'></span>";
    document.getElementById('hidden_lang').value="id";
    for (var i = 0; i < lang_list.length; i++) {
      lang_list[i].classList.remove('on');
    }
    lang_list[12].classList.add('on');
  }
  $('#lang_select').hide();
  key_up();
}

  /* 복사 버튼 */
  function copys(string){
    document.getElementById('input_data').select();
    document.execCommand("Copy");
    const toast = document.getElementById("toast");

    toast.classList.contains("reveal") ?
        (clearTimeout(removeToast), removeToast = setTimeout(function () {
            document.getElementById("toast").classList.remove("reveal")
        }, 1000)) :
        removeToast = setTimeout(function () {
            document.getElementById("toast").classList.remove("reveal")
        }, 1600)
    toast.classList.add("reveal"),
        toast.innerText = string
  }

  /* 복사 버튼 */
  function copys2(string){
    document.getElementById('result1').select();
    document.execCommand("Copy");
    const toast = document.getElementById("toast");

    toast.classList.contains("reveal") ?
        (clearTimeout(removeToast), removeToast = setTimeout(function () {
            document.getElementById("toast").classList.remove("reveal")
        }, 1000)) :
        removeToast = setTimeout(function () {
            document.getElementById("toast").classList.remove("reveal")
        }, 1600)
    toast.classList.add("reveal"),
        toast.innerText = string
  }



</script>


</html>
