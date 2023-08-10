<?php include_once '../db.php'; ?>
<?php


// để xác định số lượng bản ghi hiển thị trên mỗi trang.
$records_per_page = 6;

// sử dụng để lấy số trang hiện tại từ tham số truy vấn URL. Nếu tham số truy vấn không tồn tại, thì số trang được đặt là 1.
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

//  $start_index và $limit được tính toán để xác định vị trí bắt đầu của bản ghi và số bản ghi được hiển thị trên trang hiện tại.
$start_index = ($current_page - 1) * $records_per_page;
// $limit lưu trữ số lượng bản ghi hiển thị trên mỗi trang, được tính dựa trên biến $records_per_page.
$limit = $records_per_page;
//đếm tổng số bản ghi trong bảng
$sql_count = "SELECT COUNT(*) AS total_records FROM loaisach";


$sql = "SELECT * FROM `loaisach`";

    
if (isset($_GET["s"]) && !empty(trim($_GET["s"]))) {
    $s1 = $_GET["s"];
   
    $sql .= " WHERE loaisach.tenloaisach  LIKE '%$s1%'";
}
else{
        $sql .= " LIMIT $start_index, $limit";
}

$stmt_count = $conn->query($sql_count);
$total_records = $stmt_count->fetch(PDO::FETCH_ASSOC)['total_records'];


// if( isset( $_GET["s"] )  ){
//     $s1= $_GET["s"];
//     $sql .= " WHERE loaisach.tenloaisach  LIKE '%$s1%'";

// }

$stmt = $conn->query($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);//array 
$loaisach = $stmt->fetchAll();
?>
<?php include_once "../includes/header.php" ?>

<div class="container-fluid px-4">
  <a class="btn btn-success mb-3" href="add.php"> Thêm mới </a>
  <table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>Thể Loại Sách</th>
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
<?php if ($total_records > $records_per_page) : ?>
        <div class="pagination justify-content-center">
            <?php
            // khi mà trang đang nằm ở vị số 1 thì k có phần này
            $total_pages = ceil($total_records / $records_per_page);
            if ($current_page > 1) :
            ?>
                <a class="page-link" href="?page=<?php echo $current_page - 1; ?>" aria-label="Trang trước">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            <?php endif; ?>
                 <!-- lấy ra được số lượng trang -->
            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                <?php if ($i == $current_page) : ?>
                    <a class="page-link active" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php else : ?>
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>
            <!-- hiển thị khi mà không phải trang cuối cùng -->
            <?php if ($current_page < $total_pages) : ?>
                <a class="page-link" href="?page=<?php echo $current_page + 1; ?>" aria-label="Trang sau">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
