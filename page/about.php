<?php
include_once('../head.php');

// 리스트에 출력하기 위한 sql문
$history_year_sql = "select * from history_year_tbl order by year asc";
$history_year_stt=$db_conn->prepare($history_year_sql);
$history_year_stt->execute();


// 리스트에 출력하기 위한 sql문
$awards_sql = "select * from awards_tbl order by id";
$awards_stt=$db_conn->prepare($awards_sql);
$awards_stt->execute();

$awards_dir = $site_url .'/data/awards/';

?>
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/about.css" rel="stylesheet" />
<style>
    .page-top-banner{
        background: url("<?= $site_url ?>/img/about/about-banner.png");
    }
</style>
<div class="page-top-banner">
    <p class="title">회사 소개</p>
    <p class="sub">Company introduction</p>
</div>
<div class="section01">
    <p class="t-sub">당신의 이야기를 세상에 들려주는 기획자,</p>
    <p class="t-title">라이프에디트 협동조합</p>
    <span class="line"></span>
    <p class="sc-sub">Who we are</p>
    <p class="sc-title"><strong>라이프에디트,</strong> 우리는 누구일까요?</p>
    <p class="txt">
        <strong>
        "짧은 인생 다양한 경험을 하며 살고 싶어요"<br>
        "다른 사람의 시선이 아닌 나의 행복에 집중하며<br class="tablet"> 나답게 살고 싶어요"<br>
        </strong><br>
        하지만 나만이 아닌 나의 옆에 당신도 당신답게, <br class="tablet">우리 모두 우리 답게 행복하게 사는 세상을 만드는 것.<br>
        꿈 같은 이야기를 함께 하며 탄생하게 된 라이프에디트.<br>
        <br>
        서로 다른 6명이 만든 라이프에디트는<br class="tablet"> 우리 모두 각자 자신답게 또 함께 어울려 사는<br>
        세상을 꿈꾸고 만들어나가는 여정에<br class="tablet"> 함께할 여러분을 위해 열려 있는 곳입니다.<br>
        <br>
        라이프에디트는 세상과 스토리로 소통합니다.<br>
        나의 이야기를, 당신의 이야기를, 우리의 이야기를<br class="tablet"> 스토리를 통해 세상이 공감할 수 있게 합니다.<br>
        공감을 통해 함께할 친구를 만나고<br class="tablet"> 라이프에디트가 꿈꾸는 세상을 만들어 나갑니다.<br>
        <br>
        이야기의 힘을 믿는 사람이라면<br class="tablet"> 망설이지말고 함께하세요.<br>
        라이프에디트가 여러분만의 목소리에 스토리를 입혀<br class="tablet"> 세상을 바꾸는데 함께 하겠습니다.
    </p>
    <img src="<?= $site_url ?>/img/about/s01-img.png">
</div>
<div class="section02">
    <p class="sc-sub">Story</p>
    <p class="sc-title">라이프에디트가 이야기로 <strong class="tablet">세상과 소통하는 이유</strong></p>
    <div class="txt">
        우리는 모두 스토리에 흠뻑 빠져본 적이 있습니다.<br>
        이야기는 다정한 방법이죠. <br class="tablet">강요하지 않고 공감하게 해주니까요.<br>
        우리는 시각장애인의 이야기를 들려주기 위해 <br class="tablet">암전뮤지컬을 시작했습니다.<br>
        아이들에게 인성을 교육하기 위해 <br class="tablet">뮤지컬 동화를 만들었죠..<br>
        여행지의 매력을 담은 그곳의 이야기를 <br class="tablet">오디오 해설로 만듭니다.<br>
        <br>
        라이프에디트는 <span class="colored">이야기로 말하는 기획자</span>입니다.
    </div>
</div>
<div class="section03">
    <div class="wrapper">
        <p class="sc-sub">Mission & Vision & LOGO</p>
        <p class="sc-title">
            <span class="middle">라이프에디트가 전하는</span><br>
            <strong>핵심가치 & 미션비전 & 로고소개</strong>
        </p>
        <p class="top"><strong>MISSION</strong>너를 너답게, 나를 나답게, 우리답게</p>
        <p class="top"><strong>VISION</strong>프로젝트를 통해 장벽없는 세상을 만든다.</p>
    </div>
    <div class="img-wrap">
        <img class="pc" src="<?= $site_url ?>/img/about/s03-img.png">
        <img class="mobile" src="<?= $site_url ?>/img/about/s03-img-mo.png">
    </div>
    <div class="wrapper">
        <p class="bottom">
           <strong>라이프에디트의 미션과 비전,<br class="mobile"> 핵심가치를 담았습니다.</strong><br>
            초록색 f와 i는 삶의 장벽을 함께 뛰어넘고자 하는<br class="mobile"> 라이프에디트의 핵심가치를,<br>
            t는 가장 나다운 모습으로 살아가는<br class="mobile"> 라이프에디트의 미션과 비전을 표현합니다.
        </p>
    </div>
</div>
<div class="section04">
    <div class="wrapper">
        <div class="title-wrap">
            <p class="sc-sub">History</p>
            <p class="sc-title">
                <strong>연혁</strong>
            </p>
        </div>
        <div class="history-container">
            <?php
            while($year=$history_year_stt->fetch()){
                $history_detail_sql = "select * from history_detail_tbl where fk_year =  ".$year['id']." order by month asc";
                $history_detail_stt=$db_conn->prepare($history_detail_sql);
                $history_detail_stt->execute();
            ?>
            <div class="item">
                <p class="year"><?= $year['year'] ?></p>
                <?php
                while($detail=$history_detail_stt->fetch()){?>
                <div class="line">
                    <span class="month"><?= $detail['month'] ?></span>
                    <span class="txt"><?= $detail['content'] ?></span>
                </div>
                <? } ?>
            </div>
            <? } ?>
        </div>
    </div>
</div>
<div class="section05">
    <p class="sc-sub">Awards</p>
    <p class="sc-title">
        <strong>인증 & 수상내역</strong>
    </p>
    <div class="flex-wrap">
        <?php
        while($awards=$awards_stt->fetch()){
        ?>
        <div class="item">
            <div class="img-wrap" style="background: url('<?= $awards_dir .$awards['chg_name'] ?>')"></div>
            <p class="title"><?= $awards['title'] ?></p>
            <p class="txt"><?= $awards['content'] ?></p>
        </div>
        <?php } ?>
    </div>
</div>
<div class="section06">
    <p class="sc-sub">SNS</p>
    <p class="sc-title">
        <strong>둘러보기</strong>
    </p>
    <div class="flex-wrap">
        <div class="item" onclick="window.open('https://youtube.com/@cooplifedit9842?si=a5TDtf0vleMgPsQl')">
            <img class="logo" src="<?= $site_url ?>/img/about/youtube.png"/>
            <p class="name">유튜브</p>
        </div>
        <div class="item" onclick="window.open('https://blog.naver.com/lifedit_')">
            <img class="logo" src="<?= $site_url ?>/img/about/blog.png"/>
            <p class="name">네이버 블로그</p>
        </div>
        <div class="item" onclick="window.open('https://instagram.com/lifedit_coop?igshid=OGQ5ZDc2ODk2ZA==')">
            <img class="logo" src="<?= $site_url ?>/img/about/instagram.png"/>
            <p class="name">인스타그램</p>
        </div>
        <div class="item" onclick="window.open()">
            <img class="logo" src="<?= $site_url ?>/img/about/smartstore.png"/>
            <p class="name">스마트스토어</p>
        </div>
    </div>
</div>

<?php
include_once('../tale.php');
?>
