<?php

class Lesson
{
    private PDO $db;

    public function __construct()
    {
        $this->db = new PDO("mysql:host=127.0.0.1;dbname=lessons", "root", "");
    }

    public function findGroup($group): void
    {
        $statement = $this->db->prepare("SELECT week_day, lesson_number, auditorium, disciple, type FROM lesson INNER JOIN lesson_groups ON ID_Lesson = FID_Lesson2 WHERE FID_Groups = ?");
        $statement->execute([$group]);
        $txt = "<table>";
        $txt .= " <tr>
     <th> День Недели  </th>
     <th> Пара </th>
     <th> Аудитория </th>
     <th> Дисциплина </th>
     <th> Тип Пары </th>
    </tr> ";
        while ($data = $statement->fetch()) {
            $txt .= " <tr>
         <td> {$data['week_day']}  </td>
         <td> {$data['lesson_number']} </td>
         <td> {$data['auditorium']} </td>
         <td> {$data['disciple']} </td>
         <td> {$data['type']} </td>
        </tr> ";
        }
        $txt .= "</table>";
        echo $txt;
    }

    public function findTeacher($teacher): void
    {
        $statement = $this->db->prepare("SELECT week_day, lesson_number, auditorium, disciple, type FROM lesson INNER JOIN lesson_teacher ON ID_Lesson = FID_Lesson1 WHERE FID_Teacher = ?");
        $statement->execute([$teacher]);
        $txt = "<table>";
        $txt .= " <tr>
     <th> День Недели  </th>
     <th> Пара </th>
     <th> Аудитория </th>
     <th> Дисциплина </th>
     <th> Тип Пары </th>
    </tr> ";
        while ($data = $statement->fetch()) {
            $txt .= " <tr>
         <td> {$data['week_day']}  </td>
         <td> {$data['lesson_number']} </td>
         <td> {$data['auditorium']} </td>
         <td> {$data['disciple']} </td>
         <td> {$data['type']} </td>
        </tr> ";
        }
        $txt .= "</table>";
        echo json_encode($txt);
    }

    public function findAuditorium($auditorium): void
    {
        $statement = $this->db->prepare("SELECT week_day, lesson_number, auditorium, disciple, type FROM lesson WHERE auditorium = ?");
        $statement->execute([$auditorium]);
        $txt = "<table>";
        $txt .= " <tr>
     <th> День Недели  </th>
     <th> Пара </th>
     <th> Аудитория </th>
     <th> Дисциплина </th>
     <th> Тип Пары </th>
    </tr> ";
        while ($data = $statement->fetch()) {
            $txt .= " <tr>
         <td> {$data['week_day']}  </td>
         <td> {$data['lesson_number']} </td>
         <td> {$data['auditorium']} </td>
         <td> {$data['disciple']} </td>
         <td> {$data['type']} </td>
        </tr> ";
        }
        $txt .= "</table>";
        echo $txt;
    }
}

$lesson = new Lesson();

if (isset($_POST["group"])) {
    $lesson->findGroup($_POST["group"]);
} elseif (isset($_POST["teacher"])) {
    $lesson->findTeacher($_POST["teacher"]);
} elseif (isset($_POST["auditorium"])) {
    $lesson->findAuditorium($_POST["auditorium"]);
}