<?php
include_once('../head.php');

$contents_sql = "select * from contents2_tbl where id = 1";
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

$portfolio_sql = "select * from portfolio_tbl where category = 4 and is_notice = 'Y'";
$portfolio_stt = $db_conn->prepare($portfolio_sql);
$portfolio_stt->execute();


$portfolio_thumb_dir = $site_url .'/data/portfolio/';

?>
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/info/common.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/swiper.css" rel="stylesheet" />
<script type="text/javascript" src="<?= $site_url ?>/js/swiper.js"></script>
<style>
    .page-top-banner{
        background: url("<?= $site_url ?>/img/info/edu-bg.png");
    }
</style>
<div class="page-top-banner">
    <p class="title">교육사업</p>
    <p class="sub">Sharing</p>
</div>
<div class="section section01">
    <p class="sc-sub">Business Introduction</p>
    <p class="sc-title">사업 소개</p>
    <div class="main-img-wrap" style="background: url('<?= $img_file0 ?>')"></div>
    <p class="big">
        더불어 함께사는 세상을 위해,<br>
        <strong>미래 세대</strong>를 만납니다.
    </p>
    <p class="txt">
        나만 잘사는 것이 아닌 다같이 잘사는 사회.<br>
        라이프에디트가 꿈꾸는 미래의 모습입니다.<br>
        우리가 그리는 교육사업은<br class="mobile"> 머리로만 배우는 것이 아니라<br>
        직접 몸으로 경험하고 쌓아나가는 일입니다.<br>
        <br>
        스토리를 통해 조금 더 쉽고 재미있게,<br>
        강요하지 않고 공감할 수 있도록<br class="mobile"> 교육을 진행합니다.<br>
        혼자 외치는 것 같던 메시지가<br class="mobile"> 우리의 이야기가 되는 경험,<br>
        이야기의 힘을 믿는 기획자들의 진가를<br class="mobile"> 라이프에디트 교육사업을 통해 만나보세요.
    </p>
</div>
<div class="section section02">
    <div class="wrapper">
        <div class="img-wrap" style="background: url('<?= $img_file1 ?>')"></div>
        <div class="flex-wrap">
            <div class="left">
                <p class="sc-sub">Difference</p>
                <p class="sc-title">교육사업 차별점</p>
                <a class="download" href="<?= $file ?>" download="<?= $data['file_name'] ?>"><img src="<?= $site_url ?>/img/info/down-icon.png"/> 사업 소개 다운로드</a>
            </div>
            <div class="right">
                <div class="line">
                    <div class="step">01</div>
                    <div class="step-mobile"><img src="<?= $site_url ?>/img/info/s02-step1.png"></div>
                    <div class="txt-wrap">
                        <p class="tit">스토리로 공감하며 재미있게 배우는 교육</p>
                        <p class="txt">
                            추상적인 개념을 이야기로 풀어내어 쉽게 이해하고<br>
                            공감할 수 있는 교육을 진행합니다.<br>
                            어려운 개념을 스토리로 풀어내어 쉽게 이해할 수 있는 교육을 진행합니다.
                        </p>
                    </div>
                </div>
                <div class="line">
                    <div class="step">02</div>
                    <div class="step-mobile"><img src="<?= $site_url ?>/img/info/s02-step2.png"></div>
                    <div class="txt-wrap">
                        <p class="tit">직접 활동하며 머리와 몸으로 이해하는 교육</p>
                        <p class="txt">
                            워크북을 통해 머리로 이해하고 활동 키트를 통해<br>
                            몸으로 체험하는 교육을 진행합니다.
                        </p>
                    </div>
                </div>
                <div class="line">
                    <div class="step">03</div>
                    <div class="step-mobile"><img src="<?= $site_url ?>/img/info/s02-step3.png"></div>
                    <div class="txt-wrap">
                        <p class="tit">오감을 활용하여 상상력을 자극하는 교육</p>
                        <p class="txt">
                            전달형 수업이 아닌 오감을 활용하여<br class="mobile"> 직접 체험하는 활동으로<br>
                            창의력과 상상력을 발달시키는 교육을 진행합니다.
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
                    <p class="tit"><img src="<?= $site_url ?>/img/info/chk-icon.png"/> 창의인성교육</p>
                    <p class="txt">
                        뮤지컬동화와 다양한 창의활동을 통해 아이들이 쉽고 재밌게 인성의 덕목을 배웁니다.<br style="display: block !important;">
                        <br style="display: block !important;">
                        * 스톱모션 애니메이션으로 나눔의 가치 표현하기<br style="display: block !important;">
                        * 감정 에세이로 프로소통러 되기<br style="display: block !important;">
                        * show&tell 기법으로 존중의 가치 표현하기
                    </p>
                </div>
                <div class="info-line">
                    <p class="tit"><img src="<?= $site_url ?>/img/info/chk-icon.png"/> 오감활용교육</p>
                    <p class="txt ">
                        오감을 활용한 체험 활동으로 특수교육에 다양한 이야기를 담아냅니다.<br style="display: block !important;">
                        <br style="display: block !important;">
                        * 시각장애인 대상 오감워크숍(청각/촉각/후각)<br style="display: block !important;">
                        * 발달장애인 대상 오감 체험 교육
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section section03">
    <div class="wrapper">
        <p class="sc-sub">Performance Data</p>
        <p class="sc-title">오디오 콘텐츠 실적 데이터 <span class="sub-txt">(2023년 기준)</span></p>
        <div class="flex-wrap">
            <div class="item">
                <p class="label label1"><?= $data['data_cnt1'] ?></p>
                <img class="arrow" src="<?= $site_url ?>/img/info/s03-arrow1.png">
                <img class="chart" src="<?= $site_url ?>/img/info/s03-chart1.png">
                <p class="txt">교육 진행 수 (개)</p>
            </div>
            <div class="item">
                <p class="label label3"><?= $data['data_cnt2'] ?></p>
                <img class="arrow" src="<?= $site_url ?>/img/info/s03-arrow3.png">
                <img class="chart" src="<?= $site_url ?>/img/info/s03-chart3.png">
                <p class="txt">수강생 수 (명)</p>
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
