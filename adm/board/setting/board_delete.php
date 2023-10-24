<?
include_once('../../head.php');

$chk_count = count($_POST['chk']);
$type = $_POST['type'];
$link = "";


if($type == "notice"){
    for ($i = 0; $i < $chk_count; $i ++) {
        $id = $_POST['chk'][$i];


        $delete_sql = "delete from notice_tbl
        where
           id = $id";

        $deleteStmt = $db_conn->prepare($delete_sql);
        $deleteStmt->execute();

        $count = $deleteStmt->rowCount();

        $link = "notice_list.php";
    }
}
else if($type == "community"){
    for ($i = 0; $i < $chk_count; $i ++) {
        $id = $_POST['chk'][$i];

        $admin_sql = "select * from community_file_tbl where fk_id = $id";
        $admin_stt=$db_conn->prepare($admin_sql);
        $admin_stt->execute();
        $file = $admin_stt -> fetch();


        unlink($root_path ."/data/community/".$file['chg_name']);

        $delete_sql = "delete from community_tbl
        where
           id = $id";

        $deleteStmt = $db_conn->prepare($delete_sql);
        $deleteStmt->execute();

        $count = $deleteStmt->rowCount();

        $link = "portfolio_list.php";
    }
}
else if($type == "news"){
    for ($i = 0; $i < $chk_count; $i ++) {
        $id = $_POST['chk'][$i];

        $admin_sql = "select * from news_tbl where id = $id";
        $admin_stt=$db_conn->prepare($admin_sql);
        $admin_stt->execute();
        $file = $admin_stt -> fetch();


        unlink($root_path ."/data/news/".$file['chg_name']);


        $delete_sql = "delete from news_tbl
        where
           id = $id";

        $deleteStmt = $db_conn->prepare($delete_sql);
        $deleteStmt->execute();

        $count = $deleteStmt->rowCount();

        $link = "news_list.php";
    }
}




echo "<script type='text/javascript'>";
echo "alert('삭제 되었습니다.'); location.href='../$link?menu=44&'";
echo "</script>";
?>
