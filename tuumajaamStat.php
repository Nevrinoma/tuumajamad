<?php
require_once("connect.php");
global $conn;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tuumajaamade statistika</title>
    <link rel="stylesheet" href="tuumajaamStyle.css">
</head>
<body>
<header>
    <div class="container">
        <h1>Aatomielektrijaamad</h1>
        <nav>
            <a href="tuumajaamIndex.php">Pealeht</a>
            <a href="tuumajaamAdd.php">Lisa jaam</a>
            <a href="tuumajaamStat.php">Jaamade statistika</a>
        </nav>
    </div>
</header>
<h1>Tuumajaamade statistika</h1>
<?php
// Проверка соединения
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Запрос на выборку данных из таблицы
$sql = "SELECT * FROM tuumajaamad";
$result = mysqli_query($conn, $sql);

// Проверка наличия данных
if (mysqli_num_rows($result) > 0) {
    // Начало вывода таблицы
    echo "<table>";
    echo "<tr><th>ID</th><th>Nimi</th><th>Veekulu</th><th>Tööaeg (tunnid)</th></tr>";

    // Вывод данных из каждой строки таблицы
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["water_level"]. "</td><td>" . $row["uptime"]. "</td></tr>";
    }
    // Конец вывода таблицы
    echo "</table>";
} else {
    echo "AB viga- ei ole data.";
}

// Закрытие соединения с базой данных
mysqli_close($conn);
?>

<a href="tuumajaamIndex.php">Tagasi tuumajaamade nimekirja</a>
</body>
</html>
