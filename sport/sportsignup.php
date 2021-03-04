<!DOCTYPE html>
<html>
<head>
<title>Signup</title>
        <meta name="viewport" content="width=device-width;initial-scale=1.0">
        <meta charset="UTF-8">
<style>
    .error{color:#FF0000;}
    body {
      background-image:url("booksignuppage1.jpg");
      background-size:cover;
    }
    a:link {
      background_color:"red";
    }
</style>
</head>
<body>
    <?php
$usernameErr = $emailErr =$dobErr= $genderErr = $passwordErr=$con_passwordErr=$con_passwordnotErr=$charonly=$emailonly="";
$username = $email =$dob= $gender = $password=$con_password= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $usernameErr = "Username is required";
  } elseif(ctype_alpha($_POST["username"])) {
      
      $username = test_input($_POST["username"]);
    }
    else{
      $charonly="Only alphabet are allowed";
      }   
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } elseif(filter_var(($_POST["email"]),FILTER_VALIDATE_EMAIL)) {
    $email = test_input($_POST["email"]);
  }
  else
  {
    $emailonly="Give valide email";
  }
    
  if (empty($_POST["dob"])) {
    $dobErr = "";
  } else {
    $dob = test_input($_POST["dob"]);
  }
  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
  if (empty($_POST["password"])) {
    $passwordErr = "password is required";
  } else {
    $password = test_input($_POST["password"]);
  }
  if (empty($_POST["con_password"])) {
    $con_passwordErr = "Confirm-password is required";
  } 
  elseif(($_POST["password"])!=($_POST["con_password"])){
    $con_passwordnotErr="Password and Confirm-password are different";
  }
  else {
    $con_password = test_input($_POST["con_password"]); 
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
    <h1>Signup Page</h1>
    <form method="post" name="signup" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
    <p><span class="error">* required field</span></p>
    <label for="username">Username</label><span class="error">*<?php echo $usernameErr; ?></span><span class="error"><?php echo $charonly; ?></span><br>
    <input type="text" id="username" name="username" autofocus></input><br>
    <label for="email">Email</label><span class="error">*<?php echo $emailErr; ?></span><span class="error"><?php echo $emailonly ?></span><br>
    <input type="email" id="email" name="email" ></input><br>
    <label for="dob">Date Of Birth</label><span class="error"><?php echo $dobErr; ?></span><br>
    <input type="date" id="dob" name="dob" ></input><br>
    <label for="gender">Gender</label><span class="error">*<?php echo $genderErr; ?></span><br>
    <input type="radio" id="male" name="gender"><label for="male">Male</label></input><br>
    <input type="radio" id="female" name="gender"><label for="female">Female</label></input><br>
    <input type="radio" id="other" name="gender"><label for="other">Other</label></input><br>
    <label for="password">Password</label><span class="error">*<?php echo $passwordErr; ?></span><br>
    <input type="password" id="password" name="password"></input><br>
    <label for="con_password">Confirm-password</label><span class="error">*<?php echo $con_passwordErr; ?></span><span class="error"><?php echo $con_passwordnotErr; ?></span><br>
    <input type="password" id="con_password" name="con_password"></input><br>
    <input type="submit" name="create" value="Create" ></input>
    </form><br> 
    <a class="viewallbuttom" href="viewpage.php">View All</a>
<?php 
$servername = "localhost";
$username1 = "root";
$password1 = "";
$dbname = "skp";

$conn = mysqli_connect($servername, $username1, $password1, $dbname);
if(isset($_POST["create"])){
  $username=$_REQUEST['username'];
  $email=$_REQUEST['email'];
  $dob=$_REQUEST['dob'];
  $gender=$_REQUEST['gender'];
  $password=$_REQUEST['password'];
  $con_password=$_REQUEST['con_password'];
  $sql="INSERT INTO signup(username,email,dob,gender,password,con_password) values('$username','$email','$dob','$gender','$password','$con_password')";
  if(mysqli_query($conn,$sql))
  {

    echo"Insertion Success";
  }
  else
  {
    echo "Error in insertion:".$sql."<br>";mysqli_error($conn);
  }
}
  
?>
</body>    
</html>
