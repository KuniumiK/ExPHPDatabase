<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <!-- รับค่าข้อมูลที่ส่งมาเอาไปบันทึกเพื่อแก้ไขลงใน Database แล้วแจ้งว่าบันทึกเรียบร้อย -->

    <?php

    // สร้างตัวแปรเก็บข้อมูลที่ส่งมา
    $stuId = $_POST["stuId"];
    $stuName = $_POST["stuName"];
    $midtermScore = $_POST["midtermScore"];
    $finalScore = $_POST["finalScore"];
    $quizScore = $_POST["quizScore"];

    // ทำงานกับ Database โดยใช้ (MySQLi Object - oriented) 
    // 1.สร้าง Connection ไปยัง Database
    $host = "localhost";
    $uname = "root";
    $pword = "";
    $dbname = "ComSciDB";

    $conn = new mysqli($host, $uname, $pword, $dbname);

    if ($conn->connect_error) {
        die("Connection error : " . $conn->connect_error);
    }

    // 2. สร้างคำสั่ง sql นำข่อมูลที่ส่งมาไป update
    $str_sql = "UPDATE tb_studentstudy SET stuName = '{$stuName}' , midtermScore = '{$midtermScore}'  , finalScore = $finalScore  , quizScore = '{$quizScore}'
                    WHERE stuId = {$stuId}";


    // 3. สั่งให้ sql ทำงาน
    if ($conn->query($str_sql) == true) {
        echo "<h1>บันทึกข้อมูลเรีบร้อยแล้ว</h1>";
        echo "<meta http-equiv = \"refresh\" content = \"3; url=showallpage.php\" >";
    } else {
        echo "<h1>Error : พบปัญหาในการบันทึกข้อมูล ลองอีกครั้งหรือติดต่อ support@gmail.com </h1>";
    }

    // 4.ยกเลิกการเชื่อมต่อ
    $conn->close();

    ?>

</body>

</html>