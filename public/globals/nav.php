<head>
    <title>McDonald's Resource API</title>
</head>
<link rel='stylesheet' href='css/main.css' />
<link rel='stylesheet' href='../css/main.css' />

<div id="topNav">

    <div 
    id="home" 
    class="navBtn"
    onClick="client()">
        <p>HOME</p>
    </div>

    <div 
    id="search" 
    class="navBtn"
    onClick="search()">
        <p>SEARCH</p>
    </div>
    <div 
    id="update" 
    class="navBtn"
    onClick="update()">
        <p>UPDATE</p>
    </div>
    <div 
    id="delete" 
    class="navBtn"
    onClick="pdelete()">
        <p>DELETE</p>
    </div>
    <div 
    id="view" 
    class="navBtn"
    onClick="view()">
        <p>VIEW</p>
    </div>
</div>



<script>


    function client(){
        var baseURL = window.location.href.split('/NEWM-N425_Group-4')[0];
        window.location.href = baseURL + '/NEWM-N425_Group-4/client';
    }

    function search(){
        var baseURL = window.location.href.split('/NEWM-N425_Group-4')[0];
        window.location.href = baseURL + '/NEWM-N425_Group-4/search';
    }

    function update(){
        var baseURL = window.location.href.split('/NEWM-N425_Group-4')[0];
        window.location.href = baseURL + '/NEWM-N425_Group-4/update';
    }

    //Function is pdelete due to keyword reservation of 'delete'.
    function pdelete(){
        var baseURL = window.location.href.split('/NEWM-N425_Group-4')[0];
        window.location.href = baseURL + '/NEWM-N425_Group-4/delete';
    }

    function view(){
        var baseURL = window.location.href.split('/NEWM-N425_Group-4')[0];
        window.location.href = baseURL + '/NEWM-N425_Group-4/view';
    }



    /*var submitBtn = document.getElementById("submitBtn");

    submitBtn.onclick = () => {
        if(!document.getElementById("tableValue").value){
            alert('You must input a resource value.');
        }else{
            var url = window.location.href;
            // url = url.split('/')[0];
            window.location.href = url + '/mcdonalds/' + document.getElementById("tableValue").value;
        }
    };*/
</script>