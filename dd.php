<?php

    // MySql Configuration   
    $servername = "localhost";
    $username = "root";
    $password = "";

    // Create Database 
    $database = "CREATE DATABASE IF NOT EXISTS Bank_Management";  // In First Time
    // $database = "Bank_Management";    // if exist 

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
    $conx = new mysqli($servername, $username, $password); // In First Time
    // $conx = new mysqli($servername, $username, $password, $database); // If Database Exist 
    

    $conx->query($database);
    // $conx->query($createClientsTable);
    // $conx->query($createAccountsTable);
    // $conx->query($createTransactionTable);

    


    $insertClientsData = "
        INSERT INTO clients (first_name, last_name, birth_date, nationality, gender) 
        VALUES  ('Amine', 'El karroudi', '2005-04-26', 'Marocain', 'Male'),
                ('Brahim', 'Ouborih', '2001-04-04', 'Marocain', 'Male'),
                ('Wafaa', 'Something', '2002-04-04', 'Marocain', 'Female'),
                ('Hafchaa', 'hajou', '2005-04-04', 'Marocain', 'Female'),
                ('Nouamane', 'Ait Sfia', '2000-04-04', 'Marocain', 'Male');
    ";

    $insertAccountsData = "
        INSERT INTO accounts (balance, currency, client_id) 
        VALUES  (608, 'Mad', 3);
    ";

    $insertTransactionsData = "
        INSERT INTO transactions (account_id, type, amount) 
        VALUES  (1, 'credit', 7800),
                (2, 'debit', 1450),
                (2, 'credit', 90),
                (3, 'credit', 450);
                
    ";

    // $conx->query($insertClientsData);
    // $conx->query($insertAccountsData);
    // $conx->query($insertTransactionsData);

?>