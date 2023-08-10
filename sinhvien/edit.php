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
      $tenSV = $_REQUEST['tenSV'];
      $diachi = $_REQUEST['diachi'];
      $email = $_REQUEST['email'];
      $sdt = $_REQUEST['sdt'];
      $ANH = $row['image'];
  
      if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
          $uploadDir = ROOT_DIR . '/public/uploads/';
          $uploadFile = $uploadDir . basename($_FILES['image']['name']);
  
          if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
              $ANH = '/public/uploads/' . $_FILES['image']['name'];
          }
      }
  
      //Viet cau truy van
      $sql = "UPDATE `sinhvien` SET 
          tenSV = '$tenSV',
          diachi = '$diachi',
          email = '$email',
          sdt = '$sdt',
          `image`='$ANH'
          WHERE id = $id";
  
      //Thuc hien truy van
      $conn->exec($sql);
  
      //Chuyen huong
      header("Location: index.php");
  }

?>
<?php include_once "../includes/header.php" ?>

<div class="container-fluid px-4">

<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="pwd">Tên Sinh Viên:</label>
    <input type="text" name="tenSV" class="form-control"  value ="<?= $row['tenSV'];?>">
  </div>
  <br>
  <div class="form-group">
    <label for="pwd">Địa Chỉ:</label>
    <input type="text" class="form-control" name="diachi"  value ="<?= $row['diachi'];?>">
  </div>
  <br>

  <div class="form-group">
    <label for="pwd">Email:</label>
    <input type="email" class="form-control" name="email"  value ="<?= $row['email'];?>">
  </div>
  <br>

  <div class="form-group">
    <label for="pwd">Số Điện Thoại:</label>
    <input type="text" class="form-control" name="sdt"  value ="<?= $row['sdt'];?>">
  </div>
  <br>

  <div class="mb-3">
      <label class="form-label">Ảnh</label>
      <?php if ($row['image']) : ?>
        <img src="<?= ROOT_URL . $row['image']; ?>" alt="<?= ROOT_URL . $row['tenSV']; ?>" style="max-width: 200px;">
      <?php endif; ?>
      <input type="file" class="form-control" name="image">
    </div>
  <button class="btn btn-success">Cập Nhật Thông Tin</button>
</form>
</div>

<?php include_once "../includes/footer.php" ?>
