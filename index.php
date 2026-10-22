<?php
echo "<h1>กำลังทดสอบเชื่อมต่อฐานข้อมูล...</h1>";

// ใช้การเชื่อมต่อแบบ Direct เข้า Supabase โดยตรง (ตัดปัญหาเรื่อง Tenant User ของ Pooler)
$host = "db.oemjlrwnbeaslblmfgqy.supabase.co";
$port = "5432";
$dbname = "postgres";
$user = "postgres";
$password = "@Stu365771319800624924"; // <-- เปลี่ยนตรงนี้เป็นรหัสผ่านจริงของคุณ

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $conn = new PDO($dsn, $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p style='color: green; font-size: 20px;'><b>✅ เย้! เชื่อมต่อฐานข้อมูลสำเร็จแล้ว!</b></p>";
    
} catch (PDOException $e) {
    echo "<p style='color: red;'><b>❌ เชื่อมต่อไม่สำเร็จ:</b> " . $e->getMessage() . "</p>";
}
?>
