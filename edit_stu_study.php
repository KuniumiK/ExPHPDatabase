<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1 style="text-align:center;color: rgb(27, 52, 121);">แก้ไขข้อมูลคะแนนนักศึกษา</h1>
    <?php

    //ทำงานกับ database โดยใช้ (MySQL Oblect-oriented)
    // 1.สร้าง Connection ไปยัง Database
    $host = "localhost";
    $uname = "root";
    $pword = "";
    $dbname = "ComSciDB";

    $conn = new mysqli($host, $uname, $pword, $dbname);

    if ($conn->connect_error) {
        die("Connection error : " . $conn->connect_error);
    }

    //2.สร้างคำสั่ง sql เพื่อไปดึง/เอาข้อมูลทั้งหมดมาจากตาราง 
    $str_sql =  "SELECT * FROM tb_studentstudy WHERE stuId = " . $_GET["stuId"];

    //3.สั่งให้ sql ทำงาน
    //สำหรับคำสั่ง SELECT เราควรสร้างตัวแปรมาเก็บข้อมูลที่ได้มาจากการไปดึง/เอามา
    $result = $conn->query($str_sql);

    //4.เอาข้อมูลที่ได้มาไปใช้งาน ณ ที่นี้เอาไปใส่ในฟอร์มเพื่อแก้ไขต่อไป
    //$row = $result->fetch_assoc(); //fetch ข้อมูลออกมาเก็บไว้ใย row

    ?>
    <table width = 80% border = 1 >
        <form action="์update_stu_study.php" method="POST" enctype="multipart/form-data">
            <tr>
                <td>
                    รหัสนักศึกษา :
                </td>
                <td>
                    <?php echo $row["stuId"] ?>
                </td>
            </tr>
            <tr>
                <td>
                    ชื่อ-นามสกุล :
                </td>
                <td>
                    <input type="text" name="stuName" id="" value="<?php echo $row["stuName"]; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    คะแนนสอบกลางภาค :
                </td>
                <td>
                    <input type="text" name="midtermScore" id="" value="<?php echo $row["midtermScore"]; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    คะแนนสอบปลายภาค :
                </td>
                <td>
                    <input type="text" name="finalScore" id="" value="<?php echo $row["finalScore"]; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    คะแนนเก็บ :
                </td>
                <td>
                    <input type="text" name="quizScore" id="" value="<?php echo $row["quizScore"]; ?>">
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <input type="submit" value="บันทึก">
                    <input type="reset" value="ยกเลิก">
                </td>
            </tr>
        </form>
    </table>
    <?php

    //5.ยกเลิกการเชื่อมต่อ Database 
    $conn->close();

    ?>

</body>

</html>