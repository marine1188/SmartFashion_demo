<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript">

    </script>
    <style media="screen">

    </style>
  </head>
  <body>
    <?php
      error_reporting(E_ALL);
      ini_set('display_errors', '1');



      $frame_mk = mkdir("/var/www/html/SmartFashion/video_frame/".substr( $_FILES['userfile']['name'],0,-4),0777,true);
          if($frame_mk)
            {
              echo "프레임 저장 폴더 생성 성공";
            }
          else
             {
              echo "실패";
             }


      // $_FIESE 로 받아온것에 대한 변수 선언
      $vido_name = $_FILES['userfile']['name'];

      // 세션 시작
      session_start();
      $_SESSION['file_info'] = $_FILES;


      //임시 디렉토리에 위치 하는 파일을 파일 디렉토리 지정 하기
      echo '<pre>';
       $uploaddir = '/var/www/html/SmartFashion/video_file/';

       echo  $uploaddir;
       echo '<pre>';
       echo $_FILES['userfile']['name'];
      //업로드 된 임시디렉토리에있는 것이 어디에 어느 이름으로 할것인가 //그파일의 월래이름 이 name
      $uploadfile = $uploaddir.basename($_FILES['userfile']['name']);
      echo '<pre>';
      //보안상 문제를 확인 해주는 php 함수  move_uploaded_file
        if(move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadfile))
          {
             echo "파일이 성공적으로 업로드 되었습니다\n";
          }
        else
          {
            print "파일 업로드 공격 가능성이 있습니다\n";
          }
          echo "자세한디비깅 정보입니다";

          //html 파일  post 전송을 통한 파일에 대한 정보
         print_r($_FILES);
           //동영상 파일 이름
         Print_r($_FILES['userfile']['name']);

         //서버에 저장된 동영상에 대한 정보 전체 출력 명령어
         $command_string_video_info = "ffmpeg -i /var/www/html/SmartFashion/video_file/".$vido_name." 2>&1";
          //동영상 총 시간 grep 을 통해 문자열 추출 명령어
         $command_string_video_t = "ffmpeg -i /var/www/html/SmartFashion/video_file/".$vido_name." 2>&1 | grep Duration | cut -d '' -f 4 | sed s/,//";

         //총 프래임 수 나타내는 명령어
         $command_string_video_fps_total = "ffprobe -v error -select_streams v:0 -show_entries stream=nb_frames -of default=nokey=1:noprint_wrappers=1  /var/www/html/SmartFashion/video_file/".$_FILES['userfile']['name']." 2>&1";


        // 비디오에 대한 정보의 리눅스서버 실행후 출력
         exec($command_string_video_info, $output_info, $status);
         if($status) {
           echo $status;
           print_r($output_info);
           echo "실패";
         } else {
           echo $status;
           print_r($output_info);
           echo "성공";
         }

         //비디오 총 시간에 정보 grep를 이용하여 문자열 추출 리눅스 서버 실행
         exec($command_string_video_t, $output_t, $status);
         if($status) {
           echo $status;
           print_r($output_t);
           echo "실패";
         } else {
           echo $status;
           print_r($output_t);
           echo "성공";
         }
         // 이 동영상의 전체 프레임수를 알수있다
         exec($command_string_video_fps_total, $output_fps_total, $status);
         if($status) {
           echo $status;
           print_r($output_fps_total);
           echo "실패";
         } else {
           echo $status;
           print_r($output_fps_total);
           echo "성공";
         }

         // fps, 문자열 부터 자르는 코드 () //이 동영상의 프레임 속도
        $output_fps = explode('fps,',$output_info[19]);
        echo $output_fps[1];
    ?>
    <form class="" action="video_divde.php" method="post">

      <video width="500" heigh="250" src="/SmartFashion/video_file/<?= $vido_name?>" controls></video>
      <br>
        <p>video info</p>
        <p>동영상시간:<?=print_r (substr($output_t[0],15,8))?></p>
        <p>총 프레임수 :<?=$output_fps_total[0]?></p>
        <p>초당 프레임 횟수 (fps) :<?=print_r(substr($output_fps[1],0,5))?></p>
        <p>프레임수 입력</p>
        <input type="number" id="frame_input" name="frame_input">
        <input type="submit" name="" value="프래임 분활">

    </form>
  </body>
</html>
