<?php
include_once('../../head.php');

if(!isset($_GET['page']))
{
    $_GET['page']=1;
}

$stx = isset($_POST['skey']) ? $_POST['skey'] : '';

// 검색
if($stx == ""){
    $stx_key = "";
}else{
    $stx_key = " where title like '%$stx%' or writer like '%$stx%'";
}

$list_size = 5;
$page_size = 10;
$first = ($_GET['page']*$list_size)-$list_size;

// 리스트에 출력하기 위한 sql문
$admin_sql = "select * from news_tbl"
    .$stx_key
    ." order by id desc limit $first, $list_size";
$admin_stt=$db_conn->prepare($admin_sql);
$admin_stt->execute();

//총 페이지를 구하기 위한 sql문
$total_sql = "select count(*) from news_tbl";
$total_stt=$db_conn->prepare($total_sql);
$total_stt->execute();
$total_row=$total_stt->fetch();

$total_list = $total_row['count(*)'];
$total_page = ceil($total_list/$list_size);
$row = ceil($_GET['page']/$page_size);

$start_page=(($row-1)*$page_size)+1;

$dir = $site_url .'/data/news/';
?>
<link rel="stylesheet" type="text/css" href="<?= $site_url ?>/css/board.css" rel="stylesheet" />

<article id="board">
    <p class="page-title">News</p>
    <h3 class="page-title-sub">언론보도</h3>
    <div class="search-container">
        <form method="post">
            <div class="search-wrap">
                <div class="input-wrap">
                    <input type="text" name="skey" placeholder="검색어를 입력해 주세요." />
                    <img src="<?= $site_url ?>/img/common/search-icon.png" class="icon">
                </div>
                <input type="submit" class="search-btn" value="검색"/>
            </div>
        </form>
    </div>
    <div class="gly-style-container">
        <?php
        $data = 0;
        while($list=$admin_stt->fetch()){
            $data = 1;
            $file = $list['chg_name'];

            $textContent = strip_tags($list['content_desc']); // 모든 HTML 태그 제거
            $maxTextLength = 200; // 최대 길이 설정
            if (mb_strlen($textContent) > $maxTextLength) {
                $shortText = mb_substr($textContent, 0, $maxTextLength) . '...'; // 일부만 표시
            } else {
                $shortText = $textContent; // 전체 내용 표시
            }
        ?>
         <div class="item" onclick="location.href='news-detail.php?id=<?= $list['id']  ?>'">
            <div class="img-wrap" style="background: url('<? echo $dir .$file ?>')"></div>
             <div class="info-wrap">
                <p class="info">
                    <span class="date"><?= str_replace('-', '.', substr($list['regdate'], 0, 10)) ?></span>
                    <span class="view">조회수 · <?=$list['view_cnt']?></span>
                </p>
                 <p class="title"><?=$list['title']?></p>
                 <p class="preview"><?= $shortText ?></p>
             </div>
         </div>
        <? } ?>
        <? if($data == 0){ ?>
            <p class="no-data">게시글이 없습니다.</p>
        <? } ?>
    </div>
    <div class="paging-wrap">
        <?php
        if($start_page<=0){
            $start_page = 1;
        }
        $end_page=($start_page+$page_size)-1;
        if($total_page<$end_page){
            $end_page=$total_page;
        }
        if($_GET['page']!=1){
            $back=$_GET['page']-$page_size;
            if($back<=0){
                $back= $_GET['page'] - 1;
            }
            echo "<a href='$_SERVER[PHP_SELF]?page=$back' class='prev'>이전</a>";
        }
        for($i=$start_page; $i<=$end_page; $i++){
            if($_GET['page']!=$i){
                echo "  <a href='$_SERVER[PHP_SELF]?page=$i'>";
                echo "      $i";
                echo "  </a>";
            }else{
                echo "  <span class='active'>";
                echo "      $i";
                echo "  </span>";
            }
        }
        if($_GET['page']!=$total_page){
            $next=$_GET['page']+$page_size;
            if($total_page<$next){
                $next= $_GET['page'] + 1;
            }
            echo "<a class='next' href='$_SERVER[PHP_SELF]?page=$next'>다음</a>";
        }
        ?>

    </div>
</article>


<script>

</script>

<?php
include_once('../../tale.php');
?>
