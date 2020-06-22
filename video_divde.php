<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    // 세션 받아는 부분
    session_start();
    $_SESSION['file_info'];
    Print_r($_SESSION);

    // 동영상의 확장자에 자름에 대한 변수 생성
    $vido_name_cut = substr($_SESSION['file_info']['userfile']['name'],0,-4);

    // $frame_mk = mkdir("/var/www/html/SmartFashion/video_frame/".substr($_SESSION['file_info']['userfile']['name'],0,-4),777,true);
    //     if($frame_mk)
    //       {
    //         echo "프레임 저장 폴더 생성 성공";
    //       }
    //     else
    //        {
    //         echo "실패";
    //        }

    echo $vido_name_cut;
        echo "<br/>\n";
    //세션을 받아온 동영상의 이름 정보 변수 생성
    $vido_name = $_SESSION['file_info']['userfile']['name'];
    echo $vido_name;
        echo "<br/>\n";
    // 원하는 프레임 수
    $frames_num = $_POST["frame_input"];
    echo $frames_num;

    echo "<br/>\n";
    Print_r($_SESSION['flie_info']['userfile']['name']);

    // echo $frames_num;
    //전체 프레임수에서 원하는 프레임 수 만큼 받아와서 쎔네일 만드는것을 해야함
        $cmd_div_frame_img = "ffmpeg -i /var/www/html/SmartFashion/video_file/".$vido_name." -an -ss 00:00:00 -qscale 1 -r $frames_num -y /var/www/html/SmartFashion/video_frame/".$vido_name_cut."/".$vido_name_cut."_%05d.jpg 2>&1";
        $cmd_mk_frmae_video ="ffmpeg -f image2 -r  $frames_num -i /var/www/html/SmartFashion/video_frame/".$vido_name_cut."/".$vido_name_cut."_%05d.jpg -vcodec libx264 /var/www/html/SmartFashion/video_file/change_fps_video/".$frames_num."_fps_".$vido_name." 2>&1";



    echo "<br/>\n";
    echo $cmd_div_frame_img;
    echo "<br/>\n";
     //$command_string = "ls"
    exec($cmd_div_frame_img, $output_div_frame_img, $status);
    if($status)
      {
        echo $status;
        print_r($output_div_frame_img);
        echo "실패";
      }
    else
      {
        echo $status;
        print_r($output_div_frame_img);
        echo "fps 변경 성공";
      }

      echo "<br/>\n";
      echo $cmd_mk_frmae_video;
      echo "<br/>\n";

      exec($cmd_mk_frmae_video, $output_mk_frmae_video, $status);
      if($status)
        {
          echo $status;
          print_r($output_mk_frmae_video);
          echo "실패";
        }
      else
        {
          echo $status;
          print_r($output_mk_frmae_video);
          echo "fps 변경된 이미지 동영상 변경 완료";
        }
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
       <script type="text/javascript">

       </script>
   </head>
   <body>
     <h1>동영상 원본 </h1>
     <video width="400" heigh="200" src="/SmartFashion/video_file/<?=$vido_name?>" controls></video>
     <br>
     <h1><?=$frames_num?>fps 변경된 동영상 </h1>
      <video width="400" heigh="200" src="/SmartFashion/video_file/change_fps_video/<?=$frames_num."_fps_".$vido_name?>" controls></video>
      <br>

       <img width="200" heigh="100" src="/SmartFashion/video_frame/<?=$vido_name_cut?>_00001.jpg" alt="">
       <img width="200" heigh="100" src="/SmartFashion/video_frame/<?=$vido_name_cut?>_00002.jpg" alt="">
       <img width="200" heigh="100" src="/SmartFashion/video_frame/<?=substr($_SESSION['file_info']['userfile']['name'],0,-4)?>003.png" alt="">
       <img width="200" heigh="100" src="/SmartFashion/video_frame/<?=substr($_SESSION['file_info']['userfile']['name'],0,-4)?>004.png" alt="">
       <img width="200" heigh="100" src="/SmartFashion/video_frame/<?=substr($_SESSION['file_info']['userfile']['name'],0,-4)?>005.png" alt="">
       <img width="200" heigh="100" src="/SmartFashion/video_frame/<?=substr($_SESSION['file_info']['userfile']['name'],0,-4)?>006.png" alt="">
       <img width="200" heigh="100" src="/SmartFashion/video_frame/<?=substr($_SESSION['file_info']['userfile']['name'],0,-4)?>007.png" alt="">
       <img width="200" heigh="100" src="/SmartFashion/video_frame/<?=substr($_SESSION['file_info']['userfile']['name'],0,-4)?>008.png" alt="">
       <img width="200" heigh="100" src="/SmartFashion/video_frame/<?=substr($_SESSION['file_info']['userfile']['name'],0,-4)?>009.png" alt="">
       <img width="200" heigh="100" src="/SmartFashion/video_frame/<?=substr($_SESSION['file_info']['userfile']['name'],0,-4)?>010.png" alt="">
       <img width="200" heigh="100" src="/SmartFashion/video_frame/<?=substr($_SESSION['file_info']['userfile']['name'],0,-4)?>011.png" alt="">
       <img width="200" heigh="100" src="/SmartFashion/video_frame/<?=substr($_SESSION['file_info']['userfile']['name'],0,-4)?>012.png" alt="">
       <img width="200" heigh="100" src="/SmartFashion/video_frame/<?=substr($_SESSION['file_info']['userfile']['name'],0,-4)?>013.png" alt="">
       <img width="200" heigh="100" src="/SmartFashion/video_frame/<?=substr($_SESSION['file_info']['userfile']['name'],0,-4)?>014.png" alt="">
       <img width="200" heigh="100" src="/SmartFashion/video_frame/<?=substr($_SESSION['file_info']['userfile']['name'],0,-4)?>015.png" alt="">
       <img width="200" heigh="100" src="/SmartFashion/video_frame/<?=substr($_SESSION['file_info']['userfile']['name'],0,-4)?>016.png" alt="">
       <img width="200" heigh="100" src="/SmartFashion/video_frame/<?=substr($_SESSION['file_info']['userfile']['name'],0,-4)?>017.png" alt="">
       <img width="200" heigh="100" src="/SmartFashion/video_frame/<?=substr($_SESSION['file_info']['userfile']['name'],0,-4)?>018.png" alt="">
       <img width="200" heigh="100" src="/SmartFashion/video_frame/<?=substr($_SESSION['file_info']['userfile']['name'],0,-4)?>019.png" alt="">
       <img width="200" heigh="100" src="/SmartFashion/video_frame/<?=substr($_SESSION['file_info']['userfile']['name'],0,-4)?>020.png" alt="">

   </body>
 </html>
