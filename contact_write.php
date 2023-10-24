<?php
    include_once('db/dbconfig.php');

    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    date_default_timezone_set('Asia/Seoul');

    session_start();
    $captcha = $_POST['g-recaptcha'];
    $secretKey = '6LcLwbIoAAAAAFKDtkFz0mzzgx-oJkLvRB8prrkY';
    $ip = $_SERVER['REMOTE_ADDR'];

    $data = array(
        'secret' => $secretKey,
        'response' => $captcha,
        'remoteip' => $ip
    );

    $url = "https://www.google.com/recaptcha/api/siteverify";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($ch);
    curl_close($ch);

    $responseKeys = json_decode($response, true);

    if ($responseKeys["success"]) {
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('비정상적인 접근입니다.');";
        echo "location.href = '/index.php';";
        echo "</script>";
        exit;
    }



    $posted = date("Y-m-d H:i:s");
    $name = $_POST["name"];
    $type = $_POST["type"];
    $phone = $_POST["phone"];
    $title = $_POST["title"];
    $email = $_POST["email"];
    $desc = $_POST["contact_desc"];

    $writer_ip = $_POST["writer_ip"];

    $sql="
        insert into contact_tbl
            (name, title, type, phone, email, contact_desc, result_status,
             consult_fk, manager_fk, writer_ip, write_date)
        value
            (?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?)";

    $db_conn->prepare($sql)->execute(
        [$name, $title, $type, $phone, $email, $desc, '대기',
        0, 0, $writer_ip, $posted]);


    $contact_cnt_sql = "insert into contact_log_tbl
                                  (contact_cnt,  reg_date)
                             value
                                  (? ,?)";


    $db_conn->prepare($contact_cnt_sql)->execute(
        [1, $posted]);


    $email_sql = "select * from email_tbl where id = 1";
    $email_stt=$db_conn->prepare($email_sql);
    $email_stt->execute();
    $row = $email_stt -> fetch();

    $email = $row['email'];


    $mail_from = "lifedit_@naver.com";          // 보내는 사람 메일주소\
    $mailto = "$email";
    $subject = "=?UTF-8?B?".base64_encode("[라이프에디트] 새로운 문의가 등록되었습니다.")."?=";
    $headers = "From: 라이프에디트<$mail_from>\n";
    $headers .= "X-Sender: <$mail_from>\n";
    $headers .= "X-Mailer: PHP ".phpversion()."\n";
    $headers .= "Return-Path: <...>\n";
    $headers .= "Content-Type:text/html;charset=utf-8; ";



    // Additional headers


    $message = '<html><body>
                       <div style="width: 500px; margin: 0 auto; text-align: left;">
                            <p style="font-size: 25px; color:#3EB86F; font-weight: 600; margin-bottom: 30px; text-align: center;">라이프에디트</p>
                            <p style="font-size: 20px; margin-bottom: 30px;"><strong style="color:#3EB86F;">신규 문의</strong> 안내입니다.</p>
                            <p style="font-size: 16px; margin-bottom: 40px;">
                                <strong style="margin-right: 30px">문의 구분:</strong> '.$type.'<br>                   
                                <strong style="margin-right: 30px">이름:</strong> '.$name.'<br>                   
                                <strong style="margin-right: 30px">연락처:</strong> '.$phone.'<br>                   
                                <strong style="margin-right: 30px">이메일:</strong> '.$email.'<br>                   
                                <strong style="margin-right: 30px">문의 제목:</strong> '.$title.'<br>                   
                                <strong style="margin-right: 30px">문의 내용:</strong><br>
                                '.$desc.'                   
                            </p>
                        </div>
                </body></html>';



    $result=mail($mailto, $subject, $message, $headers);




echo "<script type='text/javascript'>";
    echo "alert('문의가 등록 되었습니다.');";
    echo "try{";
    echo "setTimeout(function(){";
    echo "location.href = './contact.php';";
    echo "}, 500);";
    echo "}catch(e){}";
    echo "</script>";


?>
