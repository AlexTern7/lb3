<?php
$db = new PDO("mysql:host=127.0.0.1;dbname=lessons", "root", "");

function addLesson($db, $week_day, $lesson_number, $auditorium, $disciple, $type, $teacher, $group): void
{
    $statement = $db->prepare("INSERT INTO lesson (week_day, lesson_number, auditorium, disciple, `type`) VALUES (?, ?, ?, ?, ?)");
    $statement->execute([$week_day, $lesson_number, $auditorium, $disciple, $type]);
    $lessonId = $db->lastInsertId();
    $statement = $db->prepare("INSERT INTO lesson_teacher (FID_Teacher, FID_Lesson1) VALUES (:teacher, :lesson);
        INSERT INTO lesson_groups (FID_Groups, FID_Lesson2) VALUES (:group, :lesson)");
    $statement->execute(["teacher"=>$teacher, "lesson"=>$lessonId, "group"=>$group]);
}

function groups($db): void
{
    $statement = $db->query("SELECT DISTINCT * FROM groups");
    while ($data = $statement->fetch()) {
        echo "<option value='$data[0]'>$data[1]</option>";
    }
}

function teachers($db): void
{
    $statement = $db->query("SELECT DISTINCT * FROM teacher");
    while ($data = $statement->fetch()) {
        echo "<option value='$data[0]'>$data[1]</option>";
    }
}

function auditoriums($db): void
{
    $statement = $db->query("SELECT DISTINCT auditorium FROM lesson");
    while ($data = $statement->fetch()) {
        echo "<option value='$data[0]'>$data[0]</option>";
    }
}

if (isset($_POST["week_dayAdd"])) {
    addLesson($db, $_POST["week_day1"], $_POST["lesson_number1"], $_POST["auditorium1"], $_POST["disciple1"], $_POST["type1"], $_POST["teacher1"], $_POST["group1"]);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lab3</title>
    <script src="script.js"></script>
</head>
<body>

<form action="" method="post" id="group">
    <select name="group">
        <?php
        groups($db);
        ?>
    </select>
    <input type="submit"><br>
</form>
<br>
<form action="" method="post" id="teacher">
    <select name="teacher">
        <?php
        teachers($db);
        ?>
    </select>
    <input type="submit"><br>
</form>
<br>
<form action="" method="post" id="auditorium">
    <select name="auditorium">
        <?php
        auditoriums($db);
        ?>
    </select>
    <input type="submit"><br>
</form>
<br>
<div id="content"></div>
<br>
<form action="" method="post">
    <input type="text" name="week_day1" placeholder="Add Week Day">
    <input type="number" name="lesson_number1" placeholder="Add Lesson Number">
    <input type="text" name="auditorium1" placeholder="Add Auditorium">
    <input type="text" name="disciple1" placeholder="Add Discipline">
    <input type="text" name="type1" placeholder="Add Type">
    <select name="teacher1">
        <?php
        teachers($db);
        ?>
    </select>
    <select name="groupAdd">
        <?php
        groups($db);
        ?>
    </select>
    <input type="submit" value="Добавить"><br>
</form>
</body>
</html>
