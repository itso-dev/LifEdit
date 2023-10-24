<?php
    include_once('../../../db/dbconfig.php');

    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    date_default_timezone_set('Asia/Seoul');
    $posted = date("Y-m-d H:i:s");

    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];

    $year = sprintf("%02d", $_POST['year']);
    $month = sprintf("%02d", $_POST['month']);
    $day = sprintf("%02d", $_POST['day']);


    $birth = $year. ".". $month. ".". $day;
    $address = $_POST['address'];
    $address_detail = $_POST['address_detail'];
    $phone = $_POST['phone'];
    $event = $_POST['event'];

    //비밀번호 암호화
    $encrypted_password = password_hash($password , PASSWORD_DEFAULT );

    $insert_sql = "insert into member_tbl
                                  (email, password, name, 
                                  birth, address, address_detail, 
                                   phone, event_agree, 
                                   regdate)
                             value
                                  (?, ?, ?,
                                    ?, ?, ?,
                                  ?, ?, 
                                  ?)";


    $db_conn->prepare($insert_sql)->execute(
        [$email, $encrypted_password, $name,
            $birth, $address, $address_detail,
            $phone, $event,
            $posted]);

    echo "<script type='text/javascript'>";
    echo "location.href='../join03.php'";
    echo "</script>";

?>
