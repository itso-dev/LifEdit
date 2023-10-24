<?php
include_once('../../../head.php');
$prevPage = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);

if($prevPage != '/Lifedit/page/bbs/find/ajax/find_id_ajax.php') {
    echo "<script>alert('허용되지 않는 잘못된 접근입니다.');location.href='".$site_url."'</script>";
}
$m_id = $_GET['m_id'];

$find_sql = "select * from member_tbl where id = $m_id";
$find_stt=$db_conn->prepare($find_sql);
$find_stt->execute();
$val = $find_stt -> fetch();
$email = $val['email'];
?>
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/bbs/join.css" rel="stylesheet" />

<article id="join03_article01">
        <div class="join03_inner">
            <img src="../../../img/common/joinlogo.png">
            <p>가입하신 아이디는<strong style="margin: 0 10px"><?= $email ?></strong>입니다.</p>
        </div>
    </article>

    <article id="loginbtn03_div">
        <button class="green_box_btn green_login" onclick="location.href='<?= $site_url ?>/page/bbs/login.php'" type="button">로그인하러 가기</button>
    </article>
</div>

<?php
include_once('../../../tale.php');
?>
