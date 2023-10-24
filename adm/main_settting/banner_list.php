<?php
    include_once('../head.php');
    include_once('../default.php');

    // 리스트에 출력하기 위한 sql문
    $admin_sql = "select * from banner_tbl order by id";
    $admin_stt=$db_conn->prepare($admin_sql);
    $admin_stt->execute();

?>
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/manager_list.css" rel="stylesheet" />

<form name="fmemberlist" id="fmemberlist" action="./setting/banner_delete.php" onsubmit="return fmemberlist_submit(this);" method="post">
    <input type="hidden" name="sst" value="mb_datetime">
    <input type="hidden" name="sod" value="desc">
    <input type="hidden" name="sfl" value="">
    <input type="hidden" name="stx" value="">
    <input type="hidden" name="page" value="1">
    <div class="page-header">
        <h4 class="page-title">
            메인 배너 관리
        </h4>
        <div class="btn_fixed_top">
           <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
            <a href="banner_form.php?menu=22&type=insert" id="member_add" class="btn btn_01">배너 추가</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table border-bottom" style="min-width: 800px;">
                <thead>
                    <tr>
                        <th scope="col" id="mb_list_chk" width="5%" rowspan="2" class="text-center">
                            <label for="chkall" class="d-none">회원 전체</label>
                            <input type="checkbox" name="chkall" value="1" onclick="check_all(this)">
                        </th>
                        <th scope="col" id="mb_list_name" width="10%" class="text-center">노출순서</th>
                        <th scope="col" id="mb_list_join" width="40%" class="text-center">배너명</th>
                        <th scope="col" id="mb_list_join" width="20%" class="text-center">최종 수정일</th>
                        <th scope="col" rowspan="2" id="mb_list_mng" width="20%" class="text-center">관리</th>
                    </tr>
                </thead>
                    <tbody>
                        <?php
                            while($list_row=$admin_stt->fetch()){
                        ?>
                        <tr class="bg0">
                            <td headers="mb_list_chk" class="td_chk text-center">
                                <input type="hidden" name="mb_id[<?=$list_row['id']?>]" value="admin" id="mb_id_<?=$list_row['id']?>">
                                <input type="checkbox" name="chk[]" class="m_chk" value="<?=$list_row['id']?>" id="chk_<?=$list_row['id']?>">
                            </td>
                            <td headers="mb_list_name" class="td_mbname text-center"><?=$list_row['b_order']?></td>
                            <td headers="mb_list_name" class="td_mbname text-center"><?=$list_row['title']?></td>
                            <td headers="mb_list_join" class="td_date text-center"><?=$list_row['regdate']?></td>
                            <td headers="mb_list_mng" class="td_mng td_mng_s text-center"><a href="banner_form.php?menu=22&type=modify&id=<?=$list_row['id']?>" class="btn btn_03">수정</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
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

function check_all(thisobj) {
	var $this = $(thisobj);

	if($this.prop("checked") == true) {
		$this.closest("#fmemberlist").find("input[type=checkbox]").prop("checked", true);
	} else {
		$this.closest("#fmemberlist").find("input[type=checkbox]").prop("checked", false);
	}
}

function fmemberlist_submit(f){
    var count = 0;
    var obj = document.getElementsByName("chk[]");

    for(var i=0 ; i < obj.length ; i++){
        if( obj[i].checked == true ){
            count++;
        }
    }
    if( count == 0) {
        alert("삭제하실 대상을 선택해주세요.");
        return false;
    } else {
        if(document.pressed == "선택삭제") {
            if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
                return false;
            }
        }
        return true;
    }
}

</script>
