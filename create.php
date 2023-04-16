<?php 

$servername = "localhost";
$username = "root";
$password = "";
$database = "myshop";
$port = 3307;

//Create connection since we changed the port num had to add it here
$connection = new mysqli($servername, $username, $password, $database, $port);

$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];


    do {
        if ( empty($name) || empty($email) || empty($phone) || empty($address) ) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "INSERT INTO clients (name, email, phone, address) ". 
                "VALUES ('$name', '$email', '$phone', '$address')";
        $result = $connection->query($sql);


        //check if query exe was successfull 
        if (!$result) {
            $errorMessage = "Invalid query: ". $connection->error;
        }

        //add new client to database
        $name = "";
        $email = "";
        $phone = "";
        $address = "";

        $successMessage = "Client added correctly";

        header("location: /myshop/index.php");
        exit;

    } while (false);

}

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>My Shop</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css
">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="container my-5">
            <h2>New Client</h2>


            <?php 
            if ( !empty($errorMessage)) {
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'> 
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                
                ";
            }
            
            ?>

            <form method="post">
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Name</label>
                        <div class="clo-sm-6">  
                            <input type="text" class="form-control" name="name" value="<?php echo $name?>"> 
                        </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Email</label>
                        <div class="clo-sm-6">  
                            <input type="text" class="form-control" name="email" value="<?php echo $email?>"> 
                        </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Phone</label>
                        <div class="clo-sm-6">  
                            <input type="text" class="form-control" name="phone" value="<?php echo $phone?>"> 
                        </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Address</label>
                        <div class="clo-sm-6">  
                            <input type="text" class="form-control" name="address" value="<?php echo $address?>"> 
                        </div>
                </div>


                <?php
                   if ( !empty($successMessage)) {
                    echo "
                    <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                    <div class='alert alert-success alert-dismissible fade show' role='alert'> 
                    <strong>$successMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                    </div>
                    </div>
                    ";
                }
                ?>


                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                        <div class="col-sm-3 d-grid"> 
                            <a class="btn btn-outline-primary" href="/myshop/index.php" role="button">Cancel</a>
                             </div> 

                </div>

            </form> <!-- action not really needed since form is submitted on same page -->

        </div>
  
        
      
    </body>
</html>