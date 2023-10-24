<?php
include_once('../../db/dbconfig.php');
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $reg_date = date("Y-m-d H:i:s");

    $title = $_POST['title'];
    $writer = $_POST['writer'];
    $content = $_POST['content'];

    $insert_sql = "insert into community_tbl
                                  (title, writer,
                                   content_desc, view_cnt,
                                   is_notice, regdate)
                             value
                                  (?, ?,
                                    ?, ?,
                                   ?, ?)";

    $db_conn->prepare($insert_sql)->execute(
        [
            $title,
            $writer,
            $content,
            "0",
            'N',
            $reg_date
        ]
    );
    $last_id = $db_conn->lastInsertId();


//파일이 있을경우
//파일이 있을경우
if(isset($_FILES['file']))   {
    $max_file_size = 5242880; // 5MB
    $upload_directory = $_SERVER["DOCUMENT_ROOT"]."/Lifedit/data/community/"; // 이 경로가 파일을 저장할 경로인지 확인

    // 업로드된 파일의 수를 계산
    $countfiles = count($_FILES['file']['name']);
    $query = "INSERT INTO community_file_tbl (file_name, chg_name, fk_id, regdate) VALUES(?,?,?,?)";
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
    echo "alert('등록 되었습니다.'); location.href='community.php'";
    echo "</script>";
?>
