<?php
 include_once '../db.php';//$conn
//  echo '<pre>';
//  print_r($_GET);
//  die();

 // Lay gia tri ID tren URL
 $id = $_GET['id'];
 //Debug id
 //var_dump($id);die();

 $sql = "DELETE FROM loaisach WHERE id = $id";
 //Debug sql
 //var_dump($sql);die();

 //Thuc hien truy van
 $conn->exec($sql);

 // chuyen huong ve trang danh sach
 header("Location: index.php");