<?php
    require_once("./config/db.class.php");

    class Product{
        public $productID;
        public $productName;
        public $cateID;
        public $price;
        public $quantity;
        public $description;
        public $picture;

        public function __construct($pro_name, $cate_id, $price, $quantity, $desc, $picture){
            $this->productName = $pro_name;
            $this->cateID = $cate_id;
            $this->price = $price;
            $this->quantity = $quantity;
            $this->description = $desc;
            $this->picture = $picture;
        }

        public function save(){
            // Lưu sản phẩm
            // Đường dẫn tạm của file ở trên server
            $file_temp = $this->picture["tmp_name"];
            print_r($file_temp);
            // Tên của file các bạn vừa upload lên.
            $user_file = $this->picture["name"];
            // Ngày giờ upfile
            $timestamp = date("Y").date("m").date("d").date("h").date("i").date("s");
            $filepath = "./images/".$timestamp.$user_file;
            if(move_uploaded_file($file_temp, $filepath) == false){
                return false;
            }


            $db = new Db();
            $sql = "INSERT INTO Product (ProductName, CateID, Price, Quantity, Description, Picture) VALUES 
            ('$this->productName',
                '$this->cateID',
                '$this->price',
                '$this->quantity',
                '$this->description',
                '$filepath'
            )";
            $result = $db->query_excute($sql);
            return $result;
        }

        public function list_product(){
            $db = new Db();
            $sql = "SELECT * FROM product";
            $result = $db->select_to_array($sql);
            return $result;
        }

        public static function list_product_by_cateid($cateid){
            $db = new Db();
            $sql = "SELECT * FROM product WHERE CateID='$cateid'";
            $result = $db->select_to_array($sql);
            return $result;
        }

        public static function list_product_relate($cateid, $id)
        {
            $db = new Db();
            $sql = "SELECT * FROM product WHERE CateID ='$cateid' AND productID !='$id'";
            $result = $db->select_to_array($sql);
            return $result;
        }

        public static function get_product($id)
        {
            $db = new Db();
            $sql = "SELECT * FROM product WHERE productID = '$id'";
            $result = $db->select_to_array($sql);
            return $result;
        } 

        public function update($id){

            $file_temp = $this->picture["tmp_name"];
            print_r($file_temp);
            // Tên của file các bạn vừa upload lên.
            $user_file = $this->picture["name"];
            // Ngày giờ upfile
            $timestamp = date("Y").date("m").date("d").date("h").date("i").date("s");
            $filepath = "./images/".$timestamp.$user_file;
            if(move_uploaded_file($file_temp, $filepath) == false)
            {
                return false;
            }

            $db = new Db();
            $sql = "UPDATE product SET Product(ProductName , CateID , Price, Quantity , Description , Picture) values
            ('$this->productName',
                '$this->cateID',
                '$this->price',
                '$this->quantity',
                '$this->description',
                '$filepath'
            )
            WHERE ProductID = '$id' "; 
            
            $result = $db->query_excute($sql);
            return $result;
        }

        public function delete($id) {
            $db = new Db();
            $sql = "DELETE FROM product WHERE ProductID='$id'";
            $result = $db->query_excute($sql);
            return $result;
        }

    }
?>