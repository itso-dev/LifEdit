<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



function email_send($email){

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);
    $body = "내용 안녕하세요.반갑습니다. 좋은하루 되세요.";

    $mail->IsSMTP();
    $mail->SMTPAuth   = true;
    $mail->Port       = 25;

    $mail->Host = "smtp.gmail.com";
    $mail->Username   = "ojh0906@gmail.com";    // 계정
    $mail->Password   = "mzac zpss aczh fjrw";            // 패스워드
    $mail->SetFrom('ojh0906@gmail.com', '테스트'); // 보내는 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
    $mail->AddAddress($email); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
    $mail->Subject = '제목';        // 메일 제목
    $mail->MsgHTML($body);    // 메일 내용 (HTML 형식도 되고 그냥 일반 텍스트도 사용 가능함)
    $mail->Send();
}
email_send("ojh0906@gmail.com");
?>
