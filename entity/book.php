<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of book
 *
 * @author master
 */
class book {

    //put your code here
    private $isbn;
    private $title;
    private $author;
    private $description;
    private $publisher;
    private $publish_date;
    private $genre;
    private $namabaru;

    function __construct() {
        $this->genre = new Genre();
    }

    public function _set($name, $value) {
        if (!isset($this->genre))
            $this->genre = new Genre();
    }

    public function __get($name, $value) {
        if (!isset($this->genre)) {
            $this->genre = new Genre;
        }
        if (isset($value)) {
            switch ($name) {
                case 'id' :
                    $this->genre->setId = ($value);
                case 'name' :
                    $this->genre->setName = ($value);
                default :
                    break;
            }
        }
    }

    public function getIsbn() {
        return $this->isbn;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPublisher() {
        return $this->publisher;
    }

    public function getPublish_date() {
        return $this->publish_date;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function getNamabaru() {
        return $this->namabaru;
    }

    public function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setPublisher($publisher) {
        $this->publisher = $publisher;
    }

    public function setPublish_date($publish_date) {
        $this->publish_date = $publish_date;
    }

    public function setGenre($genre) {
        $this->genre = $genre;
    }

    public function setNamabaru($namabaru) {
        $this->namabaru = $namabaru;
    }

}
