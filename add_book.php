<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $stmt = $conn->prepare("INSERT INTO books (title, author, price, quantity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $title, $author, $price, $quantity);
    $stmt->execute();
    echo "Book added successfully! <a href='admin_dashboard.php'>Back to Dashboard</a>";
}
?>
<head>
<link rel="stylesheet" href="style.css">

</head>
<form method="POST">
    Title: <input type="text" name="title" required><br>
    Author: <input type="text" name="author" required><br>
    Price: <input type="number" name="price" step="0.01" required><br>
    Quantity: <input type="number" name="quantity" required><br>
    <button type="submit">Add Book</button>
</form>