<?
    include_once('../../head.php');

    $id = $_POST['id'];
    $type = $_POST['type'];

    if($type == 'detail'){
        $delete_sql = "delete from history_detail_tbl
        where
           id = $id";

        $deleteStmt = $db_conn->prepare($delete_sql);
        $deleteStmt->execute();

        $count = $deleteStmt->rowCount();
    }
    if($type == 'all'){

        $delete_sql = "delete from history_detail_tbl
            where
               fk_year = $id";

        $deleteStmt = $db_conn->prepare($delete_sql);
        $deleteStmt->execute();

        $count = $deleteStmt->rowCount();

        $delete2_sql = "delete from history_year_tbl
            where
               id = $id";

        $deleteStmt2 = $db_conn->prepare($delete2_sql);
        $deleteStmt2->execute();

        $count = $deleteStmt2->rowCount();
    }
?>
