<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
      
<div class = "container">
<?php
/*

*	File:		list_insert.php
*	By:			edwardso
*	Date:		20180420

=====================================
*/
echo $_SERVER['REMOTE_ADDR'];

if(isset($_POST['name'])) {
	$name = $_POST['name'];
}
if(isset($_POST['isbn'])) {
	$isbn = $_POST['isbn'];
}
if(isset($_POST['addinfo'])) {
	$addinfo = $_POST['addinfo'];
}
if(isset($_POST['delinfo'])) {
	$delinfo = $_POST['delinfo'];
}
if(isset($_GET['id'])) {
	$id = $_GET['id'];
	echo $id;
}


//echo $delinfo;
//echo $addinfo;


if(isset($_POST['addinfo'])) {
if (!empty($name) AND $addinfo == "Add Info") {
			
		$hostname = "localhost";
		$username = "id4508758_root";
		$password = "admin";
		$databaseName = "id4508758_booktable";
        $dbConnected = mysqli_connect($hostname,$username,$password,$databaseName);

		$isbn_SQLinsert = "INSERT INTO bookTable ( ";
		$isbn_SQLinsert .=  "isbn, ";		
		$isbn_SQLinsert .=  "name ";
		$isbn_SQLinsert .=  ") ";
		$isbn_SQLinsert .=  "VALUES (";

        //XSS
        $isbn = htmlspecialchars($isbn, ENT_QUOTES);							
        $isbn_SQLinsert .=  "'".$isbn."', ";

        //XSS
        $name = htmlspecialchars($name, ENT_QUOTES);							
        //SQL Injection
		//$_name = mysql_real_escape_string($name);
		$isbn_SQLinsert .=  "'".$name."' ";
		$isbn_SQLinsert .=  ") ";

        if ($dbConnected->query($isbn_SQLinsert) === TRUE) {
            //echo "New record created successfully";
        } else {
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $dbConnected->close();
} else {}
}

if(isset($_POST['delinfo'])) {
if (!empty($isbn) AND $delinfo == "Del Info") {
	$hostname = "localhost";
	$username = "id4508758_root";
	$password = "admin";
	$databaseName = "id4508758_booktable";
	$dbConnected = mysqli_connect($hostname,$username,$password,$databaseName);

    //XSS
    $isbn = htmlspecialchars($isbn, ENT_QUOTES);							
    //SQL Injection
	//$_isbn = mysql_real_escape_string($isbn);
    
	$company_SQLupdate = "DELETE FROM bookTable WHERE isbn='".$isbn."'";
    if ($dbConnected->query($company_SQLupdate) === TRUE) {
	        //	echo "delete OK";
        } else {
	        //	echo "delete fail";
        }
    $dbConnected->close();
}
}
$conn = new mysqli("localhost", "id4508758_root", "admin", "id4508758_booktable");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM bookTable";
$result = $conn->query($sql);
echo "<table border='1'>";
echo "<tr><th> isbn </th><th> Name </th></tr> ";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

        echo "<tr><td>". $row["isbn"]. "</td><td>". $row["name"]. "</td></tr> ";
    }
} else {
    echo "0 results";
}
echo "</table>";
$conn->close();


?>
</div>
<div class = "container">
<form action="list_insert.php" method="post">
	<hr><br>
	isbn: <input type="number" class="form-control" name="isbn" value="" required="required" />
	<br>
	Name: <input type="text" class="form-control" name="name" value=""  required="required"  />
	<br>
	Pic: <input type="file" class="form-control"  name="avatar" accept="image/png, image/jpeg" />
   <br>
	<table class="table"><tr>
	<td><input type="submit" class="btn btn-primary" name="addinfo" value="Add Info" /></td>
	<td><input type="submit" class="btn btn-outline-primary" name="delinfo" value="Del Info" /></td>
	</tr></table>
	<br>
	Click here to clean <a href = "logout.php" tite = "Logout">Session.

</form>
</div>