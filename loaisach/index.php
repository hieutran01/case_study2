<?php include_once '../db.php'; ?>
<?php
$sql = "SELECT * FROM `loaisach`";



$stmt = $conn->query($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);//array 
$loaisach = $stmt->fetchAll();
?>
<?php include_once "../includes/header.php" ?>

<div class="container-fluid px-4">
<a href="add.php"> Thêm mới </a>
<table border="1" class="table">
    <thead>
        <tr>
            <th>MALOAISACH</th>
            <th>THELOAISACH</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach( $loaisach as $key => $row ): 
            // echo '<pre>';
            // print_r($row);
            // die();
            ?>
            <tr>
                <td> <?php echo $key+1;?> </td>
                <td><?php echo $row['tenloaisach'];?></td>
                <td>
                    <a class="btn btn-primary" href="edit.php?id=<?= $row['id'] ;?>">Sửa</a> <br>
                    <a class="btn btn-danger" onclick="return confirm('bạn có muốn xóa loại sách này không ?');" href="delete.php?id=<?= $row['id'] ;?>">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>


<?php include_once "../includes/footer.php" ?>
