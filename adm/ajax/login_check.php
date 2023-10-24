<?php
include_once('../head.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');

$login_id = $_POST["login_id"];
$password = $_POST["password"];

$login_sql = "select * from admin_tbl WHERE login_id = '$login_id'";
$login_stt=$db_conn->prepare($login_sql);
$login_stt->execute();


echo $login_id;

$is_admin = 1;

while($list_row=$login_stt->fetch()){
    if($login_id == $list_row['login_id'] && password_verify( $password , $list_row['password'] )){
        $_SESSION['manager_id'] = $list_row['login_id'];
        ?>
        <meta http-equiv="refresh" content="0;url=../index.php" />
        <?php
    }else{
        echo "<script type='text/javascript'>";
        echo "alert('가입된 회원아이디가 아니거나 비밀번호가 틀립니다.'); location.href='../bbs/login.php'";
        echo "</script>";
    }

}

?>
