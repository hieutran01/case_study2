<?php
    include_once '../db.php';
    $sql = "SELECT * FROM `sach`";
    $stmt = $conn->query($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);//array 
    $sachs = $stmt->fetchAll();


    $sql1 = "SELECT * FROM `sinhvien`";
    $stmt1 = $conn->query($sql1);
    $stmt1->setFetchMode(PDO::FETCH_ASSOC);//array 
    $sinhviens = $stmt1->fetchAll();
    //Xu ly form
    // var_dump($sinhviens);
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
        // echo '<pre>';
        // print_r( $_REQUEST );
        // die();
        // $MASACH = $_REQUEST['id'];
        
        $ngaymuonsach = $_REQUEST['ngaymuonsach'];
        $ngaydukientra = $_REQUEST['ngaydukientra'];
        $sach_id = $_REQUEST['sach_id'];
        $sinhvien_id = $_REQUEST['sinhvien_id'];



        


        //Viet cau truy van
        $sql = "INSERT INTO phieumuon(ngaymuonsach,ngaydukientra,sach_id,sinhvien_id) VALUES('$ngaymuonsach','$ngaydukientra','$sach_id','$sinhvien_id')";
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
<h2>Thêm mới </h2>
<form action="" method="post">
  <div class="mb-3">
    <label  class="form-label">ngày mượn sách</label>
    <input type="text" class="form-control" name="ngaymuonsach">

    <label  class="form-label">ngày dự kiến trả</label>
    <input type="text" class="form-control" name="ngaydukientra">


    <label  class="form-label">tensach</label>
    <select name="sach_id" class="form-control">
    <?php foreach( $sachs as $sach ): ?>
      <option value="<?php echo $sach['id'];?>"><?php echo $sach['tensach'];?></option>
      <?php endforeach; ?>
    </select>

    <label  class="form-label">tensinhvien</label>
    <select name="sinhvien_id" class="form-control">
    <?php foreach( $sinhviens as $sinhvien ): ?>
      <option value="<?php echo $sinhvien['id'];?>"><?php echo $sinhvien['tenSV'];?></option>
      <?php endforeach; ?>
    </select>

  

    
  </div>

  <input type="submit" value="Thêm">
</form>

</div>
<?php include_once "../includes/footer.php" ?>
