<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>
<head>
<link rel="stylesheet" href="style.css">

</head>
<h1>Admin Dashboard</h1>
<a href="add_book.php">Add Book</a> | <a href="view_books.php">View Books</a> | <a href="logout.php">Logout</a>