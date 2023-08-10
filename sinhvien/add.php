<?php
    include_once '../db.php';

    $error = [];
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
        $ANH = '';

        if (isset($_FILES['image']))
        {
            if (!$_FILES['image']['error'])
            {
              move_uploaded_file($_FILES['image']['tmp_name'], ROOT_DIR.'/public/uploads/'.$_FILES['image']['name']);
              $ANH = '/public/uploads/'.$_FILES['image']['name'];
            }
        }
        


        if($tenSV == ""){
          $error['tenSv'] = 'Vui lòng nhập tên Sinh Viên!';
          }
        if($diachi == ""){
          $error['diachi'] = 'vui lòng nhập địa chỉ!';
          }
        if($email == ""){
          $error['email'] = 'Vui lòng nhập email!';
          }
          if($sdt == ""){
              $error['sdt'] = 'Vui lòng nhập sđt!';
              }
              if($ANH == ""){
                $error['image'] = 'Vui lòng chọn ảnh!';
                }
        
              if (count($error) == 0){

        //Viet cau truy van
        $sql = "INSERT INTO sinhvien(tenSV,diachi,email,sdt,image) VALUES('$tenSV','$diachi','$email','$sdt','$ANH')";
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
<h2>Thêm Mới Sinh Viên</h2>
<form action="" method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label  class="form-label">Tên Sinh Viên</label>
    <input type="text" class="form-control" name="tenSv"><br>
    <div class="text-danger"> <?php echo isset($error['tenSv']) ? $error['tenSv'] : ''; ?> </div>

    <label  class="form-label">Địa Chỉ</label>
    <input type="text" class="form-control" name="diachi"><br>
    <div class="text-danger"> <?php echo isset($error['diachi']) ? $error['diachi'] : ''; ?> </div>


    <label  class="form-label">Email</label>
    <input type="text" class="form-control" name="email"><br>
    <div class="text-danger"> <?php echo isset($error['email']) ? $error['email'] : ''; ?> </div>


    <label  class="form-label">SĐT</label>
    <input type="text" class="form-control" name="sdt"><br>
    <div class="text-danger"> <?php echo isset($error['sdt']) ? $error['sdt'] : ''; ?> </div>


    <label  class="form-label">Ảnh</label>
    <input type="file" class="form-control" name="image">
    <div class="text-danger"> <?php echo isset($error['image']) ? $error['image'] : ''; ?> </div>


  </div>

  <button class="btn btn-success">Thêm</button>
</form>

</div>