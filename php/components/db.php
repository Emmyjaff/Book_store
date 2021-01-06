<?php
    function createDatabase(){
        $serverName = "localhost";
        $userName = "root";
        $password = "";
        $dbname = "bookstore";

        //create connection
        $connection = mysqli_connect($serverName, $userName, $password);

        //check the connection
        if(!$connection){
            die("connection failed: ".mysql_connect_error($connection));
        }

        //create Database
        $database = "CREATE DATABASE IF NOT EXISTS $dbname";

        if(mysqli_query($connection, $database)){
            $connection = mysqli_connect($serverName, $userName, $password, $dbname);

            $database = "
                    CREATE TABLE IF NOT EXISTS books(
                    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    table_name VARCHAR (25) NOT NULL,
                    book_publisher VARCHAR (20),
                    book_price FLOAT
                );
            ";
        
            if(mysqli_query($connection, $database)){
                return $connection;
            }
            else{
                echo "cannot create table" .mysqli_error($connection);
            }
        }
        else{
            echo "error occured while creating database". mysqli_error($connection);
        }

    }