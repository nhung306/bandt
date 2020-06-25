<?php
    require_once("./entities/product.class.php");
?>
<?php 
    include_once("header.php");
    $prods = Product::list_product();
?>
<div class="container text-center">
    <h3>Sản phẩm hot</h3><br>    
    <div class="row">
    <?php
        foreach($prods as $item){
    ?>
        <div class="col-sm-4">           
            <img style="width:100%; height: 260px" src="<?php echo $item["Picture"]?>" alt="<?php echo $item["ProductName"]?>">
            <div class="well">
                <h5 class="card-title">Tên sản phẩm: <?php echo $item["ProductName"]?></h5>
                <!-- <p class="card-text">Mô tả: <?php echo $item["Description"]?></p> -->
                <p class="card-text">Giá: <?php echo $item["Price"]?></p>
                <button type="button" class="btn btn-primary" onclick="location.href='./shopping_cart.php?id=<?php echo $item["ProductID"]; ?>'" >Mua ngay</button>
                <a href="./product_detail.php?id=<?php echo $item["ProductID"]?>" class="btn btn-info">Xem chi tiết</a>
                <a href="./update_product.php?id=<?php echo $item["ProductID"]?>" class="btn btn-primary">Chỉnh sửa</a>
                <!-- <a href="./delete_product.php?id=<?php echo $item["ProductID"]?>" class="btn btn-danger">Xóa</a> -->
            </div>
           
        </div>  
        
    <?php }?>
    </div>
</div>
<br>

  
    
<?php include_once("footer.php")?>