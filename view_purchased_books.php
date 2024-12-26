<?php
session_start();
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch purchased books with details from the books table
$query = "
    SELECT books.title, books.author, books.price
    FROM purchases
    JOIN books ON purchases.book_id = books.id
    WHERE purchases.user_id = $user_id
";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Purchased Books</title>
</head>
<body>
    <h1>Your Purchased Books</h1>
    <table border="1">
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Price</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['title']); ?></td>
            <td><?php echo htmlspecialchars($row['author']); ?></td>
            <td>$<?php echo htmlspecialchars($row['price']); ?></td>
        </tr>
        <?php } ?>
    </table>
    <a href="customer_dashboard.php">Back to Dashboard</a>
</body>
</html>
