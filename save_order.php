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
$order = json_decode(file_get_contents('php://input'), true);
$name = $order['name'];
$phone = $order['phone'];
$email = $order['email'];
$address = $order['address'];
$productName = $order['productName'];
$price = $order['price'];

// Подготавливаем и выполняем SQL-запрос
$stmt = $conn->prepare("INSERT INTO orders (name, phone, email, address, product_name, price) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssd", $name, $phone, $email, $address, $productName, $price);

if ($stmt->execute()) {
    echo "Order saved successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
