<?php


require_once("db.php");
require_once("button.php");
require_once("input.php");

$returnConnection = createDatabase();



//create click function
if(isset($_POST['add'])){
    createDate();
}


function createData(){
    
}