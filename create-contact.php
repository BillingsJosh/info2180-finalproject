<?php
session_start();
if(!isset($_SESSION['id'])){
    session_destroy();
    header('Location: login.php');
    exit;
}


$host = "localhost";
$username = "root";
$password = "";
$db_name = "dolphin_crm";

$conn = new PDO("mysql:host=$host; dbname=$db_name; charset=utf8mb4",$username, $password);

$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Contact</title>

    <link rel="stylesheet" href="css/create-contact.css">
    <script src="js/create-contact.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

    <nav>
        <img src="img/Dolphin.jpg" alt="Dolphin CRM LOGO" srcset="">
        <p>Dolphin CRM</p>
    </nav>
    <section class="container">
        <aside>
            <ul>
                <a href="dashboard.php"><li><i class="material-icons">home</i>Home</li></a>
                <a href="#" class="currentPage"><li><i class="material-icons">account_circle</i>New Contact</li></a>
                <a href="view_users.php"><li><i class="material-icons">people_outline</i>Users</li></a>
                <hr>
                <a href="php/logout.php"><li><i class="material-icons">exit_to_app</i>Logout</li></a>
            </ul>
        </aside>

        <div class="create-contact">
            <h1>New Contact</h1>
            <form>
                <div class="form-groupfull">
                    <label for="title">Title</label>
                    <select name="title" id="title" class="form-element"> 
                        <option value="Mr">Mr</option>
                        <option value="Mrs">Mrs</option>
                        <option value="Miss">Miss</option>
                    </select>
                </div>
                        
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" name="firstname" id="firstname" required class="form-element" placeholder="Jane">
                    <div class="fnameMsg error"></div>
                </div>

                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" name="lastname" id="lastname" required class="form-element" placeholder="Doe">
                    <div class="lnameMsg error"></div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required class="form-element" placeholder="something@example.com">
                    <div class="emailMsg error"></div>
                </div>

                <div class="form-group">
                    <label for="Telephone">Telephone</label>
                    <input type="number" name="number" id="number" required class="form-element">
                    <div class="phoneMsg error"></div>
                </div>

                <div class="form-group">
                    <label for="company">Company</label>
                    <input type="text" name="company" id="company" required class="form-element">
                    <div class="companyMsg error"></div>
                </div>

                <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" id="type" class="form-element">
                        <option value="Sales Lead">Sales Lead</option>
                        <option value="Support">Support</option>
                    </select>
                </div>
                        

                <div class="form-groupfull">
                    <label for="assigned">Assigned To</label>
                    <select name="assigned" id="assigned" class="form-element">
                    
                    <?php
                        foreach($results as $row){
                            echo "<option value=\"". $row['id'] ."\">". $row['firstname'] . " ".$row['lastname'] ."</option>";
                        }
                    ?> 
                    </select>
                </div>

                <div class="save-group">
                    <div class="msg"></div>
                    <input type="submit" value="Save">
                </div>

            </form>
        </div>

    </section>

</body>
</html>