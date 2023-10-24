<?php
    include_once('../../../db/dbconfig.php');


    $email = $_POST['email'];

    $admin_sql = "select * from member_tbl where email = '$email'";
    $admin_stt=$db_conn->prepare($admin_sql);
    $admin_stt->execute();
    $result = $admin_stt->fetch(); // 또는 fetchAll()을 사용할 수 있음

    if ($result) {
        // 결과가 존재하는 경우에 수행할 작업
        echo "Y";
    } else {
        // 결과가 존재하지 않는 경우에 수행할 작업
        echo "N";
    }

?>
