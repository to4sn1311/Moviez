<!DOCTYPE html>
<html lang="en">

<head>
    <title>TO4SN</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php
include 'include/header.php';
$news = new News();
$initial_limit = 6;
$offset = 0;
$each_news = $news->selectAllwithLimit($initial_limit, $offset);
$most_views = $news->selectMostView();
?>

<body>
    <div class="news-container">
        <div class="GRID GRID-width">
            <div class="hang">
                <?php
                $query1 = mysqli_query($conn, "SELECT `post`.*, `category`.* 
                FROM `post` 
                LEFT JOIN `category` ON `post`.`category_id` = `category`.`category_id`
                ORDER BY `post`.`post-date` DESC 
                LIMIT 1;
                ");
                if ($row1 = mysqli_fetch_array($query1)) {
                    ?>
                    <div class="cot cot-8 tablet-cot-12 mobile-cot-12">
                        <div class="news-thumbnails">
                            <a href="test-detail.php?nid=<?php echo htmlentities($row1["post-ID"]) ?>"><img class="thumb-1"
                                    src="../ADMIN/postimages/<?php echo htmlentities($row1["post-image"]) ?>" alt=""></a>
                            <a href="test-detail.php?nid=<?php echo htmlentities($row1["post-ID"]) ?>">
                                <p class="news-title"><?php echo htmlentities($row1["post-title"]) ?></p>
                            </a>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <?php
                $query2 = mysqli_query($conn, "SELECT `post`.*, `category`.* 
                FROM `post` 
                LEFT JOIN `category` ON `post`.`category_id` = `category`.`category_id`
                ORDER BY `post`.`post-date` DESC 
                LIMIT 1 OFFSET 1");
                if ($row2 = mysqli_fetch_array($query2)) {
                    ?>
                    <div class="cot cot-4 tablet-cot-12 mobile-cot-12">
                        <div class="news-thumbnails">
                            <a href="test-detail.php?nid=<?php echo htmlentities($row2["post-ID"]) ?>"><img class="thumb-2"
                                    src="../ADMIN/postimages/<?php echo htmlentities($row2["post-image"]) ?>" alt=""></a>
                            <a href="test-detail.php?nid=<?php echo htmlentities($row2["post-ID"]) ?>">
                                <p class="news-title"><?php echo htmlentities($row2["post-title"]) ?></p>
                            </a>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <?php
                $query3 = mysqli_query($conn, "SELECT `post`.*, `category`.* 
                FROM `post` 
                LEFT JOIN `category` ON `post`.`category_id` = `category`.`category_id`
                ORDER BY `post`.`post-date` DESC 
                LIMIT 1 OFFSET 2");
                if ($row3 = mysqli_fetch_array($query3)) {
                    ?>
                    <div class="cot cot-3 tablet-cot-6 mobile-cot-6">
                        <div class="news-thumbnails">
                            <a href="test-detail.php?nid=<?php echo htmlentities($row3["post-ID"]) ?>"><img class="thumb-3"
                                    src="../ADMIN/postimages/<?php echo htmlentities($row3["post-image"]) ?>" alt=""></a>
                            <a href="test-detail.php?nid=<?php echo htmlentities($row3["post-ID"]) ?>">
                                <p class="news-title"><?php echo htmlentities($row3["post-title"]) ?></p>
                            </a>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <?php
                $query4 = mysqli_query($conn, "SELECT `post`.*, `category`.* 
                FROM `post` 
                LEFT JOIN `category` ON `post`.`category_id` = `category`.`category_id`
                ORDER BY `post`.`post-date` DESC 
                LIMIT 1 OFFSET 3");
                if ($row4 = mysqli_fetch_array($query4)) {
                    ?>
                    <div class="cot cot-3 tablet-cot-6 mobile-cot-6">
                        <div class="news-thumbnails">
                            <a href="test-detail.php?nid=<?php echo htmlentities($row4["post-ID"]) ?>"><img class="thumb-3"
                                    src="../ADMIN/postimages/<?php echo htmlentities($row4["post-image"]) ?>" alt=""></a>
                            <a href="test-detail.php?nid=<?php echo htmlentities($row4["post-ID"]) ?>">
                                <p class="news-title"><?php echo htmlentities($row4["post-title"]) ?></p>
                            </a>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <?php
                $query5 = mysqli_query($conn, "SELECT `post`.*, `category`.* 
                FROM `post` 
                LEFT JOIN `category` ON `post`.`category_id` = `category`.`category_id`
                ORDER BY `post`.`post-date` DESC 
                LIMIT 1 OFFSET 4");
                if ($row5 = mysqli_fetch_array($query5)) {
                    ?>
                    <div class="cot cot-3 tablet-cot-6 mobile-cot-6">
                        <div class="news-thumbnails">
                            <a href="test-detail.php?nid=<?php echo htmlentities($row5["post-ID"]) ?>"><img class="thumb-3"
                                    src="../ADMIN/postimages/<?php echo htmlentities($row5["post-image"]) ?>" alt=""></a>
                            <a href="test-detail.php?nid=<?php echo htmlentities($row5["post-ID"]) ?>">
                                <p class="news-title"><?php echo htmlentities($row5["post-title"]) ?></p>
                            </a>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <?php
                $query6 = mysqli_query($conn, "SELECT `post`.*, `category`.* 
                FROM `post` 
                LEFT JOIN `category` ON `post`.`category_id` = `category`.`category_id`
                ORDER BY `post`.`post-date` DESC 
                LIMIT 1 OFFSET 5");
                if ($row6 = mysqli_fetch_array($query6)) {
                    ?>
                    <div class="cot cot-3 tablet-cot-6 mobile-cot-6">
                        <div class="news-thumbnails">
                            <a href="test-detail.php?nid=<?php echo htmlentities($row6["post-ID"]) ?>"><img class="thumb-3"
                                    src="../ADMIN/postimages/<?php echo htmlentities($row6["post-image"]) ?>" alt=""></a>
                            <a href="test-detail.php?nid=<?php echo htmlentities($row6["post-ID"]) ?>">
                                <p class="news-title"><?php echo htmlentities($row6["post-title"]) ?></p>
                            </a>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="banner-container">
        <h2 class="title">Quảng Cáo</h2>
        <hr>
        <div class="GRID GRID-width">
            <div class="hang">
                <div class="cot cot-12 tablet-cot-12 mobile-cot-12">
                    <div class="news-thumbnails">
                        <marquee behavior="scroll" direction="left">
                            <img class="thumb-5" src="image/banner.png" alt="">
                        </marquee>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="news-2-container">
            <h2 class="title">Tin Tức</h2>
            <div class="GRID GRID-width" id="news-container">
                <?php
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
            </div>
            <button id="load-more" style="display:block; margin:auto;">Load More</button>
        </div>
        <div class="news-3-container">
            <div class="aside">
                <h2 class="title">TIN NÓNG</h2>
                <hr>
                <?php
                foreach ($most_views as $most_view) {
                    ?>
                    <a href="test-detail.php?nid=<?php echo $most_view["post-ID"] ?>"><img
                            src="../ADMIN/postimages/<?php echo $most_view["post-image"] ?>" alt="" class="thumb-4"></a>
                    <a href="test-detail.php?nid=<?php echo $most_view["post-ID"] ?>">
                        <h4><?php echo $most_view["post-title"] ?></h4>
                    </a>
                    <p><span style="color: red;"><a href="MOBILE.html">MOBILE</a></span> /
                        <?php echo $most_view['post-date'] ?>
                        <span>
                            <a href="bookmark.php?bid=<?php echo $most_view["post-ID"] ?>">
                                <i style="background-color: #f5f5f7; border: none; font-size: 30px; margin-left: 25dvw"
                                    class="fa-solid fa-circle-plus">
                                </i>
                            </a></span>
                    </p>
                    <?php
                }
                ?>
                <hr>
                <img src="image/banner-2.png" alt="" class="thumb-6">
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            var limit = 6;
            var offset = 6;

            $('#load-more').click(function () {
                $.ajax({
                    url: 'loadmore.php',
                    method: 'POST',
                    data: {
                        limit: limit,
                        offset: offset
                    },
                    success: function (data) {
                        $('#news-container').append(data);
                        offset += limit;
                    }
                });
            });
        });
    </script>
</body>
<?php
include 'include/footer.php';
?>

</html>