<?
include_once('../../head.php');

$type = "";

if(isset($_POST['type'])){
    $type = $_POST['type'];
}


if($type == "detail"){
    $id = $_POST['id'];


    $delete_sql = "delete from member_tbl
    where
       id = $id";

    $deleteStmt = $db_conn->prepare($delete_sql);
    $deleteStmt->execute();

    $count = $deleteStmt->rowCount();

} else {
    $chk_count = count($_POST['chk']);

    for ($i = 0; $i < $chk_count; $i ++) {
        $id = $_POST['chk'][$i];

        $delete_sql = "delete from member_tbl
        where
           id = $id";

        $deleteStmt = $db_conn->prepare($delete_sql);
        $deleteStmt->execute();

        $count = $deleteStmt->rowCount();
    }
}




echo "<script type='text/javascript'>";
echo "alert('삭제 되었습니다.'); location.href='../member_list.php?menu=11&'";
echo "</script>";
?>
