<?php
require_once("connect.php");
global $conn;
$station_id = $_GET["station_id"];
$sql = "SELECT * FROM tuumajaamad WHERE id='$station_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!isset($_GET["station_id"])) {
    die("Jaama id puudub. Palun minge tagasi tuumajaamade loendisse ja valige hallatav jaam.");
}

// Обработка данных формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $station_id = mysqli_real_escape_string($conn, $_POST["station_id"]);
    $demand = mysqli_real_escape_string($conn, $_POST["demand"]);
    $reactor_status = isset($_POST["reactor_status"]) ? 1 : 0;

    $sql = "UPDATE tuumajaamad SET demand='$demand', isset='$reactor_status' WHERE id='$station_id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: tuumajaamControl.php?station_id=$station_id");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Juhtimine</title>
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
<h1>Juhtimine: <?php echo $row["name"]; ?></h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?station_id=$station_id"; ?>" method="post">
    <input type="hidden" name="station_id" value="<?php echo $station_id; ?>">
    <label for="demand">Nõudlus energiale (number):</label>
    <input type="number" name="demand" id="demand" value="<?php echo $row["demand"]; ?>" required>
    <br>
    <label for="production">Toodang (number):</label>
    <input type="number" name="production" id="production" value="<?php echo $row["production"]; ?>" disabled>
    <br>
    <label for="reactor_status">Tuumareaktorite sisse/väljalülitamine:</label>
    <input type="checkbox" name="reactor_status" id="reactor_status" <?php echo $row["isset"] ? "checked" : ""; ?>>
    <br>
    <input type="submit" value="Salvesta muudatused">
</form>
<p>Vahe toodangu ja nõudluse vahel: <span id="difference"><?php echo $row["production"] - $row["demand"]; ?></span></p>
<a href="tuumajaamIndex.php">Tagasi aatomjaamade loendisse</a>
<script>
    document.getElementById("reactor_status").addEventListener("change", function() {
        const production = parseFloat(document.getElementById("production").value);
        const demand = parseFloat(document.getElementById("demand").value);
        const isEnabled = document.getElementById("reactor_status").checked;

        if (isEnabled && demand > production) {
            alert("Nõudlus ületab pakkumist, jaam võib ülekuumeneda ja puruneda.");
        }
    });

</script>
</body>
</html>
