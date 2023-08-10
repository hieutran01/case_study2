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
    $error = array();
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
        // echo '<pre>';
        // print_r( $_REQUEST );
        // die();
        $THELOAISACH = $_REQUEST['tenloaisach'];

        if ($THELOAISACH == "") {
            $error['tenloaisach'] = 'Vui lòng nhập Thể Loại Sách';
        }

        //Kiểm tra nếu không có lỗi thì thực hiện cập nhật thông tin vào CSDL
        if (count($error) == 0) {
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
    }

?>
<?php include_once "../includes/header.php" ?>

<div class="container-fluid px-4">
<form action="" method="post"><br>
<label  class="form-label">Thể Loại Sách</label><br>
<input type="text" name="tenloaisach" value ="<?= $row['tenloaisach'];?>">
<?php if (isset($error['tenloaisach'])) { ?>
    <span class="text-danger"><?= $error['tenloaisach'] ?></span>
<?php } ?>
<br><br>
<button class="btn btn-success">Cập Nhật Thông Tin</button>
</form>
</div>

<?php include_once "../includes/footer.php" ?>

