<!-- This is the file to open the connection between the PHP files and databses -->
<?PHP

// Default servername, username, password, and databasename
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "meteor_hospital";

// Open the conection between database and the system
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli -> connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
else{
    #echo "Connected successfully!";
}
?>