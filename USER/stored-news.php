<!DOCTYPE html>
<html lang="en">

<head>
    <title>TO4SN</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .banner-container-2 {
            max-width: 100%;
            margin-top: 98px;
            background-color: #f5f5f7;
            border-radius: 20px;
            border: 1px solid #e5e5e5;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
            flex-wrap: wrap;
        }

        .full-width-input {
            width: 92vw;
            /* sửa lại từ 92dvw thành 92vw */
            box-sizing: border-box;
            padding: 6px;
            font-size: 12px;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <?php
    include 'include/header.php';
    include '../connect.php';
    //include '../control.php';
    
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $user = new USER();
        $checkLogin = $user->checkLogin($username);
        $userID = $checkLogin->fetch_assoc()["user-id"];

        $news = new News();
        $most_views = $news->selectMostView();

        $query = mysqli_query($conn, "SELECT `post`.*, `category`.*
                                FROM `post` 
                                LEFT JOIN `category` ON `post`.`category_id` = `category`.`category_id`
                                LEFT JOIN `bookmark` ON `post`.`post-ID` = `bookmark`.`post_id`
                                LEFT JOIN `bookmark-detail` ON `bookmark`.`bookmark_id` = `bookmark-detail`.`bookmark_id`
                                WHERE `bookmark-detail`.`user_id` = '$userID'");
    } else {
        echo "<script>
            alert('You need to log in to view your bookmarks.');
            window.location.href = 'LOGIN.php';
          </script>";
        exit();
    }
    ?>
    <div class="banner-container-2">
        <div class="GRID GRID-width">
            <div class="hang">
                <div class="cot cot-12 tablet-cot-12 mobile-cot-12">
                    <div class="news-thumbnails">
                        <!-- <form method="post" action="">
                            <input class="full-width-input" type="text" name="txt_find" id="">
                            <input style="border-radius: 8px; border: 1px solid grey" type="submit" value="Search">
                        </form> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="news-2-container">
            <h2 class="title">Tin Đã Lưu</h2>
            <div class="GRID GRID-width">
                <div class="hang">
                    <div class="cot cot-12 tablet-cot-12 mobile-cot-12">
                        <div class="news-thumbnails">
                            <p>_________________________________________________________________________________________________________________________</p>
                        </div>
                    </div>
                </div>
                <?php
                if(mysqli_num_rows($query) == 0){
                    echo "<h2>No Results</h2>";
                }
                else{
                    while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <hr>
                        <div class="hang">
                            <div class="cot cot-3 tablet-cot-12 mobile-cot-12">
                                <div class="news-thumbnails">
                                    <a href="test-detail.php?nid=<?php echo htmlentities($row["post-ID"]) ?>"><img
                                            src="../ADMIN/postimages/<?php echo htmlentities($row["post-image"]) ?>" alt=""
                                            class="thumb-3"></a>
                                </div>
                            </div>
                            <div class="cot cot-9 tablet-cot-12 mobile-cot-12">
                                <a href="test-detail.php?nid=<?php echo htmlentities($row["post-ID"]) ?>">
                                    <h3><?php echo htmlentities($row["post-title"]) ?></h3>
                                </a>
                                <p><?php echo htmlentities($row['post-des']) ?></p>
                                <p><span style="color: red;"><a
                                            href="category-detail.php?catid=<?php echo htmlentities($row['category_id']) ?>"><?php echo htmlentities($row['category_name']) ?></a></span>
                                    / <?php echo htmlentities($row['post-date']) ?>
                                    <span><a
                                        href="delete-bookmark.php?bid=<?php echo htmlentities($row["post-ID"]) ?>"><i
                                            style="background-color: #f5f5f7; border: none; font-size: 35px; margin-left: 45dvw"
                                            class="fa-solid fa-circle-minus"></i>
                                    </a></span>
                                </p>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="news-3-container">
            <div class="aside">
                <h2 class="title">TIN NÓNG 24H</h2>
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
                        <span><a
                            href="bookmark.php?bid=<?php echo $most_view["post-ID"] ?>">
                            <i style="background-color: #f5f5f7; border: none; font-size: 30px; margin-left: 25dvw"
                                class="fa-solid fa-circle-plus"></i>
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
    <?php
    include 'include/footer.php';
    ?>
</body>

</html>