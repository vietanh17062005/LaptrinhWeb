<?php
include('db_connection.php');

$id = $_GET['id'];

$sql = "DELETE FROM table_Students WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header('Location: index.php');
} else {
    echo "Lỗi: " . $conn->error;
}

$conn->close();
?>
