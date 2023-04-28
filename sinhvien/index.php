<?php include_once '../db.php'; ?>
<?php
$sql = "SELECT * FROM `sinhvien`";
$msg = isset( $_GET['msg'] ) ? $_GET['msg'] : '';


$stmt = $conn->query($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);//array 
$sinhvien = $stmt->fetchAll();
?>

<?php include_once "../includes/header.php" ?>

<div class="container-fluid px-4">
<a href="add.php"> Thêm mới </a>
<p>
    <?= $msg ?>
</p>
<table border="1" class="table">
    <thead>
        <tr>
            <th>MÃ SINH VIÊN</th>
            <th>TÊN SINH VIÊN</th>
            <th>ĐỊA CHỈ</th>
            <th>EMAIL</th>
            <th>SĐT</th>
            <th>HÀNH ĐỘNG</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach( $sinhvien as $key => $row ): 
            // echo '<pre>';
            // print_r($row);
            // die();
            ?>
            <tr>
                <td> <?php echo $key+1;?> </td>
                <td><?php echo $row['tenSV'];?></td>
                <td><?php echo $row['diachi'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['sdt'];?></td>
                <td>
                    <a class="btn btn-primary" href="edit.php?id=<?= $row['id'] ;?>">Sửa</a> <br>
                    <a class="btn btn-danger" onclick="return confirm('bạn có muốn xóa sinh viên này không ?');" href="delete.php?id=<?= $row['id'] ;?>">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php include_once "../includes/footer.php" ?>

