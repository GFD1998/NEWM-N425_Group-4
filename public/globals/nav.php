<div id="topNav">

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

    function search(){
        window.location.href += '/search';
    }

    function update(){
        window.location.href += '/update';
    }

    //Function is pdelete due to keyword reservation of 'delete'.
    function pdelete(){
        window.location.href += '/delete';
    }

    function view(){
        window.location.href += '/view';
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