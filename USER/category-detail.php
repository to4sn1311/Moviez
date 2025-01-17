<?php
include 'include/header.php';
$news = new News();
$most_views = $news->selectMostView();
$catid = intval($_GET['catid']);
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 8;
$offset = ($pageno - 1) * $no_of_records_per_page;


$total_pages_sql = "SELECT COUNT(*) FROM post";
$result = mysqli_query($conn, $total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);
$query = mysqli_query(
    $conn,
    "SELECT `post`.*, `category`.*
                        FROM `post` 
                        LEFT JOIN `category` ON `post`.`category_id` = `category`.`category_id`
                        WHERE post.`category_id` = $catid
                        AND post.`is_active` = 1
                        order by post.`post-ID` desc LIMIT $offset, $no_of_records_per_page"
);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>TO4SN / CATEGORY</title>
</head>

<body>
    <div class="news-container">
        <div class="GRID GRID-width">
            <div class="hang">
                <?php
                $querymain1= mysqli_query($conn, "SELECT `post`.*, `category`.*
                FROM `post`
                LEFT JOIN `category` ON `post`.`category_id` = `category`.`category_id`
                WHERE `post`.`category_id` = $catid
                ORDER BY `post`.`post-date` DESC
                LIMIT 1;");
                if ($row = mysqli_fetch_array($querymain1)) {
                ?>
                <div class="cot cot-7 tablet-cot-12 mobile-cot-12">
                    <div class="news-thumbnails">
                        <a href="test-detail.php?nid=<?php echo htmlentities($row["post-ID"])?>"><img class="thumb-1" src="../ADMIN/postimages/<?php echo htmlentities($row["post-image"]) ?>" alt=""></a>
                        <a href="test-detail.php?nid=<?php echo htmlentities($row["post-ID"])?>">
                            <p class="news-title"><?php echo htmlentities($row["post-title"])?></p>
                        </a>
                    </div>
                </div>
                <?php
                }
                ?>
                <?php
                $querymain2= mysqli_query($conn, "SELECT `post`.*, `category`.*
                FROM `post`
                LEFT JOIN `category` ON `post`.`category_id` = `category`.`category_id`
                WHERE `post`.`category_id` = $catid
                ORDER BY `post`.`post-date` DESC
                LIMIT 1 OFFSET 1;");
                if ($row2 = mysqli_fetch_array($querymain2)) {
                ?>
                <div class="cot cot-5 tablet-cot-12 mobile-cot-12">
                    <div class="news-thumbnails">
                        <a href="test-detail.php?nid=<?php echo htmlentities($row2["post-ID"])?>"><img class="thumb-2" src="../ADMIN/postimages/<?php echo htmlentities($row2["post-image"]) ?>" alt=""></a>
                        <a href="test-detail.php?nid=<?php echo htmlentities($row2["post-ID"])?>">
                            <p class="news-title"><?php echo htmlentities($row2["post-title"])?></p>
                        </a>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="news-2-container">
            <h2 class="title"><?php echo htmlentities($row['category_name'])?></h2>
            <div class="GRID GRID-width">
                <?php
                $rowcount = mysqli_num_rows($query);
                if ($rowcount == 0) {
                    echo "No record found";
                }
                else{
                    while ($row = mysqli_fetch_array($query)) {
                ?>
                <hr>
                        <div class="hang">
                            <div class="cot cot-3 tablet-cot-12 mobile-cot-12">
                                <div class="news-thumbnails">
                                    <a href="test-detail.php?nid=<?php echo htmlentities($row["post-ID"]) ?>"><img src="../ADMIN/postimages/<?php echo htmlentities($row["post-image"]) ?>" alt="" class="thumb-3"></a>
                                </div>
                            </div>
                            <div class="cot cot-9 tablet-cot-12 mobile-cot-12">
                                <a href="test-detail.php?nid=<?php echo htmlentities($row["post-ID"]) ?>"><h3><?php echo htmlentities($row["post-title"]) ?></h3></a>
                                <p><?php echo htmlentities($row["post-des"]) ?></p>
                                <p><span style="color: red;"><a href="#"><?php echo htmlentities($row["category_name"]) ?></a></span> / <?php echo htmlentities($row["post-date"]) ?><a href="bookmark.php?bid=<?php echo htmlentities($row["post-ID"]) ?>">
                                <i
                                    style="background-color: #f5f5f7; border: none; font-size: 35px; margin-left: 45dvw"
                                    class="fa-solid fa-circle-plus"></i>
                                </a></p>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
                <!-- <div class="hang">
                    <div class="cot cot-3 tablet-cot-12 mobile-cot-12">
                        <div class="news-thumbnails">
                            <a href="news-7.html"><img src="image/thumb-7.jpg" alt="" class="thumb-3"></a>
                        </div>
                    </div>
                    <div class="cot cot-9 tablet-cot-12 mobile-cot-12">
                        <a href="news-7.html">
                            <h3>Call of Duty: Modern Warfare 3 chính thức lọt top tựa game tệ nhất trong thương hiệu
                            </h3>
                        </a>
                        <p>Modern Warfare 3 đã giành được danh hiệu cho tựa game bị đánh giá tệ nhất trong lịch sử dòng
                            game Call of Duty một cách thuyết phục.</p>
                        <p><span style="color: red;"><a href="PC-CONSOLE.html">PC-CONSOLE</a></span> 15/11/2023</p>
                    </div>
                </div>
                <hr>
                <div class="hang">
                    <div class="cot cot-3 tablet-cot-12 mobile-cot-12">
                        <div class="news-thumbnails">
                            <a href="news-8.html"><img src="image/thumb-8.png" alt="" class="thumb-3"></a>
                        </div>
                    </div>
                    <div class="cot cot-9 tablet-cot-12 mobile-cot-12">
                        <a href="news-8.html">
                            <h3>Hogwarts Legacy bị The Game Awards 2023 loại bỏ, chuyện gì đang xảy ra?</h3>
                        </a>
                        <p>The Game Awards 2023 đã loại bỏ Hogwarts Legacy, game nhập vai hành động thế giới mở Harry
                            Potter của Avalanche Software.</p>
                        <p><span style="color: red;"><a href="PC-CONSOLE.html">PC-CONSOLE</a></span> 15/11/2023</p>
                    </div>
                </div>
                <hr>
                <div class="hang">
                    <div class="cot cot-3 tablet-cot-12 mobile-cot-12">
                        <div class="news-thumbnails">
                            <a href="news-10.html"><img src="image/thumb-10.png" alt="" class="thumb-3"></a>
                        </div>
                    </div>
                    <div class="cot cot-9 tablet-cot-12 mobile-cot-12">
                        <a href="news-10.html">
                            <h3>Avatar: Frontiers of Pandora hé lộ chi tiết các tính năng độc quyền cho PS5</h3>
                        </a>
                        <p>PlayStation đã giới thiệu những tính năng độc quyền mà Avatar: Frontiers of Pandora dành cho
                            PS5 giúp tăng trải nghiệm khi chơi trò chơi.</p>
                        <p><span style="color: red;"><a href="PC-CONSOLE.html">PC-CONSOLE</a></span> 15/11/2023</p>
                    </div>
                </div>
                <hr>
                <div class="hang">
                    <div class="cot cot-3 tablet-cot-12 mobile-cot-12">
                        <div class="news-thumbnails">
                            <a href="news-11.html"><img src="image/thumb-11.png" alt="" class="thumb-3"></a>
                        </div>
                    </div>
                    <div class="cot cot-9 tablet-cot-12 mobile-cot-12">
                        <a href="news-11.html">
                            <h3>Nintendo là hãng có nhiều đề cử giải thưởng nhất tại The Game Awards 2023</h3>
                        </a>
                        <p>Danh sách đề cử The Game Awards 2023 tiết lộ Nintendo là nhà phát hành có nhiều đề cử giải
                            thưởng nhất với một số trò chơi nổi tiếng.</p>
                        <p><span style="color: red;"><a href="PC-CONSOLE.html">PC-CONSOLE</a></span> 14/11/2023</p>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="news-3-container">
            <div class="aside">
                <h2 class="title">TIN NÓNG 24H</h2>
                <hr>
                <?php
                    foreach ($most_views as $most_view){
                ?>
                <a href="test-detail.php?nid=<?php echo $most_view["post-ID"] ?>"><img src="../ADMIN/postimages/<?php echo $most_view["post-image"] ?>" alt="" class="thumb-4"></a>
                <a href="test-detail.php?nid=<?php echo $most_view["post-ID"] ?>"><h4><?php echo $most_view["post-title"] ?></h4></a>
                <p><span style="color: red;"><a href="test-detail.php?nid=<?php echo $most_view["post-ID"] ?>">MOBILE</a></span> / <?php echo $most_view['post-date'] ?></p>
                <a href="bookmark.php?bid=<?php echo $most_view["post-ID"] ?>">
                            <i style="background-color: #f5f5f7; border: none; font-size: 30px; margin-left: 25dvw"
                                class="fa-solid fa-circle-plus">
                            </i>
                        </a>
                <?php
                    }
                ?>
                <hr>
                <!-- <a href="#"><img src="image/sidebar-img-2.jpg" alt="" class="thumb-4"></a>
                <a href="#">
                    <h4>NetEase thắng lớn ở thị trường quốc nội</h4>
                </a>
                <p><span style="color: red;"><a href="#">MOBILE</a></span> 19/11/2023</p> -->
            </div>
        </div>
    </div>
</body>
<?php
include 'include/footer.php';
?>
</html>