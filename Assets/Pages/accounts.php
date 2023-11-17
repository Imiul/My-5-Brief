<?php 

include("../Database/db_connection.php");

$accounts = PrintAccounts();
$clientsName = fetchClientData();

if(isset($_POST['submit'])){
    $rib = time();
    // $client_name = $_POST['Client'];
    $devise = $_POST['Devise'];
    $balance = $_POST['Balance'];

    $stmt = $conx->prepare("INSERT INTO `accounts` (rib, balance, currency, client_id) VALUES (?, ?, ?, ?)");

    $stmt->bind_param('sssss', $rib, $client_name, $devise, $balance);

    $stmt->execute();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
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
                    <p>/Bank-management/Assets/Php/accounts.Php</p>
                </div>
                <div>
                    
                    <a class="sp-btn" href="../../Index.php">return</a>
                    <button class="sp-btn-reverse" id="open">Add Account</button>
                </div>
            </div>

            <!-- CLIENT TABLE HEAD --> 
            <div class="account-list-head table">
                <h4>Id</h4>
                <h4>Rib</h4>
                <h4>Balance</h4>
                <h4>devise</h4>
                <h4>Client Id</h4>
                <h4>Action</h4>
            </div>

            <!-- CLIENT TABLE LIST --> 
            <div class="client-list">

                <?php
                if (!empty($accounts)) {
                    foreach ($accounts as $account) {
                        echo '<div class="client table">';
                        echo '<h4>' . $account['id'] . '</h4>';
                        echo '<h4>' . $account['rib'] . '</h4>';
                        echo '<h4>' . $account['balance'] . '</h4>';
                        echo '<h4>' . $account['currency'] . '</h4>';
                        echo '<h4>' . $account['client_id'] . '</h4>';
                        echo '<div style="display: flex; align-items: center;">';
                        echo '<button class="sp-btn"><i class="fa-solid fa-pen-to-square"></i></button>';
                        echo '<button class="sp-btn remove" style="margin-left: 10px;"><i class="fa-solid fa-trash"></i></button>';
                        echo '<a class="sp-btn remove" style="margin-left: 10px;" href="transaction.php?id=' . $account["id"] . '">Transactions</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="if-empty">';
                    echo '<h4> There is No Accounts Yet </h4>';
                    echo '</div>';
                }   
                ?>

                <!-- OTHER CLIENTS WILL BE DISPLAYED HERE -->
            </div>

        </div>
    </main>


    <!-- ADD SECTION --> 
    <section class="add" id="new">

        <div class="hero">
            <div>
                <h3>New Account</h3>
                <p>accounts.php/New</p>
            </div>
            <button class="remove" id="close" ><i class="fa-solid fa-xmark"></i></button>
        </div>

        <form action="" method="post">
            
            <div>
                <select name="Client">
                <option value="0" selected>Choose Your Client</option>
                    <?php
                    if (!empty($clientsName)) {
                        foreach ($clientsName as $client) {
                            echo '<option value="1">' . $client["first_name"] . ' ' . $client["last_name"] . '</option>';
                        }
                    }
                    ?>
                </select>
                <div class="errorMessage"></div>
            </div>

            <div>
                <select name="Devise">
                    <option value="0" selected>Choose Your Devise</option>
                    <option value="Mad">Mad</option>
                    <option value="Usd">Usd</option>
                    <option value="Earo">Euro</option>
                </select>
                <div class="errorMessage"></div>
            </div>

            <div>
                <input type="text" placeholder="Balance" name="Balance">
                <div class="errorMessage"></div>
            </div>

            <button type="submit" class="sp-btn-reverse">Add Client</button>
        </form>

    </section>

    <!-- SCRIPT --> 
    <script src="../Js/New-pop-up.js"></script>
    <script>
        const Client = document.querySelector('select[name="Client"]');
        const Devise = document.querySelector('select[name="Devise"]');
        const Balance = document.querySelector('input[name="Balance"]');

        const add_form = document.querySelector('form');
        const error = document.querySelectorAll('.errorMessage');
        let form_valid = false;
        
        const balanceRegex = /^\d+(\.\d{1,2})?$/;

        function validate_Client() {
            if (Client.value == "0") {
                error[0].innerText = "Client Non Valid";
                form_valid = false;
            }
            else {error[0].innerText = ""; form_valid = true;}
        }

        function validate_Devise() {
            if (Devise.value == "0") {
                error[1].innerText = "Devise Non Valid";
                form_valid = false;
            }
            else {error[1].innerText = ""; form_valid = true;}
        }

        function validate_Balance() {
            if (!balanceRegex.test(Balance.value)) {
                error[2].innerText = "Balance Non Valid";
                form_valid = false;
            }
            else {error[2].innerText = ""; form_valid = true;}
        }


        function runValidation() {
            validate_Client();
            validate_Devise();
            validate_Balance();
        }



        add_form.addEventListener('submit', (e) => {
            runValidation();

            if (form_valid == false) {
                e.preventDefault();

            } else {
                add_form.submit();

                Client.value = "Choose Your Client";
                Devise.value = "Choose Your Devise";
                Balance.value = "";
            }
        });

    </script>

</body>
</html>