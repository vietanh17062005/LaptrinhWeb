<?php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['full_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $hometown = $_POST['hometown'];
    $level = $_POST['level_id'];
    $group_number = $_POST['group_id'];

    // Kiểm tra trùng khóa chính trước khi thêm
    $check_sql = "SELECT * FROM table_Students WHERE full_name = '$fullname' AND dob = '$dob'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "Sinh viên này đã tồn tại trong hệ thống!";
    } else {
        // Không cần phải cung cấp giá trị khóa chính ('id') khi thêm
        // Sử dụng hàm `LAST_INSERT_ID()` để lấy id cuối cùng và thêm 1 vào để xác định id mới
        $last_id_sql = "SELECT MAX(id) as last_id FROM table_Students";
        $last_id_result = $conn->query($last_id_sql);
        $row = $last_id_result->fetch_assoc();
        $new_id = $row['last_id'] + 1;

        $sql = "INSERT INTO table_Students (id, full_name, dob, gender, hometown, level_id, group_id)
                VALUES ('$new_id', '$fullname', '$dob', '$gender', '$hometown', '$level', '$group_number')";

        if ($conn->query($sql) === TRUE) {
            header('Location: index.php');
        } else {
            echo "Lỗi: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm mới Sinh viên</title>
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
    <h1>Thêm mới sinh viên</h1>
    <form method="POST">
        <label>Họ và tên:</label>
        <input type="text" name="full_name" required><br>
        
        <label>Ngày sinh:</label>
        <input type="datetime-local" name="dob" required><br>
        
        <label>Giới tính:</label>
        <input type="radio" name="gender" value="1" required> Nam
        <input type="radio" name="gender" value="0" required> Nữ<br>
        
        <label>Quê quán:</label>
        <input type="text" name="hometown" required><br>
        
        <label>Trình độ học vấn:</label>
        <select name="level_id" required>
            <option value="0">Tiến sĩ</option>
            <option value="1">Thạc sĩ</option>
            <option value="2">Kỹ sư</option>
            <option value="3">Khác</option>
        </select><br>
        
        <label>Nhóm:</label>
        <input type="number" name="group_id" required><br>
        
        <button type="submit">Lưu</button>
    </form>
    <a href="index.php">Quay lại</a>
</body>
</html>
