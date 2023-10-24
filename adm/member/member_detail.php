<?php
    include_once('../head.php');
    include_once('../default.php');

    $id = $_GET['id'];

    $admin_sql = "select * from member_tbl where id = $id";
    $admin_stt = $db_conn->prepare($admin_sql);
    $admin_stt->execute();
    $row = $admin_stt->fetch();

?>
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/member_detail.css" rel="stylesheet" />

    <div class="page-header">
        <h4 class="page-title">
            회원 관리
        </h4>
        <form method="post" action="setting/member_delete.php" onsubmit="return delChk(); ">
            <input type="hidden" name="id" value="<?= $id ?>" />
            <input type="hidden" name="type" value="detail" />
            <input type="submit" class="delete" value="회원 삭제"/>
        </form>
    </div>
 <!-- box end -->
</div>

<div class="member-detail-container">
    <div class="line">
        <div class="wrap">
            <p class="label">가입일:</p>
            <p class="val"><?= $row['regdate'] ?></p>
        </div>
        <div class="wrap">
            <p class="label">이메일:</p>
            <p class="val"><?= $row['email'] ?></p>
        </div>
    </div>
    <div class="line">
        <div class="wrap">
            <p class="label">이름:</p>
            <p class="val"><?= $row['name'] ?></p>
        </div>
        <div class="wrap">
            <p class="label">생년월일:</p>
            <p class="val"><?= $row['birth'] ?></p>
        </div>
    </div>
    <div class="line">
        <div class="wrap">
            <p class="label">휴대폰 번호:</p>
            <p class="val"><?= $row['name'] ?></p>
        </div>
        <div class="wrap">
            <p class="label">주소:</p>
            <p class="val"><?= $row['address'] ?></p>
        </div>
    </div>
    <div class="line">
        <div class="wrap">
            <p class="label">이벤트 정보 수집 동의:</p>
            <p class="val"><?= $row['event_agree'] ?></p>
        </div>
        <div class="wrap">
            <p class="label">상세 주소:</p>
            <p class="val"><?= $row['address_detail'] ?></p>
        </div>
    </div>
</div>

<div class="btn-wrap">
    <a href="./member_list.php?menu=11" class="go-back">목록</a>
</div>

<!-- content-box-wrap end -->
<style>
    .list-thumb{
        width: 200px;
    }
</style>

<script type="text/javascript">
    function delChk(){
        if(!confirm("회원 정보를 삭제하시겠습니까? 삭제된 정보는 복구하실 수 없습니다.")) {
            return false;
        }else{
            return true;
        }
    }
</script>
