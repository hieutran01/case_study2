<?php
 include_once '../db.php';//$conn
//  echo '<pre>';
//  print_r($_GET);
//  die();

 // Lay gia tri ID tren URL
 $id = $_GET['id'];
 //Debug id
 //var_dump($id);die();

 $sql = "DELETE FROM phieumuon WHERE id = $id";
 //Debug sql
//  var_dump($sql);die();

 //Thuc hien truy van
 try {
   $conn->exec($sql);
   $msg = 'xóa thành công';
 } catch (Exception $e) {
   $msg = 'xóa không thành công';
 }


 // chuyen huong ve trang danh sach
 header("Location: index.php?msg=$msg");