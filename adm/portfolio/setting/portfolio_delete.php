<?
    include_once('../../head.php');

    $type = $_POST['type'];

    if($type == 'detail'){
        $id = $_POST['id'];

        $file_sql = "select * from portfolio_file_tbl where fk_id = $id";
        $file_stt=$db_conn->prepare($file_sql);
        $file_stt->execute();

        while($file=$file_stt->fetch()){
            unlink($root_path ."/data/portfolio/".$file['chg_name']);
        }

        $thumb_sql = "select * from portfolio_tbl where id = $id";
        $thumb_stt=$db_conn->prepare($thumb_sql);
        $thumb_stt->execute();
        $thumb = $thumb_stt -> fetch();

        unlink($root_path ."/data/portfolio/".$thumb['chg_name']);


        $delete_sql = "delete from portfolio_tbl
        where
           id = $id";

        $deleteStmt = $db_conn->prepare($delete_sql);
        $deleteStmt->execute();

        $count = $deleteStmt->rowCount();
    }
    if($type == 'all'){
        $chk_count = count($_POST['chk']);

        for ($i = 0; $i < $chk_count; $i ++) {
            $id = $_POST['chk'][$i];

            $file_sql = "select * from portfolio_file_tbl where fk_id = $id";
            $file_stt=$db_conn->prepare($file_sql);
            $file_stt->execute();

            while($file=$file_stt->fetch()){
                unlink($root_path ."/data/portfolio/".$file['chg_name']);
            }

            $thumb_sql = "select * from portfolio_tbl where id = $id";
            $thumb_stt=$db_conn->prepare($thumb_sql);
            $thumb_stt->execute();
            $thumb = $thumb_stt -> fetch();

            unlink($root_path ."/data/portfolio/".$thumb['chg_name']);


            $delete_sql = "delete from portfolio_tbl
        where
           id = $id";

            $deleteStmt = $db_conn->prepare($delete_sql);
            $deleteStmt->execute();

            $count = $deleteStmt->rowCount();

        }
    }


    echo "<script type='text/javascript'>";
    echo "alert('삭제 되었습니다.'); location.href='../portfolio_list.php?menu=99&'";
    echo "</script>";
?>
