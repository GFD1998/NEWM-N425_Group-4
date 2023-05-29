<?php
require "globals/nav.php";
?>

<head>
    <title>McDonald's Resource API</title>
</head>
<link rel='stylesheet' href='css/main.css' />
<div class='clientContainer'>
    <input id='tableValue' type='text' placeholder='Enter table...' />
    <p id='submitBtn'>Submit</p>
</div>

<script>
    var submitBtn = document.getElementById("submitBtn");

    submitBtn.onclick = () => {
        if(!document.getElementById("tableValue").value){
            alert('You must input a resource value.');
        }else{
            var url = window.location.href;
            // url = url.split('/')[0];
            window.location.href = url + '/mcdonalds/' + document.getElementById("tableValue").value;
        }
    };
</script>