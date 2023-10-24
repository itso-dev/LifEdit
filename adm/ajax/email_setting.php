<?
    include_once('../head.php');

    $posted = date("Y-m-d H:i:s");

    $email = $_POST['email'];



    //수정
      $modify_sql = "update email_tbl
           set 
      email = '$email',
      regdate = '$posted'
           where
      id = 1";

      $updateStmt = $db_conn->prepare($modify_sql);
      $updateStmt->execute();

      echo "<script type='text/javascript'>";
      echo "alert('저장되었습니다.'); location.href='../email_form.php?menu=1'";
      echo "</script>";


?>
