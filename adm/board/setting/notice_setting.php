<?
include_once('../../head.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$reg_date = date("Y-m-d H:i:s");

$id = "";
$type = $_POST['type'];
$title = $_POST['title'];
$writer = $_POST['writer'];
$content = $_POST['content'];


//입력
if ($type == 'insert') {

     $insert_sql = "insert into notice_tbl
                              (title, writer, 
                               content_desc, view_cnt,
                               regdate)
                         value
                              (?, ?,
                                ?, ?,
                               ?)";

     $db_conn->prepare($insert_sql)->execute(
         [
             $title,
             $writer,
             $content,
             "0",
             $reg_date
         ]
     );


     echo "<script type='text/javascript'>";
     echo "alert('등록 되었습니다.'); location.href='../notice_list.php?menu=44&'";
     echo "</script>";
}

//수정
if ($type == 'modify') {
     $id = $_POST['id'];

     $modify_sql = "update notice_tbl
               set
          title = '$title',
          writer = '$writer',
          content_desc = '$content'
               where
          id = $id";

     $updateStmt = $db_conn->prepare($modify_sql);
     $updateStmt->execute();

     $count = $updateStmt->rowCount();

     echo "<script type='text/javascript'>";
     echo "alert('수정을 완료했습니다.'); location.href='../notice_form.php?menu=44&type=modify&id=$id'";
     echo "</script>";
}
?>
