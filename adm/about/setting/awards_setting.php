<?
include_once('../../head.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');
$reg_date = date("Y-m-d H:i:s");

$id = $_POST['id'];
$type = $_POST['type'];
$title = $_POST['title'];
$content = $_POST['content'];
$old_file = $_POST['old_file'];

//입력
if ($type == 'insert') {
     if (isset($_FILES['img_upload']) && $_FILES['img_upload']['name'] != "") {
          $file = $_FILES['img_upload'];
          $upload_directory = $root_path . '/data/awards/';
          $ext_str = "jpg,gif,png";
          $allowed_extensions = explode(',', $ext_str);
          $max_file_size = 5242880;
          $ext1 = substr($file['name'], strrpos($file['name'], '.') + 1);

          // 확장자 체크
          if (!in_array($ext1, $allowed_extensions)) {
               echo "<script type='text/javascript'>";
               echo "alert('이미지 파일만 업로드 하실 수 있습니다.'); history.back()";
               echo "</script>";
          }
          // 파일 크기 체크
          if ($file['size'] >= $max_file_size) {
               echo "<script type='text/javascript'>";
               echo "alert('5MB 이하의 파일만 업로드 가능합니다.'); history.back()";
               echo "</script>";
          }

          //파일명 변경
          $chg_file = date("Y-m-d H:i:s:u") .$file['name'];
          $chg_file = str_replace(' ', '', $chg_file);


          if (move_uploaded_file($file['tmp_name'], $upload_directory . $chg_file)) {

               $insert_sql = "insert into awards_tbl
                                        (title, content, file_name, chg_name, regdate)
                                   value
                                        (?, ?, ?, ?, ?)";

               $db_conn->prepare($insert_sql)->execute(
                   [
                       $title,
                       $content,
                       $file['name'],
                       $chg_file,
                       $reg_date
                   ]
               );

               echo "<script type='text/javascript'>";
               echo "alert('등록 되었습니다.'); location.href='../awards_list.php?menu=88&'";
               echo "</script>";
          }
     }
}

//수정
if ($type == 'modify') {

     $file = "";
     $upload_directory = $root_path . '/data/awards/';
     $ext_str = "jpg,gif,png";
     $allowed_extensions = explode(',', $ext_str);
     $max_file_size = 5242880;
     $file1_sql = "";
     $file2_sql = "";
     if (isset($_FILES['img_upload']) && $_FILES['img_upload']['name'] != "") {
          $file = $_FILES['img_upload'];
          $ext1 = substr($file['name'], strrpos($file['name'], '.') + 1);

          // 확장자 체크
          if (!in_array($ext1, $allowed_extensions)) {
               echo "<script type='text/javascript'>";
               echo "alert('이미지 파일만 업로드 하실 수 있습니다.'); history.back()";
               echo "</script>";
          }
          // 파일 크기 체크
          if ($file['size'] >= $max_file_size) {
               echo "<script type='text/javascript'>";
               echo "alert('5MB 이하의 파일만 업로드 가능합니다.'); history.back()";
               echo "</script>";
          }
          //파일명 변경
          $chg_file = date("Y-m-d H:i:s:u") .$file['name'];
          $chg_file = str_replace(' ', '', $chg_file);
          if (move_uploaded_file($file['tmp_name'], $upload_directory . $chg_file)) {
               $file_sql = " file_name = '".$file['name']."',
                chg_name = '$chg_file',";
          }
          unlink($upload_directory. $old_file);
     } else {
          $file_sql = "";
     }


     $modify_sql = "update awards_tbl
               set 
               title = '$title',
               content = '$content',
               ".$file_sql."
               regdate = '$reg_date'
                    where
               id = $id";

     $updateStmt = $db_conn->prepare($modify_sql);
     $updateStmt->execute();

     $count = $updateStmt->rowCount();


     echo "<script type='text/javascript'>";
     echo "alert('수정을 완료했습니다.'); location.href='../awards_form.php?menu=88&type=modify&id=$id'";
     echo "</script>";
}
?>
