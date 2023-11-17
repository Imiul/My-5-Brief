<?php 

include("../Database/db_connection.php");

$clientsName = fetchClientData();

// if (isset($_GET['id']) && is_numeric($_GET['id'])) {

//     $clientId = $_GET['id'];

//     $deleteClientQuery = "DELETE FROM clients WHERE id = $clientId";
//     $result = $conx->query($deleteClientQuery);
// }

if(isset($_POST['submit'])){
    $first_name = $_POST['FirstName'];
    $last_name = $_POST['LastName'];
    $birthday = $_POST['BirthDate'];
    $nationality = $_POST['Nationality'];
    $gender = $_POST['Gender'];

    $stmt = $conx->prepare("INSERT INTO `clients` (first_name, last_name, birth_date, nationality, gender) VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param('sssss', $first_name, $last_name, $birthday, $nationality, $gender);

    if($stmt->execute()){
        echo "<script>alert('data inserted sucessfully');</script>";
    } else {
        echo "<script>alert('failed to excute statement : ". $stmt->error ."');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FONTS AWESOME --> 
    <script src="https://kit.fontawesome.com/0dabffdb94.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../Css/design-system.css">
    <link rel="stylesheet" href="../Css/Index.css">
    <link rel="stylesheet" href="../Css/Index.css">
    <style>
        .table h4:nth-child(5), .table div {width: 20%;}
        .if-empty {
            padding: 5px 10px;
            background-color: #eaeaea;
            border: 2px solid #808080;
        }
    </style>

    <title>Accounts Data</title>
</head>
<body>
    
    <main>
        <div class="container">

            <!-- TITLE -->
            <div class="hero">
                <div>
                    <h1>Dashboard</h1>
                    <p>/Bank-management/Assets/Php/clients.Php</p>
                </div>
                <div>
                    
                    <a class="sp-btn" href="../../Index.php">return</a>
                    <button class="sp-btn-reverse" id="open">Add Client</button>
                </div>
            </div>

            <!-- CLIENT DATA LIST TABLE HEAD -->
            <div class="client-list-head table">
                <h4>Id</h4>
                <h4>Client Name</h4>
                <h4>Birth Date</h4>
                <h4>Nationality</h4>
                <h4>Gender</h4>
                <h4>Action</h4>
            </div>

            <!-- CLIENT DATA LIST -->
            <div class="client-list">

                <?php
                if (!empty($clientsName)) {
                    foreach ($clientsName as $client) {
                        echo '<div class="client table">';
                        echo '<h4>' . $client['id'] . '</h4>';
                        echo '<h4>' . $client['first_name'] . ' ' . $client['last_name'] . '</h4>';
                        echo '<h4>' . $client['birth_date'] . '</h4>';
                        echo '<h4>' . $client['nationality'] . '</h4>';
                        echo '<h4>' . $client['gender'] . '</h4>';
                        echo '<div style="display: flex; align-items: center;">';
                        echo '<button class="sp-btn"><i class="fa-solid fa-pen-to-square"></i></button>';
                        echo '<a class="sp-btn remove" style="margin-left: 10px;" href="clients.php?id=' . $client['id'] .'" ><i class="fa-solid fa-trash"></i></a>';
                        echo '<a class="sp-btn remove" style="margin-left: 10px;" href="accounts.php?id=' . $client['id'] .'" >Accounts</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="if-empty">';
                    echo '<h4> There is No Clients Yet </h4>';
                    echo '</div>';
                }
                ?>
                
            </div>

        </div>
    </main>

    <!-- ADD SECTION --> 
    <section class="add" id="new">

        <div class="hero">
            <div>
                <h3>New Client</h3>
                <p>clients.php/New</p>
            </div>
            <button class="remove" id="close" ><i class="fa-solid fa-xmark"></i></button>
        </div>

        <form action="" method="post">
            
            <div>
                <input type="text" placeholder="First Name" name="FirstName" class="">
                <div class="errorMessage"></div>
            </div>

            <div>
                <input type="text" placeholder="Last Name" name="LastName">
                <div class="errorMessage"></div>
            </div>

            <div>
                <input type="date" name="BirthDate">
                <div class="errorMessage"></div>
            </div>

            <div>
                <input type="text" placeholder="Nationality" name="Nationality">
                <div class="errorMessage"></div>
            </div>

            <div>
                <select name="Gender">
                    <option value="0">Choose Your Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <div class="errorMessage"></div>
            </div>

            <button type="submit" name="submit" class="sp-btn-reverse">Add Client</button>
        </form>

    </section>

    <!-- SCRIPT --> 
    <script src="../Js/New-pop-up.js"></script>
    <script>
        const FirstName = document.querySelector('input[name="FirstName"]');
        const LastName = document.querySelector('input[name="LastName"]');
        const BirthDate = document.querySelector('input[name="BirthDate"]');
        const Nationality = document.querySelector('input[name="Nationality"]');
        const Gender = document.querySelector('select[name="Gender"]');

        const form = document.querySelector('form');
        const error = document.querySelectorAll('.errorMessage');
        let form_valid = false;

        const pattern_1 = /^[a-zA-Z]+$/;
        const birthDateRegex = /^\d{4}-\d{2}-\d{2}$/;
        const genderRegex = /^(Male|Female)$/;


        function validate_FirstName() {
            if (!pattern_1.test(FirstName.value)) {
                error[0].innerText = "First Name Non Valid";
                form_valid = false;
            }
            else {error[0].innerText = ""; form_valid = true;}

        }

        function validate_LastName() {
            if (!pattern_1.test(LastName.value)) {
                error[1].innerText = "Last Name Non Valid";
                form_valid = false;
            }
            else {error[1].innerText = ""; form_valid = true;}
        }

        function validate_BirthDate() {
            if (!birthDateRegex.test(BirthDate.value)) {
                error[2].innerText = "Birth Date Non Valid";
                form_valid = false;
            }
            else {error[2].innerText = ""; form_valid = true;}
        }

        function validate_Nationality() {
            if (!pattern_1.test(Nationality.value)) {
                error[3].innerText = "Nationality Non Valid";
                form_valid = false;
            }
            else {error[3].innerText = ""; form_valid = true;}
        }

        function validate_Gender() {
            if (!genderRegex.test(Gender.value)) {
                error[4].innerText = "Gender Non Valid";
                form_valid = false;
            }
            else {error[4].innerText = ""; form_valid = true;}
        }

        function runValidation() {
            validate_FirstName();
            validate_LastName();
            validate_BirthDate();
            validate_Nationality();
            validate_Gender();
        }



        form.addEventListener('submit', (e) => {
            e.preventDefault();
            runValidation();

            if (form_valid == true) {
                form.submit();
            }
        });

    </script>
</body>
</html>