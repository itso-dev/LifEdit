<?php
    include_once('../../../../db/dbconfig.php');

    $id = $_POST["id"];
    $password = $_POST["password"];
    $encrypted_password = password_hash($password , PASSWORD_DEFAULT );

    $modify_sql = "update member_tbl
                   set 
                   password = '$encrypted_password'
                        where
                   id = $id";

    $updateStmt = $db_conn->prepare($modify_sql);
    $updateStmt->execute();

    $count = $updateStmt->rowCount();

    echo "<script type='text/javascript'>";
    echo "alert('비밀번호가 재설정 되었습니다.'); location.href='../../login.php'";
    echo "</script>";

?>
