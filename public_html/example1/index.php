<h1>Hello Example1!</h1>
<h4>Attempting MySQL connection from php...</h4>
<?php
$host = 'mysql';
$user = 'root';
$pass = 'rootpassword';
$conn = new mysqli($host, $user, $pass);

if(function_exists('shell_exec')) {
    //shell_exec("echo 'hello world3' > /var/www/html/hello3.txt");
	$ouput = shell_exec("./example2.sh");
	echo $ouput;
}


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected to MySQL successfully!";
}

phpinfo();

?>