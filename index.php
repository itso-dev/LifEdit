<?php
include_once('head.php');

function get_client_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
    opcache_reset();
}


//팝업 출력하기 위한 sql문
$popup_sql = "select * from popup_tbl where `end_date` > NOW() order by id ";
$popup_stt = $db_conn->prepare($popup_sql);
$popup_stt->execute();

$today = date("Y-m-d H:i:s");
$view_sql = "insert into view_log_tbl
                              (view_cnt,  reg_date)
                         value
                              (? ,?)";

$db_conn->prepare($view_sql)->execute(
    [1, $today]
);

// 배너 Total
$banner_cnt_sql = "select count(*) as cnt from banner_tbl";
$banner_cnt_stt=$db_conn->prepare($banner_cnt_sql);
$banner_cnt_stt->execute();
$banner_cnt = $banner_cnt_stt->fetch();
// 배너
$banner_sql = "select * from banner_tbl order by b_order";
$banner_stt=$db_conn->prepare($banner_sql);
$banner_stt->execute();
$banner_dir = $site_url ."/data/banner/";

//포트폴리오
$portfolio_sql = "select * from portfolio_tbl where is_main = 'Y'";
$portfolio_stt=$db_conn->prepare($portfolio_sql);
$portfolio_stt->execute();

$portfolio_thumb_dir = $site_url .'/data/portfolio/';


// 파트너 첫째줄
$first_partner_sql = "select * from partner_tbl where row = '1' order by id";
$first_partner_stt=$db_conn->prepare($first_partner_sql);
$first_partner_stt->execute();
// 파트너 둘째줄
$second_partner_sql = "select * from partner_tbl where row = '2' order by id";
$second_partner_stt=$db_conn->prepare($second_partner_sql);
$second_partner_stt->execute();
$partner_dir = $site_url ."/data/partner/";
?>

<link rel="stylesheet" type="text/css" href="css/index.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="css/reset.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="css/swiper.min.css" rel="stylesheet" />
<script type="text/javascript" src="js/swiper.min.js"></script>



<!-- layer popup -->
<?
$arr = array();
$left_count = 0;
$top = 10;
$top2 = 10;
$z_index = 9999;
while ($popup = $popup_stt->fetch()) {
    $arr[] = $popup['id'];
    ?>
    <div class="layer-popup pc"
        style="display: block; width: 80%; max-width: <?= $popup['width'] ?>px; height: <?= $popup['height'] ?>px; top: 10%; left: 5%; z-index: <?= $z_index ?>;">
        <div id="agreePopup<?= $popup['id'] ?>" class="agree-popup-frame">
            <img src="data/popup/<?= $popup['file_name'] ?>" style=" height:calc(<?= $popup['height'] ?>px - 36px);"
                alt="<?= $popup['popup_name'] ?>">
            <div class="show-chk-wrap">
                <a href="javascript:todayClose('agreePopup<?= $popup['id'] ?>', 1);" class="today-x-btn">오늘하루닫기</a>
                <a class="close-popup x-btn">닫기</a>
            </div>
        </div>
    </div>

    <div class="layer-popup mobile"
        style="display: block; width: 80%; max-width: <?= $popup['width_mobile'] ?>px; height: <?= $popup['height_mobile'] ?>px; top: 10%; left: 10%; z-index: <?= $z_index ?>;">
        <div id="agreePopup_mo<?= $popup['id'] ?>" class="agree-popup-frame">
            <img src="data/popup/<?= $popup['file_name_mobile'] ?>" style=" height:calc(<?= $popup['height'] ?>px - 36px);"
                alt="<?= $popup['popup_name'] ?>">
            <div class="show-chk-wrap">
                <a href="javascript:todayClose('agreePopup_mo<?= $popup['id'] ?>', 1);" class="today-x-btn">오늘하루닫기</a>
                <a class="close-popup x-btn">닫기</a>
            </div>
        </div>
    </div>
    <?
    $z_index -= 1;
    $top += 10;
    $top2 += 15;
}
?>

