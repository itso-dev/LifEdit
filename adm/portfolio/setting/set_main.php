<?
include_once('../../head.php');

$link = $_POST['link'];

if($link == "portfolio_list.php"){
    $chk_count = count($_POST['chk']);
    for ($i = 0; $i < $chk_count; $i ++) {
        $id = $_POST['chk'][$i];

        $modify_sql = "update portfolio_tbl
               set
          is_main = 'Y'
               where
          id = $id";

        $updateStmt = $db_conn->prepare($modify_sql);
        $updateStmt->execute();

        $count = $updateStmt->rowCount();
    }
} else {
    $key = $_POST['key'];
        $id = $_POST['id'];

        $modify_sql = "update portfolio_tbl
               set
          is_main = '$key'
               where
          id = $id";

        $updateStmt = $db_conn->prepare($modify_sql);
        $updateStmt->execute();

        $count = $updateStmt->rowCount();

}





echo "<script type='text/javascript'>";
echo "alert('변경 되었습니다.'); location.href='../$link?menu=44&'";
echo "</script>";
?>
