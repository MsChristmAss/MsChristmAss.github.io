<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отзывы - Онлайн-магазин туалетной бумаги</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Отзывы</h1>
            <nav>
                <ul>
                    <li><a href="index.html">Главная</a></li>
                    <li><a href="catalog.html">Каталог</a></li>
                    <li><a href="blog.php">Отзывы</a></li>
                    <li><a href="contact.html">Контакты</a></li>
                    <li><a href="cart.html" id="cart-button">Корзина (<span id="cart-count">0</span>)</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <section id="blog" class="section">
            <div class="container">
                <h2>Отзывы</h2>
                <button id="load-blogs-button" action="load_blogs.php">Обновить</button><br><br>
                <?php
                    // Создаем соединение
                    $link = mysqli_connect("localhost", "root", "");
                    mysqli_select_db($link, "toilet_paper_store");

                    $sql = "SELECT username, topic, description FROM blogs";
                    $result=mysqli_query($link, $sql);
                    // Вывод блогов
                    while ($line=mysqli_fetch_row($result))
                    {
                        echo "<b>Имя: </b>".$line[0]."<br>";
                        echo "<b>Email: </b>".$line[1]."<br>";
                        echo "<b>Сообщение: </b>".$line[2]."<br><br>";

                    }
                    ?>
                <div id="blog-list"></div>
                <button id="add-blog-button">Добавить отзыв</button>
            </div>
        </section>
        <section id="add-blog-form" class="section" style="display: none;">
            <div class="container">
                <h2>Добавить новый отзыв</h2>
                <form id="new-blog-form" action="save_blog.php">
                    <div class="form-group">
                        <label for="username">Имя пользователя:</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="topic">Тема:</label>
                        <input type="text" id="topic" name="topic" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Описание:</label>
                        <textarea id="description" name="description" required></textarea>
                    </div>
                    <button type="button" id="submit-blog-button">Отправить</button>
                </form>
            </div>
        </section>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 Онлайн-магазин туалетной бумаги. Все права защищены.</p>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>
