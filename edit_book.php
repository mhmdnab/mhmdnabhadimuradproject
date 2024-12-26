<?php
include 'db.php';

// Validate the provided ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid or missing book ID. <a href='view_books.php'>Back to Book List</a>");
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $stmt = $conn->prepare("UPDATE books SET title = ?, author = ?, price = ?, quantity = ? WHERE id = ?");
    $stmt->bind_param("ssdii", $title, $author, $price, $quantity, $id);
    if ($stmt->execute()) {
        echo "Book updated successfully! <a href='view_books.php'>Back to Book List</a>";
    } else {
        echo "Error updating book: " . $stmt->error;
    }
} else {
    $stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a record is found
    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        die("Book not found. <a href='view_books.php'>Back to Book List</a>");
    }
}
?>
<head>
<link rel="stylesheet" href="style.css">
</head>
<form method="POST">
    Title: <input type="text" name="title" value="<?php echo htmlspecialchars($book['title'] ?? ''); ?>" required><br>
    Author: <input type="text" name="author" value="<?php echo htmlspecialchars($book['author'] ?? ''); ?>" required><br>
    Price: <input type="number" name="price" step="0.01" value="<?php echo htmlspecialchars($book['price'] ?? ''); ?>" required><br>
    Quantity: <input type="number" name="quantity" value="<?php echo htmlspecialchars($book['quantity'] ?? ''); ?>" required><br>
    <button type="submit">Update Book</button>
</form>
