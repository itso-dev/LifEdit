<?php
    include_once('../head.php');
    include_once('../default.php');

    $id = $_GET['id'];
    $year = $_GET['year'];


    $admin_sql = "select * from history_detail_tbl where fk_year = $id order by month asc";
    $admin_stt=$db_conn->prepare($admin_sql);
    $admin_stt->execute();


?>

<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/history_form.css" rel="stylesheet" />

    <div class="page-header">
        <h4 class="page-title">연혁 관리</h4>
        <form name="logo_form" id="logo_form" method="post" action="./setting/history_setting.php" enctype="multipart/form-data">
            <input type="hidden" name="year_id" value="<?= $id ?>" />
            <input type="hidden" name="type" value="detail" />
            <input type="hidden" name="array" value="0" />
            <input type="hidden" name="old_year" value="<?= $year ?>" />
            </div>
                <div class="input-wrap">
                    <p class="label-name">연도*</p>
                    <input type="text" name="year" class="form-control" value="<?= $year ?>" required>
                </div>
                <a href="history_detail_form.php?fk_year=<?= $id ?>&type=insert&year=<?= $year ?>" class="add-btn">연월 추가</a>
                <div class="detail-container">
                    <?php
                    while($list_row=$admin_stt->fetch()){
                    ?>
                    <div class="item">
                        <input type="text" name="" class="form-control month" readonly value="<?= $list_row['month'] ?>" />
                        <input type="hidden" class="id" name="id" value="<?= $list_row['id'] ?>"/>
                        <a href="history_detail_form.php?fk_year=<?= $id ?>&type=modify&year=<?= $year ?>&id=<?= $list_row['id'] ?>" class="modify">수정</a>
                        <span class="del" onclick="delDate(this)">삭제</span>
                        <textarea class="form-control" readonly><?= $list_row['content'] ?></textarea>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <div class="btn-wrap">
                <input type="submit" class="submit" value="확인" />
                <a href="history_list.php?menu=88" class="go-back">목록</a>
            </div>
        </form>
    </div>
    <!-- box end -->
</div>
<!-- content-box-wrap end -->

<script type="text/javascript">
    // $(".add-btn").click(function (){
    //     var array = $("input[name=array]").val();
    //     $("input[name=array]").val(parseInt(array) + 1);
    //     var add = ` <div class="item">
    //                     <input type="text" name="month[]" class="form-control month" placeholder="세부 연월 입력" required/>
    //                     <span class="del">삭제</span>
    //                     <textarea class="form-control" name="content[]" placeholder="내용 입력"></textarea>
    //                 </div>`
    //     $(".detail-container").append(add);
    // });
    //
    // $(document).on("click", ".del", function (){
    //     var array = parseInt($("input[name=array]").val());
    //     $("input[name=array]").val(array - 1);
    //
    //     $(this).parent(".item").remove();
    // });


    function delDate(element){
        var id = $(element).siblings(".id").val();
        if(!confirm("선택한 데이터를 정말 삭제하시겠습니까?")) {
            return false;
        }else{
            $.ajax({
                type:'post',
                url:'./setting/history_delete.php',
                data:{id:id, type: 'detail'},
                success:function(html){
                    $(element).parent(".item").remove();
                }
            });
        }

    }
</script>
