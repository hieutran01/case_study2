<?php
    include_once '../db.php';
    //Xu ly form
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
        // echo '<pre>';
        // print_r( $_REQUEST );
        // die();
        // $MASACH = $_REQUEST['id'];
        
        $tenSV = $_REQUEST['tenSv'];
        $diachi = $_REQUEST['diachi'];
        $email = $_REQUEST['email'];
        $sdt = $_REQUEST['sdt'];



        


        //Viet cau truy van
        $sql = "INSERT INTO sinhvien(tenSV,diachi,email,sdt) VALUES('$tenSV','$diachi','$email','$sdt')";
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
<h2>Thêm mới sinh viên</h2>
<form action="" method="post">
  <div class="mb-3">
    <label  class="form-label">tên sinh viên</label>
    <input type="text" class="form-control" name="tenSv"><br><br>

    <label  class="form-label">địa chỉ</label>
    <input type="text" class="form-control" name="diachi"><br><br>


    <label  class="form-label">email</label>
    <input type="text" class="form-control" name="email"><br><br>


    <label  class="form-label">sdt</label>
    <input type="text" class="form-control" name="sdt"><br><br>

    
  </div>

  <input type="submit" value="Thêm">
</form>

</div>