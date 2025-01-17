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
            width: 92dvw;
            box-sizing: border-box;
            padding: 6px;
            font-size: 12px;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
        }
    </style>
</head>
<?php
include 'include/header.php';
$news = new News();
$initial_limit = 6;
$offset = 0;
$each_news = $news->selectAll();
$most_views = $news->selectMostView();
$search ="";
if (isset($_POST['txt_find'])){
    $search = $_POST['txt_find'];
}
$query = mysqli_query($conn, "SELECT `post`.*, `category`.*
                            FROM `post` 
                            LEFT JOIN `category` ON `post`.`category_id` = `category`.`category_id`
                            WHERE `post`.`post-title` LIKE '%$search%'  
                            ORDER BY `post`.`post-date` DESC;");
?>

<body>
    <div class="banner-container-2">
        <div class="GRID GRID-width">
            <div class="hang">
                <div class="cot cot-12 tablet-cot-12 mobile-cot-12">
                    <div class="news-thumbnails">
                        <form method="post" action="">
                            <input class="full-width-input" type="text" name="txt_find" id="">
                            <input style="border-radius: 8px; border: 1px solid grey" type="submit" value="Search">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="news-2-container">
            <h2 class="title">Kết Quả</h2>
            <div class="GRID GRID-width">
                <?php
                if(mysqli_num_rows($query) == 0) {
                    echo "No Results";
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
                                / <?php echo htmlentities($row['post-date']) ?></p>
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
                    <a href="test-detail.php?nid=<?php echo $most_view["post-ID"] ?>ss">
                        <h4><?php echo $most_view["post-title"] ?></h4>
                    </a>
                    <p><span style="color: red;"><a href="MOBILE.html">MOBILE</a></span> /
                        <?php echo $most_view['post-date'] ?>
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