<?php
    include_once '../db.php';//$conn
    // echo '<pre>';
    // print_r($_GET);
    // die();

     
    //Lay gia tri ID tren URL
    $id = $_GET['id'];
    //lay du lieu theo ID
    $sql = "SELECT * FROM `sinhvien` WHERE id = $id";
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
        $tenSV = $_REQUEST['tenSV'];
        $diachi = $_REQUEST['diachi'];
        $email = $_REQUEST['email'];
        $sdt = $_REQUEST['sdt'];

        //Viet cau truy van
        $sql = "UPDATE `sinhvien` SET 
        tenSV = '$tenSV',
        diachi = '$diachi',
        email = '$email',
        sdt = '$sdt'
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
  <div class="form-group">
    <label for="pwd">Tên Sinh Viên:</label>
    <input type="text" name="tenSV" class="form-control"  value ="<?= $row['tenSV'];?>">
  </div>
  <div class="form-group">
    <label for="pwd">Địa Chỉ:</label>
    <input type="text" class="form-control" name="diachi"  value ="<?= $row['diachi'];?>">
  </div>

  <div class="form-group">
    <label for="pwd">Email:</label>
    <input type="email" class="form-control" name="email"  value ="<?= $row['email'];?>">
  </div>

  <div class="form-group">
    <label for="pwd">Số Điện Thoại:</label>
    <input type="text" class="form-control" name="sdt"  value ="<?= $row['sdt'];?>">
  </div>

  <button class="btn btn-success">Cập nhật thông tin</button>
</form>
</div>

<?php include_once "../includes/footer.php" ?>
