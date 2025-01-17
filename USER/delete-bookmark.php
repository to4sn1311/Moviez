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


$deleteBookmarkQuery = "DELETE `bookmark-detail`, `bookmark` 
                        FROM `bookmark` 
                        LEFT JOIN `bookmark-detail` ON `bookmark-detail`.`bookmark_id` = `bookmark`.`bookmark_id` 
                        WHERE `bookmark`.`post_id` = $postID AND `bookmark-detail`.`user_id` = $userID;";

// Thực thi truy vấn xóa
if (mysqli_query($conn, $deleteBookmarkQuery)) {
    echo "<script>
            alert('Bookmark removed');
            window.location.href = 'test.php';
          </script>";
} else {
    echo "<script>
            alert('Error removing bookmark');
            window.location.href = 'test.php';
          </script>";
}
?>
