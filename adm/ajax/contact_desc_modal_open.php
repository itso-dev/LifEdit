<?
include_once('../../db/dbconfig.php');

$wr_id = $_POST['wr_id'];

// 리스트에 출력하기 위한 sql문
$modal_sql = "select * from contact_tbl where id = $wr_id";
$modal_stt=$db_conn->prepare($modal_sql);
$modal_stt->execute();
$row = $modal_stt -> fetch();
?>

<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form name="madal_form" id="madal_form" method="post" action="./ajax/contact_insert.php">
        <input type="hidden" name="id" value="<?= $row[0] ?>" />
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= $row['name'] ?>님 문의 내용</h5>
                </div>
                <div class="modal-body">
                    <div>
                        <p><?= $row['contact_desc'] ?></p>
                    </div>
                </div>
            </div>

        </div>

    </form>
</div>

<script>
    $( document ).ready(function() {
        $('#modal-close').click(function(){
            $('#contactModal').modal('hide');
        })
    });
</script>
