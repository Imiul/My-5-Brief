/* Create Database */ 
CREATE DATABASE IF NOT EXISTS bankManagement;

/* Use The Database */ 
USE bankManagement;

/* Create clients table */ 
CREATE TABLE clients (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    birth_date DATE,
    nationality VARCHAR(50),
    gender ENUM('Male', 'Female') NOT NULL
);


/* Create accounts table */ 
CREATE TABLE accounts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    balance DECIMAL(10, 2) DEFAULT 0.0,
    currency VARCHAR(10),
    client_id INT,
    FOREIGN KEY (client_id) REFERENCES clients(id)
);


/*  Create transactions table */ 
CREATE TABLE transactions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    account_id INT,
    type VARCHAR(10) CHECK (type IN ('credit', 'debit')),
    amount DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (account_id) REFERENCES accounts(id)
);