<script>
    // * today popup close
    $(document).ready(function () {
        <?
        for ($i = 0; $i < count($arr); $i++) {
            ?>
            todayOpen('agreePopup<?= $arr[$i] ?>');
            todayOpen('agreePopup_mo<?= $arr[$i] ?>');
        <? } ?>
        $(".close-popup").click(function () {
            $(this).parent().parent().hide();
        });
    });

    // 창열기
    function todayOpen(winName) {
        var blnCookie = getCookie(winName);
        var obj = eval("window." + winName);
        console.log(blnCookie);
        if (blnCookie != "expire") {
            $('#' + winName).show();
        } else {
            $('#' + winName).hide();
        }
    }
    // 창닫기
    function todayClose(winName, expiredays) {
        setCookie(winName, "expire", expiredays);
        var obj = eval("window." + winName);
        $('#' + winName).hide();
    }

    // 쿠키 가져오기
    function getCookie(name) {
        var nameOfCookie = name + "=";
        var x = 0;
        while (x <= document.cookie.length) {
            var y = (x + nameOfCookie.length);
            if (document.cookie.substring(x, y) == nameOfCookie) {
                if ((endOfCookie = document.cookie.indexOf(";", y)) == -1)
                    endOfCookie = document.cookie.length;
                return unescape(document.cookie.substring(y, endOfCookie));
            }
            x = document.cookie.indexOf(" ", x) + 1;
            if (x == 0)
                break;
        }
        return "";
    }

    // 24시간 기준 쿠키 설정하기
    // 만료 후 클릭한 시간까지 쿠키 설정
    function setCookie(name, value, expiredays) {
        var todayDate = new Date();
        todayDate.setDate(todayDate.getDate() + expiredays);
        document.cookie = name + "=" + escape(value) + "; path=/; expires=" + todayDate.toGMTString() + ";"
    }
</script>

<!-- Contents -->
<?php if($banner_cnt['cnt'] != 1){ ?>
<div class="main-banner-container">
    <div class="swiper-wrapper">
        <?php
        while($banner=$banner_stt->fetch()){
        ?>
        <div class="swiper-slide">
            <img onclick="window.open('<?= $banner['url'] ?>')" class="pc" src="<?= $banner_dir .$banner['pc_chg_name'] ?>">
            <img onclick="window.open('<?= $banner['url'] ?>')" class="mobile" src="<?= $banner_dir .$banner['mobile_chg_name'] ?>">
        </div>
        <? } ?>
    </div>
    <div class="swiper-pagination"></div>
</div>
<?php } else {
    $banner=$banner_stt->fetch()
?>
<div class="main-banner-container">
    <img onclick="window.open('<?= $banner['url'] ?>')" class="pc" src="<?= $banner_dir .$banner['pc_chg_name'] ?>">
    <img onclick="window.open('<?= $banner['url'] ?>')" class="mobile" src="<?= $banner_dir .$banner['mobile_chg_name'] ?>">
</div>
<? } ?>
<div class="section01">
    <p class="sc-title">사업소개</p>
    <p class="sc-title-sub">Business introduction</p>
    <div class="flex-wrap pc">
        <img data-aos="fade-right" data-aos-duration="500" src="<?= $site_url ?>/img/main/s01-img1.png">
        <img data-aos="fade-right" data-aos-duration="500" data-aos-delay="150" src="<?= $site_url ?>/img/main/s01-img2.png">
        <img data-aos="fade-right" data-aos-duration="500" data-aos-delay="300" src="<?= $site_url ?>/img/main/s01-img3.png">
        <img data-aos="fade-right" data-aos-duration="500" data-aos-delay="450" src="<?= $site_url ?>/img/main/s01-img4.png">
        <img data-aos="fade-right" data-aos-duration="500" data-aos-delay="600" src="<?= $site_url ?>/img/main/s01-img5.png">
    </div>
    <div class="flex-wrap mobile">
        <img data-aos="fade-right" data-aos-duration="500" src="<?= $site_url ?>/img/main/s01-img1.png">
        <img data-aos="fade-right" data-aos-duration="500" data-aos-delay="150" src="<?= $site_url ?>/img/main/s01-img2.png">
        <img data-aos="fade-right" data-aos-duration="500" data-aos-delay="300" src="<?= $site_url ?>/img/main/s01-img3.png">
        <img data-aos="fade-right" data-aos-duration="500" data-aos-delay="150" src="<?= $site_url ?>/img/main/s01-img4.png">
        <img data-aos="fade-right" data-aos-duration="500" data-aos-delay="300" src="<?= $site_url ?>/img/main/s01-img5.png">
    </div>
