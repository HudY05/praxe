<?php
$servername = "db";
$username = "root";
$password = "heslo";
$db = "db";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $db, 3306);

echo "<h1> Výběr kritéria </h1>";
echo "<p> Výpis z databáze bude vypsán podle daného kritéria <p>";

print('<form action="B.php">
  <label for="zpusob">Vybrat způsob:</label>
  <select name="zpusob" id="zpusob">
    <option value="abc">Abecedně</option>
    <option value="rok_vydani_stary">Od nejstaršího</option>
    <option value="rok_vydani_novy">Od nejnovějšího</option>
  </select>
  <br><br>
  <input type="submit" value="Submit">
</form>
');
if (!empty($_GET["zpusob"])) {

    if ($_GET["zpusob"] === "abc") {
        $sql = "SELECT * FROM `filmova knihovna` WHERE 1 ORDER  BY `Nazev` ASC";
    } elseif ($_GET["zpusob"] === "rok_vydani_stary") {
        $sql = "SELECT * FROM `filmova knihovna` WHERE 1 ORDER  BY `rok vydání` ASC";
    } elseif ($_GET["zpusob"] === "rok_vydani_novy") {
        $sql = "SELECT * FROM `filmova knihovna` WHERE 1 ORDER  BY `rok vydání` DESC";
    } else {
        $sql = "SELECT * FROM `filmova knihovna` WHERE 1";
        echo "Neplatný pokus, vypisuji všechny data";
    }


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

    // End HTML table    
}


echo "<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
</style>";