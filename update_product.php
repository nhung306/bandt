<?php
    require_once("./entities/category.class.php");
    require_once("./entities/product.class.php");
    
    if(isset($_GET["id"])){
        $id =  $_GET["id"];
        $prod = Product::get_product($id);
        $prod = $prod[0];        
    
       
    
    }else{
        header('Location: list_product.php');
    }  

    if(isset($_POST["btnsubmit"])){

        $productName = $_POST["txtName"];
        $cateID = $_POST["txtID"];
        $price = $_POST["txtprice"];
        $quantity = $_POST["txtquantity"];
        $description = $_POST["txtdesc"];
        $picture = $_FILES["txtpic"];
        
        $file_temp = $picture["tmp_name"];
        print_r($file_temp);
        $user_file = $picture["name"];
        $timestamp = date("Y").date("m").date("d").date("h").date("i").date("s");
        $filepath = "./images/".$timestamp.$user_file;
        if(move_uploaded_file($file_temp,$filepath) == false)
        {
            return false;
        }
        
        $productID=intval($_GET['id']);
        $db = new Db();
        $connection = $db->connect();
        $sql="UPDATE product SET ProductName = ?, CateID = ?, Price = ?, Quantity = ?, Description = ?, Picture = ? WHERE ProductID = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('sidissi', $productName, $cateID, $price, $quantity, $description, $filepath, $productID);
        $stmt->execute();
        
        if(!$result){
            header("Location: update_product.php?failture");
        }else{
            header("Location: update_product.php?inserted");
        }
    }

    $categories = Category::list_category();
?>
<?php $url = $_SERVER['HTTP_HOST']?>

<?php include_once("header.php");?>

<div class="container">
    <div class="col-sm-4 pannel panel-danger">
        <h3 class="panel-heading">Thông tin sản phẩm</h3>
        <img class="card-img-top" style="width:300px; height:300px; margin: 10px" src="<?php echo $prod["Picture"]?>"
            alt="<?php echo $prod["ProductName"]?>">
        <h5 sty class="card-title">Tên sản phẩm: <?php echo $prod["ProductName"]?></h5>
        <p class="card-text">Mô tả: <?php echo $prod["Description"]?></p>
        <p class="card-text">Giá: <?php echo $prod["Price"]?></p>
    </div>
    
    <div class="col-sm-8 panel panel-info ">
        <form action="" method="POST" enctype="multipart/form-data" style="width:800px">
            <h3 class="panel-heading ">Chỉnh sửa sản phẩm</h3>
            <div class="form-group">
                <div class="lbltitle">
                    <label>Tên sản phẩm</label>
                </div>
                <div class="lblinput">
                    <input class="form-control" type="text" name="txtName"
                        value="<?php echo isset($_POST["txtName"])? $_POST["txtName"] :"" ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="lbltitle">
                    <label>Danh mục sản phẩm</label>
                </div>
                <div class="lblinput">
                    <select class="form-control" name="txtID">
                        <?php
                        foreach($categories as $category){
                    ?>
                        <option value="<?php echo $category["CateID"]?>">
                        <?php echo $category["CategoryName"]?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="lbltitle">
                    <label>Mô tả sản phẩm</label>
                </div>
                <div class="lblinput">
                    <textarea class="form-control" name="txtdesc" rows="5">
                        <?php echo isset($_POST["txtdesc"])? $_POST["txtdesc"] :"" ?>
                    </textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="lbltitle">
                    <label>Giá sản phẩm</label>
                </div>
                <div class="lblinput">
                    <input class="form-control" type="number" name="txtprice"
                        value="<?php echo isset($_POST["txtprice"])? $_POST["txtprice"] :"" ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="lbltitle">
                    <label>Số lượng sản phẩm</label>
                </div>
                <div class="lblinput">
                    <input class="form-control" type="number" name="txtquantity"
                        value="<?php echo isset($_POST["txtquantity"])? $_POST["txtquantity"] :"" ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="lbltitle">
                    <label>Hình ảnh sản phẩm</label>
                </div>
                <div class="lblinput">
                    <input class="form-control" id="txtpic" type="file" name="txtpic" accept=".PNG,.GIF,.JPG">
                </div>
            </div>
            <div class="submit" style="margin-top:10px; margin-bottom: 40px, width:70%">
                <button class="btn btn-primary" type="submit" name="btnsubmit">Chỉnh sửa sản phẩm</button>
            </div>
        </form>
    </div>
</div>
<br>

<?php include_once("footer.php");?>