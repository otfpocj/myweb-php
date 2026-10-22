<?php
// แทนที่ด้วย Web App URL ที่ได้จาก Google Apps Script
$scriptUrl = "https://script.google.com/macros/s/AKfycbwF-oqgOgyf9npSQP7VQq-WsJ-0HGkQsrqSePwVzgXOlCarwK56gZj5kVgS7ynogkkROA/exec"; 

// จัดการการเพิ่มข้อมูล
if (isset($_POST['add'])) {
    $name = urlencode($_POST['name']);
    $email = urlencode($_POST['email']);
    file_get_contents("$scriptUrl?action=add&name=$name&email=$email");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// จัดการการลบข้อมูล
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    file_get_contents("$scriptUrl?action=delete&id=$id");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// ดึงข้อมูลมาแสดงผล
$response = @file_get_contents("$scriptUrl?action=get");
$users = json_decode($response, true);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ระบบจัดการข้อมูลด้วย Google Sheets + PHP</title>
    <style>
        body { font-family: sans-serif; margin: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        form { background: #f9f9f9; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        input { padding: 8px; margin-right: 10px; }
        button { padding: 8px 15px; background: #28a745; color: white; border: none; cursor: pointer; }
        a.delete { color: red; text-decoration: none; }
    </style>
</head>
<body>

    <h1>🚀 ระบบจัดการข้อมูล (Google Sheets Backend)</h1>

    <!-- ฟอร์มเพิ่มข้อมูล -->
    <form method="POST">
        <h3>เพิ่มข้อมูลใหม่</h3>
        <input type="text" name="name" placeholder="ชื่อ-นามสกุล" required>
        <input type="email" name="email" placeholder="อีเมล" required>
        <button type="submit" name="add">บันทึกข้อมูล</button>
    </form>

    <!-- ตารางแสดงข้อมูล -->
    <h3>รายชื่อในระบบ</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>ชื่อ</th>
            <th>อีเมล</th>
            <th>จัดการ</th>
        </tr>
        <?php if (!empty($users) && is_array($users)): ?>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td><?= htmlspecialchars($user['name']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><a class="delete" href="?delete_id=<?= $user['id'] ?>" onclick="return confirm('ยืนยันการลบ?')">ลบ</a></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4" style="text-align: center;">ยังไม่มีข้อมูลในระบบ</td></tr>
        <?php endif; ?>
    </table>

</body>
</html>
