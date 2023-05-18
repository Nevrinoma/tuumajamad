<?php
require_once("connect.php");
global $conn;

// Обработка данных формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $location = mysqli_real_escape_string($conn, $_POST["location"]);
    $type = mysqli_real_escape_string($conn, $_POST["type"]);
    $production = mysqli_real_escape_string($conn, $_POST["production"]);
    $demand = mysqli_real_escape_string($conn, $_POST["demand"]);
    $temperature = mysqli_real_escape_string($conn, $_POST["temperature"]);
    $water_level = mysqli_real_escape_string($conn, $_POST["water_level"]);
    $number_of_reactors = mysqli_real_escape_string($conn, $_POST["number_of_reactors"]);
    $working_reactors = mysqli_real_escape_string($conn, $_POST["working_reactors"]);
    $uptime = mysqli_real_escape_string($conn, $_POST["uptime"]);
    $isset = mysqli_real_escape_string($conn, $_POST["isset"]);

    $sql = "INSERT INTO tuumajaamad (name, location, type, production, demand, temperature, water_level, number_of_reactors, working_reactors, uptime, isset) VALUES ('$name', '$location', '$type', '$production', '$demand', '$temperature', '$water_level', '$number_of_reactors', '$working_reactors', '$uptime', '$isset')";
    if (mysqli_query($conn, $sql)) {
        header("Location: tuumajaamIndex.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lisa tuumaelektrijaam</title>
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
<h1>Lisa tuumaelektrijaam</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="name">Nimi:</label>
    <input type="text" name="name" id="name" placeholder="Näide: Eesti Jaam" required>
    <br>
    <label for="location">Asukoht:</label>
    <input type="text" name="location" id="location" placeholder="Näide: Tallinn" required>
    <br>
    <label for="type">Tüüp:</label>
    <input type="text" name="type" id="type" placeholder="Näide: Väike" required>
    <br>
    <label for="production">Tootmine:</label>
    <input type="text" name="production" id="production" placeholder="Näide: 1000" required>
    <br>
    <label for="demand">Nõudlus:</label>
    <input type="text" name="demand" id="demand" placeholder="Näide: 950" required>
    <br>
    <label for="temperature">Temperatuur:</label>
    <input type="text" name="temperature" id="temperature" placeholder="Näide: 25" required>
    <br>
    <label for="water_level">Vee tase:</label>
    <input type="text" name="water_level" id="water_level" placeholder="Näide: 50" required>
    <br>
    <label for="number_of_reactors">Reaktorite arv:</label>
    <input type="text" name="number_of_reactors" id="number_of_reactors" placeholder="Näide: 2" required>
    <br>
    <label for="working_reactors">Töötavad reaktorid:</label>
    <input type="text" name="working_reactors" id="working_reactors" placeholder="Näide: 1" required>
    <br>
    <label for="uptime">Tööaeg:</label>
    <input type="text" name="uptime" id="uptime" placeholder="Näide: 100" required>
    <br>
    <label for="isset">On seatud:</label>
    <input type="text" name="isset" id="isset" placeholder="Näide: 1 jah / 0 ei" required>
    <br>
    <input type="submit" value="Lisa tuumaelektrijaam">
</form>
<a href="tuumajaamIndex.php">Tagasi aatomielektrijaamade loendisse</a>
</body>
</html>
