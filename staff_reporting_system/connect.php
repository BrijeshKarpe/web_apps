<?PHP
$servername="localhost";
$username="root";
$password="Brijesh484@B";
$dbname="srs";
$conn =  mysqli_connect($servername,$username,$password,$dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
