<?php

$email = $_POST['email'];
$num = $_POST['num'];


$mail_from = "lifedit_@naver.com";          // 보내는 사람 메일주소\
$mailto = "$email";
$subject = "=?UTF-8?B?".base64_encode("[라이프에디트] 회원가입 인증 번호")."?=";
$headers = "From: 라이프에디트<$mail_from>\n";
$headers .= "X-Sender: <$mail_from>\n";
$headers .= "X-Mailer: PHP ".phpversion()."\n";
$headers .= "Return-Path: <...>\n";
$headers .= "Content-Type:text/html;charset=utf-8; ";



// Additional headers


$message = '<html><body>
                   <div style="width: 500px; margin: 0 auto; text-align: left;">
                        <p style="font-size: 25px; color:#3EB86F; font-weight: 600; margin-bottom: 30px; text-align: center;">라이프에디트</p>
                        <p style="font-size: 20px; margin-bottom: 30px;"><strong style="color:#3EB86F;">회원가입 인증</strong> 안내입니다.</p>
                        <p style="font-size: 16px; margin-bottom: 40px;">
                            안녕하세요.<br>
                            라이프에디트를 이용해 주셔서 진심으로 감사드립니다.<br>
                            아래 인증 번호를 입력해주시면 회원가입을 진행하실 수 있습니다.<br><br>
                            감사합니다.                        
                        </p>
                        <p style="letter-spacing: 6px; font-size: 20px; background:#3EB86F; padding: 5px 15px; color:#fff; font-weight: 600; width: 200px; margin: 0 auto; border-radius: 10px; text-align: center;">'.$num.'</p>
                    </div>
            </body></html>';



$result=mail($mailto, $subject, $message, $headers);


?>
