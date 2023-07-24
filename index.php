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
?>

<link rel="stylesheet" type="text/css" href="css/index.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="css/reset.css" rel="stylesheet" />
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<script src='https://www.google.com/recaptcha/api.js'></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<!-- recapture -->
<script src='https://www.google.com/recaptcha/api.js?render=6LcLwBwnAAAAANtwRmDwYZOnnULJtKw5VvmjMC85'></script>



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

<audio id="audio" autoplay type="audio/mp3">
    <source src="bgm.mp3">
</audio>
<!-- Menu Navi    -->
<div class="nav-wrap">
    <img class="logo" src="img/logo-top.png">
    <div class="pc-menu-wrap">
        <ul>
            <li><a href="#menu1">브랜드</a></li>
            <li><a href="#menu2">경쟁력</a></li>
            <li><a href="#menu3">상권안내</a></li>
            <li><a href="#menu4">성공전략</a></li>
            <li><a href="#menu5">문의하기</a></li>
        </ul>
    </div>
    <i class="fas fa-bars menu-open"></i>
</div>
<div class="sidebar-wrap">
    <div class="menu-container">
        <div class="close-wrap">
            <i class="far fa-times-circle menu-close"></i>
        </div>
        <div class="menu-wrap">
            <a href="#menu1">브랜드</a>
        </div>
        <div class="menu-wrap">
            <a href="#menu2">경쟁력</a>
        </div>
        <div class="menu-wrap">
            <a href="#menu3">상권안내</a>
        </div>
        <div class="menu-wrap">
            <a href="#menu4">성공전략</a>
        </div>
        <div class="menu-wrap">
            <a href="#menu5">문의하기</a>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('.menu-open').click(function () {
            $(".sidebar-wrap").animate({
                width: 500
            });
        });
        $('.menu-close').click(function () {
            $(".sidebar-wrap").animate({
                width: 0
            });
        });

    });
</script>


<form name="contact_form" id="contact_form" method="post" action="contact_write.php" onsubmit="return FormSubmit();">
    <input type="hidden" name="writer_ip" value="<?= get_client_ip() ?>" />
    <input type="hidden" name="action" value="go">
    <div class="contact-container" id="menu5">
        <div class="contact-wrap">
            <div class="input-item">
                <div class="label-wrap">
                    <p>성함</p>
                </div>
                <div class="input-wrap">
                    <input type="text" name="name" required>
                </div>
            </div>
            <div class="input-item">
                <div class="label-wrap">
                    <p>연락처</p>
                </div>
                <div class="input-wrap">
                    <input type="text" name="phone" required>
                </div>
            </div>
            <div class="input-item">
                <div class="label-wrap">
                    <p>창업희망지역</p>
                </div>
                <div class="input-wrap">
                    <input type="text" name="location" required>
                </div>
            </div>
            <div class="input-item">
                <div class="label-wrap">
                    <p>희망창업비용</p>
                </div>
                <div class="input-wrap">
                    <input type="text" name="price" required>
                </div>
                <span class="sub">만원</span>
            </div>
            <div class="input-item">
                <div class="label-wrap">
                    <p>문의사항</p>
                </div>
                <div class="input-wrap">
                    <textarea name="contact_desc"></textarea>
                </div>
            </div>
        </div>
        <div class="agreement-wrap">
            <div class="agreement">
                <p class="tit">&#60;개인정보 취급방침&#62;</p>
                <p class="content">
                    작성하신 실명과 전화번호는 개인정보 보호법 제 15조 및 22조에 의거, 상담접수 및 서비스제공 용도로만 사용되며 랜딩접수가 진행되는기간 동안만 보관하게 됩니다.<br>
                    수집 개인정보는 이름 및 휴대전화 번호이며 랜딩접수 및 서비스제공의 목적으로만 사용됩니다.<br>
                    <br>
                    - 개인정보 수집, 이용 목적 : 랜딩접수 및 서비스제공<br>
                    - 수집하려는 개인정보 항목 : 이름, 휴대폰 번호<br>
                    - 개인정보의 보유 및 이용기간 : 랜딩페이지 사용 종료 후 , 서비스 안내 일주일 후 파기
                </p>
            </div>
            <div class="agree-wrap">
                <label>
                    <input type="checkbox" name="agree" required>
                    개인 정보 취급 방침에 동의
                </label>
            </div>
            <input class="submit-btn" type="submit" value="창업 문의하기" class="g-recaptcha" data-sitekey="6LeIUPcmAAAAAKknvdvB6rUxzAeGwrQrm3tGMnrV" data-callback='frmSubmit' data-action='submit'  />
        </div>
    </div>
