<?php
    include_once '../db.php';
    //Xu ly form
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
        // echo '<pre>';
        // print_r( $_REQUEST );
        // die();
        // $MASACH = $_REQUEST['id'];
        
        $THELOAISACH = $_REQUEST['tenloaisach'];
        


        //Viet cau truy van
        $sql = "INSERT INTO loaisach(tenloaisach) VALUES('$THELOAISACH')";
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
<h2>Thêm mới thể loại</h2>
<form action="" method="post">
  <div class="mb-3">
    <label  class="form-label">THELOAISACH</label>
    <input type="text" class="form-control" name="tenloaisach">
  </div>
  <input type="submit" value="Them">
</form>

</div>