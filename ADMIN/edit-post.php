<?php
session_start();
include ('includes/connect.php');
error_reporting(0);
if (strlen($_SESSION['username']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['update'])) {
        $posttitle = $_POST['posttitle'];
        $catid = $_POST['category'];
        $postdes = $_POST['postdes'];
        $postdetails = $_POST['postdescription'];
        $arr = explode(" ", $posttitle);
        $url = implode("-", $arr);
        $postid = intval($_GET['pid']);
        $query = mysqli_query($conn, "UPDATE `post` SET `post-title`= '$posttitle', `category_id`='$catid', `post-detail`='$postdetails' WHERE `post-ID`='$postid'");
        // echo "SQL Query: $query<br>";
        // echo "SQL Query: $posttitle<br>";
        // echo "SQL Query: $catid<br>";
        // echo "SQL Query: $postdetails<br>";
        if ($query) {
            $msg = "Post updated ";
        } else {
            $error = "Something went wrong . Please try again.";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- App title -->
        <title>Newsportal | Add Post</title>

        <!-- Summernote css -->
        <link href="../plugins/summernote/summernote.css" rel="stylesheet" />

        <!-- Select2 -->
        <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

        <!-- Jquery filer css -->
        <link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
        <link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <script src="assets/js/modernizr.min.js"></script>
        <!-- <script>
            function getSubCat(val) {
                $.ajax({
                    type: "POST",
                    url: "get_subcategory.php",
                    data: 'catid=' + val,
                    success: function(data) {
                        $("#subcategory").html(data);
                    }
                });
            }
        </script> -->
    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include ('includes/topheader.php'); ?>
            <!-- ========== Left Sidebar Start ========== -->
            <?php include ('includes/leftsidebar.php'); ?>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">


                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Edit Post </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#"> Posts </a>
                                        </li>
                                        <li class="active">
                                            Add Post
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <!---Success Message--->
                            <?php if ($msg) { ?>
                            <div class="alert alert-success" role="alert">
                                <strong>Well done!</strong>
                                <?php echo htmlentities($msg); ?>
                            </div>
                            <?php } ?>

                            <!---Error Message--->
                            <?php if ($error) { ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Oh snap!</strong>
                                <?php echo htmlentities($error); ?>
                            </div>
                            <?php } ?>


                        </div>
                    </div>

                    <?php
                    $postid = intval($_GET['pid']);
                    $query = mysqli_query($conn, "SELECT `post`.`post-ID` as `id`,
                                                        `post`.`post-image` as `image`,
                                                        `post`.`post-title` as `title`,
                                                        `post`.`post-des` AS `des`,
                                                        `post`.`post-detail` as `postdetail`,
                                                        `category`.`category_name` as `category`,
                                                        `category`.`category_id` as `catid` 
                                                        from `post` left join `category` on `category`.`category_id`=`post`.`category_id`
                                                        where `post`.`post-ID`='$postid' and `post`.`is_active`= 1 ");
                    while ($row = mysqli_fetch_array($query)) {
                        ?>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="p-6">
                                <div class="">
                                    <form name="addpost" method="post">
                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Post Title</label>
                                            <input type="text" class="form-control" id="posttitle"
                                                value="<?php echo htmlentities($row['title']); ?>" name="posttitle"
                                                placeholder="Enter title" required>
                                        </div>
                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Post Description</label>
                                            <input type="text" class="form-control" id="postdes"
                                                value="<?php echo htmlentities($row['des']); ?>" name="posttitle"
                                                placeholder="Enter title" required>
                                        </div>
                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Category</label>
                                            <select class="form-control" name="category" id="category"
                                                onChange="getSubCat(this.value);" required>
                                                <option value="<?php echo htmlentities($row['catid']); ?>">
                                                    <?php echo htmlentities($row['category']); ?>
                                                </option>
                                                <?php
                                                // Feching active categories
                                                $ret = mysqli_query($conn, "SELECT `category_id`, `category_name` from  `category` where `is_active` =1");
                                                while ($result = mysqli_fetch_array($ret)) {
                                                    ?>
                                                <option value="<?php echo htmlentities($result['catid']); ?>">
                                                    <?php echo htmlentities($result['category_name']); ?>
                                                </option>
                                                <?php } ?>

                                            </select>
                                        </div>

                                        <!-- <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Sub Category</label>
                                            <select class="form-control" name="subcategory" id="subcategory" required>
                                                <option value="<?php echo htmlentities($row['subcatid']); ?>">
                                                    <?php echo htmlentities($row['subcategory']); ?>
                                                </option>
                                            </select>
                                        </div> -->


                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card-box">
                                                    <h4 class="m-b-30 m-t-0 header-title"><b>Post Details</b></h4>
                                                    <textarea class="summernote" name="postdescription"
                                                        required><?php echo htmlentities($row['postdetail']); ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card-box">
                                                    <h4 class="m-b-30 m-t-0 header-title"><b>Post Image</b></h4>
                                                    <img src="postimages/<?php echo htmlentities($row['image']); ?>"
                                                        width="300" />
                                                    <br />
                                                    <a
                                                        href="change-image.php?pid=<?php echo htmlentities($row['id']); ?>">Update
                                                        Image</a>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="update"
                                        class="btn btn-success waves-effect waves-light">Update 
                                    </button>
                                    </form>
                                    <?php 
                                        } 
                                    ?>
                                </div>
                            </div> <!-- end p-20 -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->



                    </div> <!-- container -->

                </div> <!-- content -->

                <?php include ('includes/footer.php'); ?>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->



        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>
        <!-- Select 2 -->
        <script src="../plugins/select2/js/select2.min.js"></script>
        <!-- Jquery filer js -->
        <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>

        <!-- page specific js -->
        <script src="assets/pages/jquery.blog-add.init.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script>
    jQuery(document).ready(function () {
        $('.summernote').summernote({
            height: 240, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false, // set focus to editable area after initializing summernote
            callbacks: {
                onImageUpload: function(files) {
                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            // Tạo thẻ <div> bao quanh
                            const divWrapper = $('<div>').addClass('news-thumbnails');
                            // Tạo thẻ <img> và gán class "img"
                            const imgNode = $('<img>').attr('src', e.target.result).addClass('img');
                            // Chèn thẻ <img> vào trong <div>
                            divWrapper.append(imgNode);
                            // Chèn thẻ <div> vào Summernote
                            $('.summernote').summernote('pasteHTML', divWrapper[0].outerHTML);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            }
        });

        // Select2
        $(".select2").select2();

        $(".select2-limiting").select2({
            maximumSelectionLength: 2
        });
    });
</script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>



    </body>

    </html>
<?php } ?>