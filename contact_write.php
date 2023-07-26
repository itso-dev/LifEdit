<?php
    include_once('head.php');

    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    date_default_timezone_set('Asia/Seoul');

    session_start();
    $captcha = $_POST['g-recaptcha'];
    $secretKey = '6LeIUPcmAAAAAOmmC7uHCV0ehulrrbqDHKztxIUk';
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
    $phone = $_POST["phone"];
    $location = $_POST["location"];
    $desc = $_POST["desc"];

    $writer_ip = $_POST["writer_ip"];

    $sql="
        insert into contact_tbl
            (name, phone, location, contact_desc, result_status,
             consult_fk, manager_fk, writer_ip, write_date)
        value
            (?, ?, ?, ?, ?,
            ?, ?, ?, ?)";

    $db_conn->prepare($sql)->execute(
        [$name, $phone, $location, $desc, '대기',
        0, 0, $writer_ip, $posted]);


    $contact_cnt_sql = "insert into contact_log_tbl
                                  (contact_cnt,  reg_date)
                             value
                                  (? ,?)";


    $db_conn->prepare($contact_cnt_sql)->execute(
        [1, $posted]);

    echo "<script type='text/javascript'>";
    echo "alert('등록 되었습니다.');";
    echo "try{";
    echo "setTimeout(function(){";
    echo "location.href = '/index.php';";
    echo "}, 500);";
    echo "}catch(e){}";
    echo "</script>";


?>
