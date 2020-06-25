<?php
    require_once("./entities/product.class.php");
    require_once("./entities/category.class.php");
    require_once("./config/db.class.php");


    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $prod = Product::get_product($id);
        $prod = $prod[0];        
    }
    else{
        header('Location: list_product.php');
    }

    if(isset($_POST["btnsubmit"])){
        $productName = $_POST[$prod["ProductName"]];
        $cateID = $_POST[$prod["CateID"]];
        $price = $_POST[$prod["Price"]];
        $quantity = $_POST[$prod["Quantity"]];
        $description = $_POST[$prod["Description"]];
        $picture = $_FILES[$prod["Picture"]];

        $newProduct = new Product($productName, $cateID, $price, $quantity, $description, $picture);
        $result = $newProduct->delete($id);
        if(!$result){
            header("Location: delete_product.php?failture");
        }else{
            header("Location: delete_product.php?inserted");
            header('Location: list_product.php');
        }
    }

    $db = new Db();
    $sql = "SELECT * FROM category";
    $categories = $db->select_to_array($sql);
?>

<?php $url = $_SERVER['HTTP_HOST']?>
<?php include_once("header.php");?>

<div class="container">
    <div class="lbltitle">
        <h3 style="text-align:center; font-weight:bold; padding-bottom:20px; padding-top:10px">XÓA SẢN PHẨM</h3>
    </div>
        <div class="row">
            <form action="" method="POST" enctype="multipart/form-data" style="width:800px">
                <?php
                if(isset($_GET["inserted"])){
            ?>
                <div class="alert alert-success" style="margin-top:10px">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Xóa sản phẩm thành công!
                </div>
                <?php } ?>

                <?php
                if(isset($_GET["failture"])){
            ?>
                <div class="alert alert-danger" style="margin-top:10px">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Xóa sản phẩm thất bại!
                </div>
                <?php } ?>
                <div class="col-sm-6">

                    <div style="padding-right:50px" class="col-sm-4">
                        <img class="card-img-top" style="width:300px; height:300px; margin: 10px"
                            src="<?php echo $prod["Picture"]?>" alt="<?php echo $prod["ProductName"]?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <h5 sty class="card-title">Tên sản phẩm: <?php echo $prod["ProductName"]?></h5>
                    <p class="card-text">Mô tả: <?php echo $prod["Description"]?></p>
                    <!-- <p class="card-text">Loại: <?php echo $category["CateID"]?><?php echo $category["CategoryName"]?></p> -->
                    <p class="card-text">Giá: <?php echo $prod["Price"]?></p>
                    <div class="submit" style="margin-top:10px; margin-bottom: 10px; align:center; padding-left:208px">
                        <button class="btn btn-danger" type="submit" name="btnsubmit">Xóa sản phẩm</button>
                    </div>
                </div>
            </form>
        </div>
</div>

<?php include_once("footer.php");?>