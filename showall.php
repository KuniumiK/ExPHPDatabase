<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1 style="text-align:center;color: rgb(27, 52, 121);">ข้อมูลคะแนนนักศึกษา</h1>
    <?php

        //ดึงข้อมูลจากตาราง มาแสดง
        // 1.สร้าง Connection ไปยัง Database
        $host = "localhost";
        $uname = "root";
        $pword = "";
        $dbname = "ComSciDB";

        $conn = new mysqli($host, $uname, $pword, $dbname);

        if ($conn->connect_error) {
            die("Connection error : " . $conn->connect_error);
        }

        //2.สร้างคำสั่ง sql เพื่อไปดึง/เอาข้อมูลทั้งหมดมาจากตาราง student_tb
        $str_sql =  "SELECT * FROM tb_studentstudy";

        //3.สั่งให้ sql ทำงาน
        //สำหรับคำสั่ง SELECT เราควรสร้างตัวแปรมาเก็บข้อมูลที่ได้มาจากการไปดึง/เอามา
        $result = $conn->query($str_sql);

        //4.เอาข้อมูลที่ได้มาไปใช้งาน ณ ที่นี้เอาไปแสดงผลบนหน้าจอเบราเซอร์
        if ($result->num_rows > 0) {
            //กรณีมีข้อมูล ข้อฒุลอาจจะมีมากกว่า 1 แถว/เรคอด จึงต้อง loop เพื่อนำข้อมูลทั้งหมดมาแสดง
            echo "<table width = \"800\" border = \"1\">";
            echo "<tr style=\"text-align:center\">";
            echo "<td>รหัส</td> <td>ชื่อ-นามสกุล</td> <td>คะแนนสอบกลางภาค</td> <td>คะแนนสอบปลายภาค</td> <td>คะแนนเก็บ</td> <td>คะแนนรวม</td> <td>แก้ไขข้อมูล</td> <td>ลบข้อมูล</td>";
            echo "</td>";
            while ($row = $result->fetch_assoc()) { //การ fetch คือการเข้าถึงข้อมูลในแต่ละแถว/เรคอด
                echo "<tr> ";
                echo "<td>" . $row["stuId"] . "</td> ";
                echo "<td style = \"text-align:center\">" . $row["stuName"] ."</td>";
                echo "<td style = \"text-align:center\">" . $row["midtermScore"] ."</td>";
                echo "<td style = \"text-align:center\">" . $row["finalScore"] ."</td>";
                echo "<td style = \"text-align:center\">" . $row["quizScore"] ."</td>";

                $totalScore = $row["midtermScore"] + $row["finalScore"] + $row["quizScore"];
                echo "<td style = \"text-align:center\">" . "$totalScore" . "</td>";

                echo "<td style = \"text-align:center\">";
                echo "<a href =\"edit_stu_study.php?stuId = " . $row["stuId"] . "\"> แก้ไข </a>"; //ส่งค่าตัวแปรไปด่วย 
                echo "</td>";
                echo "<td style = \"text-align:center\">";
                echo "<a href =\"delete_stu_study.php?stuId = " . $row["stuId"] . "\"> ลบ </a>";
                echo "</td>";
                echo "</tr> ";
            }
                echo "</table>";
        } else {
            echo "<strong> ไม่พบข้อมูล... </strong>";
        }

        //5.ยกเลิกการเชื่อมต่อ Database 
        $conn->close();

    ?>

</body>

</html>