function deleteConfirm(){ // ask confirmation before deleting something
    //console_log("on est la");
    var del=confirm("Êtes-vous sûr de vouloir supprimer ces exercices ?" );
    if (del==true){
        document.cookie="delete=true";
    }
    return del;
}


function selectAll(source) {// select all checkbox elem with the class "exerciceCheck"
    checkboxes = document.getElementsByClassName('exerciceCheck');
    for(var i=0, n=checkboxes.length;i<n;i++) {
        checkboxes[i].checked = source.checked;
    }
}