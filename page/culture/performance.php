<?php
include_once('../../head.php');

$contents_sql = "select * from contents_tbl where id = 1";
$contents_stt=$db_conn->prepare($contents_sql);
$contents_stt->execute();
$data = $contents_stt -> fetch();

//첫번째 이미지
$img_file1 = $site_url .'/data/contents/' . $data['img_chg_name1'];
//두번째 이미지
$img_file2 = $site_url .'/data/contents/' . $data['img_chg_name2'];
//소개서 파일
$file = $site_url .'/data/contents/' . $data['chg_name'];

$portfolio_sql = "select * from portfolio_tbl where category = 1 and is_notice = 'Y'";
$portfolio_stt = $db_conn->prepare($portfolio_sql);
$portfolio_stt->execute();


$portfolio_thumb_dir = $site_url .'/data/portfolio/';

?>
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/info/common.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/swiper.css" rel="stylesheet" />
<script type="text/javascript" src="<?= $site_url ?>/js/swiper.js"></script>

<style>
    .page-top-banner{
        background: url("<?= $site_url ?>/img/info/performance-bg.png");
    }
</style>
<div class="page-top-banner">
    <p class="title">공연</p>
    <p class="sub">Performance</p>
</div>
<div class="section section01">
    <p class="sc-sub">Business Introduction</p>
    <p class="sc-title">사업 소개</p>
    <div class="video-container">
        <div class="video-wrap">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $data['video_id'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
    </div>
    <p class="big">
        들어보셨나요? <strong>암전뮤지컬</strong>
    </p>
    <p class="txt">
        암전뮤지컬은 어둠 속에서 소리에 집중하고 <br class="mobile">상상하며 듣는 뮤지컬입니다.<br>
        <br>
        누가 시각장애인인지 비장애인인지 구분할 수 없는<br>
        깜깜한 어둠 속에서 외적인 모습에 집중하지 않고<br>
        배우 각자가 가진 재능과 가치에<br class="mobile"> 집중하는 시간을 선사합니다.<br>
        <br>
        소리에만 집중하는 시간으로<br>
        작품을 이해하는 과정에서 풍부한 상상력이 발휘됩니다.<br>
        시각의 차원을 넘어, 숨죽여 귀를 열어둔 시간동안<br>
        <br>
        보이지 않을 때 비로소 보이는 것들을 느껴보세요.
    </p>
</div>
<div class="section section02">
    <div class="wrapper">
        <div class="img-wrap" style="background: url('<?= $img_file1 ?>')"></div>
        <div class="flex-wrap">
            <div class="left">
                <p class="sc-sub">Difference</p>
                <p class="sc-title">공연 차별점</p>
                <a class="download" href="<?= $file ?>" download="<?= $data['file_name'] ?>"><img src="<?= $site_url ?>/img/info/down-icon.png"/> 사업 소개 다운로드</a>
            </div>
            <div class="right">
                <div class="line">
                    <div class="step">01</div>
                    <div class="step-mobile"><img src="<?= $site_url ?>/img/info/s02-step1.png"></div>
                    <div class="txt-wrap">
                        <p class="tit">재미와 감동이 함께 있는 가치 소비 공연</p>
                        <p class="txt">공연 한 편 관람으로 암전 속에서 <br class="mobile">재미와 감동을 더해 자연스럽게<br>
                            장애인식개선 효과를 주는 뮤지컬입니다.</p>
                    </div>
                </div>
                <div class="line">
                    <div class="step">02</div>
                    <div class="step-mobile"><img src="<?= $site_url ?>/img/info/s02-step2.png"></div>
                    <div class="txt-wrap">
                        <p class="tit">훌륭한 가성비 공연</p>
                        <p class="txt">무대장치가 거의 없는 암전 공연<br class="mobile"> 특성으로 일반 뮤지컬 대비<br>
                            적은 비용 고퀄리티 뮤지컬을 공연하여<br class="mobile"> 관객의 만족도를 높입니다.</p>
                    </div>
                </div>
                <div class="line">
                    <div class="step">03</div>
                    <div class="step-mobile"><img src="<?= $site_url ?>/img/info/s02-step3.png"></div>
                    <div class="txt-wrap">
                        <p class="tit">상상력을 개발하는 공연</p>
                        <p class="txt">소리를 통해 관객 개개인의 상상으로 무대를 감상하여<br>
                            눈을 감고 있어도 지루하지 않으며 <br>
                            오히려 상상을 통해 무대라는 한계를 뛰어넘어<br>
                            무한 확장되는 작품 세계를 경험할 수 있습니다.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section section02">
    <div class="wrapper">
        <div class="img-wrap" style="background: url('<?= $img_file2 ?>')"></div>
        <div class="flex-wrap">
            <div class="left">
                <p class="sc-sub">Product</p>
                <p class="sc-title">공연 상품 소개</p>
            </div>
            <div class="right">
                <div class="info-line">
                    <p class="tit"><img src="<?= $site_url ?>/img/info/chk-icon.png"/> 찾아가는 공연 <span> (60분 전체 공연)</span></p>
                    <p class="txt">
                        암전 뮤지컬은 무대장치가 별도로 필요 없이 사운드로 즐기는<br>
                        뮤지컬이기 때문에 언제, 어디서든 공연 가능합니다.<br style="display: block !important;">
                        찾아가는 공연으로 상상력을 만들어나가는 암전뮤지컬을 내가 있는 곳에서 즐겨보세요.
                    </p>
                </div>
                <div class="info-line">
                    <p class="tit"><img src="<?= $site_url ?>/img/info/chk-icon.png"/> 갈라 공연 <span> (20분 행사 공연)</span></p>
                    <p class="txt">
                        학교, 복지관, 기업, 공공기관 행사에서 갈라버전의 암전뮤지컬을 즐겨보세요.<br style="display: block !important;">
                        당신의 행사에 특별함을 더할 수 있습니다.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section section03">
    <div class="wrapper">
        <p class="sc-sub">Performance Data</p>
        <p class="sc-title">공연 실적 데이터 <span class="sub-txt">(2023년 기준)</span></p>
        <div class="flex-wrap">
            <div class="item">
                <p class="label label1"><?= $data['data_cnt1'] ?></p>
                <img class="arrow" src="<?= $site_url ?>/img/info/s03-arrow1.png">
                <img class="chart" src="<?= $site_url ?>/img/info/s03-chart1.png">
                <p class="txt">암전뮤지컬 작품 수 (개)</p>
            </div>
            <div class="item">
                <p class="label label2"><?= $data['data_cnt2'] ?></p>
                <img class="arrow" src="<?= $site_url ?>/img/info/s03-arrow2.png">
                <img class="chart" src="<?= $site_url ?>/img/info/s03-chart2.png">
                <p class="txt">공연 횟수 (회)</p>
            </div>
            <div class="item">
                <p class="label label3"><?= $data['data_cnt3'] ?></p>
                <img class="arrow" src="<?= $site_url ?>/img/info/s03-arrow3.png">
                <img class="chart" src="<?= $site_url ?>/img/info/s03-chart3.png">
                <p class="txt">관객 수 (명)</p>
            </div>
        </div>
    </div>
</div>
<div class="section section04">
    <div class="wrapper">
        <div class="head">
            <p class="sc-sub">Portfolio</p>
            <p class="sc-title">포트폴리오</p>
            <a href="<?= $site_url ?>/page/portfolio/portfolio.php" class="more">더보기 +</a>
        </div>
        <div class="flex-wrap">
            <?php while($pf=$portfolio_stt->fetch()){ ?>
                <div class="item" onclick="modalOpen(<?= $pf['id'] ?>, <?= $pf['category'] ?>)">
                    <div class="img-wrap" style="background: url('<?= $portfolio_thumb_dir .$pf['chg_name'] ?>')">
                        <span class="category">공연</span>
                    </div>
                    <p class="tit"><?= $pf['title'] ?></p>
                    <p class="txt"><?= $pf['text'] ?></p>
                </div>
            <? } ?>
        </div>
    </div>
    <a class="contact" href="<?= $site_url ?>/contact.php"><img src="<?= $site_url ?>/img/info/contact-icon.png">문의하기</a>
</div>

<div class="modal-bg"></div>
<div class="modal-container">
</div>

<script>
    function modalOpen(id, category){
        $.ajax({
            type:'post',
            url:'../../portfolio_detail_modal.php',
            data:{id: id, category: category, tab: "대표"},
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
