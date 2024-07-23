<?php

// Создаем соединение
$conn = new mysqli("localhost", "root", "", "toilet_paper_store");

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Извлечение блогов из базы данных
$sql = "SELECT id, username, topic, description FROM blogs";
$result = $conn->query($sql);


    // Вывод блогов
while($line=mysqli_fetch_row($result))  {
    echo "<b>Имя:</b>".$line[0]."<br>";
    echo "<b>Email:</b>".$line[1]."<br>";
    echo "<b>Сообщение:</b>".$line[2]."<br>";

}
?>
