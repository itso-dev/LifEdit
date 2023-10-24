<?
include_once('../../head.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');
$reg_date = date("Y-m-d H:i:s");

$id = $_POST['id'];
$type = $_POST['type'];
$title = $_POST['title'];
$url = $_POST['url'];
$order = $_POST['order'];
$pc_old_file = $_POST['pc_old_file'];
$mobile_old_file = $_POST['mobile_old_file'];


//입력
if ($type == 'insert') {
     if (isset($_FILES['pc_img']) && $_FILES['pc_img']['name'] != "") {
          $pc_file = $_FILES['pc_img'];
          $upload_directory = $root_path . '/data/banner/';
          $ext_str = "jpg,gif,png";
          $allowed_extensions = explode(',', $ext_str);
          $max_file_size = 5242880;
          $ext1 = substr($pc_file['name'], strrpos($pc_file['name'], '.') + 1);

          // 확장자 체크
          if (!in_array($ext1, $allowed_extensions)) {
               echo "<script type='text/javascript'>";
               echo "alert('이미지 파일만 업로드 하실 수 있습니다.'); history.back()";
               echo "</script>";
          }
          // 파일 크기 체크
          if ($pc_file['size'] >= $max_file_size) {
               echo "<script type='text/javascript'>";
               echo "alert('5MB 이하의 파일만 업로드 가능합니다.'); history.back()";
               echo "</script>";
          }

          //파일명 변경
          $pc_chg_file = date("Y-m-d H:i:s:u") .$pc_file['name'];
          $pc_chg_file = str_replace(' ', '', $pc_chg_file);

          // 모바일 이미지가 있을 경우
          if (isset($_FILES['mobile_img']) && $_FILES['mobile_img']['name'] != "") {
               $mobile_file = $_FILES['mobile_img'];
               $ext2 = substr($mobile_file['name'], strrpos($mobile_file['name'], '.') + 1);
               // 확장자 체크
               if (!in_array($ext2, $allowed_extensions)) {
                    echo "<script type='text/javascript'>";
                    echo "alert('이미지 파일만 업로드 하실 수 있습니다.'); history.back()";
                    echo "</script>";
               }
               // 파일 크기 체크
               if ($mobile_file['size'] >= $max_file_size) {
                    echo "<script type='text/javascript'>";
                    echo "alert('5MB 이하의 파일만 업로드 가능합니다.'); history.back()";
                    echo "</script>";
               }
               //파일명 변경
               $mobile_chg_file = date("Y-m-d H:i:s:u") .$mobile_file['name'];
               $mobile_chg_file = str_replace(' ', '', $mobile_chg_file);
          } else {
               $mobile_file = $_FILES['pc_img'];
               $mobile_chg_file = $pc_chg_file;
          }


          if (move_uploaded_file($pc_file['tmp_name'], $upload_directory . $pc_chg_file)) {
               move_uploaded_file($mobile_file['tmp_name'], $upload_directory . $mobile_chg_file);


               $insert_sql = "insert into banner_tbl
                                        (b_order, title, url, 
                                         pc_file_name, pc_chg_name,
                                         mobile_file_name, mobile_chg_name,
                                         regdate)
                                   value
                                        (?, ?, ?,
                                            ?, ?,
                                            ?, ?,
                                            ?)";

               $db_conn->prepare($insert_sql)->execute(
                   [
                       $order,
                       $title,
                       $url,
                       $pc_file['name'],
                       $pc_chg_file,
                       $mobile_file['name'],
                       $mobile_chg_file,
                       $reg_date
                   ]
               );

               echo "<script type='text/javascript'>";
               echo "alert('등록 되었습니다.'); location.href='../banner_list.php?menu=22&'";
               echo "</script>";
          }
     }
}

//수정
if ($type == 'modify') {

     $pc_file = "";
     $upload_directory = $root_path . '/data/banner/';
     $ext_str = "jpg,gif,png";
     $allowed_extensions = explode(',', $ext_str);
     $max_file_size = 5242880;
     $pc_file_sql = "";
     $mobile_file_sql = "";
     if (isset($_FILES['pc_img']) && $_FILES['pc_img']['name'] != "") {
          $pc_file = $_FILES['pc_img'];
          $ext1 = substr($pc_file['name'], strrpos($pc_file['name'], '.') + 1);

          // 확장자 체크
          if (!in_array($ext1, $allowed_extensions)) {
               echo "<script type='text/javascript'>";
               echo "alert('이미지 파일만 업로드 하실 수 있습니다.'); history.back()";
               echo "</script>";
          }
          // 파일 크기 체크
          if ($pc_file['size'] >= $max_file_size) {
               echo "<script type='text/javascript'>";
               echo "alert('5MB 이하의 파일만 업로드 가능합니다.'); history.back()";
               echo "</script>";
          }
          //파일명 변경
          $pc_chg_file = date("Y-m-d H:i:s:u") .$pc_file['name'];
          $pc_chg_file = str_replace(' ', '', $pc_chg_file);
          if (move_uploaded_file($pc_file['tmp_name'], $upload_directory . $pc_chg_file)) {
               $pc_file_sql = " pc_file_name = '".$pc_file['name']."',
                pc_chg_name = '$pc_chg_file',";
          }

          unlink($upload_directory. $pc_old_file);

     } else {
          $pc_file_sql = "";
     }


     // 모바일 이미지가 있을 경우
     if (isset($_FILES['mobile_img']) && $_FILES['mobile_img']['name'] != "") {
          $mobile_file = $_FILES['mobile_img'];
          $ext2 = substr($mobile_file['name'], strrpos($mobile_file['name'], '.') + 1);
          // 확장자 체크
          if (!in_array($ext2, $allowed_extensions)) {
               echo "<script type='text/javascript'>";
               echo "alert('이미지 파일만 업로드 하실 수 있습니다.'); history.back()";
               echo "</script>";
          }
          // 파일 크기 체크
          if ($mobile_file['size'] >= $max_file_size) {
               echo "<script type='text/javascript'>";
               echo "alert('5MB 이하의 파일만 업로드 가능합니다.'); history.back()";
               echo "</script>";
          }
          //파일명 변경
          $mobile_chg_file = date("Y-m-d H:i:s:u") .$mobile_file['name'];
          $mobile_chg_file = str_replace(' ', '', $mobile_chg_file);
          if (move_uploaded_file($mobile_file['tmp_name'], $upload_directory . $mobile_chg_file)){
               $mobile_file_sql = " mobile_file_name = '".$mobile_file['name']."',
                mobile_chg_name = '$mobile_chg_file',";
          }
          unlink($upload_directory. $mobile_old_file);
     } else {
          $mobile_file_sql = "";
     }

     $modify_sql = "update banner_tbl
               set 
               b_order = '$order',
               title = '$title',
               ".$pc_file_sql."
               ".$mobile_file_sql."
               url = '$url'
                    where
               id = $id";

     $updateStmt = $db_conn->prepare($modify_sql);
     $updateStmt->execute();

     $count = $updateStmt->rowCount();


     echo "<script type='text/javascript'>";
     echo "alert('수정을 완료했습니다.'); location.href='../banner_form.php?menu=22&type=modify&id=$id'";
     echo "</script>";
}
?>
