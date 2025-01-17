<?php
include ("connect.php");
class USER
{
    public function signup($username, $password, $email)
    {
        global $conn;
        $sql = "insert into user(username, password, email) 
            VALUES('$username', '$password', '$email')";
        return mysqli_query($conn, $sql);
    }
    public function checkUser($username)
    {
        global $conn;
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function checkLogin($username)
    {
        global $conn;
        $sql = "SELECT * FROM user WHERE username = '$username'";
        return mysqli_query($conn, $sql);
    }
}

class News
{
    public function selectCategory()
    {
        global $conn;
        $sql = "SELECT * FROM category where `is_active` = 1";
        return mysqli_query($conn, $sql);
    }

    public function selectAll()
    {
        global $conn;
        $sql = "SELECT `post`.*, `category`.*
                    FROM `post` 
                    LEFT JOIN `category` ON `post`.`category_id` = `category`.`category_id`
                    ORDER BY post.`post-date` DESC;";
        return mysqli_query($conn, $sql);
    }

    public function selectAllwithLimit($limit, $offset)
    {
        global $conn;
        $sql = "SELECT `post`.*, `category`.*
                FROM `post` 
                LEFT JOIN `category` ON `post`.`category_id` = `category`.`category_id`
                ORDER BY post.`post-date` DESC
                LIMIT $limit OFFSET $offset";
        return mysqli_query($conn, $sql);
    }

    public function selectMostView()
    {
        global $conn;
        $sql = "SELECT `post`.*, `category`.*
                    FROM `post` 
                    LEFT JOIN `category` ON `post`.`category_id` = `category`.`category_id`
                    ORDER BY `post`.`view` DESC
                    LIMIT 2";
        return mysqli_query($conn, $sql);
    }

    public function HomeLayout()
    {
        global $conn;
        $sql = "SELECT `post`.*, `category`.*
                    FROM `post` 
                    LEFT JOIN `category` ON `post`.`category_id` = `category`.`category_id`
                    ORDER BY `post`.`post-date` DESC
                    LIMIT 6;";
        $result = mysqli_query($conn, $sql);

        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row; // Lưu từng dòng kết quả vào mảng
        }
        return $data; // Trả về mảng chứa kết quả
    }
}
?>