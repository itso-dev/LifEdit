<?
include_once('../../head.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');
$reg_date = date("Y-m-d H:i:s");


$type = $_POST['type'];


//입력
if ($type == 'year_insert') {
     $year = $_POST['year'];

     $insert_sql = "insert into history_year_tbl
                                        (year, regdate)
                                   value
                                        (?, ?)";

     $db_conn->prepare($insert_sql)->execute(
         [
             $year,
             $reg_date
         ]
     );

     echo "<script type='text/javascript'>";
     echo "alert('등록 되었습니다.'); location.href='../history_list.php?menu=88&'";
     echo "</script>";
}

//입력
if ($type == 'detail') {
     $id = $_POST['year_id'];
     $year = $_POST['year'];
     $old_year = $_POST['old_year'];


     // 연도 변경시
     if($year != $old_year){
          $year_modify_sql = "update history_year_tbl
               set 
               year = '$year',
               regdate = '$reg_date'
                    where
               id = $id";

          $yearUpdateStmt = $db_conn->prepare($year_modify_sql);
          $yearUpdateStmt->execute();

          $count = $yearUpdateStmt->rowCount();
     }

     echo "<script type='text/javascript'>";
     echo "alert('수정을 완료했습니다.'); location.href='../history_detail.php?menu=88&year=$year&id=$id'";
     echo "</script>";
}

//입력
if ($type == 'insert') {
     $fk_id = $_POST['fk_id'];
     $year = $_POST['year'];
     $month = $_POST['month'];
     $content = $_POST['content'];

     $insert_sql = "insert into history_detail_tbl
                                        (month, content, fk_year, regdate)
                                   value
                                        (?, ?, ?, ?)";

     $db_conn->prepare($insert_sql)->execute(
         [
             $month,
             $content,
             $fk_id,
             $reg_date
         ]
     );
     echo "<script type='text/javascript'>";
     echo "alert('등록 되었습니다.'); location.href='../history_detail.php?menu=88&year=$year&id=$fk_id'";
     echo "</script>";
}

//수정
if ($type == 'modify') {
     $fk_id = $_POST['fk_id'];
     $id = $_POST['id'];
     $year = $_POST['year'];
     $month = $_POST['month'];
     $content = $_POST['content'];

     $year_modify_sql = "update history_detail_tbl
               set 
               month = '$month',
               content = '$content',
               regdate = '$reg_date'
                    where
               id = $id";

     $yearUpdateStmt = $db_conn->prepare($year_modify_sql);
     $yearUpdateStmt->execute();

     $count = $yearUpdateStmt->rowCount();

     echo "<script type='text/javascript'>";
     echo "alert('수정을 완료했습니다.'); location.href='../history_detail.php?menu=88&year=$year&id=$fk_id'";
     echo "</script>";
}

?>
