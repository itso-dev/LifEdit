<?php
    include_once('../head.php');
    include_once('../default.php');

    $fk_id = $_GET['fk_year'];
    $type = $_GET['type'];
    $year = $_GET['year'];
    $id = "";
    $month = "";
    $content = "";

    if($type=='modify') {
        $admin_sql = "select * from history_detail_tbl where fk_year = $fk_id";
        $admin_stt = $db_conn->prepare($admin_sql);
        $admin_stt->execute();
        $val = $admin_stt -> fetch();

        $id = $val['id'];
        $month = $val['month'];
        $content = $val['content'];

    }

?>

<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/history_form.css" rel="stylesheet" />

    <div class="page-header">
        <h4 class="page-title">연혁 관리</h4>
        <form name="logo_form" id="logo_form" method="post" action="./setting/history_setting.php" enctype="multipart/form-data">
            <input type="hidden" name="fk_id" value="<?= $fk_id ?>" />
            <input type="hidden" name="id" value="<?= $id ?>" />
            <input type="hidden" name="type" value="<?= $type ?>" />
            <input type="hidden" name="year" value="<?= $year ?>" />
                <div class="detail-container">
                    <p class="label">세부 연월 추가</p>
                    <div class="item">
                        <input type="text" name="month" class="form-control month" placeholder="세부 연월 입력" value="<?= $month ?>" required/>
                        <textarea class="form-control" name="content" placeholder="내용 입력"><?= $content ?></textarea>
                    </div>
                </div>

            <div class="btn-wrap">
                <input type="submit" class="submit" value="확인" />
                <a href="javascript:window.history.back();" class="go-back">목록</a>
            </div>
        </form>
    </div>
    <!-- box end -->
</div>
<!-- content-box-wrap end -->

<script type="text/javascript">
    $(".add-btn").click(function (){
        var array = $("input[name=array]").val();
        $("input[name=array]").val(parseInt(array) + 1);
        var add = ` <div class="item">
                        <input type="text" name="month[]" class="form-control month" placeholder="세부 연월 입력" required/>
                        <span class="del">삭제</span>
                        <textarea class="form-control" name="content[]" placeholder="내용 입력"></textarea>
                    </div>`
        $(".detail-container").append(add);
    });

    $(document).on("click", ".del", function (){
        var array = parseInt($("input[name=array]").val());
        $("input[name=array]").val(array - 1);

        $(this).parent(".item").remove();
    });
</script>
