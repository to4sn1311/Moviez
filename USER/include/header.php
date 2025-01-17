<?php
session_start();
include '../control.php';
$news = new News();
$categorys = $news->selectCategory();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include 'head.php'
        ?>
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
            text-align: center;
            left: 25%;
        }

        .dropdown-content {
            left: -20px;
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 100px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .search-icon-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            height: 100%;
        }

        .fa-magnifying-glass {
            margin-top: 25%;
            font-size: 20px;
            cursor: pointer;
            margin-right: -40%;
        }
    </style>
</head>
<header>
    <div class="navbar-container">
        <div class="GRID GRID-width">
            <div class="hang">
                <div class="cot cot-2 tablet-cot-12 mobile-cot-12">
                    <a href="test.php"><img class="logo" src="image\Asset 2.png" alt=""> </a>
                </div>
                <?php
                foreach ($categorys as $category) {
                    ?>
                    <div class="cot cot-2 mobile-cot-0 tablet-cot-3">

                        <div>
                            <a href="category-detail.php?catid=<?php echo $category['category_id'] ?>">
                                <p class="navbar-content"><?php echo $category['category_name'] ?></p>
                            </a>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="cot cot-1 mobile-cot-0 tablet-cot-6">
                    <?php
                    if (!empty($_SESSION["username"])) {
                        echo '<div class="dropdown">';
                        echo '<p class="navbar-content">' . $_SESSION["username"] . '</p>';
                        echo '<div class="dropdown-content">';
                        echo '<a href="LOGOUT.php">LOGOUT</a> 
                                    <a href="../ADMIN/index.php">ADMIN</a> 
                                    <a href="stored-news.php">Bookmark</a>';
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<a href="LOGIN.php"><p class="navbar-content">LOGIN</p></a>';
                    }
                    ?>
                </div>
                <div class="cot cot-1 mobile-cot-0 tablet-cot-6 search-icon-container">
                    <a href="find.php" class="fa-solid fa-magnifying-glass"></a>
                </div>
            </div>
        </div>
    </div>
</header>