<?php
include 'db.php';
$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: view_books.php");
exit();
?>