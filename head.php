<?php
header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');
session_start();

$site_path = $_SERVER["DOCUMENT_ROOT"]."/Lifedit";
$site_url = "http://".$_SERVER["HTTP_HOST"]."/Lifedit";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once($site_path.'/db/dbconfig.php');

//사이트 정보 쿼리
$site_info_sql = "select * from site_setting_tbl";
$site_info_stt=$db_conn->prepare($site_info_sql);
$site_info_stt->execute();
$site = $site_info_stt -> fetch();

?>

<!doctype html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes">
    <meta name="HandheldFriendly" content="true">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="imagetoolbar" content="no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta property="og:title" content="<?=$site[1]?>" />
    <meta property="og:description" content="<?=$site[2]?>" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <title><?=$site[1]?></title>

    <link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/common.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/reset.css" rel="stylesheet" />

    <!-- CSS only -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" rel="stylesheet" />

    <script type="text/javascript" src="<?= $site_url ?>/js/jquery-1.12.4.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://developers.kakao.com/sdk/js/kakao.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- recapture -->
    <script src='https://www.google.com/recaptcha/api.js?render=6LcLwBwnAAAAANtwRmDwYZOnnULJtKw5VvmjMC85'></script>

</head>

<body>
<!-- 상단 레이아웃 -->
<header id="header">
    <div class="header_inner pc">
        <div class="logo">
            <a href="/"><img src="<?= $site_url ?>/img/common/header_logo.png"></a>
        </div>
        <nav>
            <ul>
                <li class="menu"><a href="<?= $site_url ?>/page/about.php">회사소개</a></li>
                <li class="menu"><a href="<?= $site_url ?>/page/culture/performance.php">문화 사업</a>
                    <ul class="dep2 submenu">
                        <li><a href="<?= $site_url ?>/page/culture/performance.php">공연</a></li>
                        <li><a href="<?= $site_url ?>/page/culture/audio.php">오디오 콘텐츠</a></li>
                        <li><a href="<?= $site_url ?>/page/culture/event.php">축제 / 행사</a></li>
                    </ul>
                </li>
                <li class="menu"><a href="<?= $site_url ?>/page/sharing.php">교육 사업</a></li>
                <li class="menu"><a href="<?= $site_url ?>/page/lab.php">라이프에디트 랩</a></li>
                <li class="menu"><a href="<?= $site_url ?>/page/portfolio/portfolio.php">포트폴리오</a></li>
                <li class="menu"><a href="<?= $site_url ?>/page/board/notice.php">라이프에디트 소식</a>
                    <ul class="dep2 submenu">
                        <li><a href="<?= $site_url ?>/page/board/notice.php">공지사항</a></li>
                        <li><a href="<?= $site_url ?>/page/board/news.php">언론보도</a></li>
                    </ul>
                </li>
                <li class="menu"><a href="<?= $site_url ?>/contact.php">문의하기</a></li>
                <?php if(isset($_SESSION['m_id'])){ ?>
                <li class="menu"><a href="<?= $site_url ?>/page/board/community.php">커뮤니티</a></li>
                <?php } ?>
            </ul>
        </nav>
        <?php if(isset($_SESSION['m_id'])){ ?>
        <div class="login_div member">
            <a href="<?= $site_url ?>/page/bbs/ajax/logout.php">로그아웃</a>
        </div>
        <?php } else { ?>
        <div class="login_div">
            <a href="<?= $site_url ?>/page/bbs/join01.php">회원가입</a>
            <a href="<?= $site_url ?>/page/bbs/login.php">로그인</a>
        </div>
        <?php } ?>
    </div>
    <!--
        ################### mo header
    -->
    <div class="header_inner mobile">
        <div class="logo">
            <a href="/"><img src="<?= $site_url ?>/img/common/header_logo.png"></a>
        </div>
        <div class="login_div">
            <?php if(isset($_SESSION['m_id'])){ ?>
                <a class="member" href="<?= $site_url ?>/page/bbs/ajax/logout.php">로그아웃</a>
            <?php } else { ?>
                <a href="<?= $site_url ?>/page/bbs/join01.php">회원가입</a>
                <a href="<?= $site_url ?>/page/bbs/login.php">로그인</a>
            <?php } ?>
            <div class="mobile-menu-open">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <div class="mobile-menu-container">
        <div class="head">
            <img class="mobile-menu-close" src="<?= $site_url ?>/img/common/close.png">
            <img class="logo" src="<?= $site_url ?>/img/common/header_logo.png">
        </div>
        <div class="menu-wrap">
            <div class="menu">
                <a href="<?= $site_url ?>/page/about.php">회사소개</a>
            </div>
            <div class="menu issub">
                <p>문화사업 <img class="arrow" src="<?= $site_url ?>/img/common/right-arrow.png"></p>
                <div class="submenu">
                    <a href="<?= $site_url ?>/page/culture/performance.php">공연</a>
                    <a href="<?= $site_url ?>/page/culture/audio.php">오디오 콘텐츠</a>
                    <a href="<?= $site_url ?>/page/culture/event.php">축제/행사</a>
                </div>
            </div>
            <div class="menu">
                <a href="<?= $site_url ?>/page/sharing.php">교육사업</a>
            </div>
            <div class="menu">
                <a href="<?= $site_url ?>/page/lab.php">라이프에디트 랩</a>
            </div>
            <div class="menu">
                <a href="<?= $site_url ?>/page/portfolio/portfolio.php">포트폴리오</a>
            </div>
            <div class="menu issub">
                <p>라이프에디트 소식 <img class="arrow" src="<?= $site_url ?>/img/common/right-arrow.png"></p>
                <div class="submenu">
                    <a href="<?= $site_url ?>/page/board/notice.php">공지사항</a>
                    <a href="<?= $site_url ?>/page/board/news.php">언론보도</a>
                </div>
            </div>
            <div class="menu">
                <a href="<?= $site_url ?>/contact.php">문의하기</a>
            </div>
            <?php if(isset($_SESSION['m_id'])){ ?>
            <div class="menu">
                <a href="<?= $site_url ?>/page/board/community.php">커뮤니티</a>
            </div>
            <?php } ?>
        </div>
    </div>
</header>
<script>
    $(".header_inner .menu").hover(function (){
            $(this).find(".submenu").show();
        }, function (){
        $(this).find(".submenu").hide();
        }
    );
    $(".mobile-menu-open").click(function (){
        $(".mobile-menu-container").fadeIn("500");
    });
    $(".mobile-menu-close").click(function (){
        $(".mobile-menu-container").fadeOut("500");
    });
    $(".mobile-menu-container .issub").click(function (){
        if($(this).hasClass("open")){
            $(this).removeClass("open");
            $(this).find(".submenu").slideUp('500');
        } else {
            $(this).addClass("open");
            $(this).find(".submenu").slideDown('500');
        }
    });


</script>

<!-- 컨텐츠 시작 -->
<div id="container">
