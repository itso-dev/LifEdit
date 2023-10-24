<?
include_once('../../head.php');

$chk_count = count($_POST['chk']);
$link = $_POST['link'];


for ($i = 0; $i < $chk_count; $i ++) {
    $id = $_POST['chk'][$i];



    $modify_sql = "update community_tbl
               set
          is_notice = 'Y'
               where
          id = $id";

    $updateStmt = $db_conn->prepare($modify_sql);
    $updateStmt->execute();

    $count = $updateStmt->rowCount();

}



echo "<script type='text/javascript'>";
echo "alert('변경 되었습니다.'); location.href='../$link?menu=99&'";
echo "</script>";
?>
