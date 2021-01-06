<?php
require_once("php/components/input.php");
require_once("php/components/button.php");
require_once("php/components/operation.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Store</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <!-- header section -->
        <header>
            <h1>book shelf</h1>
        </header>
        <!-- form section -->
        <form action="" method="post">
            <input type="hidden" name="id" value="<?=getRecord()->id?>"/>
            <!-- form input -->
            <?php inputElement("BN", "Book Name", "table_name", getRecord()->table_name, "text")?>
            <?php inputElement("PN", "Publisher Name", "book_publisher", getRecord()->book_publisher, "text")?>
            <?php inputElement("$", "Price", "book_price", getRecord()->book_price, "text")?>
            <!-- form buttons -->
            <div class="button">
                <?php buttonElement("add", "blue", "Add", "btn_add")?>
                <?php buttonElement("update", "dark", "Update", "btn_update")?>
                <?php buttonElement("update", "green", "Edit", "btn_edit")?>
                <?php buttonElement("delete", "red", "Delete", "btn_delete")?>
            </div>
        </form>
        <!-- table section -->
        <table class='table-design'>
            <thead class='table-head-design'>
                <tr>
                    <th>ID</th>
                    <th>Book Name</th>
                    <th>Publisher</th>
                    <th>Book Price</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        //get data function
                    
                        $result = getData();
                    
                    if($result){
                        $initial_Id = 1;
                        while($rows = mysqli_fetch_array($result)
                        ){
                    ?>

                    <tr>
                        <td><?=$initial_Id?></td>
                        <td><?php echo $rows['table_name']?></td>
                        <td><?php echo $rows['book_publisher'] ?? '';?></td>
                        <td><?php echo $rows['book_price'] ?? '';?></td>
                        <td>
                        <a href="?bookid=<?=$rows['id']?>">Update</a>
                        </td>
                    </tr>

                    <?php

                        $initial_Id++;
                    }
                }
                
                ?>
            </tbody>
        </table>
    </div>


    <!-- javascript files -->
    <script src="php/components/main.js"></script>
</body>
</html>