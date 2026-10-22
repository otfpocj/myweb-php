<?php
echo "<h1>สวัสดี! เว็บ PHP ของฉันทำงานแล้ว 🚀</h1>";

// ดึงค่าเชื่อมต่อจาก Environment Variables
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$port = getenv('DB_PORT') ?: 5432;

if ($host) {
    try {
        // ตัวอย่างเชื่อมต่อ PostgreSQL (ของ Supabase)
        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
        $conn = new PDO($dsn, $username, $password);
        echo "<p style='color: green;'>✅ เชื่อมต่อฐานข้อมูลสำเร็จแล้ว!</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>❌ เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p style='color: orange;'>⚠️ ยังไม่ได้ตั้งค่าตัวแปรฐานข้อมูล</p>";
}
?>
