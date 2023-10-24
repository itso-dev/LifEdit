<?
include_once('../../head.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');
$reg_date = date("Y-m-d H:i:s");

$id = $_POST['id'];
$type = $_POST['type'];
$video_id = $_POST['video_id'];
$data_cnt1 = $_POST['data_cnt1'];
$data_cnt2 = $_POST['data_cnt2'];
$data_cnt3 = $_POST['data_cnt3'];
$is_show = $_POST['is_show'];

//이전 파일
$old_img_file1 = $_POST['old_img_file1'];
$old_img_file2 = $_POST['old_img_file2'];
$old_file = $_POST['old_file'];


$img_file1 = "";
$img_file2 = "";
$file = "";

$upload_directory = $root_path . '/data/contents/';
$ext_str = "jpg,gif,png";
$allowed_extensions = explode(',', $ext_str);
$max_file_size = 5242880;
$img_file1_sql = "";
$img_file2_sql = "";
$file_sql = "";

//첫번쨰 이미지
if (isset($_FILES['img_file1']) && $_FILES['img_file1']['name'] != "") {
     $img_file1 = $_FILES['img_file1'];
     $ext1 = substr($img_file1['name'], strrpos($img_file1['name'], '.') + 1);

     // 확장자 체크
     if (!in_array($ext1, $allowed_extensions)) {
          echo "<script type='text/javascript'>";
          echo "alert('이미지 파일만 업로드 하실 수 있습니다.'); history.back()";
          echo "</script>";
     }
     // 파일 크기 체크
     if ($img_file1['size'] >= $max_file_size) {
          echo "<script type='text/javascript'>";
          echo "alert('5MB 이하의 파일만 업로드 가능합니다.'); history.back()";
          echo "</script>";
     }
     //파일명 변경
     $img_chg_file1 = date("Y-m-d H:i:s:u") .$img_file1['name'];
     $img_chg_file1 = str_replace(' ', '', $img_chg_file1);
     if (move_uploaded_file($img_file1['tmp_name'], $upload_directory . $img_chg_file1)) {
          $img_file1_sql = " img_file_name1 = '".$img_file1['name']."',
           img_chg_name1 = '$img_chg_file1',";
     }

     unlink($upload_directory. $old_img_file1);

} else {
     $img_file1_sql = "";
}


// 두번째 이미지
if (isset($_FILES['img_file2']) && $_FILES['img_file2']['name'] != "") {
     $img_file2 = $_FILES['img_file2'];
     $ext1 = substr($img_file2['name'], strrpos($img_file2['name'], '.') + 1);

     // 확장자 체크
     if (!in_array($ext1, $allowed_extensions)) {
          echo "<script type='text/javascript'>";
          echo "alert('이미지 파일만 업로드 하실 수 있습니다.'); history.back()";
          echo "</script>";
     }
     // 파일 크기 체크
     if ($img_file2['size'] >= $max_file_size) {
          echo "<script type='text/javascript'>";
          echo "alert('5MB 이하의 파일만 업로드 가능합니다.'); history.back()";
          echo "</script>";
     }
     //파일명 변경
     $img_chg_file2 = date("Y-m-d H:i:s:u") .$img_file2['name'];
     $img_chg_file2 = str_replace(' ', '', $img_chg_file2);
     if (move_uploaded_file($img_file2['tmp_name'], $upload_directory . $img_chg_file2)) {
          $img_file2_sql = " img_file_name2 = '".$img_file2['name']."',
           img_chg_name2 = '$img_chg_file2',";
     }

     unlink($upload_directory. $old_img_file2);

} else {
     $img_file2_sql = "";
}

// 소개서 파일
if (isset($_FILES['file']) && $_FILES['file']['name'] != "") {
     $file = $_FILES['file'];

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

$modify_sql = "update contents_tbl
          set 
          video_id = '$video_id',
          ".$img_file1_sql."
          ".$img_file2_sql."
          ".$file_sql."
          data_cnt1 = '$data_cnt1',
          data_cnt2 = '$data_cnt2',
          data_cnt3 = '$data_cnt3',
          is_show = '$is_show',
          regdate = '$reg_date'
               where
          id = $id";

$updateStmt = $db_conn->prepare($modify_sql);
$updateStmt->execute();

$count = $updateStmt->rowCount();


echo "<script type='text/javascript'>";
echo "alert('수정을 완료했습니다.'); location.href='../$type.php?menu=55'";
echo "</script>";

?>
