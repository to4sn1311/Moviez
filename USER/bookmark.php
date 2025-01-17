<?php
session_start();
include '../connect.php';
include '../control.php';

if (isset($_GET['bid'])) {
    $postID = $_GET['bid'];
}

$username = $_SESSION['username'];
$user = new USER();
$checkLogin = $user->checkLogin($username);
$userID = $checkLogin->fetch_assoc()["user-id"];

$checkBookmarkQuery = "SELECT `bookmark`.*, `bookmark-detail`.*
                    FROM `bookmark` 
                    LEFT JOIN `bookmark-detail` ON `bookmark-detail`.`bookmark_id` = `bookmark`.`bookmark_id`
                    WHERE `bookmark`.`post_id` = $postID
                    AND `bookmark-detail`.`user_id` = '$userID';";
$result = mysqli_query($conn, $checkBookmarkQuery);

$bookmarkQuery = "INSERT INTO bookmark (`post_id`) VALUES ('$postID')";

$bookmarkDetailQuery = "INSERT INTO `bookmark-detail` (`bookmark_id`, `user_id`, `bookmark_date`) 
                        VALUES (LAST_INSERT_ID(), '$userID', UNIX_TIMESTAMP())";

if (mysqli_num_rows($result) == 0) {
    if (mysqli_query($conn, $bookmarkQuery)) {
        if (mysqli_query($conn, $bookmarkDetailQuery)) {
            echo "<script>
                    alert('Bookmarked');
                    window.location.href = 'test.php';
                  </script>";
        } else {
            echo "<script>
                    alert('ERROR');
                    window.location.href = 'test.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('ERROR');
                window.location.href = 'test.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Already bookmarked');
            window.location.href = 'test.php';
          </script>";
}
?>