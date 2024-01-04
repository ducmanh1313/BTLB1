<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['username'])) {
  // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
  header('Location: login.php');
  exit();
}
?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Làm bài thi trắc nghiệm</title>
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/index.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <!-- Các script khác -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>

  <div id="header">
      <ul id="left-nav">
        <li><a href="index.php">Làm bài thi</a></li>
        

      </ul>
      <ul id="right-nav">
       <li><a href="contact.php">Liên hệ</a></li>
       <li><a href="session.php">Đăng xuất</a></li>
      </ul>
  </div>

  <div class="container">
    <div class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-body">
            <form id="examForm" action="" method="post">
                <div class="row">
                    <div class="col-sm-12 text-center welcome-section">
                        <h3>Chào mừng bạn đến với bài thi!</h3>
                        <p>Nhấn nút "Bắt đầu" để bắt đầu làm bài kiểm tra.</p>                   
                        <button type="button" name="button" class="btn btn-success" id="btnStart">Làm ngay</button>
                    </div>
                <div id="questions"></div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                    <div><span id="display" style="color:#FF0000;font-size:15px"></span></div>
                    <div><span id="submitted" style="color:#FF0000;font-size:15px"></span></div>
                        <button type="button" class="btn btn-warning" id="btnFinish">Kết thúc bài thi</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h4 id='mark' class="text-info"></h4>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


  

  </div>
</body>
</html>

<script type="text/javascript">
  var countdownInterval; // Global variable for the interval
var timeDuration = 10;
 function startCountdown(duration, display) {
    var timer = duration, minutes, seconds;
    var countdownInterval = setInterval(function () {
      minutes = parseInt(timer / 60, 10);
      seconds = parseInt(timer % 60, 10);

      minutes = (minutes < 10) ? "0" + minutes : minutes;
      seconds = (seconds < 10) ? "0" + seconds : seconds;
      display.html("<b>" + minutes + "m : " + seconds + "s" + "</b>");
      
      if (timer <= 0) {
        clearInterval(countdownInterval);
        finishExam();
      } else {
        timer--;
      }
    }, 1000);
  }

  function finishExam() {
    $('#submitted').text("Hết giờ!");
    clearInterval(countdownInterval);
    $('#btnFinish').hide(); // Ẩn nút hoàn thành nếu muốn
    $('#btnFinish').trigger('click'); // Mô phỏng sự kiện click của nút "Kết thúc bài thi"
}


$(document).ready(function(){
  $('#btnFinish').hide();
 
});
var questions;//biến toàn cục để lưu danh sách câu hỏi
$('#btnStart').click(function(){
  GetQuestions();
  $('#btnFinish').show();
  $(this).hide();
   $('.welcome-section').hide();
   startCountdown(timeDuration, $('#display'));
});

$('#btnFinish').click(function(){
  $(this).hide();
  $('#btnStart').show();
  CheckResult();
  finishExam();
});

function CheckResult(){
  let mark = 0;
  $('#questions div.row').each(function(k,v){
    //bước 1: lấy đáp án đúng của câu hỏi
    let id = $(v).find('h5').attr('id');
    let question = questions.find(x=>x.id == id);//tìm câu hỏi trong mảng questions dựa vào id đã có ở trên
    let answer = question['answer'];//lấy đáp án đúng của câu hỏi


    //bước 2: lấy đáp án của người dùng ~ thằng radio được check
    let choice = $(v).find('fieldset input[type="radio"]:checked').attr('class');

    if(choice == answer){
      mark +=2;//mỗi câu đúng được cộng 2 điểm
    }else{
        console.log('Câu có id: '+id+' sai');
    }

    //bước 3: đánh dấu đáp án đúng để người dùng đối chiếu

    $('#question_'+id+' > fieldset > div > label.'+answer).css("background-color", "yellow");

  });

  $('#mark').text('Điểm của bạn là: '+mark);
}

function GetQuestions(){
  $.ajax({
    url:'questions.php',
    type:'get',
    success:function(data){
      questions = jQuery.parseJSON( data);
      let index = 1;
      let d = '';
      $.each(questions,function(k,v){
        d+=   '<div class="row" style = "margin-left:10px;" id="question_'+v['id']+'"> ';
        d+=   '<h5 style="font-weight:bold;" id="'+v['id']+'"> <span class="text-danger">Câu '+index+': </span>'+v['question']+'</h5>';

        d +=   '<fieldset>';
        d+=   '<div class="radio col-md-12 ">';
        d+=    '<label class = "A"><input type="radio" class="A" name = "'+v['id']+'"><span class="text-danger">A: </span>'+v['option_a']+'</label>';
        d+=   '</div>';

        d+=  ' <div class="radio col-md-12">';
        d+=     '<label class = "B"><input type="radio" class="B" name = "'+v['id']+'"><span class="text-danger">B: </span>'+v['option_b']+'</label>';
        d+=   '</div>';

        d+=   '<div class="radio  col-md-12">';
        d+=     '<label class = "C"><input type="radio"  class="C" name = "'+v['id']+'"><span class="text-danger">C: </span>'+v['option_c']+'</label>';
        d+=   '</div>';

        d+=   '<div class="radio col-md-12">';
        d+=     '<label class = "D"><input type="radio" class="D" name = "'+v['id']+'"><span class="text-danger">D: </span>'+v['option_d']+'</label>';
        d+=   '</div>';
        d+=  '</fieldset>';
        d+= '</div>';
        index++;
      });
      $('#questions').html(d);
      
    }
  });
}

</script>