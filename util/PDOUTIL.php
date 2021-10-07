<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PDOUTIL
 *
 * @author master
 */
class PDOUTIL {

//put your code here

    public static function createMySqlConnection() {
        $link = new PDO("localhost", "root", "", "pwl20181", "3306") or die(mysqli_connect_error());
        $link->setAttribute(PDO::ATTR_AUTOCOMMIT, $link);
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $link;
    }

    public static function CloseConn(PDO $link) {
        $link = NULL;
        ;
    }

}
