<?php
include 'include/head.php';
include 'include/header.php';
include '../connect.php';

if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

if (isset($_POST['submit'])) {
    //Verifying CSRF Token
    if (!empty($_POST['csrftoken'])) {
        if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $comment = $_POST['comment'];
            $postid = intval($_GET['nid']);
            $st1 = '0';
            $query = mysqli_query($conn, "insert into comment(`post-ID`,`user-name`,email,comment,status) values('$postid','$name','$email','$comment','$st1')");
            if ($query):
                echo "<script>alert('comment successfully submit. Comment will be display after admin review ');</script>";
                unset($_SESSION['token']);
            else:
                echo "<script>alert('Something went wrong. Please try again.');</script>";
            endif;
        }
    }
}

$postid = intval($_GET['nid']);
$sql = "SELECT view FROM post WHERE `post-ID` = '$postid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $visits = $row["view"];
        $sql = "UPDATE post SET view = $visits+1 WHERE `post-ID` ='$postid'";
        $conn->query($sql);
    }
} else {
    echo "no results";
}


$query = mysqli_query($conn, "SELECT `post`.*, `category`.*
                FROM `post` 
                LEFT JOIN `category` ON `post`.`category_id` = `category`.`category_id`
                WHERE `post-ID` = '$postid'");
$pid = intval($_GET['nid']);
if ($row = mysqli_fetch_array($query)) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <script src="https://cdn.tiny.cloud/1/17egwk6fx9c2q49tiswgkph1an1su7snvoqwrahd09qgfjjy/tinymce/7/tinymce.min.js"
            referrerpolicy="origin"></script>
        <title><?php echo htmlentities($row['post-title']) ?></title>
        <!-- <script>
    tinymce.init({
        selector: '#content',
        plugins: 'image',
        toolbar: 'image',
        images_upload_url: 'upload_image.php', // URL để tải lên ảnh
        images_upload_base_path: '/uploads', // Thư mục lưu trữ ảnh
    });
</script> -->
    </head>

    <body>
        <div class="news-container">
            <div class="GRID GRID-width">
                <div class="hang">
                    <div class="content">
                        <h1><?php echo htmlentities($row['post-title']) ?></h1>
                        <hr>
                        <p><span style="color: red;">
                                <a href="E-SPORT.html"><?php echo htmlentities($row['category_name']); ?></a></span> /
                            <?php echo htmlentities($row['post-date']); ?> / Views:
                            <?php echo htmlentities($row['view']); ?> 
                            <span style="float: right;">Post by: <span
                                    style="color:brown"><?php echo htmlentities($row['post-by']) ?></span>
                            </span>
                        </p>
                        <hr>
                        <!-- <h4>Sau chiến thắng mãn nhãn của T1 tại Tứ Kết CKTG 2023, cộng đồng LMHT trên khắp thế giới như bùng
                        nổ và để lại vô số lời ca ngợi có cánh.</h4>
                    <p>Trong ngày thi đấu vừa qua, T1 đã giành chiến thắng hoàn toàn áp đảo trước “kỳ lân Tô Châu” – LNG
                        tại Tứ Kết CKTG 2023. Dù đã có khá nhiều fan LMHT dự đoán T1 là đội giành chiến thắng, tuy nhiên
                        cái cách mà đội tuyển áo đỏ đánh bại đối thủ đến từ LPL lại khiến cho không ít fan phấn khích.
                    </p>
                    <div class="news-thumbnails">
                        <img class="img" src="image/thumb-1.jpg" alt="">
                        <p class="img-caption">T1 đã có một chiến thắng 3-0 mãn nhãn trước LNG.</p>
                    </div>
                    <h3>Một số bình luận từ cộng đồng LMHT phương Tây</h3>
                    <p>“Dopa: Khi mọi thứ trở nên vô vọng chúng ta lại bám víu vào Faker. <br> <br> 3 cái mắt ở đường
                        giữa trong ván cuối đúng là 3 ngọn nến cho SKT Scout, GRF Tarzan và người Hàn mới nhập tịch –
                        người anh em Hang. <br><br> Zeus đang chơi Jayce hay là *** Xerath vậy? <br><br> Keria thật sự
                        nói rằng “Tôi sẽ một tay đem lại meta xạ thủ vị trí hỗ trợ và không ai có thể cản tôi.” <br><br>
                        LNG không lấy được một con rồng nào. Con Sứ Giả mà tôi nhớ của họ đã bị hạ gục trước khi nó kịp
                        húc trụ. Họ đã bị khắc chế trong màn cấm chọn ở 3 ván đấu. Oner đánh vào điểm yếu của họ xuyên
                        suốt các ván đấu, phần còn lại của T1 làm họ nghẹt thở. đây đúng là LMHT hoàn hảo dành cho các
                        bạn.”</p>
                    <div class="news-thumbnails">
                        <img class="img" src="image/news-1-p2.jpg" alt="">
                        <p class="img-caption">Nhiều lời ca ngợi dành cho T1 từ cộng đồng fan phương Tây.</p>
                    </div>
                    <p>“Faker thua 40 lính và vẫn hữu dụng hơn Scout thật đúng là điên rồ. Có lẽ Faker đúng là phụ huynh
                        của Scout. <br> <br> Khá chắc rằng Faker hứa sẽ khao gà rán cho tất cả mọi người bên phía LNG
                        sau trận đấu. <br> <br> Scout và Tarzan đúng là những người Hàn yêu nước, hãy miễn NVQS cho họ
                        thay vì Ruler và Kanavi, họ mới là những người thật sự xứng đáng.
                        Đầu tiên hãy cho Hang nhập tịch đã, sau đó miễn NVQS luôn. <br><br>Số người xem CKTG đã được bảo
                        đảm. <br><br> Không thể tin được cái đội này đã thua 1-7 (ở LCK) khi vắng Faker.”</p>
                    <div class="news-thumbnails">
                        <img class="img" src="image/news-1-p3.jpg" alt="">
                        <p class="img-caption">Quỷ Vương Bất Tử cũng được khen ngợi hết lời.</p>
                    </div>
                    <h3>Một số bình luận từ fan LMHT Hàn Quốc</h3>
                    <p>“Wow! 5 người thay phiên nhau tỏa sáng! Họ thi đấu rất tốt, cuối cùng LCK vẫn là T1. <br><br>T1
                        có phải hi vọng của LCK để ngăn cản LPL? LPL sẽ phải chặn đứng T1 mới đúng, đội chưa từng thua
                        LPL tại CKTG. <br><br>Tôi đang khóc đây! Thật sự rất cảm ơn các bạn. <br><br>Đi thôi! Quỷ Vương
                        đánh bại LPL. <br><br>LCK last hope, cố lên!”</p>
                    <div class="news-thumbnails">
                        <img class="img" src="image/news-1-p4.jpg" alt="">
                        <p class="img-caption">Fan Hàn cho rằng các đội LPL mới là những người cần ngăn cản bước tiến
                            của T1.</p>
                    </div>
                    <h3>Một số bình luận từ fan LMHT Trung Quốc</h3>
                    <p>“Nơi có những tuyển thủ giỏi nhất là T1, mục tiêu của chúng tôi là giành chức vô địch. <br><br>
                        Ai am hiểu đều có thể biết T1 chơi không hay, chỉ có thể thắng thêm 6 ván đấu nữa thôi. <br><br>
                        Vẫn còn 2 BO5 trước khi các bạn (T1) trở thành những vị thần (GODS). <br><br> Chồng ơi cứ thi
                        đấu đi đừng lo, tuần sau em sẽ đi chùa cầu nguyện cho anh (thiêng lắm)! <br><br> Các bạn (T1)
                        thật quá đáng, món McDonald tôi gọi vẫn chưa được giao đến mà đã đánh xong trận đấu rồi. Tốt
                        nhất là các bạn nên chơi thêm 2 trận BO5 như thế này. <br><br> Oner, màn trình diễn hôm nay thật
                        xứng đáng với 2 năm thi đấu ở T1. Cảm ơn bạn! Sẽ thật tuyệt nếu bạn giữ được phong độ này mọi
                        lúc.”</p>
                    <div class="news-thumbnails">
                        <img class="img" src="image/news-1-p5.jpg" alt="">
                        <p class="img-caption">Vô số lời ca ngợi từ cộng đồng LMHT Trung Quốc dành cho T1.</p>
                    </div>
                    <h3>Một số bình luận từ cộng đồng LMHT Việt Nam</h3>
                    <p>“Seed 2 đánh hay thế này thì seed 1 còn thế nào nữa. <br><br> GEN là người cản được T1, GEN về
                        rồi thì T1 năm nay vô địch. <br><br>Sunday the king plays. <br><br>LCK last hope! T1 cố lên!
                        <br><br>Khu vực T1 đỉnh quá.”</p>
                    <div class="news-thumbnails">
                        <img class="img" src="image/news-1-p6.jpg" alt="">
                        <p class="img-caption">Fan Việt để lại khá nhiều bình luận ăn mừng như “siu” và “sunday the king
                            plays”.</p>
                    </div>
                    <p>Hiện tại, chiến thắng của T1 vẫn được rất nhiều game thủ đem ra thảo luận và phân tích.</p><br> -->
                        <h3><?php echo htmlentities($row['post-des']); ?></h3>
                        <?php
                        $pt = $row['post-detail'];
                        echo (substr($pt, 0));
                        ?>
                        <div>
                            <p>Xem thêm: <a class="more" href="news-2.html  ">Đấu Trường Chân Lý: Bật mí Tộc Hệ mùa 10 và
                                    nhiều tính năng, cơ chế mới</a></p>
                        </div>

                        <!-- <form method="post" action="news-1.php" enctype="multipart/form-data">
                        <textarea name="content" id="content" cols="30" rows="10" placeholder="INPUT"></textarea>
                        <input name="submit" type="submit" value="OK">
                    </form> -->
                    </div>
                </div>
                <?php
}
?>
        </div>
        <div class="GRID GRID-width">
            <div class="hang">
                <div class="content">
                    <h3>Leave a Comment:</h3>
                    <form name="Comment" method="post">
                        <input type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']);?>"/>
                        <input type="text" name="name" class="input" placeholder="Enter your fullname" required>
                        <input type="email" name="email" class="input" placeholder="Enter your Valid email" required>

                        <textarea class="input-2" name="comment" rows="10" placeholder="Comment" required></textarea>
                        <button type="submit" class="input" name="submit">Submit</button>
                    </form>
                </div>
            </div>
            <hr style="width: 80%">
        </div>
        <div class="GRID GRID-width">
            <div class="hang">
                <div class="content">
                    <?php
                    $sts = 1;
                    $query = mysqli_query($conn, "select `user-name`,comment,`post-date` from  comment where `post-ID`='$pid' and status='$sts'");
                    while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <div class="comment">
                            <div class="comment-avatar">
                                <img src="image/usericon.png" alt="">
                            </div>
                            <div class="media-body">
                                <span class="user-name"><?php echo htmlentities($row['user-name']); ?></span>
                                <span class="post-date"><b>at</b> <?php echo htmlentities($row['post-date']); ?></span>
                                <p><?php echo htmlentities($row['comment']); ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
include 'include/footer.php';
?>

</html>