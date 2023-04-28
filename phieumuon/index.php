<?php include_once '../db.php'; ?>
<?php
$sql = "SELECT phieumuon.id, sinhvien.tenSV, sach.tensach, phieumuon.ngaymuonsach, phieumuon.ngaydukientra
FROM phieumuon
JOIN sinhvien ON phieumuon.sinhvien_id = sinhvien.id
JOIN sach ON phieumuon.sach_id = sach.id;";

$stmt = $conn->query($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);//array 
$phieumuon = $stmt->fetchAll();
// var_dump($phieumuon);   
// die();
?>
<?php include_once "../includes/header.php" ?>

<div class="container-fluid px-4">
<a href="add.php"> Thêm mới </a>
<table border="1" class="table">
    <thead>
        <tr>
            <th>MAPHIEUMUON</th>
            <th>NGAYMUONSACH</th>
            <th>NGAYDUKIENTRA</th>
            <th>THUOUCSACH</th>
            <th>THUOCSINHVIEN</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach( $phieumuon as $key => $row ): 
            // echo '<pre>';
            // print_r($row);
            // die();
            ?>
            <tr>
                <td> <?php echo $key+1;?> </td>
                <td><?php echo $row['ngaymuonsach'];?></td>
                <td><?php echo $row['ngaydukientra'];?></td>
                <td><?php echo $row['tensach'];?></td>
                <td><?php echo $row['tenSV'];?></td>
                <td>
                    <a class="btn btn-primary" href="edit.php?id=<?= $row['id'] ;?>">Sửa</a> <br>
                    <a class="btn btn-danger" onclick="return confirm('bạn có muốn xóa phiếu mượn này không ?');" href="delete.php?id=<?= $row['id'] ;?>">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

<?php include_once "../includes/footer.php" ?>
