<?php
include('db_connection.php');

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['full_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $hometown = $_POST['hometown'];
    $level = $_POST['level_id'];
    $group_number = $_POST['group_id'];

    $sql = "UPDATE table_Students SET full_name='$fullname', dob='$dob', gender='$gender',
            hometown='$hometown', level_id='$level', group_id='$group_number' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Lấy thông tin sinh viên hiện tại
$sql = "SELECT * FROM table_Students WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa thông tin sinh viên</title>
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
        form {
            width: 300px;
            margin: auto;
            padding: 20px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
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
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #4CAF50;
        }
    </style>
</head>
<body>
    <h1>Sửa thông tin sinh viên</h1>
    <form method="POST">
        <label>Họ và tên:</label>
        <input type="text" name="full_name" value="<?php echo $row['full_name']; ?>" required><br>
        
        <label>Ngày sinh:</label>
        <input type="datetime-local" name="dob" value="<?php echo date('Y-m-d\TH:i', strtotime($row['dob'])); ?>" required><br>
        
        <label>Giới tính:</label>
        <input type="radio" name="gender" value="1" <?php echo ($row['gender'] == 1) ? 'checked' : ''; ?> required> Nam
        <input type="radio" name="gender" value="0" <?php echo ($row['gender'] == 0) ? 'checked' : ''; ?> required> Nữ<br>
        
        <label>Quê quán:</label>
        <input type="text" name="hometown" value="<?php echo $row['hometown']; ?>" required><br>
        
        <label>Trình độ học vấn:</label>
        <select name="level_id" required>
            <option value="0" <?php echo ($row['level_id'] == 0) ? 'selected' : ''; ?>>Tiến sĩ</option>
            <option value="1" <?php echo ($row['level_id'] == 1) ? 'selected' : ''; ?>>Thạc sĩ</option>
            <option value="2" <?php echo ($row['level_id'] == 2) ? 'selected' : ''; ?>>Kỹ sư</option>
            <option value="3" <?php echo ($row['level_id'] == 3) ? 'selected' : ''; ?>>Khác</option>
        </select><br>
        
        <label>Nhóm:</label>
        <input type="number" name="group_id" value="<?php echo $row['group_id']; ?>" required><br>
        
        <button type="submit">Cập nhật</button>
    </form>
    <a href="index.php">Quay lại</a>
</body>
</html>
