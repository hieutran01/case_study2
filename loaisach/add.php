<?php
    include_once '../db.php';
    $error = array();
    //Xử lý form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $tenloaisach = $_POST['tenloaisach'];
        
        //Xác thực các trường nhập liệu
        if (empty($tenloaisach)) {
            $error['tenloaisach'] = 'Vui lòng nhập tên loại sách!';
        }
        
        //Kiểm tra có lỗi hay không
        if (count($error) == 0) {
            //Câu truy vấn SQL
            $sql = "INSERT INTO loaisach (tenloaisach) VALUES ('$tenloaisach')";
            //Thực hiện truy vấn
            $conn->exec($sql);
            //Chuyển hướng đến trang index.php
            header("Location: index.php");
            exit();
        }
    }
?>
<?php include_once "../includes/header.php" ?>

<div class="container-fluid px-4">
    <h2>Thêm mới thể loại</h2>
    <form action="" method="post">
        <div class="mb-3">
            <label for="tenloaisach" class="form-label">Thể Loại Sách</label>
            <input type="text" class="form-control" id="tenloaisach" name="tenloaisach" value="<?php if(isset($_POST['tenloaisach'])) echo $_POST['tenloaisach']; ?>">
            <?php if (isset($error['tenloaisach'])) echo '<small class="text-danger">' . $error['tenloaisach'] . '</small>'; ?>
        </div>
        <button type="submit" class="btn btn-success">Thêm</button>
    </form>
</div>
