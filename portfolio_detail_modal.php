<?php
$site_path = $_SERVER["DOCUMENT_ROOT"]."/Lifedit";
$site_url = "http://".$_SERVER["HTTP_HOST"]."/Lifedit";

include_once($site_path. '/db/dbconfig.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = $_POST['id'];
$category = $_POST['category'];
$tab = $_POST['tab'];

function type($num){
    $link = "";
    switch ($num){
        case 1:
            $link = "/culture/performance.php";
            break;
        case 2:
            $link = "/culture/audio.php";
            break;
        case 3:
            $link = "/culture/email.php";
            break;
        case 4:
            $link = "/sharing.php";
            break;
        case 5:
            $link = "/lab.php";
            break;
    }
    return $link;
}



$detail_sql = "select * from portfolio_tbl where id = $id";
$detail_stt=$db_conn->prepare($detail_sql);
$detail_stt->execute();
$val = $detail_stt -> fetch();



$file_sql = "select * from portfolio_file_tbl where fk_id = $id";
$file_stt=$db_conn->prepare($file_sql);
$file_stt->execute();

$prev_id = "";
$next_id = "";

if($tab == "전체"){
    $prev_sql = "select * from portfolio_tbl where id < " .$id ." order by id desc limit 1";
    $prev_stt = $db_conn->prepare($prev_sql);
    $prev_stt->execute();
    $prev = $prev_stt->fetch();
    if($prev){
        $prev_id =  $prev['id'];
    }

    $next_sql = "select * from portfolio_tbl where id > " .$id ." order by id ASC limit 1";
    $next_stt = $db_conn->prepare($next_sql);
    $next_stt->execute();
    $next = $next_stt->fetch();
    if($next){
        $next_id = $next['id'];
    }
} else if($tab == "대표") {
    $prev_sql = "select * from portfolio_tbl where id < " .$id ." and category = $category and is_notice = 'Y' order by id desc limit 1";
    $prev_stt = $db_conn->prepare($prev_sql);
    $prev_stt->execute();
    $prev = $prev_stt->fetch();
    if($prev){
        $prev_id =  $prev['id'];
    }

    $next_sql = "select * from portfolio_tbl where id > " .$id ." and category = $category and is_notice = 'Y' order by id ASC limit 1";
    $next_stt = $db_conn->prepare($next_sql);
    $next_stt->execute();
    $next = $next_stt->fetch();
    if($next){
        $next_id = $next['id'];
    }
} else {
    $prev_sql = "select * from portfolio_tbl where id < " .$id ." and category = $category order by id desc limit 1";
    $prev_stt = $db_conn->prepare($prev_sql);
    $prev_stt->execute();
    $prev = $prev_stt->fetch();
    if($prev){
        $prev_id =  $prev['id'];
    }

    $next_sql = "select * from portfolio_tbl where id > " .$id ." and category = $category order by id ASC limit 1";
    $next_stt = $db_conn->prepare($next_sql);
    $next_stt->execute();
    $next = $next_stt->fetch();
    if($next){
        $next_id = $next['id'];
    }
}


?>

<img class="modal-close" src="<?= $site_url ?>/img/modal-close.png"/>
<?php if($prev){ ?>
<img class="prev-data" src="<?= $site_url ?>/img/navi-icon.png" onclick="pageMove(<?= $prev_id ?>, <?= $category ?>, '<?= $tab ?>');">
<?php } ?>
<?php if($next){ ?>
<img class="next-data" src="<?= $site_url ?>/img/navi-icon.png" onclick="pageMove(<?= $next_id ?>, <?= $category ?>, '<?= $tab ?>');">
<?php } ?>
<div class="wrapper">

    <?php if($val['type'] == 1) { ?>
    <div class="video-container">
        <div class="video-wrap">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $val['video_id'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
    </div>
    <? } else {?>
    <div class="img-slide-container">
        <div class="swiper-wrapper">
            <?php while($file=$file_stt->fetch()){
                $thumb_file = $site_url .'/data/portfolio/' . $file['chg_name'];
            ?>
            <div class="swiper-slide" style="background: url('<?= $thumb_file ?>')"></div>
            <? } ?>
        </div>
        <div class="swiper-pagination""></div>
    </div>
    <?php } ?>
    <div class="info-wrap">
        <p class="title"><?= $val['title'] ?></p>
        <p class="txt">
            <?= $val['text'] ?>
        </p>
        <a href="<?=  type($val['category']) ?>" class="more">사업 소개</a>
    </div>
</div>

<script>
    var portfolio = new Swiper(".img-slide-container", {

        observer: true,
        observeParents: true,
        loopAdditionalSlides: 1,
        slidesPerView: 1,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

    $(".modal-close").click(function (){
        $(".modal-bg").hide();
        $(".modal-container").hide();
    });
    $(".modal-bg").click(function (){
        $(".modal-bg").hide();
        $(".modal-container").hide();
    });
</script>
