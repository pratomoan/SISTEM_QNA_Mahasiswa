function deleteGenre(id) {
    var confir = confirm("are you sure?");
    if (confir) {
        //window.alert(id);
        window.location = "index.php?navito=genre&command=delete&sid=" + id;
    }
}

function deleteBook(isbn) {
    var confir = confirm("are you sure?");
    if (confir) {
        window.location = "index.php?navito=book&command=delete&isbn=" + isbn;
    }
}

function deleteAgenda(id) {
    var confir = confirm("are you sure?");
    if (confir) {
        //window.alert(id);
        window.location = "index.php?navito=agenda&command=delete&sid=" + id;
    }
}

function deleteProgramStudi(id) {
    var confir = confirm("are you sure?");
    if (confir) {
        //window.alert(id);
        window.location = "index.php?navito=progstud&command=delete&sid=" + id;
    }
}

function updateGenre(id) {
    window.location = 'index.php?navito=genre&command=update&id=' + id;
}
function updateBook(isbn) {
    window.location = 'index.php?navito=book&command=update&isbn=' + isbn;
}
function updateAgenda(id) {
    window.location = 'index.php?navito=agenda&command=update&id=' + id;
}
function updateProgStud(id) {
    window.location = 'index.php?navito=progstud&command=update&id=' + id;
}