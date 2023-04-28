<?php
    include_once '../db.php';//$conn
    // echo '<pre>';
    // print_r($_GET);
    // die();

     
    //Lay gia tri ID tren URL
    $id = $_GET['id'];
    //lay du lieu theo ID
    $sql = "SELECT * FROM `loaisach` WHERE id = $id";
    //Debug sql
    // var_dump($sql);
    $stmt = $conn->query($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);//array

    //Lấy về dữ liệu duy nhat
    $row = $stmt->fetch();

    //  echo '<pre>';
    // print_r($row);
    // die();
    //Xu ly form
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
        // echo '<pre>';
        // print_r( $_REQUEST );
        // die();
        $THELOAISACH = $_REQUEST['tenloaisach'];

        //Viet cau truy van
        $sql = "UPDATE `loaisach` SET 
        tenloaisach = '$THELOAISACH'
         WHERE id = $id
        ";
       
        //Debug sql
        // var_dump($sql);
        // die();

        //Thuc hien truy van
        $conn->exec($sql);

        //Chuyen huong
        header("Location: index.php");
    }

?>
<?php include_once "../includes/header.php" ?>

<div class="container-fluid px-4">
<form action="" method="post">
THELOAISACH :<input type="text" name="tenloaisach" value ="<?= $row['tenloaisach'];?>"> <br>
<button class="btn btn-success">Cập nhật thông tin</button>
</form>
</div>

<?php include_once "../includes/footer.php" ?>
