<?php
include_once('../../head.php');

$contents_sql = "select * from contents_tbl where id = 3";
$contents_stt=$db_conn->prepare($contents_sql);
$contents_stt->execute();
$data = $contents_stt -> fetch();

//첫번째 이미지
$img_file1 = $site_url .'/data/contents/' . $data['img_chg_name1'];
//두번째 이미지
$img_file2 = $site_url .'/data/contents/' . $data['img_chg_name2'];
//소개서 파일
$file = $site_url .'/data/contents/' . $data['chg_name'];

$portfolio_sql = "select * from portfolio_tbl where category = 3 and is_notice = 'Y'";
$portfolio_stt = $db_conn->prepare($portfolio_sql);
$portfolio_stt->execute();


$portfolio_thumb_dir = $site_url .'/data/portfolio/';

?>
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/info/common.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/swiper.css" rel="stylesheet" />
<script type="text/javascript" src="<?= $site_url ?>/js/swiper.js"></script>
<style>
    .page-top-banner{
        background: url("<?= $site_url ?>/img/info/event-bg.png");
    }
</style>
<div class="page-top-banner">
    <p class="title">축제/행사</p>
    <p class="sub">Festival / Event</p>
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
        당신의 행사, <br class="mobile"><strong>A부터 Z까지</strong> 책임집니다.
    </p>
    <p class="txt">
        라이프에디트는 6명의 기획자가 모인 협동조합으로<br>
        행사 기획부터 운영, 결과물 그리고 정산과 결과보고까지.<br>
        행사에 필요한 모든 서비스를 원스톱으로 제공합니다.<br>
        <br>
        모든 일을 ‘나의 일’처럼 하는 라이프에디트는<br>
        모두가 함께 즐기고 만족할 수 있는<br class="mobile"> 행사가 되도록 고민하고 또 고민합니다.<br>
        ‘내가 한 명만 더 있었으면 좋겠다’라고 생각하는<br>
        당신을 위한 마지막 선택지,<br>
        라이프에디트와 함께하세요.<br>
    </p>
</div>
<div class="section section02">
    <div class="wrapper">
        <div class="img-wrap" style="background: url('<?= $img_file1 ?>')"></div>
        <div class="flex-wrap">
            <div class="left">
                <p class="sc-sub">Difference</p>
                <p class="sc-title">축제/행사 차별점</p>
                <a class="download" href="<?= $file ?>" download="<?= $data['file_name'] ?>"><img src="<?= $site_url ?>/img/info/down-icon.png"/> 사업 소개 다운로드</a>
            </div>
            <div class="right">
                <div class="line">
                    <div class="step">01</div>
                    <div class="step-mobile"><img src="<?= $site_url ?>/img/info/s02-step1.png"></div>
                    <div class="txt-wrap">
                        <p class="tit">기획부터 결과보고까지<br class="mobile"> 한 번에 진행하는 축제/행사</p>
                        <p class="txt">
                            직접 축제/행사를 기획, 운영해본 구성원들이 기획, 운영뿐만 아니라<br>
                            행정업무 서비스도 한번에 제공합니다.
                        </p>
                    </div>
                </div>
                <div class="line">
                    <div class="step">02</div>
                    <div class="step-mobile"><img src="<?= $site_url ?>/img/info/s02-step2.png"></div>
                    <div class="txt-wrap">
                        <p class="tit">사회적경제조직이 함께<br class="mobile"> 만들어가는 축제/행사</p>
                        <p class="txt">
                            사회적경제조직인 라이프에디트는<br class="mobile"> 다양한 사회적경제 기업과<br> 함께 행사를 만들어 갑니다.
                        </p>
                    </div>
                </div>
                <div class="line">
                    <div class="step">03</div>
                    <div class="step-mobile"><img src="<?= $site_url ?>/img/info/s02-step3.png"></div>
                    <div class="txt-wrap">
                        <p class="tit">모두가 참여할 수 있는<br class="mobile"> 배리어프리 축제/행사</p>
                        <p class="txt">
                            남녀노소, 장애인까지 모두가 함께 참여하고 만들어나가는 행사를 기획합니다.
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
                <p class="sc-title">축제/행사 분야 소개</p>
            </div>
            <div class="right">
                <div class="info-line">
                    <p class="tit"><img src="<?= $site_url ?>/img/info/chk-icon.png"/> 축제 기획/운영</p>
                    <p class="txt">
                        지역의 특색을 살린 축제부터 아이들이 즐길 수 있는 축제까지.<br>
                        다양한 사람들이 함께 모여 즐길 수 있도록 주제와 지역, 대상에 맞춰<br>
                        축제를 기획하고 운영합니다.
                    </p>
                </div>
                <div class="info-line">
                    <p class="tit"><img src="<?= $site_url ?>/img/info/chk-icon.png"/> 행사 기획/운영</p>
                    <p class="txt ">
                        행사 목적에 맞는 프로그램을 구성하고 기획부터 진행까지 모든 단계를<br>
                        성공적으로 계획하여 원활하게 행사를 운영합니다.<br>
                        효율적이고 완성도 높은 행사기획을 함께 고민하고 기획하세요.
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
        <p class="sc-title">오디오 콘텐츠 실적 데이터 <span class="sub-txt">(2023년 기준)</span></p>
        <div class="flex-wrap">
            <div class="item">
                <p class="label label1"><?= $data['data_cnt1'] ?></p>
                <img class="arrow" src="<?= $site_url ?>/img/info/s03-arrow1.png">
                <img class="chart" src="<?= $site_url ?>/img/info/s03-chart1.png">
                <p class="txt">행사 수 (개)</p>
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
                        <span class="category">축제 / 행사</span>
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
