<?php
$servername = "db";
$username = "root";
$password = "heslo";
$db = "db";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $db, 3306);

if (!empty($_POST)) {
    $nazev = $conn->real_escape_string(trim($_POST['nazev']));
    $zanr = $conn->real_escape_string(trim($_POST['zanr']));
    $reziser = $conn->real_escape_string(trim($_POST['reziser']));
    $herci = $conn->real_escape_string(trim($_POST['herci']));
    $rok = $conn->real_escape_string(intval(trim($_POST['rok'])));

    var_dump($rok);
    $sql = "INSERT INTO `filmova knihovna` (`Nazev`, `Žánr`, `Režisér`, `Hl. herci`, `rok vydání`)
    VALUES ('$nazev', '$zanr', '$reziser', '$herci', '$rok')";

    if (!mysqli_query($conn, $sql)) {
        printf("%d Row inserted.\n", mysqli_affected_rows($conn));
    }
}

$sql = "SELECT * FROM `filmova knihovna` WHERE 1";

$result = mysqli_query($conn, $sql);
// Fetch all rows
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Get column names
$columnNames = mysqli_fetch_fields($result);

// Start HTML table
echo "<table>";
echo "<tr>";
// Print column names separated by "|"
foreach ($columnNames as $column) {
    echo "<th>" . $column->name . "</th>";
}
echo "</tr>";

// Print all the details
foreach ($rows as $row) {
    echo "<tr>";
    foreach ($row as $value) {
        echo "<td>" . $value . "</td>";
    }
    echo "</tr>";

}

?>

<form action="A.php" method="POST">
    <tr id="added-rows">
        <td> </td>
        <td> <input type="text" name="nazev" value="" required></td>
        <td> <input type="text" name="zanr" value="" required></td>
        <td> <input type="text" name="reziser" value="" required></td>
        <td> <input type="text" name="herci" value="" required></td>
        <td> <input type="number" name="rok" value="" min="1888" max="2023" required></td>

    </tr>

    <tr>
        <td>
            <button id="add" type="submit">přidat záznam</button>
        </td>
    </tr>
</form>

</table>

<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
</style>