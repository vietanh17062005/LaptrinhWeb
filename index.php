<?php
include('db_connection.php');

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$sql = "SELECT * FROM table_Students WHERE full_name LIKE '%$search%' OR hometown LIKE '%$search%'";

$result = $conn->query($sql);

// Kiểm tra lỗi truy vấn
if (!$result) {
    die("Lỗi trong câu truy vấn SQL: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sinh viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #4CAF50;
        }
        form, table {
            width: 80%;
            margin: auto;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        input, select, button {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ddd;
            border-radius: 3px;
            font-size: 14px;
        }
        input[type="radio"] {
            width: auto;
            margin-right: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            opacity: 0.9;
        }
        a {
            display: inline-block;
            margin-right: 10px;
            text-decoration: none;
        }
        .search-box {
            text-align: center;
            margin-bottom: 20px;
        }
        .icon {
            width: 24px;
            height: 24px;
            display: block;
            margin: auto;
        }
        .add-button {
            display: inline-block;
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            border-radius: 3px;
        }
        td.index {
            text-align: center;
        }
        th {
            text-align: center;
        }
        td.action {
            text-align: center; /* Căn giữa icon trong thao tác */
        }
    </style>
</head>
<body>
    <h1>Danh sách sinh viên</h1>
    <div class="search-box">
        <form method="GET" action="index.php">
            <input type="text" name="search" placeholder="Tìm kiếm theo họ tên hoặc quê quán..." value="<?php echo $search; ?>" required>
            <button type="submit">Tìm kiếm</button>
        </form>
    </div>
    <table>
        <thead>
            <tr>
                <th>Số thứ tự</th>
                <th>Họ và tên</th>
                <th>Ngày sinh</th>
                <th>Giới tính</th>
                <th>Quê quán</th>
                <th>Trình độ học vấn</th>
                <th>Nhóm</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                $index = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='index'>" . $index++ . "</td>"; // Căn giữa nội dung ô số thứ tự
                    echo "<td>" . htmlspecialchars($row['full_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['dob']) . "</td>";
                    echo "<td>" . (($row['gender'] == 1) ? 'Nam' : 'Nữ') . "</td>";
                    echo "<td>" . htmlspecialchars($row['hometown']) . "</td>";
                    echo "<td>";
                    switch ($row['level_id']) {
                        case 0: echo 'Tiến sĩ'; break;
                        case 1: echo 'Thạc sĩ'; break;
                        case 2: echo 'Kỹ sư'; break;
                        default: echo 'Khác'; break;
                    }
                    echo "</td>";
                    echo "<td>Nhóm " . htmlspecialchars($row['group_id']) . "</td>";
                    echo "<td class='action'>"; // Căn giữa các icon trong thao tác
                    echo "<a href='edit.php?id=" . $row['id'] . "'><img src='icons/edit-icon.jpg' alt='Sửa' class='icon'></a> ";
                    echo "<a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa?\");'><img src='icons/delete-icon.jpg' alt='Xóa' class='icon'></a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Không có dữ liệu!</td></tr>";
            }
            ?>
        </tbody>
    </table>    
    <a href="add.php" class="add-button">Thêm sinh viên mới</a>
</body>
</html>

<?php $conn->close(); ?>