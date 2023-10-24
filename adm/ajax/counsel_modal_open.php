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
                    <h5 class="modal-title"><?= $row['name'] ?>님 상담내역</h5>
                </div>
                <div class="modal-body">
                    <div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th>이름</th>
                                <th class="text-center">연락처</th>
                                <th class="text-center">결과</th>
                                <th class="text-center">생성일</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="modal_id text-center" id="modal_id"><?= $row[0] ?></td>
                                <td class="modal_name" id="modal_name"><?= $row['name'] ?></td>
                                <td class="modal_subject text-center" id="modal_subject"><?= $row['phone'] ?></td>
                                <td class="modal_result text-center" id="modal_result"><?= $row['result_status'] ?></td>
                                <td class="modal_datetime text-center" id="modal_datetime"><?= $row['write_date'] ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="modal_counsel_content_result">결과</label>
                            <select class="custom-select modal_counsel_result" id="modal_counsel_result" name="result_status">
                                <option value="대기" <? if($row['result_status'] == "대기") echo "selected"?>>대기</option>
                                <option value="진행" <? if($row['result_status'] == "진행") echo "selected"?>>진행</option>
                                <option value="부재" <? if($row['result_status'] == "부재") echo "selected"?>>부재</option>
                                <option value="거절" <? if($row['result_status'] == "거절") echo "selected"?>>거절</option>
                                <option value="완료" <? if($row['result_status'] == "완료") echo "selected"?>>완료</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="counsel_content_body" class="col-form-label">상담내용</label>
                    </div>
                    <div>
                        <textarea name="contact_desc"><?= $row['counsel_desc'] ?></textarea>
                    </div>
                    <div>
                        <input type="submit" class="btn btn-primary" value="저장"></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="modal-close">닫기</button>
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
