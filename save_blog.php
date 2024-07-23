<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "toilet_paper_store";

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получаем данные из POST-запроса
$blog = json_decode(file_get_contents('php://input'), true);
$username = $blog['username'];
$topic = $blog['topic'];
$description = $blog['description'];

// Подготавливаем и выполняем SQL-запрос для сохранения блога
$stmt = $conn->prepare("INSERT INTO blogs (username, topic, description) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $topic, $description);

if ($stmt->execute()) {
    echo "Блог успешно добавлен";
} else {
    echo "Ошибка: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
