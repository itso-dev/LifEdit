<?
include_once('../head.php');

$id = $_POST['id'];
$contact_desc = $_POST['contact_desc'];
$result_status = $_POST['result_status'];


$modify_sql = "update contact_tbl
    set 
    counsel_desc = '$contact_desc',
    result_status = '$result_status'
    where
    id = $id";

$updateStmt = $db_conn->prepare($modify_sql);
$updateStmt->execute();

$count = $updateStmt->rowCount();

echo "<script type='text/javascript'>";
echo "alert('등록되었습니다.'); location.href='../apply_list.php'";
echo "</script>";

?>
