<?php



class Pagention{

    public $limit;
    public $offset;

    public function __construct($page, $numberPerPage) {

        $this->limit =  $numberPerPage;

        $this->offset = $numberPerPage*($page-1);


    }
}