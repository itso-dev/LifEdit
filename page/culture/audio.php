<?php
include_once('../../head.php');

$contents_sql = "select * from contents_tbl where id = 2";
$contents_stt=$db_conn->prepare($contents_sql);
$contents_stt->execute();
$data = $contents_stt -> fetch();

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
        background: url("<?= $site_url ?>/img/info/audio-bg.png");
    }
</style>
<div class="page-top-banner">
    <p class="title">오디오 콘텐츠</p>
    <p class="sub">Audio Contents</p>
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
        당신의 이야기를 <br class="mobile">목소리로 풀어내는,<br>
        <strong>오디오 콘텐츠</strong>
    </p>
    <p class="txt">
        라이프에디트는 목소리의 가치를 살려 <br class="mobile">오디오 콘텐츠를 제작합니다.<br>
        <br>
        라이프에디트의 오디오 콘텐츠는<br>
        귀로만 들어도 이해할 수 있는 <br class="mobile">자세한 묘사와 스토리텔링<br>
        다양한 음향효과를 통해 이야기를 전달합니다.<br>
        <br>
        시각장애인이 직접 참여하는 오디오 콘텐츠는<br>
        공연예술 작품부터 오디오 해설까지 제작 가능합니다.<br>
        <br>
        오디오 콘텐츠 기획부터 제작, 배포까지 한 번에,<br>
        남다른 오디오 전문가에게 맡겨보세요.
    </p>
</div>
<div class="section section02">
    <div class="wrapper">
        <div class="img-wrap" style="background: url('<?= $img_file1 ?>')"></div>
        <div class="flex-wrap">
            <div class="left">
                <p class="sc-sub">Difference</p>
                <p class="sc-title">오디오 콘텐츠 차별점</p>
                <a class="download" href="<?= $file ?>" download="<?= $data['file_name'] ?>"><img src="<?= $site_url ?>/img/info/down-icon.png"/> 사업 소개 다운로드</a>
            </div>
            <div class="right">
                <div class="line">
                    <div class="step">01</div>
                    <div class="step-mobile"><img src="<?= $site_url ?>/img/info/s02-step1.png"></div>
                    <div class="txt-wrap">
                        <p class="tit">스토리로 이해하는 오디오 콘텐츠</p>
                        <p class="txt">스토리텔링 기법으로 자세한 묘사를 통해<br>
                            귀로만 듣고도 이해하는 콘텐츠를 제작합니다.</p>
                    </div>
                </div>
                <div class="line">
                    <div class="step">02</div>
                    <div class="step-mobile"><img src="<?= $site_url ?>/img/info/s02-step2.png"></div>
                    <div class="txt-wrap">
                        <p class="tit">시각장애인이 참여한 오디오 콘텐츠</p>
                        <p class="txt">
                            시각장애인 목소리 배우를 양성하고 오디오 콘텐츠를 제작합니다.
                        </p>
                    </div>
                </div>
                <div class="line">
                    <div class="step">03</div>
                    <div class="step-mobile"><img src="<?= $site_url ?>/img/info/s02-step3.png"></div>
                    <div class="txt-wrap">
                        <p class="tit">접근성으로 확장하는 오디오 콘텐츠</p>
                        <p class="txt">
                            모두를 위한 접근성, 화면해설 분야로 사업을 확장합니다.
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
                <p class="sc-title">공연 상품 소개</p>
            </div>
            <div class="right">
                <div class="info-line">
                    <p class="tit"><img src="<?= $site_url ?>/img/info/chk-icon.png"/> 입체 오디오 극</p>
                    <p class="txt">
                        암한편의 뮤지컬을 집에서 편안히 들을 수 있는 오디오 뮤지컬
                    </p>
                </div>
                <div class="info-line">
                    <p class="tit"><img src="<?= $site_url ?>/img/info/chk-icon.png"/> 오디오 해설</p>
                    <p class="txt flex">
                        <span>
                            <strong>전시 오디오 해설</strong>
                            스토리텔링으로 듣는 전시 해설
                        </span>
                        <span>
                            <strong>여행지 오디오 해설</strong>
                            스토리텔링으로 듣는 여행지 해설
                        </span>
                    </p>
                </div>
                <div class="info-line">
                    <p class="tit"><img src="<?= $site_url ?>/img/info/chk-icon.png"/> 접근성/화면해설</p>
                    <p class="txt">
                        모두를 위한 정보 접근성 향상을 위한 화면해설
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
                <p class="txt">오디오 콘텐츠 수 (개)</p>
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
                    <span class="category">오디오 컨텐츠</span>
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
