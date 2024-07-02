function filterTable(){
    var input = document.getElementById("search").value.toUpperCase();
    var rows = document.getElementById("table").getElementsByTagName("tr");
    for(var i = 1; i < rows.length; i++){
        var rowText = rows[i].innerText.toUpperCase();
        if(rowText.includes(input)){
            rows[i].style.display = '';
        }
        else{
            rows[i].style.display = 'none';
        }
    }
}

var remover = document.getElementById("remover");
        remover.addEventListener("click", showRemove);

        var editor = document.getElementById("editor");
        editor.addEventListener("click", showEdit);

        function showAddProduct(){
            document.getElementById("add-product").style.display = "block";
        }
        function showEdit(){
            var editButton = document.getElementsByClassName("edit-row");
            for(var i = 0; i < editButton.length; i++){
                document.getElementById("edit-row"+i).style.display = "block";
            }
            editor.removeEventListener("click", showEdit);
            editor.addEventListener("click", hideEdit);
        }

        function hideEdit(){
            var editButton = document.getElementsByClassName("edit-row");
            for(var i = 0; i < editButton.length; i++){
                document.getElementById("edit-row"+i).style.display = "none";
            }
            editor.removeEventListener("click", hideEdit);
            editor.addEventListener("click", showEdit);
        }

        function showRemove(){
            var removeButton = document.getElementsByClassName("remove-row");
            for(var i = 0; i < removeButton.length; i++){
                document.getElementById("remove-row"+i).style.display = "block";
            }
            remover.removeEventListener("click", showRemove);
            remover.addEventListener("click", hideRemove);
        }

        function hideRemove(){
            var removeButton = document.getElementsByClassName("remove-row");
            for(var i = 0; i < removeButton.length; i++){
                document.getElementById("remove-row"+i).style.display = "none";
            }
            remover.removeEventListener("click", hideRemove);
            remover.addEventListener("click", showRemove);
        }