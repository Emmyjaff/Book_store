<?php

require_once("db.php");
require_once("button.php");
require_once("input.php");

$returnConnection = createDatabase();

//create button on click
if(isset($_POST['add']) || isset($_POST['update'])){
    createDate();
}

function createDate(){
    $bookName = textboxValue("table_name");
    $bookPublisher = textboxValue("book_publisher");
    $bookPrice = textboxValue("book_price");

    if($bookName && $bookPublisher && $bookPrice){
        $statement = " INSERT INTO books(table_name, book_publisher, book_price)
        VALUES ('$bookName', '$bookPublisher', '$bookPrice')";

        // set action 
        $action = 'Inserted';

        // check for id
        if (isset($_POST['id']) && $_POST['id'] != '')
        {
            $statement = "UPDATE books SET table_name = '{$bookName}', book_publisher = '{$bookPublisher}', book_price = '{$bookPrice}' WHERE id = {$_POST['id']}";

            // change action
            $action = 'Updated';
        
        }

        if(mysqli_query($GLOBALS['returnConnection'], $statement)){
            message("success", "Record Successfully {$action}...");
        }else{
            echo "Error";
        }

    }else{
        message("error", "Provide Book Information...");
    }

}

function textboxValue($value){
    $connection = $GLOBALS['returnConnection'];
    $textbox = mysqli_real_escape_string( $connection, trim($_POST[$value]));
    if(empty($textbox)){
        return false;
    }else{
        return $textbox;
 }
};

function message($message, $text){
    $textNode = "<h6 class='$message'>$text</h6>";
    echo $textNode;
}

//get data from data baseSELECT column_name(s) FROM table_name ORDER BY column_name(s) ASC|DESC 
function getData(){
    $getData = "SELECT * FROM books ORDER BY table_name DESC";

    $result = mysqli_query($GLOBALS['returnConnection'],$getData);

    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}

function getRecord()
{
    static $record;

    // create instance if record is null
    $record = ($record === null) ? new stdClass : $record;

    // set default values
    $record->table_name = $record->book_publisher = $record->book_price = $record->id = '';

    // check 
    if (isset($_GET['bookid'])) :

        // check for record
        $result = mysqli_query($GLOBALS['returnConnection'], "SELECT * FROM books WHERE id = {$_GET['bookid']}");

        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);
            $record->table_name = $row['table_name'];
            $record->book_publisher = $row['book_publisher'];
            $record->book_price = $row['book_price'];
            $record->id = $row['id'];
        }

    endif;

    // return std class
    return $record;
}