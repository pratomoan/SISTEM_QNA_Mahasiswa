<?php

include_once 'config.php';

function loginCheck($nip, $password) {
    $arrResult = login($nip, md5($password));
    if (!empty($arrResult) && $arrResult['nip'] == $nip) {
        $_SESSION["loggedin"] = true;
        $_SESSION["nip"] = $nip;
        $_SESSION["password"] = $password; 
        $_SESSION['name'] = $arrResult['name'];
        header('location:index.php');
    } else {
        $errMsg = 'Invalid username or password';
    }
}

function login($username) {
    $link = createMySqlConnection();
    $query = 'SELECT nip, password, nama FROM admin WHERE nip = ?';
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_execute($stmt) or die(mysqli_error($link));
        mysqli_stmt_bind_result($stmt, $returnName);
        mysqli_stmt_fetch($stmt);
        $result = array('nama' => $returnName);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
    return $result;
}

function getAllCategory() {
    $link = createMySqlConnection();
    $query = "SELECT id, category FROM category";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    mysqli_close($link);
    return $result;
}

function insertQuestion($nrp,$question,$email,$name,$category_id,$insertdate,$publication_status) {
    $link = createMySqlConnection();
    $query = "INSERT INTO question (submitted_by,question,email,nama,category_id,tanggal_masuk,is_published) VALUES(?,?,?,?,?,?,?)";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "ssssssis", $nrp,$question,$email,$name,$category_id,$insertdate,$publication_status);
        mysqli_stmt_execute($stmt) or die(mysqli_error($link));
        mysqli_commit($link);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}


function insertCategory($category) {
    $link = createMySqlConnection();
    $query = "INSERT INTO category (category,category_by) VALUES(?,?) ";
    session_start();
    $admin_name = $_SESSION["name"];
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "s,s", $category,$admin_name);
        mysqli_stmt_execute($stmt) or die(mysqli_error($link));
        mysqli_commit($link);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}



function deleteQuestion($question_id) {
    $link = createMySqlConnection();
    $query = "DELETE FROM question WHERE question_id=?";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $question_id);
        mysqli_stmt_execute($stmt) or die(mysqli_error($link));
        mysqli_commit($link);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}


function deleteCategory($category_id) {
    $link = createMySqlConnection();
    $query = "DELETE FROM category WHERE id=?";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $category_id);
        mysqli_stmt_execute($stmt) or die(mysqli_error($link));
        mysqli_commit($link);
        mysqli_stmt_close($stmt);
        if(!$stmt){
        $notice = 'error=1';
        }else{
            $notice = 'error=0';
        }
        header('location: admin.php?'.$notice);
    }
    mysqli_close($link);
}







//function deleteBook($idYangDihapus) {
//    $link = createMySqlConnection();
//    $query = "DELETE FROM book WHERE isbn=?";
//    if ($stmt = mysqli_prepare($link, $query)) {
//        mysqli_stmt_bind_param($stmt, "s", $idYangDihapus);
//        mysqli_stmt_execute($stmt) or die(mysqli_error($link));
//        mysqli_commit($link);
//        mysqli_stmt_close($stmt);
//    }
//    mysqli_close($link);
//}

