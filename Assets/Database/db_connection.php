<?php

    // MySql Configuration   
    $servername = "localhost";
    $username = "root";
    $password = "";

    // Create Database 
    // $database = "CREATE DATABASE IF NOT EXISTS Bank_Management";  // In First Time
    $database = "Bank_Management";    // if exist 

    // Create Clients Table 
    $createClientsTable = " 
        CREATE TABLE clients (
            id INT PRIMARY KEY AUTO_INCREMENT,
            first_name VARCHAR(50) NOT NULL,
            last_name VARCHAR(50) NOT NULL,
            birth_date DATE,
            nationality VARCHAR(50),
            gender ENUM('Male', 'Female') NOT NULL
        );
    ";

    // Create Accounts Table 
    $createAccountsTable = "
        CREATE TABLE accounts (
            id INT PRIMARY KEY AUTO_INCREMENT,
            rib INT UNIQUE,
            balance DECIMAL(10, 2) DEFAULT 0.0,
            currency VARCHAR(10),
            client_id INT,
            FOREIGN KEY (client_id) REFERENCES clients(id)
        );
    ";

    // Create Transactions Table 
    $createTransactionTable = "
        CREATE TABLE transactions (
            id INT PRIMARY KEY AUTO_INCREMENT,
            type ENUM('credit', 'debit'),
            amount DECIMAL(10, 2) NOT NULL,
            account_id INT,
            FOREIGN KEY (account_id) REFERENCES accounts(id)
        );
    ";


    // Create a connection
    // $conx = new mysqli($servername, $username, $password); // In First Time
    $conx = new mysqli($servername, $username, $password, $database); // If Database Exist 
    

    // $conx->query($database);
    // $conx->query($createClientsTable);
    // $conx->query($createAccountsTable);
    // $conx->query($createTransactionTable);

    // GENERATE UNIQUE RIB FUNCTION
    function generateUniqueRIB($clientId) {
        $timestamp = time();
        $result = $timestamp * $clientId;

        // $result = str_pad($result, 16, '0', STR_PAD_LEFT);

        return $result;
    }
    $New_rib = generateUniqueRIB(4878765);
    


    $insertClientsData = "
        INSERT INTO clients (first_name, last_name, birth_date, nationality, gender) 
        VALUES  ('Amine', 'El karroudi', '2005-04-26', 'Marocain', 'Male'),
                ('Brahim', 'Ouborih', '2001-04-04', 'Marocain', 'Male'),
                ('Wafaa', 'Something', '2002-04-04', 'Marocain', 'Female'),
                ('Hafchaa', 'hajou', '2005-04-04', 'Marocain', 'Female'),
                ('Nouamane', 'Ait Sfia', '2000-04-04', 'Marocain', 'Male');
    ";

    $insertAccountsData = "
        INSERT INTO accounts (balance, currency, client_id, rib) 
        VALUES  (211, 'Mad', 4, " . time() . ");
    ";

    $insertTransactionsData = "
        INSERT INTO transactions (account_id, type, amount) 
        VALUES  (1, 'credit', 740),
                (3, 'debit', 1450),
                (3, 'credit', 90),
                (4, 'credit', 450);
                
    ";

    // $conx->query($insertClientsData);
    // $conx->query($insertAccountsData);
    // $conx->query($insertTransactionsData);

    
    function PrintAccounts() {

        global $conx;

        if (isset($_GET['id'])) {
            $clientID = isset($_GET['id']) ? intval($_GET['id']) : 0;
            $fetchAccountsQuery = "SELECT * FROM accounts WHERE client_id = $clientID";
            $accountsResult = $conx->query($fetchAccountsQuery);
        }
        else {
            $fetchClientsQuery = "SELECT * FROM accounts";
            $accountsResult = $conx->query($fetchClientsQuery);
        }

        return $accountsResult;
    }

    function fetchClientData() {
        global $conx;   
        $fetchClientsQuery = "SELECT * FROM clients";
        $clientsResult = $conx->query($fetchClientsQuery);

        return $clientsResult;
    }
    
    function PrintTransaction() {

        global $conx;

        if (isset($_GET['id'])) {
            $clientID = isset($_GET['id']) ? intval($_GET['id']) : 0;
            $fetchClientsQuery = "SELECT * FROM transactions WHERE account_id = $clientID";
            $transactionResult = $conx->query($fetchClientsQuery);
        }
        else {
            $fetchClientsQuery = "SELECT * FROM transactions";
            $transactionResult = $conx->query($fetchClientsQuery);
        }

        return $transactionResult;
    }

?>