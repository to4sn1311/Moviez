<?php
include '../connect.php';
include '../control.php';

$news = new News();
$limit = isset($_POST['limit']) ? intval($_POST['limit']) : 6;
$offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
$each_news = $news->selectAllwithLimit($limit, $offset);

while ($each_new = mysqli_fetch_array($each_news)) {
    ?>
    <hr>
    <div class="hang">
        <div class="cot cot-3 tablet-cot-12 mobile-cot-12">
            <div class="news-thumbnails">
                <a href="test-detail.php?nid=<?php echo $each_new["post-ID"] ?>"><img
                        src="../ADMIN/postimages/<?php echo $each_new["post-image"] ?>" alt=""
                        class="thumb-3"></a>
            </div>
        </div>
        <div class="cot cot-9 tablet-cot-12 mobile-cot-12">
            <a href="test-detail.php?nid=<?php echo $each_new["post-ID"] ?>">
                <h3><?php echo $each_new["post-title"] ?></h3>
            </a>
            <p><?php echo $each_new['post-des'] ?></p>
            <p><span style="color: red;"><a
                        href="category-detail.php?catid=<?php echo $each_new['category_id'] ?>"><?php echo $each_new['category_name'] ?></a></span>
                / <?php echo $each_new['post-date'] ?></p>
            <a href="bookmark.php?bid=<?php echo $each_new["post-ID"] ?>"><i
                    style="background-color: #f5f5f7; border: none; font-size: 35px; margin-left: 45dvw"
                    class="fa-solid fa-circle-plus"></i>
                </a>
        </div>
    </div>
    <?php
}
?>
