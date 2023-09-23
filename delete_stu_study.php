<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    $stuId = $_GET['stuId'];

    $host = 'localhost';
    $uname = 'root';
    $pword = '';
    $dbname = 'ComSciDB';

    try {
        $con = new PDO("mysql:host=$host;dbname=$dbname", $uname, $pword);
    } catch (PDOException $ex) {
        echo "Connection Error :" . $ex->getMessage();
    }

    $stmt = $con->prepare("DELETE FROM tb_studentstudy WHERE stuId=:stuId");


    $stuId = intval(htmlspecialchars(strip_tags($stuId)));



    $stmt->bindParam(":stuId", $stuId);


    if ($stmt->execute() == true) {
        echo "ลบข้อมูลในฐานข้อมูลเรียบร้อยแล้ว";
        echo "<meta http-equiv=\"refresh\" content=\"3; url=showallpage.php\">";
    } else {
        echo "Delete ล้มเหลว กรุณาติดต่อ ADMIN";
    }


    $con = null

    ?>
</body>

</html>