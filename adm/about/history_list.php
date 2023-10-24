<?php
    include_once('../head.php');
    include_once('../default.php');

    // 리스트에 출력하기 위한 sql문
    $admin_sql = "select * from history_year_tbl order by id";
    $admin_stt=$db_conn->prepare($admin_sql);
    $admin_stt->execute();

?>
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/history_list.css" rel="stylesheet" />

<form name="fmemberlist" id="fmemberlist" action="./setting/awards_delete.php" onsubmit="return fmemberlist_submit(this);" method="post">
    <input type="hidden" name="sst" value="mb_datetime">
    <input type="hidden" name="sod" value="desc">
    <input type="hidden" name="sfl" value="">
    <input type="hidden" name="stx" value="">
    <input type="hidden" name="page" value="1">
    <div class="page-header">
        <h4 class="page-title">
            연혁 관리
        </h4>
        <div class="btn_fixed_top">
            <a href="history_form.php?menu=88&type=insert" id="member_add" class="btn btn_01">연혁 추가</a>
        </div>
    </div>
    <div class="card-body">
        <div class="history-table">
            <div class="item">
                <div class="val">연도</div>
                <div class="val">관리</div>
            </div>
            <?php
            while($list_row=$admin_stt->fetch()){
            ?>
            <div class="item">
                <input type="hidden" class="id" name="id" value="<?= $list_row['id'] ?>"/>
                <div class="val"><?= $list_row['year'] ?></div>
                <div class="val"><a href="history_detail.php?menu=88&type=modify&id=<?=$list_row['id']?>&year=<?=$list_row['year']?>" class="btn btn_03">수정</a> <span class="btn del" onclick="delDate(this)">삭제</span></span></div>
            </div>
            <? } ?>
        </div>
    </div>
    </form>
        <!-- page-header end -->
    </div>
 <!-- box end -->
</div>
<!-- content-box-wrap end -->
<style>
    .list-thumb{
        width: 200px;
    }
</style>

<script type="text/javascript">
    function delDate(element){
        var id = $(element).parents(".item").find(".id").val();
        if(!confirm("선택한 데이터를 정말 삭제하시겠습니까?")) {
            return false;
        }else{
            $.ajax({
                type:'post',
                url:'./setting/history_delete.php',
                data:{id:id, type: 'all'},
                success:function(html){
                    $(element).parents(".item").remove();
                }
            });
        }

    }
</script>
