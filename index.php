<?php
echo "<h1>สวัสดี! เว็บ PHP ของฉันทำงานแล้ว 🚀</h1>";

// ดึงค่าจาก Environment Variables ที่ตั้งไว้ใน Render
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$port = getenv('DB_PORT') ?: 5432;

if ($host) {
    try {
        // เชื่อมต่อ PostgreSQL (Supabase Connection Pooling)
        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
        $conn = new PDO($dsn, $username, $password);
        
        // ตั้งค่า Error Mode เป็น Exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<p style='color: green;'>✅ เชื่อมต่อฐานข้อมูลสำเร็จแล้ว!</p>";
        
    } catch (PDOException $e) {
        echo "<p style='color: red;'>❌ เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p style='color: orange;'>⚠️ ยังไม่ได้ตั้งค่าตัวแปรฐานข้อมูล</p>";
}
?>
