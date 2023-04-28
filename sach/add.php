<?php
    include_once '../db.php';
    $sql = "SELECT * FROM `loaisach`";
    $stmt = $conn->query($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);//array 
    $loai_sachs = $stmt->fetchAll();
    //Xu ly form
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
        // echo '<pre>';
        // print_r( $_REQUEST );
        // die();
        // $MASACH = $_REQUEST['id'];
        
        $tensach = $_REQUEST['tensach'];
        $tentacgia = $_REQUEST['tentacgia'];
        $ngayxuatban = $_REQUEST['ngayxuatban'];
        $loaisach_id = $_REQUEST['loaisach_id'];



        


        //Viet cau truy van
        $sql = "INSERT INTO sach(tensach,tentacgia,ngayxuatban,loaisach_id) VALUES('$tensach','$tentacgia','$ngayxuatban','$loaisach_id')";
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
<h2>Thêm mới sách</h2>
<form action="" method="post">
  <div class="mb-3">
    <label  class="form-label">tên sách</label>
    <input type="text" class="form-control" name="tensach"><br><br>

    <label  class="form-label">tên tác giả</label>
    <input type="text" class="form-control" name="tentacgia"><br><br>


    <label  class="form-label">ngày xuất bản</label>
    <input type="text" class="form-control" name="ngayxuatban"><br><br>


    <label  class="form-label">THELOAISACH</label>
    <select name="loaisach_id" class="form-control">
      
    <?php foreach( $loai_sachs as $loai_sach ): ?>
      <option value="<?php echo $loai_sach['id'];?>"><?php echo $loai_sach['tenloaisach'];?></option>
      <?php endforeach; ?>
    </select>

    
  </div>

  <input type="submit" value="Thêm">
</form>   

</div>