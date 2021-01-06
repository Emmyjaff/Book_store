<?php

    function inputElement($label, $placeholder, $name, $value, $type){
        $element ="
        <div class=\"inputGroup\">
        <label>$label</label>
        <input type='$type' name='$name' value='$value' placeholder='$placeholder'>
        </div>
        ";
    echo $element;
}
