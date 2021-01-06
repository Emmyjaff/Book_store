<?php

    function buttonElement($name, $class, $text, $btn_id){
        $button ="
        <button name='$name' id='$btn_id' class='$class'>$text</button>
        ";
    echo $button;
}