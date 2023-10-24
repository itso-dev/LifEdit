<?php
    include_once('../head.php');
    include_once('../default.php');

    // 리스트에 출력하기 위한 sql문
    $admin_sql = "select * from portfolio_tbl order by id";
    $admin_stt=$db_conn->prepare($admin_sql);
    $admin_stt->execute();

    function type($num){
        $type = "";
       switch ($num){
           case 1:
               $type = "공연";
               break;
           case 2:
               $type = "오디오컨텐츠";
               break;
           case 3:
               $type = "축제/행사";
               break;
           case 4:
               $type = "교육/사업";
               break;
           case 5:
               $type = "라이프에디트 랩";
               break;
        }
        return $type;
    }
?>
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/board_list.css" rel="stylesheet" />

    <div class="page-header">
        <h4 class="page-title">
            포트폴리오 관리
        </h4>
    </div>

    <form name="fmemberlist" id="fmemberlist" action="./setting/portfolio_delete.php" method="post">
        <input type="hidden" name="link" value="portfolio_list.php"/>
        <input type="hidden" name="type" value="all"/>
        <div class="btn_fixed_top">
            <span onclick="delData()" class="btn btn_02">선택삭제</span>
            <span onclick="noticeData()" class="btn btn_02">대표등록</span>
            <span onclick="mainData()" class="btn btn_02">메인 전시 등록</span>
            <a href="portfolio_form.php?menu=99&mode=insert" id="member_add" class="btn btn_01">포트폴리오 추가</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table border-bottom" style="min-width: 800px;">
                    <thead>
                        <tr>
                            <th scope="col" id="mb_list_chk" rowspan="2" width="5%">
                                <label for="chkall" class="d-none">게시글 전체</label>
                                <input type="checkbox" name="chkall" value="1" onclick="check_all(this)">
                            </th>
                            <th scope="col" id="mb_list_id" width="10%" class="text-center">구분</th>
                            <th scope="col" id="mb_list_name" width="10%" class="text-center">카테고리</th>
                            <th scope="col" id="mb_list_join" width="40%" class="text-center">포트폴리오 명</th>
                            <th scope="col" id="mb_list_join" width="10%" class="text-center">작성일</th>
                            <th scope="col" rowspan="2" id="mb_list_mng" width="10%" class="text-center">관리</th>
                        </tr>
                    </thead>
                        <tbody>
                            <?php
                                while($list_row=$admin_stt->fetch()){
                            ?>
                            <tr class="bg0">
                                <td headers="mb_list_chk" class="td_chk">
                                    <input type="hidden" name="mb_id[<?=$list_row['id']?>]" value="admin" id="mb_id_<?=$list_row['id']?>">
                                    <input type="checkbox" name="chk[]" class="m_chk" value="<?=$list_row['id']?>" id="chk_<?=$list_row['id']?>">
                                </td>
                                <td headers="mb_list_name" class="td_mbname text-center">
                                    <? if($list_row['is_notice'] == 'Y') echo "공지";  ?>
                                    <? if($list_row['is_notice'] == 'Y' && $list_row['is_main'] == 'Y') echo " / ";  ?>
                                    <? if($list_row['is_main'] == 'Y') echo "메인 전시";  ?>
                                </td>
                                <td headers="mb_list_name" class="td_mbname text-center"><?=type($list_row['category'])?></td>
                                <td headers="mb_list_join" class="td_date text-center"><?=$list_row['title']?></td>
                                <td headers="mb_list_name" class="td_mbname text-center"><?= substr($list_row['regdate'], 0, 10) ?></td>
                                <td headers="mb_list_mng" class="td_mng td_mng_s text-center"><a href="portfolio_detail.php?menu=99&id=<?=$list_row['id']?>" class="btn btn_03">상세보기</a></td>
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

function delData(){
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
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
        $("#fmemberlist").attr("action", "./setting/portfolio_delete.php");
        $("#fmemberlist").submit();
        return true;
    }
}

function noticeData(){
    var count = 0;
    var obj = document.getElementsByName("chk[]");

    for(var i=0 ; i < obj.length ; i++){
        if( obj[i].checked == true ){
            count++;
        }
    }
    if( count == 0) {
        alert("대표로 등록할 대상을 선택해주세요.");
        return false;
    } else {
        $("#fmemberlist").attr("action", "./setting/set_notice.php");
        $("#fmemberlist").submit();
        return true;
    }
}

function mainData(){
    var count = 0;
    var obj = document.getElementsByName("chk[]");

    for(var i=0 ; i < obj.length ; i++){
        if( obj[i].checked == true ){
            count++;
        }
    }
    if( count == 0) {
        alert("메인 전시로 등록할 대상을 선택해주세요.");
        return false;
    } else {
        $("#fmemberlist").attr("action", "./setting/set_main.php");
        $("#fmemberlist").submit();
        return true;
    }
}

</script>
