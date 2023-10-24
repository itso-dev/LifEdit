<?php
$mail_from = "ojh0906@naver.com";          // 보내는 사람 메일주소 omt180103@gmail.com
$mailto="ojh0906@naver.com";
$subject="[도담철거] 새로운 문의가 등록되었습니다.";

$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=utf-8';


$message = '<html><body> 
                <strong style="font-size:30px;">비대면 철거 견적 신청</strong>
           
            </body></html>';



$result=mail($mailto, $subject, $message, implode("\r\n", $headers));



?>
