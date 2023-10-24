<?php
include_once('../../head.php');

if(!isset($_SESSION['m_id'])){
    echo "<script type='text/javascript'>";
    echo "alert('로그인이 필요한 게시물 입니다.'); location.href=' $site_url/page/bbs/login.php'";
    echo "</script>";
}

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
}else{
    echo "<script type='text/javascript'>";
    echo "alert('잘못된 접근입니다.'); location.href='community.php'";
    echo "</script>";    }


$board_sql = "select * from community_tbl where id = $id";
$board_stt = $db_conn->prepare($board_sql);
$board_stt->execute();
$board = $board_stt->fetch();

//View Count
$view_sql = "UPDATE community_tbl set view_cnt = view_cnt + 1 where id = " .$id;
$viewStmt = $db_conn->prepare($view_sql);
$viewStmt->execute();

// File List
$file_sql = "select * from community_file_tbl where fk_id = $id";
$file_stt=$db_conn->prepare($file_sql);
$file_stt->execute();


//Prev Board
$prev_sql = "select * from community_tbl where id < " .$id ." order by id desc limit 1";
$prev_stt = $db_conn->prepare($prev_sql);
$prev_stt->execute();
$prev = $prev_stt->fetch();
if($prev){
    $prev_title = $prev['title'];
    $prev_href = "community-detail.php?id={$prev['id']}";
}
//Next Board
$next_sql = "select * from community_tbl where id > " .$id ." order by id ASC limit 1";
$next_stt = $db_conn->prepare($next_sql);
$next_stt->execute();
$next = $next_stt->fetch();
if($next){
    $next_title = $next['title'];
    $next_href = "community-detail.php?id={$next['id']}";
}
?>
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/board.css" rel="stylesheet" />

<article id="board">
    <p class="page-title">Community</p>
    <h3 class="page-title-sub">커뮤니티</h3>
    <div class="board-detail-container">
        <div class="head-wrap">
            <div class="title-wrap">
                <?= $board['title'] ?>
            </div>
            <div class="board-info">
                <div class="share">
                    <img src="<?= $site_url ?>/img/common/share-icon.png">
                    <div class="share-box">
                        <div class="item" id="kakaoShare">
                            <img src="<?= $site_url ?>/img/common/kakao.png">
                            카카오
                        </div>
                        <div class="item" onclick="facebook();">
                            <img src="<?= $site_url ?>/img/common/face.png">
                            페이스북
                        </div>
                        <div class="item" onclick="clip();">
                            <img src="<?= $site_url ?>/img/common/Attach.png">
                            링크복사
                        </div>
                    </div>
                </div>
                <span class="date"><?= str_replace('-', '.', substr($board['regdate'], 0, 10)) ?></span>
                <span class="view">조회수 · <?= $board['view_cnt'] ?></span>
            </div>
        </div>
        <div class="body-wrap">
            <?= $board['content_desc'] ?>
        </div>

        <div class="upload-wrap">
            <p class="upload-tit">첨부파일</p>
            <?php
            while($file=$file_stt->fetch()){
            ?>
            <a class="file" href="<?= $site_url ?>/data/community/<?= $file['chg_name'] ?>" download="<?= $file['file_name'] ?>" >
                <img class='icon' src='<?= $site_url ?>/img/common/file-icon.png'>
                <span class='name'><?= $file['file_name'] ?></span>
            </a>
            <? } ?>
        </div>
        <div class="foot-wrap">
            <? if($prev){ ?>
                <div class="item">
                    <span class="s">이전글</span>
                    <a href="<?= $prev_href ?>" class="t"><?= $prev_title ?></a>
                </div>
            <? } ?>
            <? if($next){ ?>
                <div class="item">
                    <span class="s">다음글</span>
                    <a href="<?= $next_href ?>" class="t"><?= $next_title ?></a>
                </div>
            <? } ?>
        </div>
        <a class="go-back" href="javascript:window.history.back();">목록</a>
    </div>
</article>



<script>
    $(".share").click(function (){
        if($(".share").hasClass('open')){
            $(this).find(".share-box").hide();
            $(this).removeClass("open");
        }else{
            $(this).find(".share-box").show();
            $(this).addClass("open");
        }
    });

    function facebook() {
        var thisUrl = window.location.href;
        var url = "http://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(thisUrl);
        window.open(url, "", "width=486, height=286");
    }
    function clip(){

        var url = '';
        var textarea = document.createElement("textarea");
        document.body.appendChild(textarea);
        url = window.document.location.href;
        textarea.value = url;
        textarea.select();
        document.execCommand("copy");
        document.body.removeChild(textarea);
        alert("URL이 복사되었습니다.")
    }

    var kakaoShareData = {
        container: '#kakaoShare',
        objectType: 'feed',
        content: {
            title: '<?= $board['title'] ?>',
            description: '라이프에디트 커뮤니티',
            imageUrl:
                'https://lifedit.co.kr/img/kakaothumb.png',
            link: {
                mobileWebUrl: window.location.href,
                webUrl: window.location.href,
            },
        },
    };
    Kakao.init('45ad659b498fb70e9daf35a7fe79b873'); // JavaScript 키
    Kakao.Share.createDefaultButton(kakaoShareData);
</script>


<?php
include_once('../../tale.php');
?>