</div>
<div class="section02">
    <img class="icon" src="<?= $site_url ?>/img/main/s02-icon.png">
    <p class="sub"  data-aos="fade-down">About Lifedit</p>
    <p class="txt"><span class="colored">스토리</span>로 당신의 사업을 더욱 빛나게</p>
    <a href="" data-aos="flip-up" data-aos-duration="500" data-aos-delay="300">회사 소개</a>
</div>
<div class="section03">
    <div class="flex-wrap first">
        <div class="txt-wrap" >
           <div class="inner">
               <p class="title" data-aos="fade-right" data-aos-duration="500"><strong>공연</strong>( Performance )</p>
               <strong class="title-mo" data-aos="fade-up" data-aos-duration="500">공연</strong>
               <p class="sub-mo">( Performance )</p>
               <p class="txt">
                   스토리가 담긴 특별한 행사 공연을 기획합니다.<br> 울림이 있는 가심비 공연을 만나보세요.
               </p>
               <a class="more">VIEW MORE +</a>
           </div>
        </div>
        <div class="img-wrap">
            <img class="pc-img" data-aos="fade-left" data-aos-duration="500" src="<?= $site_url ?>/img/main/sc03-img1.png">
            <img class="tablet" data-aos="fade-down" data-aos-duration="500" src="<?= $site_url ?>/img/main/s03-img1-mo.png">
        </div>
    </div>
    <div class="flex-wrap second">
        <div class="img-wrap">
            <img class="pc-img" data-aos="fade-right" data-aos-duration="500" src="<?= $site_url ?>/img/main/sc03-img2.png">
            <img class="tablet" data-aos="fade-down" data-aos-duration="500" src="<?= $site_url ?>/img/main/s03-img2-mo.png">
        </div>
        <div class="txt-wrap">
            <div class="inner">
                <p class="title" data-aos="fade-left" data-aos-duration="500"><strong>교육</strong>( Sharing )</p>
                <strong class="title-mo" data-aos="fade-up" data-aos-duration="500">교육</strong>
                <p class="sub-mo">( Sharing )</p>
                <p class="txt">
                    초등 교육 프로그램을 기획합니다.<br>
                    나만의 스토리를 가진 르네상스형 인재로 자라납니다.
                </p>
                <a class="more">VIEW MORE +</a>
            </div>
        </div>
    </div>
    <div class="flex-wrap third">
        <div class="txt-wrap">
            <div class="inner">
                <p class="title" data-aos="fade-right" data-aos-duration="500"><strong>오디오 콘텐츠</strong>( Audio Contents )</p>
                <strong class="title-mo" data-aos="fade-up" data-aos-duration="500">오디오 콘텐츠</strong>
                <p class="sub-mo">( Audio Contents )</p>
                <p class="txt">
                    열린 관광을 위한 오디오 콘텐츠를 제작합니다.<br>
                    모두가 즐길 수 있는 맞춤형 오디오 콘텐츠, 맡겨보세요.
                </p>
                <a class="more">VIEW MORE +</a>
            </div>
        </div>
        <div class="img-wrap">
            <img class="pc-img" data-aos="fade-left" data-aos-duration="500" src="<?= $site_url ?>/img/main/sc03-img3.png">
            <img class="tablet" data-aos="fade-down" data-aos-duration="500" src="<?= $site_url ?>/img/main/s03-img3-mo.png">
        </div>
    </div>
    <div class="flex-wrap fourth">
        <div class="img-wrap">
            <img class="pc-img" data-aos="fade-right" data-aos-duration="500" src="<?= $site_url ?>/img/main/sc03-img4.png">
            <img class="tablet" data-aos="fade-down" data-aos-duration="500" src="<?= $site_url ?>/img/main/s03-img4-mo.png">
        </div>
        <div class="txt-wrap">
            <div class="inner">
                <p class="title" data-aos="fade-left" data-aos-duration="500"><strong>라이프에디트 랩</strong>( Lifedit LAB )</p>
                <strong class="title-mo" data-aos="fade-up" data-aos-duration="500">라이프에디트 랩</strong>
                <p class="sub-mo">( Lifedit LAB )</p>
                <p class="txt">
                    나를 나답게, 너를 너답게, 우리답게<br>
                    선한 영향력을 위한 작당 모의
                </p>
                <a class="more">VIEW MORE +</a>
            </div>
        </div>
    </div>
