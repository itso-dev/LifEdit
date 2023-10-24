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

?>
<link rel="stylesheet" type="text/css" href="css/contact.css" rel="stylesheet" />
<script src='https://www.google.com/recaptcha/api.js?render=6LcLwbIoAAAAACWLhaIitmlj_osrDnW7-QjY8DiU'></script>

<article id="contact_article">
    <p class="page-title">Contact</p>
    <h3 class="page-title-sub">문의하기</h3>
    <div id="contact">
        <div class="left">
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3178.604488318752!2d127.0865317896426!3d37.1858692740398!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357b45d71b4eb36b%3A0x8a2492760f4991ad!2z6rK96riw64-EIO2ZlOyEseyLnCDrj5ntg4TquLDtnaXroZwyNzfrsojquLggMTI!5e0!3m2!1sko!2skr!4v1696492220569!5m2!1sko!2skr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="info">
                <p><strong>주&nbsp;&nbsp;&nbsp;&nbsp;소</strong> 경기 화성시 동탄기흥로277번길 12 2604동 1층 1, 2호</p>
                <p><strong>연락처</strong> 0507-1344-1293</p>
                <p><strong>이메일</strong> lifedit.coop@gmail.com</p>
            </div>
        </div>
        <div class="right">
            <form name="contact_form" id="contact_form" method="post" action="contact_write.php" onsubmit="return FormSubmit();">
                <input type="hidden" name="writer_ip" value="<?= get_client_ip() ?>" />
                <div class="tab-wrap">
                    <input type="hidden" name="type" value="견적문의">
                    <span class="tab active">견적문의</span>
                    <span class="tab">협업문의</span>
                    <span class="tab">기타문의</span>
                </div>
                <div class="input-line">
                    <div class="con-input">
                        <p class="label">이름 <strong>*</strong></p>
                        <input type="text" placeholder="이름을 입력해 주세요." name="name" required />
                    </div>
                    <div class="con-input">
                        <p class="label">연락처 <strong>*</strong></p>
                        <input type="text" placeholder="연락처를 입력해 주세요." name="phone" required />
                    </div>
                </div>
                <div class="input-line">
                    <div class="con-input">
                        <p class="label">이메일 <strong>*</strong></p>
                        <input type="email" placeholder="이메일을 입력해 주세요." name="email" required />
                    </div>
                </div>
                <div class="input-line">
                    <div class="con-input">
                        <p class="label">문의 제목 <strong>*</strong></p>
                        <input type="text" placeholder="제목을 입력해 주세요." name="title" required />
                    </div>
                </div>
                <div class="input-line">
                    <div class="con-input">
                        <p class="label">문의 내용 <strong>*</strong></p>
                        <textarea name="contact_desc" placeholder="내용을 입력해 주세요."></textarea>
                    </div>
                </div>
                <div class="agreement-wrap">
                    <label>
                        <input type="checkbox" required>
                        개인정보처리방침 <span>(필수)</span>
                    </label>
                    <span class="more-open">자세히<img src="<?= $site_url ?>/img/contact/arrow-down.png" /></span>
                    <div class="box">
                        <?php include_once('./page/bbs/terms/policy.php'); ?>
                    </div>
                </div>
                <input type="hidden" id="g-recaptcha" name="g-recaptcha">
                <input class="submit" type="submit" value="문의하기" class="g-recaptcha" data-sitekey="6LcLwbIoAAAAACWLhaIitmlj_osrDnW7-QjY8DiU" data-callback='frmSubmit' data-action='submit'  />

            </form>
        </div>
    </div>
</article>

<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6LcLwbIoAAAAACWLhaIitmlj_osrDnW7-QjY8DiU', {action: 'submit'}).then(function(token) {
            document.getElementById('g-recaptcha').value = token;
        });
    });

    $(".tab-wrap .tab").click(function (){
        var text = $(this).text();
        $(".tab-wrap .tab").removeClass("active");
        $(this).addClass("active");
        $("input[name=type]").val(text);
    });
    $(".more-open").click(function (){
        if($(this).hasClass("open")){
            $(this).removeClass("open");
            $(".box").slideUp('500');
        } else {
            $(this).addClass("open");
            $(".box").slideDown('500');
        }
    });
</script>

<?php
include_once('tale.php');
?>
