<?php
    include_once '../db.php';//$conn
    // echo '<pre>';
    // print_r($_GET);
    // die();

    $sql = "SELECT * FROM `sach`";
    $stmt = $conn->query($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);//array 
    $sachs = $stmt->fetchAll();

    $sql1 = "SELECT * FROM `sinhvien`";
    $stmt1 = $conn->query($sql1);
    $stmt1->setFetchMode(PDO::FETCH_ASSOC);//array 
    $sinhviens = $stmt1->fetchAll();

     
    //Lay gia tri ID tren URL
    $id = $_GET['id'];
    //lay du lieu theo ID
    $sql = "SELECT * FROM `phieumuon` WHERE id = $id";
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
        $ngaymuonsach = $_REQUEST['ngaymuonsach'];
        $ngaydukientra = $_REQUEST['ngaydukientra'];
        $sach_id = $_REQUEST['sach_id'];
        $sinhvien_id = $_REQUEST['sinhvien_id'];

        //Viet cau truy van
        $sql = "UPDATE `phieumuon` SET 
        ngaymuonsach = '$ngaymuonsach',
        ngaydukientra = '$ngaydukientra',
        sach_id = '$sach_id',
        sinhvien_id = '$sinhvien_id'
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
<label  class="form-label">Ngày Mượn Sách</label>
    <input type="date" class="form-control" name="ngaymuonsach" value ="<?= $row['ngaymuonsach'];?>">
<br>
    <label  class="form-label">Ngày Dự Kiến Trả</label>
    <input type="date" class="form-control" name="ngaydukientra" value ="<?= $row['ngaydukientra'];?>">
    <br>

    <label  class="form-label">Tên Sách</label>
    <select name="sach_id" class="form-control">
    <?php foreach( $sachs as $sach ) {?>
            <option <?=$sach['id'] == $row['sach_id'] ? "selected" : " " ?> value="<?=$sach['id'];?>"><?=$sach['tensach'];?></option>
            <?php }; ?>
    </select>
    <br>


    <label  class="form-label">Sinh Viên</label>
    <select name="sinhvien_id" class="form-control">
    <?php foreach( $sinhviens as $sinhvien ) {?>
            <option <?=$sinhvien['id'] == $row['sinhvien_id'] ? "selected" : " " ?> value="<?=$sinhvien['id'];?>"><?=$sinhvien['tenSV'];?></option>
            <?php }; ?>
 
    </select>
<br>
 

    <button class="btn btn-success">Cập Nhật Thông Tin</button>
</form>
</div>
<?php include_once "../includes/footer.php" ?>
