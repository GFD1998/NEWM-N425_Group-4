<?php
require "globals/nav.php";
?>


<div class='clientContainer'>
    <select id="table-select" class="form-select" aria-label="McDonald's Search">
        <option selected>McDonald's Search</option>
        <option value="menuitems">Menu Items</option>
        <option value="ingredients">Ingredients</option>
        <option value="allergens">Allergens</option>
        <option value="menuitemingredients">Menu Item Ingredients</option>
        <option value="menuitemallergens">Menu Item Allergens</option>
        <option value="nutritionalinformation">Nutritional Information</option>
    </select>
    <br>
    <input id='term' type='text' placeholder='Enter term (e.g. bun, burger, etc...)' />
    <p id='submitBtn' onClick='requestData()'>Submit</p>
    <br>
    <div id="results"></div>
</div>

<script>
    var submitBtn = document.getElementById("submitBtn");

    async function requestData(){
        
        console.log(document.getElementById("term").value);
        console.log(document.getElementById("table-select").value);
        const term = document.getElementById("term").value;
        const table = document.getElementById("table-select").value;
        var resultsContainer = document.getElementById("results");
        resultsContainer.innerHTML = '';
        var response;
        if(table == "McDonald's Search") {
            alert('You must select an element to search.');
        }else {
            var url = window.location.href;
            url = url.split('/search')[0];
            if(!term) {
                response = await fetch(url + '/api/resources/' + table);
                const jsonResponse = await response.json();
                var displayData = Object.keys(jsonResponse.data).map((key) => [key, jsonResponse.data[key]]);
                console.log(displayData);

                displayData.forEach((data) => {
                    resultsContainer.innerHTML += `<br>`;
                    var data = data[1];
                    $.each(data, (key, pair) => {
                        console.log(key);
                        console.log(pair);
                        resultsContainer.innerHTML += `<div class='results-row'>${key} : ${pair}</div>`;
                    });
                });
            }else {
                console.log(url + '/api/resources/' + table + '?a=' + term);
                response = await fetch(url + '/api/resources/' + table + '?a=' + term);
                const jsonResponse = await response.json();
                var displayData = jsonResponse;
                console.log(jsonResponse);
                console.log(displayData);
                $.each(displayData, (dataKey, data) => {
                    console.log(data);
                    resultsContainer.innerHTML += `<br>`;
                    $.each(data, (key, pair) => {
                        console.log(key);
                        console.log(pair);
                        resultsContainer.innerHTML += `<div class='results-row'>${key} : ${pair}</div>`;
                    });
                });
            }
        }
    }

    function resultTemplates(){

    }
</script>