</form>

<!-- floating -->
<div class="floating-container">
    <div class="floating-wrap">
        <div class="right-wrap item">
            <div class="item-wrap" id="call" onclick="location.href='tel:031-932-2030'"
                onMouseDown="javascript:_PL('http://www.yevans.com/call.php');">
                <div class="icon-wrap">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <div class="text-wrap">
                    <p>창업문의</p>
                    <p>1668-1350</p>
                </div>
            </div>
        </div>
        <div class="left-wrap item">
            <div class="item-wrap" onclick="location.href='#menu5   '">
                <div class="icon-wrap">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <div class="text-wrap">
                    <p>24시간 접수</p>
                    <p>가맹상담 신청</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    AOS.init();

    grecaptcha.ready(function() {
        grecaptcha.execute('6LcLwBwnAAAAANtwRmDwYZOnnULJtKw5VvmjMC85', {action: 'submit'}).then(function(token) {
            document.getElementById('g-recaptcha').value = token;
        });
    });

    window.onpageshow = function(event) {
        if (event.persisted || (window.performance && window.performance.navigation.type == 2)) {
            // Back Forward Cache로 브라우저가 로딩될 경우 혹은 브라우저 뒤로가기 했을 경우
            location.href = "/";
        }
    }


    $(document).ready(function () {

        var $w = $(window),
            footerHei = $('.contact-wrap').outerHeight(),
            $floating = $('.floating-container');

        $w.on('scroll', function () {

            var sT = $w.scrollTop();
            var val = $(document).height() - $w.height() - footerHei;

            if (sT >= val)
                $floating.fadeOut('600');
            else
                $floating.fadeIn('600');

        });


    });
    $(function () {

        var banchan = new Swiper(".banchan-container", {
            slidesPerView: 3,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            breakpoints: {
                0: {
                    slidesPerView: 3,
                    spaceBetween: 10
                },
                768: {
                    slidesPerView: 5,
                    spaceBetween: 20
                },
                1024: {
                    slidesPerView: 6,
                    spaceBetween: 20
                },
            }
        });

    });
</script>

<!--문자 알림-->
<script type="text/javascript">
    function setPhoneNumber(val) {
        var numList = val.split("-");
        document.smsForm.sphone1.value = numList[0];
        document.smsForm.sphone2.value = numList[1];
        if (numList[2] != undefined) {
            document.smsForm.sphone3.value = numList[2];
        }
    }
    function loadJSON() {
        var data_file = "message_send2.php";
        var http_request = new XMLHttpRequest();
        try {
            // Opera 8.0+, Firefox, Chrome, Safari
            http_request = new XMLHttpRequest();
        } catch (e) {
            // Internet Explorer Browsers
            try {
                http_request = new ActiveXObject("Msxml2.XMLHTTP");

            } catch (e) {

                try {
                    http_request = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {
                    // Eror
                    alert("지원하지 않는브라우저!");
                    return false;
                }

            }
        }
        http_request.onreadystatechange = function () {
            if (http_request.readyState == 4) {
                // Javascript function JSON.parse to parse JSON data
                var jsonObj = JSON.parse(http_request.responseText);
                if (jsonObj['result'] == "Success") {
                    var aList = jsonObj['list'];
                    var selectHtml = "<select name=\"sendPhone\" onchange=\"setPhoneNumber(this.value)\">";
                    selectHtml += "<option value='' selected>발신번호를 선택해주세요</option>";
                    for (var i = 0; i < aList.length; i++) {
                        selectHtml += "<option value=\"" + aList[i] + "\">";
                        selectHtml += aList[i];
                        selectHtml += "</option>";
                    }
                    selectHtml += "</select>";
                    document.getElementById("sendPhoneList").innerHTML = selectHtml;
                }
            }
        }

        http_request.open("GET", data_file, true);
        http_request.send();
    }

</script>
<?php
include_once('tale.php');
?>
