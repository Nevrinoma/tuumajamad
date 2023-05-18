<?php
require_once("connect.php");
global $conn;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tuumajaamade tabel</title>
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
<h1>Tuumajaamade tabel</h1>
<?php
// Проверка соединения
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_id"])) {
    $delete_id = intval($_POST["delete_id"]);
    $delete_sql = "DELETE FROM tuumajaamad WHERE id = $delete_id";
    if (mysqli_query($conn, $delete_sql)) {
        echo "Kustatud";
    } else {
        echo "Kustumine viga: " . mysqli_error($conn);
    }
}

// Запрос на выборку данных из таблицы
$sql = "SELECT * FROM tuumajaamad";
$result = mysqli_query($conn, $sql);
// Проверка наличия данных
if (mysqli_num_rows($result) > 0) {
    // Начало вывода таблицы
    echo "<table>";
    echo "<tr><th>Kustuta</th><th>Nimi</th><th>Asukoht</th><th>Tüüp</th><th>Tootmine</th><th>Nõudlus</th><th>Temperatuur</th><th>Vee tase</th><th>Reaktorite arv</th><th>Töötavad reaktorid</th><th>Tööaeg</th><th>On seadistatud</th></tr>";


    // Вывод данных из каждой строки таблицы
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td><form method='post'><input type='hidden' name='delete_id' value='" . $row["id"] . "'/><input type='submit' value='X' /></form></td><td><a href='tuumajaamControl.php?station_id=" . $row["id"] . "'>" . $row["name"]. "</a></td><td>" . $row["location"]. "</td><td>" . $row["type"]. "</td><td>" . $row["production"]. "</td><td>" . $row["demand"]. "</td><td>" . $row["temperature"]. "</td><td>" . $row["water_level"]. "</td><td>" . $row["number_of_reactors"]. "</td><td>" . $row["working_reactors"]. "</td><td>" . $row["uptime"]. "</td><td>" . $row["isset"]. "</td></tr>";
    }

    // Конец вывода таблицы
    echo "</table>";
} else {
    echo "0 results";
}
// Закрытие соединения с базой данных
mysqli_close($conn);
?>
</body>
</html>
