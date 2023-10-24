<?php
    include_once('../head.php');
    include_once('../default.php');

    if(!isset($_GET['page']))
    {
        $_GET['page']=1;
    }

    $stx = isset($_POST['skey']) ? $_POST['skey'] : '';

    // 검색
    if($stx == ""){
        $stx_key = "";
    }else{
        $stx_key = " where email like '%$stx%' OR name like '%$stx%' ";
    }

    $list_size = 10;
    $page_size = 10;
    $first = ($_GET['page']*$list_size)-$list_size;

    // 리스트에 출력하기 위한 sql문
    $admin_sql = "select * from member_tbl"
                .$stx_key
                ." order by id desc limit $first, $list_size";
    $admin_stt=$db_conn->prepare($admin_sql);
    $admin_stt->execute();

    //총 페이지를 구하기 위한 sql문
    $total_sql = "select count(*) from notice_tbl";
    $total_stt=$db_conn->prepare($total_sql);
    $total_stt->execute();
    $total_row=$total_stt->fetch();

    $total_list = $total_row['count(*)'];
    $total_page = ceil($total_list/$list_size);
    $row = ceil($_GET['page']/$page_size);

    $start_page=(($row-1)*$page_size)+1;


?>
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/board_list.css" rel="stylesheet" />

    <div class="page-header">
        <h4 class="page-title">
            회원 관리
        </h4>
    </div>

    <div class="search-container">
        <form method="post">
            <input type="hidden" name="page" value="<?= $_GET['page'] ?>">
            <input type="text" name="skey" placeholder="이름 / 이메일을 입력해주세요.">
            <input type="submit" value="검색"/>
        </form>
    </div>
    <form name="fmemberlist" id="fmemberlist" action="./setting/member_delete.php" onsubmit="return fmemberlist_submit(this);" method="post">
        <input type="hidden" name="type" value="notice"/>
        <div class="btn_fixed_top">
           <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
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
                            <th scope="col" id="mb_list_id" width="10%" class="text-center">이름</th>
                            <th scope="col" id="mb_list_name" width="10%" class="text-center">가입일</th>
                            <th scope="col" id="mb_list_join" width="20%" class="text-center">이메일</th>
                            <th scope="col" id="mb_list_join" width="10%" class="text-center">연락처</th>
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
                                <td headers="mb_list_name" class="td_mbname text-center"><?=$list_row['name']?></td>
                                <td headers="mb_list_name" class="td_mbname text-center"><?= substr($list_row['regdate'], 0, 10) ?></td>
                                <td headers="mb_list_join" class="td_date text-center"><?=$list_row['email']?></td>
                                <td headers="mb_list_join" class="td_date text-center"><?=$list_row['phone']?></td>
                                <td headers="mb_list_mng" class="td_mng td_mng_s text-center"><a href="member_detail.php?menu=11&id=<?=$list_row['id']?>" class="btn btn_03">상세보기</a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
        <!-- page-header end -->

        <nav>
            <ul class="pagination">
                <?php
                if($start_page<=0){
                    $start_page = 1;
                }
                $end_page=($start_page+$page_size)-1;
                if($total_page<$end_page){
                    $end_page=$total_page;
                }
                if($_GET['page']!=1){
                    $back=$_GET['page']-$page_size;
                    if($back<=0){
                        $back=1;
                    }
                    echo "<li class='page-item'>";
                    echo "  <a class='page-link' href='$_SERVER[PHP_SELF]?page=$back&menu=44'>처음</a>";
                    echo "</li>";
                }
                for($i=$start_page; $i<=$end_page; $i++){
                    if($_GET['page']!=$i){
                        echo "<li class='page-item'>";
                        echo "  <a class='page-link' href='$_SERVER[PHP_SELF]?page=$i&menu=44'>";
                        echo "      $i ";
                        echo "  </a>";
                        echo "</li>";
                    }else{
                        echo "<li class='page-item'>";
                        echo "  <strong class='page-link active'>";
                        echo "      $i 페이지 ";
                        echo "  </strong>";
                        echo "</li>";
                    }
                }
                if($_GET['page']!=$total_page){
                    $next=$_GET['page']+$page_size;
                    if($total_page<$next){
                        $next=$total_page;
                    }
                    echo "<li class='page-item'>";
                    echo "<a class='page-link' href='$_SERVER[PHP_SELF]?page=$next&menu=44'>맨끝</a>";
                    echo "</li>";
                }
                ?>
            </ul>
        </nav>
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
