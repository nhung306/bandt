<?php
 require_once("./entities/product.class.php");
 require_once("./entities/category.class.php");
?>

<?php
    include_once("header.php");
    if(!isset($_GET["id"])){
        header('Location: not_found.php');
    }else{
        $id =  $_GET["id"];
        $prod = Product::get_product($id);
        $prod = $prod[0];
        $prods_relate = Product::list_product_relate($prod["CateID"], $id);
    }

    $del = Product::get_product($id);
    $cates = Category::list_category();
?>

<?php $url = $_SERVER['HTTP_HOST']?>

<div class="container">
    <div class="col-sm-3 pannel panel-danger" style="padding-left: 40px">
        <h3 class="panel-heading">Danh mục</h3>
        <ul class="list-group">
            <?php
                foreach($cates as $item){
                    ?>
            <li style="width:100%" class="list-group-item">
                <a
                    href="<?php echo "list_product.php?category=".$item["CategoryName"]."&cateid=".$item["CateID"]?>"><?php echo $item["CategoryName"]?></a>
            </li>
            <?php }?>
        </ul>
    </div>

    <div class="col-sm-9 panel panel-info ">
        <h3 class="panel-heading ">Chi tiết sản phẩm</h3>
        <div class="row">
            <div class="col-sm-6">
                <img class="card-img-top" style="width:300px; height:300px; margin: 10px"
                    src="<?php echo $prod["Picture"]?>" alt="<?php echo $prod["ProductName"]?>">
            </div>
            <div class="col-sm-6">
                <h5 sty class="card-title">Tên sản phẩm: <?php echo $prod["ProductName"]?></h5>
                <p class="card-text">Mô tả: <?php echo $prod["Description"]?></p>
                <p class="card-text">Giá: <?php echo $prod["Price"]?></p>
                <button type="button" class="btn btn-primary" onclick="location.href='./shopping_cart.php?id=<?php echo $prod["ProductID"]; ?>' " >Mua ngay</button>
                <a href="./delete_product.php?id=<?php echo $prod["ProductID"]?>" class="btn btn-danger">Xóa</a>
                <br>
            </div>
        </div>
    </div>

    <div class="container text-center">
        <h3>Sản phẩm liên quan</h3><br>
        <div class="row">
            <?php
            foreach($prods_relate as $item){
        ?>
            <div class="col-sm-4">
                <img style="width:100%; height: 260px" src="<?php echo $item["Picture"]?>"
                    alt="<?php echo $item["ProductName"]?>">
                <div class="well">
                    <h5 class="card-title">Tên sản phẩm: <?php echo $item["ProductName"]?></h5>
                    <p class="card-text">Mô tả: <?php echo $item["Description"]?></p>
                    <p class="card-text">Giá: <?php echo $item["Price"]?></p>
                    <a href="./product_detail.php?id=<?php echo $item["ProductID"]?>" class="btn btn-info">Xem chi tiết</a>
                </div>

            </div>

            <?php }?>
        </div>
    </div>
    <br>
    <?php include_once("footer.php");?>