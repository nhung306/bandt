<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Website bán hàng</title>
    <style>
    .navbar {
        margin-bottom: 0;
        border-radius: 0;
    }

    footer {
        background-color: #f2f2f2;
        padding: 25px;
    }

    .container {
        margin-top: 10px;
    }

    .carousel-inner img {
        width: 100%;
        /* Set width to 100% */
        margin: auto;
        min-height: 200px;
    }

    @media (max-width: 600px) {
        .carousel-caption {
            display: none;
        }
    }
    </style>

</head>

<body>
    <?php
    require_once("./entities/product.class.php");
    require_once("./entities/category.class.php");
?>
    <?php 
    include_once("header.php");
    if(!isset($_GET["cateid"])){
        $prods = Product::list_product();
    }else{
        $cateid = $_GET["cateid"];
        $prods = Product::list_product_by_cateid($cateid);
    }
    $cates = Category::list_category();
?>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <span class="img-circle" href="index.php" src="./images/Sarin Hana.png" alt="lo-go" width="50"
                    height="50"></span>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Trang chủ</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Danh mục
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item">
                            <?php
                        foreach($cates as $item){
                    ?>
                            <a
                                href="<?php echo "?category=".$item["CategoryName"]."&cateid=".$item["CateID"]?>"><?php echo $item["CategoryName"]?></a>
                        </a>
                        <?php }?>
                <li><a href="./list_product.php">Danh sách sản phẩm</a></li>
                <li><a href="./add_product.php">Thêm sản phẩm</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
            <form class="navbar-form navbar-left" action="/action_page.php">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">
                    <i class="glyphicon glyphicon-search"></i>
                </button>
            </form>
        </div>
    </nav>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="./images/banner_1.png" alt="Los Angeles" style="width:100%;">
            </div>

            <div class="item">
                <img src="./images/baner_2.png" alt="Chicago" style="width:100%;">
            </div>

            <div class="item">
                <img src="./images/banner_3.png" alt="New york" style="width:100%;">
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>