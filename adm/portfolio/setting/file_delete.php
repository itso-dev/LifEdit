<?
include_once('../../head.php');

    $id = $_POST['id'];

    $admin_sql = "select * from portfolio_file_tbl where id = $id";
    $admin_stt=$db_conn->prepare($admin_sql);
    $admin_stt->execute();
    $file = $admin_stt -> fetch();


    unlink($root_path ."/data/portfolio/".$file['chg_name']);

    $delete_sql = "delete from portfolio_file_tbl
        where
           id = $id";

    $deleteStmt = $db_conn->prepare($delete_sql);
    $deleteStmt->execute();

    $count = $deleteStmt->rowCount();

?>
