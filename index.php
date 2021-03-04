<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

    <style>
        fieldset{
           margin-right: 800px;
           padding: 30px;
           background-color: #EE867C;
           width: 50%;
           
        }

       input{
            margin: 20px;
            border-radius: 2px;
            padding: 0px 60px 0px 5px;
        }

       label{
            padding: 5px;
            
       }
       .btn{
            padding: 4px;
            background-color: grey;
            border-radius: 10px;
            float: right;
            margin: 10px;
            padding: 8px;
       }
    </style>
    
</head>
<body>
    <div class="container">
        <form action="" id="basic-form" method="POST">
            <fieldset>
                <input type="hidden" name="id">
                <label for="name">Name :</label>
                <input type="text" name="name" id="name" placeholder="Name" required><br>
                <label for="mail">Email :</label>
                <input type="text" name="mail" id="mail"placeholder="Email" required><br>
                <label for="mobile">Mobile :</label>
                <input type="text" name="mobile" id="mobile" placeholder="Mobile No." required><br>
                <label for="gender">Gender :</label>
                <input type="radio" value="Male" name="gender" id="gender" >Male
                <input type="radio" value="Female" name="gender" id="gender" >Female<br>
                <label for="State">State :</label>
                <select name="place" id="state" required>
                    <option value="Select state">--Select state--</option>
                    <option value="Tamil nadu" >Tamil nadu</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Karnataka">Karnataka</option>
                    <option value="Kerala">Kerala</option>
                </select><br>
                <button class="btn" name='submit'>Submit</button>
            </fieldset>

        </form>
    </div>

    

</body>
</html>
<br><br>
<?php

    error_reporting(0);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $databasename = "form1";
    $con = mysqli_connect($servername, $username, $password, $databasename);
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $mail = $_POST['mail'];
        $mobile = $_POST['mobile'];
        $gender = $_POST['gender'];
        $state = $_POST['place'];

        $sql = "INSERT into info (id,name, mail, mobile, gender, state ) values ('$id','$name','$mail', '$mobile', '$gender', '$state' )";

        if(mysqli_query($con, $sql)){
            echo"<script>
            alert('Record inserted successfully');</script>";
            echo "<br>";
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
            echo "<br>";
        }
    }
    
?>
<br><br>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <style>
            table,thead,td{
                border-style:solid;
                text-align: center;
                padding: 5px;

            }
            .update{
                background-color: #0be1ec;
                border-radius: 5px;
                color: black;
            }

            .delete{
                background-color: #ec0b23;
                border-radius: 5px;
                color: black;
            }
            #btn-load{
                width: 100%;
                border-radius: 2px;
                border-bottom-color: black;
                background-color: #00ff80;
                color: black;
            }
        </style>
    </head>
    <body>
        <?php
            $conn = new mysqli($servername, $username, $password, $databasename);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
        
            $sql = "SELECT * FROM info";
            $result = $conn->query($sql);
            $id = ''; 
        ?>
                        
        <table id="retrive-table">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Mail ID</td>
                    <td>Mobile</td>
                    <td>Gender</td>
                    <td>State</td>
                    <td colspan="2">action</td>
                </tr>
              </thead>
            <tbody>
                <?php
                    while(($row = $result->fetch_assoc()) !== null){
                        echo
                    "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['mail']}</td>
                        <td>{$row['mobile']}</td>
                        <td>{$row['gender']}</td>
                        <td>{$row['state']}</td>
                        <td><a href='update.php?id=". $row['id'] ."&name=".$row['name']."&mail=". $row['mail']."&mobile=".$row['mobile']."&gender=".$row['gender']."&state=".$row['state']."'><button class='update'>Update</button></a></td>
                        <td><a onClick=\"javascript: return confirm('Please confirm deletion');\" href='delete.php?id=". $row['id'] ."&name=".$row['name']."&mail=". $row['mail']."&mobile=".$row['mobile']."&gender=".$row['gender']."&state=".$row['state']."'><button class='delete'>Delete</button></a></td>
                    </tr>\n";
                    }
                ?>
                
            </tbody> 
        </div>
        </table>
        <script>
            $(document).ready(function() {
            $("#basic-form").validate({
                
            });
            });
        </script>

    </body>
</html>

