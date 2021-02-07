<!-- php code for database connection -->
<?php
    // server name localhost
    $server = "localhost";
    // user name by default
    $username = "root";
    // password 
    $password = "";
    
    // connecting with the database
    $conn = new mysqli($server, $username, $password);
    
    // if an error comes in connection , then an error message displays.
    if($conn->connect_error){
        die("Error in connection with the Database :(");
    }
    
    // code for creating the database or checking if database already exists and if error comes in creating the database then an error messange displays.
    $isDBExists = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'ITLAB';";
    $create_db = "CREATE DATABASE ITLAB;";
    if(($norows = $conn->query($isDBExists)->num_rows) == 0){
        if($conn->query($create_db) === false){
            die("Error in creating Database ITLAB <br>");
        }
    }
    
    // if we are not able to use ITLAB database then error message error in using db displays.
    if($conn->query("USE ITLAB") === false){
        die("Error in using db <br>");
    }

    // checking if table ITLABererciseusers already exists
    $isTableExist = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'ITLABexerciseusers';";
    // code for creating the table ITLABexerciseusers.
    $create_table = "CREATE TABLE ITLABexerciseusers (
                     sno INT(11) NOT NULL AUTO_INCREMENT,
                     username VARCHAR(100) NOT NULL,
                     password VARCHAR(255) NOT NULL,
                     phone VARCHAR(10) NOT NULL,
                     dt DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
                     PRIMARY KEY(sno),
                     UNIQUE(username)
                 );";


    
    // if an error comes in creating the table then an error message displays
    if(($notable = $conn->query($isTableExist)->num_rows) == 0){
        if($conn->query($create_table) === false){
            die("Error in creating table ITLABexerciseusers <br>");
        }
        
    }

    
?>