</div>
<div class="section04">
    <p class="sc-title">포트폴리오</p>
    <p class="sc-title-sub">Portfolio</p>
    <div class="portfolio-slide-container">
        <div class="swiper-wrapper">
            <?php while($pf=$portfolio_stt->fetch()){ ?>
            <div class="swiper-slide"  style="background: url('<?= $portfolio_thumb_dir .$pf['chg_name'] ?>')"></div>
            <? } ?>
        </div>
    </div>
    <a href="<?= $site_url ?>/page/portfolio/portfolio.php">더 알아보기</a>
</div>
<div class="section05">
    <p class="sc-title">파트너</p>
    <p class="sc-title-sub">Partner</p>
    <div class="partner-slide-container">
        <div class="swiper-wrapper">
            <?php
            while($first_partner=$first_partner_stt->fetch()){
            ?>
            <div class="swiper-slide"><img onclick="window.open('<?= $first_partner['url'] ?>')" src="<?= $partner_dir .$first_partner['chg_name'] ?>"></div>
            <? } ?>
        </div>
    </div>
    <div class="partner-slide-container">
        <div class="swiper-wrapper">
            <?php
            while($second_partner=$second_partner_stt->fetch()){
                ?>
                <div class="swiper-slide"><img onclick="window.open('<?= $second_partner['url'] ?>')" src="<?= $partner_dir .$second_partner['chg_name'] ?>"></div>
            <? } ?>
        </div>
    </div>
    <a class="more" href="<?= $site_url ?>/contact.php">
        <img src="<?= $site_url ?>/img/main/s05-icon.png"/>
        문의하기
    </a>
</div>
<script>
    AOS.init();

    $(function () {

        /* 메인 슬라이드 */
        var mainBanner = new Swiper(".main-banner-container", {
            autoplay: {
                delay: 3000, //add
                disableOnInteraction: false,
            },
            observer: true,
            observeParents: true,
            speed: 5000,
            loop: true,
            loopAdditionalSlides: 1,
            slidesPerView: 1,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });

        /*  포트폴리오 슬라이드 */
        var portfolioBanner = new Swiper(".portfolio-slide-container", {
            autoplay: {
                delay: 3000, //add
                disableOnInteraction: false,
            },
            spaceBetween: 20,
            observer: true,
            observeParents: true,
            speed: 5000,
            centeredSlides: true,
            loop: true,
            loopAdditionalSlides: 1,
            slidesPerView: 2.3,
            breakpoints: {
                480: {
                    slidesPerView: 1.3,
                    spaceBetween: 10,
                },
                768: {
                    slidesPerView: 1.3,
                    spaceBetween: 10,
                },
                1024: {
                    slidesPerView: 1.9,
                    spaceBetween: 20,
                },
            }
        });
    });

    /*  파트너 슬라이드 */
    var partnerSlide = new Swiper(".partner-slide-container", {
        slidesPerView: 6.8,
        autoplay: {
            delay: 0, //add
            disableOnInteraction: false,
        },
        observer: true,
        observeParents: true,
        speed: 3000,
        centeredSlides: true,
        loop: true,
        loopAdditionalSlides: 1,
        breakpoints: {
            0: {
                slidesPerView: 2.8,
                spaceBetween: 0
            },
            768: {
                slidesPerView: 2.8,
                spaceBetween: 0
            },
            1024: {
                slidesPerView: 5.8,
                spaceBetween: 0
            },
        }
    });


</script>



<?php
include_once('tale.php');
?>
