<?php
    include_once '../db.php';
    $sql = "SELECT * FROM `loaisach`";
    $stmt = $conn->query($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);//array 
    $loai_sachs = $stmt->fetchAll();

    $error = [];

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


        if($tensach == ""){
          $error['tensach'] = 'Vui lòng nhập tên sách!';
          }
        if($tentacgia == ""){
          $error['tentacgia'] = 'Vui lòng nhập tên tác giả!';
          }
        if($ngayxuatban == ""){
          $error['ngayxuatban'] = 'Vui lòng nhập ngày xuất bản!';
          }
        

          if (count($error) == 0){
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
  }
?>

<?php include_once "../includes/header.php" ?>


<div class="container-fluid px-4">
<h2>Thêm Mới Sách</h2>
<form action="" method="post">
  <div class="mb-3">
    <label  class="form-label">Tên Sách</label>
    <input type="text" class="form-control" name="tensach"><br>
    <div class="text-danger"> <?php echo isset($error['tensach']) ? $error['tensach'] : ''; ?> </div>

    <label  class="form-label">Tên Tác Giả</label>
    <input type="text" class="form-control" name="tentacgia"><br>
    <div class="text-danger"> <?php echo isset($error['tentacgia']) ? $error['tentacgia'] : ''; ?> </div>


    <label  class="form-label">Ngày Xuất Bản</label>
    <input type="date" class="form-control" name="ngayxuatban"><br>
    <div class="text-danger"> <?php echo isset($error['ngayxuatban']) ? $error['ngayxuatban'] : ''; ?> </div>


    <label  class="form-label">Thể Loại Sách</label>
    <select name="loaisach_id" class="form-control">
      
    <?php foreach( $loai_sachs as $loai_sach ): ?>
      <option value="<?php echo $loai_sach['id'];?>"><?php echo $loai_sach['tenloaisach'];?></option>
      <?php endforeach; ?>
    </select>

    
  </div>
  <br>
  <button class="btn btn-success">Thêm</button>
</form>   

</div>