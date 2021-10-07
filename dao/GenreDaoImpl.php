<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GenreDaoImpl
 *
 * @author master
 */
include_once '.util/PDOUTIL.php';

class GenreDaoImpl {

    //put your code here
    public function updateGenre($id, $namaGenreBaru) {
        $link = PDOUTIL::createMySqlConnection();
        $query = "UPDATE genre SET name=? WHERE id=?";
        mysqli_autocommit($link, FALSE);
        if ($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_bind_param($stmt, "si", $namaGenreBaru, $id);
            mysqli_stmt_execute($stmt) or die(mysqli_error($link));
            mysqli_commit($link);
            mysqli_stmt_close($stmt);
        }
        PDOUTIL::CloseConn($link);
    }

    public function getAllGenre() {
        $link = createMySqlConnection();
        $query = "SELECT * FROM genre";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        PDOUTIL::CloseConn($link);
        return $result;
    }

    public function getOneGenreBook() {
        $link = createMySqlConnection();
        $query = "SELECT * FROM genre ORDER BY name";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        PDOUTIL::CloseConn($link);
        return $result;
    }

    public function addGenre($name) {
        $link = createMySqlConnection();
        $query = "INSERT INTO genre(name) VALUES(?)";
        if ($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_bind_param($stmt, "s", $name);
            mysqli_stmt_execute($stmt) or die(mysqli_error($link));
            mysqli_commit($link);
            mysqli_stmt_close($stmt);
        }
        PDOUTIL::CloseConn($link);
    }

    public function deleteGenre($genreId) {
        $link = createMySqlConnection();
        $query = "DELETE FROM genre WHERE id=?";
        if ($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_bind_param($stmt, "i", $genreId);
            mysqli_stmt_execute($stmt) or die(mysqli_error($link));
            mysqli_commit($link);
            PDOUTIL::CloseConn($link);
        }
        mysqli_close($link);
    }

    public function getOneGenre($sid) {
        $link = createMySqlConnection();
        $query = "SELECT * FROM genre WHERE id=?";
        if ($stmt = mysqli_prepare($link, $query) or die(mysqli_error($link))) {
            mysqli_stmt_bind_param($stmt, "i", $sid);
            mysqli_stmt_execute($stmt) or die(mysqli_error($link));
            $hasil = mysqli_stmt_get_result($stmt);
            $data = mysqli_fetch_array($hasil);
            PDOUTIL::CloseConn($link);
        }
        return $data;
    }

}
