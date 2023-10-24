<?php
    include_once('../../../db/dbconfig.php');

    $email = $_POST['email'];
    $password = $_POST['password'];

    $login_sql = "select * from member_tbl WHERE email = '$email'";
    $login_stt=$db_conn->prepare($login_sql);
    $login_stt->execute();
    $result = $login_stt->fetch(); // 또는 fetchAll()을 사용할 수 있음

    if ($result) {

    if($email == $result['email'] && password_verify( $password , $result['password'] )){
        session_start();
        $_SESSION['m_id'] = $result['id'];

        echo "<script type='text/javascript'>";
        echo "location.href='/'";
        echo "</script>";
    } else{
        echo "<script type='text/javascript'>";
        echo "alert('가입된 회원이 아니거나 비밀번호가 틀립니다.'); location.href='../login.php'";
        echo "</script>";
    }



    } else {
        echo "<script type='text/javascript'>";
        echo "alert('가입된 회원이 아니거나 비밀번호가 틀립니다.'); location.href='../login.php'";
        echo "</script>";
    }

?>
