<?
    include_once('../../head.php');

    $chk_count = count($_POST['chk']);

    for ($i = 0; $i < $chk_count; $i ++) {
        $id = $_POST['chk'][$i];

        $admin_sql = "select * from awards_tbl where id = $id";
        $admin_stt=$db_conn->prepare($admin_sql);
        $admin_stt->execute();
        $file = $admin_stt -> fetch();


        unlink($root_path ."/data/awards/".$file['chg_name']);


        $delete_sql = "delete from awards_tbl
        where
           id = $id";

        $deleteStmt = $db_conn->prepare($delete_sql);
        $deleteStmt->execute();

        $count = $deleteStmt->rowCount();
    }




          echo "<script type='text/javascript'>";
          echo "alert('삭제 되었습니다.'); location.href='../awards_list.php?menu=88&'";
          echo "</script>";
?>
