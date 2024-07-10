
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

function showAdd(){
    document.getElementById("add").style.display = "block";
}

function hideAdd(){
    document.getElementById("add").style.display = "none";
}

function hideEdit(){
    document.getElementById("edit").style.display = "none";
}

var remover = document.getElementById("remover");
if(remover){
    remover.addEventListener("click", showRemoveColumn);
}

var editor = document.getElementById("editor");
if(editor){
    editor.addEventListener("click", showEditColumn);
}

function showEditColumn(){
    var editButton = document.getElementsByClassName("edit-row");
    for(var i = 0; i < editButton.length; i++){
        document.getElementById("edit-row"+i).style.display = "block";
    }
    editor.removeEventListener("click", showEditColumn);
    editor.addEventListener("click", hideEditColumn);
}

function hideEditColumn(){
    var editButton = document.getElementsByClassName("edit-row");
    for(var i = 0; i < editButton.length; i++){
        document.getElementById("edit-row"+i).style.display = "none";
    }
    editor.removeEventListener("click", hideEditColumn);
    editor.addEventListener("click", showEditColumn);

}

function showRemoveColumn(){
    var removeButton = document.getElementsByClassName("remove-row");
    for(var i = 0; i < removeButton.length; i++){
        document.getElementById("remove-row"+i).style.display = "block";
    }
    remover.removeEventListener("click", showRemoveColumn);
    remover.addEventListener("click", hideRemoveColumn);
}

function hideRemoveColumn(){
    var removeButton = document.getElementsByClassName("remove-row");
    for(var i = 0; i < removeButton.length; i++){
        document.getElementById("remove-row"+i).style.display = "none";
    }
    remover.removeEventListener("click", hideRemoveColumn);
    remover.addEventListener("click", showRemoveColumn);
}
