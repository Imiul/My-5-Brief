<?php
    include('Assets/Database/db_connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="Assets/Css/design-system.css">
    <link rel="stylesheet" href="Assets/Css/Index.css">

    <style>
        .hero {justify-content: flex-start; align-items: center;}
        .hero p {margin-left: 20px;}
        .content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            row-gap: 20px;
        }
        .content .choice {
            width: 45%;
            background-color: #eaeaea;
            border: 2px solid #808080;
            padding: 40px 30px;

            display: flex;
            justify-content: space-around;
            align-items: center;
        }
        .content .choice div { 
            /* margin-left: 100px; */
            width: 50%;
            /* background-color: aqua; */
        }
        .content .choice p {margin-top: 5px;}
    </style>

    <title>Admin</title>
</head>
<body>
    
    <main>
        <div class="container">

            <!-- TITLE -->
            <div class="hero">
                <h1>Dashboard</h1>
                <p>/Bank-management/Index.Php</p>
            </div>

            <!-- PAGE CONTENT -->
            <div class="content">

                <!-- CLIENTS --> 
                <div class="clients choice">
                    <img src="Assets/Img/1.png" alt="Img" width="64px">
                    <div>
                        <a href="Assets/Pages/clients.php">Clients Data List</a>
                        <p>Control your bank clients</p>
                    </div>
                </div>

                <!-- ACCOUNTS --> 
                <div class="accounts choice">
                    <img src="Assets/Img/3.png" alt="Img" width="64px">
                    <div>
                        <a href="Assets/Pages/accounts.php">Accounts Data List</a>
                        <p>Control your bank Accounts</p>
                    </div>
                </div>

                <!-- TRANSACTION --> 
                <div class="transactions choice">
                    <img src="Assets/Img/2.png" alt="Img" width="64px">
                    <div>
                        <a href="Assets/Pages/transaction.php">Transactions Data List</a>
                        <p>Control your bank Transaction</p>
                    </div>
                </div>

            </div>

        </div>
    </main>

</body>
</html>