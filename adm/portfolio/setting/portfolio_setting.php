<?
include_once('../../head.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');
$reg_date = date("Y-m-d H:i:s");

$id = $_POST['id'];
$mode = $_POST['mode'];
$title = $_POST['title'];
$category = $_POST['category'];
$type = $_POST['type'];
$thumb_old_file = $_POST['thumb_old_file'];
$text = $_POST['text'];
$video_id = $_POST['video_id'];

//입력
if ($mode == 'insert') {
     if (isset($_FILES['thumb-img']) && $_FILES['thumb-img']['name'] != "") {
          $thumb_file = $_FILES['thumb-img'];
          $upload_directory = $root_path . '/data/portfolio/';
          $ext_str = "jpg,gif,png";
          $allowed_extensions = explode(',', $ext_str);
          $max_file_size = 5242880;
          $ext1 = substr($thumb_file['name'], strrpos($thumb_file['name'], '.') + 1);

          // 확장자 체크
          if (!in_array($ext1, $allowed_extensions)) {
               echo "<script type='text/javascript'>";
               echo "alert('이미지 파일만 업로드 하실 수 있습니다.'); history.back()";
               echo "</script>";
          }
          // 파일 크기 체크
          if ($thumb_file['size'] >= $max_file_size) {
               echo "<script type='text/javascript'>";
               echo "alert('5MB 이하의 파일만 업로드 가능합니다.'); history.back()";
               echo "</script>";
          }

          //파일명 변경
          $thumb_chg_file = date("Y-m-d H:i:s:u") .$thumb_file['name'];
          $thumb_chg_file = str_replace(' ', '', $thumb_chg_file);


          if (move_uploaded_file($thumb_file['tmp_name'], $upload_directory . $thumb_chg_file)) {

               $insert_sql = "insert into portfolio_tbl
                                        (category, type, title, 
                                         text, file_name, chg_name,
                                         video_id, is_notice, is_main, regdate)
                                   value
                                        (?, ?, ?, 
                                        ?, ?, ?, ?,
                                        ?, ?, ?)";

               $db_conn->prepare($insert_sql)->execute(
                   [
                       $category,
                       $type,
                       $title,
                       $text,
                       $thumb_file['name'],
                       $thumb_chg_file,
                       $video_id,
                       'N',
                       'N',
                       $reg_date
                   ]
               );
               $last_id = $db_conn->lastInsertId();

               //이미지 파일이 있을경우
               if(isset($_FILES['file']))   {
                    $max_file_size = 5242880; // 5MB

                    // 업로드된 파일의 수를 계산
                    $countfiles = count($_FILES['file']['name']);
                    $query = "INSERT INTO portfolio_file_tbl (file_name, chg_name, fk_id, regdate) VALUES(?,?,?,?)";
                    $statement = $db_conn->prepare($query);
                    for($i=0; $i<$countfiles; $i++){
                         $file_name = $_FILES['file']['name'][$i];

                         $tmp_file = $_FILES['file']['tmp_name'][$i]; // 임시 파일명

                         $chg_file = date("YmdHisu") . $file_name; // 파일 이름 변경
                         $chg_file = str_replace(' ', '', $chg_file);

                         // 파일 크기를 확인하여 제한을 초과하는지 확인
                         if ($_FILES['file']['size'][$i] > $max_file_size) {
                              echo "<script type='text/javascript'>";
                              echo "alert('5MB 이하의 파일만 업로드 가능합니다.'); history.back()";
                              echo "</script>";
                              exit();
                         }

                         if (move_uploaded_file($tmp_file, $upload_directory . $chg_file)) {
                              $statement->execute(array($file_name, $chg_file, $last_id, $reg_date));
                         }
                    }
               }

               echo "<script type='text/javascript'>";
               echo "alert('등록 되었습니다.'); location.href='../portfolio_list.php?menu=99'";
               echo "</script>";
          }
     }
}

//수정
if ($mode == 'modify') {

     $thumb_file = "";
     $upload_directory = $root_path . '/data/portfolio/';
     $ext_str = "jpg,gif,png";
     $allowed_extensions = explode(',', $ext_str);
     $max_file_size = 5242880;
     $thumb_file_sql = "";
     if (isset($_FILES['thumb-img']) && $_FILES['thumb-img']['name'] != "") {
          $thumb_file = $_FILES['thumb-img'];
          $ext1 = substr($thumb_file['name'], strrpos($thumb_file['name'], '.') + 1);

          // 확장자 체크
          if (!in_array($ext1, $allowed_extensions)) {
               echo "<script type='text/javascript'>";
               echo "alert('이미지 파일만 업로드 하실 수 있습니다.'); history.back()";
               echo "</script>";
          }
          // 파일 크기 체크
          if ($thumb_file['size'] >= $max_file_size) {
               echo "<script type='text/javascript'>";
               echo "alert('5MB 이하의 파일만 업로드 가능합니다.'); history.back()";
               echo "</script>";
          }
          //파일명 변경
          $thumb_chg_file = date("Y-m-d H:i:s:u") .$thumb_file['name'];
          $thumb_chg_file = str_replace(' ', '', $thumb_chg_file);
          if (move_uploaded_file($thumb_file['tmp_name'], $upload_directory . $thumb_chg_file)) {
               $thumb_file_sql = " file_name = '".$thumb_file['name']."',
                chg_name = '$thumb_chg_file',";
          }
          unlink($upload_directory. $thumb_old_file);
     } else {
          $file_sql = "";
     }


     $modify_sql = "update portfolio_tbl
               set 
               category = '$category',
               type = '$type',
               title = '$title',
               text = '$text',
               ".$thumb_file_sql."
               video_id = '$video_id'
                    where
               id = $id";

     $updateStmt = $db_conn->prepare($modify_sql);
     $updateStmt->execute();

     $count = $updateStmt->rowCount();

     //이미지 파일이 있을경우
     if(isset($_FILES['file']))   {
          $max_file_size = 5242880; // 5MB

          // 업로드된 파일의 수를 계산
          $countfiles = count($_FILES['file']['name']);
          $query = "INSERT INTO portfolio_file_tbl (file_name, chg_name, fk_id, regdate) VALUES(?,?,?,?)";
          $statement = $db_conn->prepare($query);
          for($i=0; $i<$countfiles; $i++){
               $file_name = $_FILES['file']['name'][$i];

               $tmp_file = $_FILES['file']['tmp_name'][$i]; // 임시 파일명

               $chg_file = date("YmdHisu") . $file_name; // 파일 이름 변경
               $chg_file = str_replace(' ', '', $chg_file);

               // 파일 크기를 확인하여 제한을 초과하는지 확인
               if ($_FILES['file']['size'][$i] > $max_file_size) {
                    echo "<script type='text/javascript'>";
                    echo "alert('5MB 이하의 파일만 업로드 가능합니다.'); history.back()";
                    echo "</script>";
                    exit();
               }

               if (move_uploaded_file($tmp_file, $upload_directory . $chg_file)) {
                    $statement->execute(array($file_name, $chg_file, $id, $reg_date));
               }
          }
     }

     echo "<script type='text/javascript'>";
     echo "alert('수정을 완료했습니다.'); location.href='../portfolio_form.php?menu=99&mode=modify&id=$id'";
     echo "</script>";
}
?>
