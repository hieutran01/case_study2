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
$sql_count = "SELECT COUNT(*) AS total_records FROM phieumuon";


$sql = "SELECT phieumuon.id, sinhvien.tenSV, sach.tensach, phieumuon.ngaymuonsach, phieumuon.ngaydukientra
FROM phieumuon
JOIN sinhvien ON phieumuon.sinhvien_id = sinhvien.id
JOIN sach ON phieumuon.sach_id = sach.id";


// phân trang và tìm kiếm
if (isset($_GET["s"]) && !empty(trim($_GET["s"]))) {
    $s = $_GET["s"];
   
    $sql .= " WHERE sinhvien.tenSV  LIKE '$s' OR sach.tensach LIKE '$s' OR phieumuon.ngaymuonsach LIKE '$s' OR phieumuon.ngaydukientra LIKE '$s'";
}
else{
        $sql .= " LIMIT $start_index, $limit";
}

$stmt_count = $conn->query($sql_count);
$total_records = $stmt_count->fetch(PDO::FETCH_ASSOC)['total_records'];




// tìm kiếm
// if( isset( $_GET["s"] )  ){
//     $s1= $_GET["s"];
//     $sql .= " WHERE sinhvien.tenSV  LIKE '%$s1%' OR sach.tensach LIKE '%$s1%' OR phieumuon.ngaymuonsach LIKE '%$s1%' OR phieumuon.ngaydukientra LIKE '%$s1%'";
// }


$stmt = $conn->query($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);//array 
$phieumuon = $stmt->fetchAll();
// var_dump($phieumuon);   
// die();
?>
<?php include_once "../includes/header.php" ?>

<div class="container-fluid px-4">
  <a class="btn btn-success" href="add.php">Thêm mới</a>
  <table class="table table-bordered mt-4">
    <thead>
        <tr>
            <th>STT</th>
            <th>Ngày Mượn Sách</th>
            <th>Ngày Dự Kiến Trả</th>
            <th>Thuộc Sách</th>
            <th>Thuộc Sinh Viên</th>
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

<!-- phân trang -->
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