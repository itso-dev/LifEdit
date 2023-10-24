<?php
    include_once('../../../../db/dbconfig.php');

    $name = $_POST["name"];
    $phone = $_POST["phone"];

    $find_sql = "select * from member_tbl where name = '$name' and phone = '$phone'";
    $find_stt=$db_conn->prepare($find_sql);
    $find_stt->execute();
    $val = $find_stt -> fetch();

    if($val){
        echo "<script type='text/javascript'>";
        echo "location.href='../result.php?m_id=".$val['id']."'";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('등록된 회원정보가 없습니다.'); location.href='../find_id.php'";
        echo "</script>";
    }
?>
