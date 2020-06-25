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

<div class="container text-center">
    <h3>Sản phẩm</h3><br>  
    <div class='row'>  
    <?php
        foreach($prods as $item){
    ?>
        <div class="col-md-4">           
            <img style="width:100%; height: 260px" src="<?php echo $item["Picture"]?>" alt="<?php echo $item["ProductName"]?>">
            <br>
            <div class="well">
                <h5 class="card-title">Tên sản phẩm: <?php echo $item["ProductName"]?></h5>
                <p class="card-text">Giá: <?php echo $item["Price"]?></p>
                <button type="button" class="btn btn-danger" onclick="location.href='/PHP_Lab3/shopping_cart.php?id=<?php echo $item["ProductID"]; ?> '" >Mua ngay</button>
                <a href="./product_detail.php?id=<?php echo $item["ProductID"]?>" class="btn btn-info">Xem chi tiết</a>
                <a href="./update_product.php?id=<?php echo $item["ProductID"]?>" class="btn btn-primary">Chỉnh sửa</a>
            </div>           
        </div>         
    <?php }?>
    </div>
</div>
<br>

<?php include_once("footer.php");?>