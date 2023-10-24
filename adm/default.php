<?
header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');
if( isset( $_SESSION[ 'manager_id' ] ) ) {
    $adm_login = TRUE;
}

if ( !$adm_login ) {
    ?>
    <script>

    </script>
    <meta http-equiv="refresh" content="0;url=bbs/login.php" />
    <?
}

?>

<script type="text/javascript">

    $( document ).ready(function() {
        $('.navbar-toggler').click(function(){
            $('body').toggleClass('sidebar-open');
        });
        $(".sidebar-wrapper .nav li").click(function (){
            if($(this).hasClass("toggle-open")){
                $(this).find(".submenu").slideUp("300");

                $(this).removeClass("toggle-open");
            } else {
                $(this).find(".submenu").slideDown("300");
                $(this).addClass("toggle-open");
            }
        });
    });

</script>



<body>
<!-- admin menu -->
<div class="gnb-container">
    <div class="sidebar">
        <div class="brand-wrapper">
            <a class="brand" >라이프에디트</a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li <?php if($menu == 0  || $menu == "") echo "class='active'" ?> >
                    <a class="menu" href="<?= $site_url ?>/index.php?menu=0">
                        <i class="fas fa-chart-bar"></i>
                        <p>로그관리</p>
                    </a>
                </li>
                <li <?php if($menu == 11) echo "class='active'" ?> >
                    <a class="menu" href="<?= $site_url ?>/member/member_list.php?menu=11">
                        <i class="fas fa-users"></i>
                        <p>회원관리</p>
                    </a>
                </li>
                <li <?php if($menu == 22) echo "class='active'" ?> >
                    <span class="menu" href="<?= $site_url ?>/main_settting/banner_list.php?menu=22">
                        <i class="fas fa-home"></i>
                        <p>메인 페이지 관리</p>
                        <i class="fas fa-chevron-down toggle"></i>
                    </span>
                    <div class="submenu">
                        <a href="<?= $site_url ?>/main_settting/banner_list.php?menu=22">메인 배너 관리</a>
                        <a href="<?= $site_url ?>/main_settting/partner_list.php?menu=22">파트너 관리</a>
                    </div>
                </li>
                <li <?php if($menu == 88) echo "class='active'" ?> >
                    <span class="menu" href="<?= $site_url ?>/about/history_list.php?menu=88">
                        <i class="far fa-building"></i>
                        <p>회사소개 관리</p>
                        <i class="fas fa-chevron-down toggle"></i>
                    </span>
                    <div class="submenu">
                        <a href="<?= $site_url ?>/about/history_list.php?menu=88">연혁 관리</a>
                        <a href="<?= $site_url ?>/about/awards_list.php?menu=88">수상 내역 관리</a>
                    </div>
                </li>
                <li <?php if($menu == 55) echo "class='active'" ?> >
                    <span class="menu" href="<?= $site_url ?>/culture/performance.php?menu=55">
                        <i class="far fa-smile"></i>
                        <p>문화 사업 관리</p>
                        <i class="fas fa-chevron-down toggle"></i>
                    </span>
                    <div class="submenu">
                        <a href="<?= $site_url ?>/culture/performance.php?menu=55">공연 사업 관리</a>
                        <a href="<?= $site_url ?>/culture/audio.php?menu=55">오디오콘텐츠 사업 관리</a>
                        <a href="<?= $site_url ?>/culture/event.php?menu=55">축제/행사 사업 관리</a>
                    </div>
                </li>
                <li <?php if($menu == 66) echo "class='active'" ?> >
                    <a class="menu" href="<?= $site_url ?>/edu/edu.php?menu=66">
                        <i class="fas fa-user-graduate"></i>
                        <p>교육 사업 관리</p>
                    </a>
                </li>
                <li <?php if($menu == 77) echo "class='active'" ?> >
                    <span class="menu" href="<?= $site_url ?>/lab/lab.php?menu=77">
                        <i class="fas fa-vial"></i>
                        <p>라이프에디트랩 관리</p>
                        <i class="fas fa-chevron-down toggle"></i>
                    </span>
                    <div class="submenu">
                        <a href="<?= $site_url ?>/lab/lab.php?menu=77">프로젝트 관리</a>
                    </div>
                </li>
                <li <?php if($menu == 99) echo "class='active'" ?> >
                    <a class="menu" href="<?= $site_url ?>/portfolio/portfolio_list.php?menu=99">
                        <i class="fas fa-scroll"></i>
                        <p>포트폴리오 관리</p>
                    </a>
                </li>
                <li <?php if($menu == 1) echo "class='active'" ?> >
                    <a class="menu" href="<?= $site_url ?>/apply_list.php?menu=1">
                        <i class="far fa-envelope"></i>
                        <p>문의관리</p>
                    </a>
                </li>
                <li <?php if($menu == 2) echo "class='active'" ?> >
                    <a class="menu" href="<?= $site_url ?>/config_form.php?menu=2">
                        <i class="fas fa-list-ul"></i>
                        <p>기본 설정</p>
                    </a>
                </li>
                <li <?php if($menu == 3) echo "class='active'" ?> >
                    <a class="menu" href="<?= $site_url ?>/popup_list.php?menu=3">
                        <i class="far fa-clone"></i>
                        <p>팝업 설정</p>
                    </a>
                </li>
                <li <?php if($menu == 44) echo "class='active'" ?> >
                    <span class="menu" href="<?= $site_url ?>/board/notice_list.php?menu=44">
                        <i class="fas fa-chalkboard"></i>
                        <p>게시판 관리</p>
                        <i class="fas fa-chevron-down toggle"></i>
                    </span>
                    <div class="submenu">
                        <a href="<?= $site_url ?>/board/notice_list.php?menu=44">공지사항 관리</a>
                        <a href="<?= $site_url ?>/board/community_list.php?menu=44">커뮤니티 관리</a>
                        <a href="<?= $site_url ?>/board/news_list.php?menu=44">언론보도 관리</a>
                    </div>
                </li>
                <li <?php if($menu == 4) echo "class='active'" ?> >
                    <a href="<?= $site_url ?>/manager_list.php?menu=4">
                        <i class="far fa-user"></i>
                        <p>담당자 설정</p>
                    </a>
                </li>
            </ul>
            <div class="service-center-wrap">
                <p class="tit"><i class="fas fa-headphones"></i> 고객센터</p>
                <p class="text">사용 중인 관리서비스에<br>필요한 내용을 확인하세요.</p>
                <a href="service_center.php?menu=10">고객센터</a>
            </div>
        </div>

    </div>
</div>

<!-- 컨텐츠 영역 시작 -->
<div class="main-wrapper" id="wrapper">

    <!-- 상단 레이아웃 -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-wrapper">
                <div class="navbar-toggle">
                    <button type="button" class="navbar-toggler">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </button>
                </div>
                <!--a class="navbar-brand" href="apply_list.php">예반스</a-->
            </div>
            <div class="navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/adm/apply_list.php"><i class="fas fa-redo-alt"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="./ajax/logout.php?is_login=<?= $adm_login ?>"> <i class="fas fa-sign-out-alt"></i></a>

                    </li>
                    <li class="nav-item">
                        <a href="/index.php"> <i class="fas fa-home"></i> </a>
                    </li>
                </ul>

            </div>

        </div>
    </nav>


    <div class="panel-header"></div>

    <div id="container">
        <div class="content-box-wrap">
            <div class="box">
                <div class="page-header">
