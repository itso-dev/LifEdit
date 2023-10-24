<?php
include_once('../head.php');

$contents_sql = "select * from contents2_tbl where id = 2";
$contents_stt=$db_conn->prepare($contents_sql);
$contents_stt->execute();
$data = $contents_stt -> fetch();

//대표 이미지
$img_file0 = $site_url .'/data/contents/' . $data['img_chg_name0'];
//첫번째 이미지
$img_file1 = $site_url .'/data/contents/' . $data['img_chg_name1'];
//두번째 이미지
$img_file2 = $site_url .'/data/contents/' . $data['img_chg_name2'];
//소개서 파일
$file = $site_url .'/data/contents/' . $data['chg_name'];
$portfolio_sql = "select * from portfolio_tbl where category = 2 and is_notice = 'Y'";
$portfolio_stt = $db_conn->prepare($portfolio_sql);
$portfolio_stt->execute();


$portfolio_thumb_dir = $site_url .'/data/portfolio/';
?>
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/info/common.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/swiper.css" rel="stylesheet" />
<script type="text/javascript" src="<?= $site_url ?>/js/swiper.js"></script>
<style>
    .page-top-banner{
        background: url("<?= $site_url ?>/img/info/lab-bg.png");
    }
</style>
<div class="page-top-banner">
    <p class="title">라이프에디트 랩</p>
    <p class="sub">Lifedit LAB</p>
</div>
<div class="section section01">
    <p class="sc-sub">Business Introduction</p>
    <p class="sc-title">사업 소개</p>
    <div class="main-img-wrap" style="background: url('<?= $img_file0 ?>')"></div>
    <p class="big">
        너를 너답게, 나를 나답게,<strong>우리답게</strong>
    </p>
    <p class="txt">
        가장 라이프에디트다움을 보여주는 사업이 <br class="mobile">바로 라이프에디트랩입니다.<br>
        <br>
        무언가 새로운 것을 도전하고 싶을 때,<br>
        함께 하면 도전의 시작이 조금은 쉬워질 수 있어요.<br>
        관심이 비슷한 사람들이 모여 <br class="mobile">새로운 작당을 해 볼 수 있는 시간.<br>
        암전뮤지컬, 오디오콘텐츠 그리고 교육사업까지<br>
        모두 이 라이프에디트 랩의 ‘프로젝트’에서 시작한 사업입니다.<br>
        <br>
        한번뿐인 인생, 도전하며 살고 싶다면<br>
        라이프에디트가 당신의 도전에 함께 합니다.
    </p>
</div>
<div class="section section02">
    <div class="wrapper">
        <div class="img-wrap" style="background: url('<?= $img_file1 ?>')"></div>
        <div class="flex-wrap">
            <div class="left">
                <p class="sc-sub">Difference</p>
                <p class="sc-title">라이프에디트 랩 차별점</p>
                <a class="download" href="<?= $file ?>" download="<?= $data['file_name'] ?>"><img src="<?= $site_url ?>/img/info/down-icon.png"/> 사업 소개 다운로드</a>
            </div>
            <div class="right">
                <div class="line">
                    <div class="step">01</div>
                    <div class="step-mobile"><img src="<?= $site_url ?>/img/info/s02-step1.png"></div>
                    <div class="txt-wrap">
                        <p class="tit">내가 원하는 대로, 맞춤형 프로젝트</p>
                        <p class="txt">
                            하고 싶은 것은 있지만 판을 만들기 어렵다면,<br>
                            라이프에디트가 함께 기획해서 맞춤형 프로젝트를 진행할 수 있습니다.
                        </p>
                    </div>
                </div>
                <div class="line">
                    <div class="step">02</div>
                    <div class="step-mobile"><img src="<?= $site_url ?>/img/info/s02-step2.png"></div>
                    <div class="txt-wrap">
                        <p class="tit">경험을 통해 포트폴리오가 쌓이는 프로젝트</p>
                        <p class="txt">
                            프로젝트를 진행하는 과정에서 경험하고<br>
                            프로젝트의 결과물로 포트폴리오를 쌓을 수 있습니다.
                        </p>
                    </div>
                </div>
                <div class="line">
                    <div class="step">03</div>
                    <div class="step-mobile"><img src="<?= $site_url ?>/img/info/s02-step3.png"></div>
                    <div class="txt-wrap">
                        <p class="tit">혼자가 아닌 함께 만들어가는 프로젝트</p>
                        <p class="txt">
                            프로젝트에 참여하며 관심있는 분야가 비슷한 사람들과<br>
                            또 다른 새로운 것을 만들어 볼 수 있습니다.
                        </p>
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
                <p class="sc-title">교육 분야 소개</p>
            </div>
            <div class="right">
                <div class="info-line">
                    <p class="tit"><img src="<?= $site_url ?>/img/info/chk-icon.png"/> 문화분야</p>
                    <p class="txt">
                        예술가나 크리에이터의 꿈이 있다면 기초부터 전문과정까지 경험하고<br>
                        직접 무대에 오르거나 콘텐츠를 만들 수 있습니다.
                    </p>
                </div>
                <div class="info-line">
                    <p class="tit"><img src="<?= $site_url ?>/img/info/chk-icon.png"/> 교육분야</p>
                    <p class="txt ">
                        배우고 싶은 건 뭐든 가능합니다.<br>
                        목소리로, 촉각으로, 향으로 감각을 통해 배우고 가르치는 것을 잘합니다.
                    </p>
                </div>
                <div class="info-line">
                    <p class="tit"><img src="<?= $site_url ?>/img/info/chk-icon.png"/> 기타분야</p>
                    <p class="txt ">
                        여행도 좋고 공연을 보는 것이 좋고 그냥 수다떠는 것도 좋다면<br>
                        그것도 하나의 프로젝트가 될 수 있습니다.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if($data['is_show'] == 'Y'){ ?>
<div class="section section03">
    <div class="wrapper">
        <p class="sc-sub">Performance Data</p>
        <p class="sc-title">라이프에디트 랩 실적 데이터 <span class="sub-txt">(2023년 기준)</span></p>
        <div class="flex-wrap">
            <div class="item">
                <p class="label label1"><?= $data['data_cnt1'] ?></p>
                <img class="arrow" src="<?= $site_url ?>/img/info/s03-arrow1.png">
                <img class="chart" src="<?= $site_url ?>/img/info/s03-chart1.png">
                <p class="txt">프로젝트 수 (개)</p>
            </div>
            <div class="item">
                <p class="label label3"><?= $data['data_cnt2'] ?></p>
                <img class="arrow" src="<?= $site_url ?>/img/info/s03-arrow3.png">
                <img class="chart" src="<?= $site_url ?>/img/info/s03-chart3.png">
                <p class="txt">참여자 수 (명)</p>
            </div>
        </div>
    </div>
</div>
<?php } ?>
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
                        <span class="category">교육 사업</span>
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
            url:'../portfolio_detail_modal.php',
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
            url:'../portfolio_detail_modal.php',
            data:{id: id, category: category, tab: tab},
            success:function(html){
                $(".modal-container").empty();
                $(".modal-container").append(html);
            }
        });
    }
</script>

<?php
include_once('../tale.php');
?>
