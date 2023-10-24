<?php
include_once('../../head.php');

$contents_sql[0] = "select * from portfolio_tbl";
$contents_stt[0]=$db_conn->prepare($contents_sql[0]);
$contents_stt[0]->execute();

for($i = 1; $i <= 5; $i++){
    $contents_sql[$i] = "select * from portfolio_tbl where category = $i";
    $contents_stt[$i]=$db_conn->prepare($contents_sql[$i]);
    $contents_stt[$i]->execute();
}

function type($num){
    $type = "";
    switch ($num){
        case 1:
            $type = "공연";
            break;
        case 2:
            $type = "오디오콘텐츠";
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

$thumb_dir = $site_url .'/data/portfolio/';

?>
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/portfolio.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/swiper.css" rel="stylesheet" />
<script type="text/javascript" src="<?= $site_url ?>/js/swiper.js"></script>

<style>

</style>
<div class="page-top-banner">
    <p class="title">포트폴리오</p>
    <p class="sub">Portfolio</p>
</div>
<div class="tab-container">
    <div class="tab-wrap">
        <div class="tab-menu active">전체</div>
        <div class="tab-menu">공연</div>
        <div class="tab-menu">오디오 콘텐츠</div>
        <div class="tab-menu">축제 / 행사</div>
        <div class="tab-menu">교육사업</div>
        <div class="tab-menu">라이프에디트 랩</div>
    </div>
</div>
<div class="portfolio-container">
<?php for($z = 0; $z <= 5; $z++) { ?>
    <div class="tab-area">
        <div class="portfolio-wrap">
            <?php while($val=$contents_stt[$z]->fetch()){ ?>
            <div class="item" onclick="modalOpen(<?= $val['id'] ?>, <?= $val['category'] ?>)">
                <div class="img-wrap" style="background: url('<?= $thumb_dir .$val['chg_name'] ?>')">
                    <span class="category"><?= type($val['category']) ?></span>
                </div>
                <p class="tit"><?= $val['title'] ?></p>
                <p class="txt"><?= $val['text'] ?></p>
            </div>
            <? } ?>
        </div>
    </div>
    <? } ?>
</div>

<div class="modal-bg"></div>
<div class="modal-container">

</div>



<script>
    let category_select;

    $( document ).ready(function() {
        category_select = "0"
    });
    $(".tab-menu").click(function (){
        var idx = $(this).index();

        $(".tab-menu").removeClass("active");
        $(this).addClass("active");
        $(".tab-area").hide();
        $(".tab-area").eq(idx).show();
    });

    function modalOpen(id, category){
        let tab = $(".tab-menu.active").text();
        $.ajax({
            type:'post',
            url:'../../portfolio_detail_modal.php',
            data:{id: id, category: category, tab: tab},
            success:function(html){
                $(".modal-bg").show();
                $(".modal-container").empty();
                $(".modal-container").append(html);
                $(".modal-container").fadeIn("400");
            }
        });
    }

    function pageMove(id, category, tab){
        $.ajax({
            type:'post',
            url:'../../portfolio_detail_modal.php',
            data:{id: id, category: category, tab: tab},
            success:function(html){
                $(".modal-container").empty();
                $(".modal-container").append(html);
            }
        });
    }
</script>
<?php
include_once('../../tale.php');
?>
