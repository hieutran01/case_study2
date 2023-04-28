<?php include_once '../db.php'; ?>
<?php
$sql = "SELECT sach.*,loaisach.tenloaisach AS ten_loai_sach FROM `sach`
JOIN loaisach ON sach.loaisach_id  = loaisach.id";



$stmt = $conn->query($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);//array 
$sach = $stmt->fetchAll();
?>

<?php include_once "../includes/header.php" ?>

<div class="container-fluid px-4">
<a href="add.php"> Thêm mới </a>
<table border="1" class="table">
    <thead>
        <tr>
            <th>MASACH</th>
            <th>TENSACH</th>
            <th>TENTACGIA</th>
            <th>NGAYXUATBAN</th>
            <th>Thuộc loại sách</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach( $sach as $key => $row ): 
            // echo '<pre>';
            // print_r($row);
            // die();
            ?>
            <tr>
                <td> <?php echo $key+1;?> </td>
                <td><?php echo $row['tensach'];?></td>
                <td><?php echo $row['tentacgia'];?></td>
                <td><?php echo $row['ngayxuatban'];?></td>
                <td><?php echo $row['ten_loai_sach'];?></td>
            
                <td>
                    <a class="btn btn-primary" href="edit.php?id=<?= $row['id'] ;?>">Sửa</a> <br>
                    <a class="btn btn-danger" onclick="return confirm('bạn có muốn xóa sách này không ?');" href="delete.php?id=<?= $row['id'] ;?>">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php include_once "../includes/footer.php" ?>