///////////////////////////////////////////////////
//
//function GetProgramStudiAgenda() {
//    $link = createMySqlConnection();
//    $query = "SELECT * FROM program_studi ORDER BY nama";
//    $result = mysqli_query($link, $query) or die(mysqli_error($link));
//    mysqli_close($link);
//    return $result;
//}
//
//
//function GetAllAgenda() {
//    $link = createMySqlConnection();
//    $query = "SELECT b.id, b.nama, b.keterangan, b.tanggal_mulai, b.tanggal_selesai, b.tempat, b.namaposter, g.kode, g.nama as 'namaps' FROM Agenda b join program_studi g on b.program_studi_id = g.id";
//    $result = mysqli_query($link, $query) or die(mysqli_error($link));
//    mysqli_close($link);
//    return $result;
//}
//
//function $link = createMySqlConnection();
//    $link = createMySqlConnection();
//    $query = "INSERT INTO Agenda(nama,keterangan,tanggal_mulai,tanggal_selesai,tempat,program_studi_id,namaposter) VALUES(?,?,?,?,?,?,?)";
//    if ($tanggal_selesai < $tanggal_mulai) {
//        
//    } else {
//        if ($stmt = mysqli_prepare($link, $query)) {
//            mysqli_stmt_bind_param($stmt, "sssssis", $nama, $keterangan, $tanggal_mulai, $tanggal_selesai, $tempat, $program_studi, $namaposter);
//            mysqli_stmt_execute($stmt) or die(mysqli_error($link));
//            mysqli_commit($link);
//            mysqli_stmt_close($stmt);
//        }
//    }
//    mysqli_close($link);
//}
//
//function insertProgStud($kode, $nama) {
//    $link = createMySqlConnection();
//    $query = "INSERT INTO program_studi(kode,nama) VALUES(?,?)";
//    if ($stmt = mysqli_prepare($link, $query)) {
//        mysqli_stmt_bind_param($stmt, "ss", $kode, $nama);
//        mysqli_stmt_execute($stmt) or die(mysqli_error($link));
//        mysqli_commit($link);
//        mysqli_stmt_close($stmt);
//    }
//    mysqli_close($link);
//}
//
//function deleteBook($idYangDihapus) {
//    $link = createMySqlConnection();
//    $query = "DELETE FROM book WHERE isbn=?";
//    if ($stmt = mysqli_prepare($link, $query)) {
//        mysqli_stmt_bind_param($stmt, "s", $idYangDihapus);
//        mysqli_stmt_execute($stmt) or die(mysqli_error($link));
//        mysqli_commit($link);
//        mysqli_stmt_close($stmt);
//    }
//    mysqli_close($link);
//}
//
//function deleteAgenda($idYangDihapus) {
//    $link = createMySqlConnection();
//    $query = "DELETE FROM Agenda WHERE id = ?";
//    if ($stmt = mysqli_prepare($link, $query)) {
//        mysqli_stmt_bind_param($stmt, "i", $idYangDihapus);
//        mysqli_stmt_execute($stmt) or die(mysqli_error($link));
//        mysqli_commit($link);
//        mysqli_stmt_close($stmt);
//    }
//    mysqli_close($link);
//}
//
//function deleteProgStud($idYangDihapus) {
//    $link = createMySqlConnection();
//    $query = "DELETE FROM program_studi WHERE id = ?";
//    if ($stmt = mysqli_prepare($link, $query)) {
//        mysqli_stmt_bind_param($stmt, "i", $idYangDihapus);
//        mysqli_stmt_execute($stmt) or die(mysqli_error($link));
//        mysqli_commit($link);
//        mysqli_stmt_close($stmt);
//    }
//    mysqli_close($link);
//}
//
//function getOneBook($sid) {
//    $link = createMySqlConnection();
//    $query = "SELECT * FROM book WHERE isbn=?";
//    if ($stmt = mysqli_prepare($link, $query) or die(mysqli_error($link))) {
//        mysqli_stmt_bind_param($stmt, "i", $sid);
//        mysqli_stmt_execute($stmt) or die(mysqli_error($link));
//        $hasil = mysqli_stmt_get_result($stmt);
//        $data = mysqli_fetch_array($hasil);
//        mysqli_stmt_close($stmt);
//    }
//    return $data;
//}
//
//function getOneAgenda($sid) {
//    $link = createMySqlConnection();
//    $query = "SELECT * FROM agenda WHERE id=?";
//    if ($stmt = mysqli_prepare($link, $query) or die(mysqli_error($link))) {
//        mysqli_stmt_bind_param($stmt, "i", $sid);
//        mysqli_stmt_execute($stmt) or die(mysqli_error($link));
//        $hasil = mysqli_stmt_get_result($stmt);
//        $data = mysqli_fetch_array($hasil);
//    }
//    return $data;
//}
//
//function getOneProgStud($sid) {
//    $link = createMySqlConnection();
//    $query = "SELECT * FROM program_studi WHERE id=?";
//    if ($stmt = mysqli_prepare($link, $query)) {
//        mysqli_stmt_bind_param($stmt, 'i', $sid);
//        mysqli_stmt_execute($stmt) or die(mysqli_error($link));
//        $result = mysqli_stmt_get_result($stmt);
//        $data = mysqli_fetch_array($result);
//    }
//    return $data;
//}
//
//function updateGenre($id, $namaGenreBaru) {
//    $link = createMySqlConnection();
//    $query = "UPDATE genre SET name=? WHERE id=?";
//    mysqli_autocommit($link, FALSE);
//    if ($stmt = mysqli_prepare($link, $query)) {
//        mysqli_stmt_bind_param($stmt, "si", $namaGenreBaru, $id);
//        mysqli_stmt_execute($stmt) or die(mysqli_error($link));
//        mysqli_commit($link);
//        mysqli_stmt_close($stmt);
//    }
//    mysqli_close($link);
//}
//
//function updateBook($titleBaru, $authorBaru, $descriptionBaru, $publisherBaru, $publishDateBaru, $idGenreBaru, $isbnLama, $namabaru) {
//    $link = createMySqlConnection();
//    $query = "UPDATE book SET title=?, author=?, description=?, publisher=?, publish_date=?, genre_id=?, namabaru=? WHERE isbn=?";
//    mysqli_autocommit($link, FALSE);
//    if ($stmt = mysqli_prepare($link, $query)) {
//        mysqli_stmt_bind_param($stmt, "sssssiss", $titleBaru, $authorBaru, $descriptionBaru, $publisherBaru, $publishDateBaru, $idGenreBaru, $namabaru, $isbnLama);
//        mysqli_stmt_execute($stmt) or die(mysqli_error($link));
//        mysqli_commit($link);
//        mysqli_stmt_close($stmt);
//    }
//    mysqli_close($link);
//}
//
//function updateAgenda($namaBaru, $keteranganBaru, $tanggal_mulaiBaru, $tanggal_selesaiBaru, $tempatBaru, $program_studiBaru, $namaposter, $idLama) {
//    $link = createMySqlConnection();
//    $query = "UPDATE agenda SET nama=?, keterangan=?, tanggal_mulai=?, tanggal_selesai=?, tempat=?, program_studi_id=?, namaposter=? WHERE id=?";
//    mysqli_autocommit($link, FALSE);
//    if ($stmt = mysqli_prepare($link, $query)) {
//        mysqli_stmt_bind_param($stmt, "sssssisi", $namaBaru, $keteranganBaru, $tanggal_mulaiBaru, $tanggal_selesaiBaru, $tempatBaru, $program_studiBaru, $namaposter, $idLama);
//        mysqli_stmt_execute($stmt) or die(mysqli_error($link));
//        mysqli_commit($link);
//        mysqli_stmt_close($stmt);
//    }
//}
//
//function updateProgStud($namaBaru, $kodeBaru, $idLama) {
//    $link = createMySqlConnection();
//    $query = 'UPDATE program_studi SET nama=?, kode=? where id=?';
//    if ($stmt = mysqli_prepare($link, $query)) {
//        mysqli_stmt_bind_param($stmt, 'ssi', $namaBaru, $kodeBaru, $idLama);
//        mysqli_stmt_execute($stmt) or die(mysqli_error($link));
//        mysqli_commit($link);
//        mysqli_stmt_close($link);
//    }
//}
//
//function GetAllProgStud() {
//    $link = mysqli_connect("localhost", "root", "", "pwl20181", "3306") or die(mysqli_connect_error());
//    $query = "SELECT * FROM program_studi";
//    $result = mysqli_query($link, $query) or die(mysqli_error($link));
//    mysqli_close($link);
//    return $result;
//}
