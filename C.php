<?php
$servername = "db";
$username = "root";
$password = "heslo";
$db = "db";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $db, 3306);

$sql = "SELECT * FROM `filmova knihovna` WHERE 1 ORDER  BY `rok vydání` ASC";
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
echo "</table>";

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