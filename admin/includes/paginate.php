<?php

class Paginate {

  public $current_page;
  public $items_per_page;
  public $items_total_count;

  public function __construct($page=1, $items_per_page=10, $items_total_count){
    $this->current_page = (int)$page;
    $this->items_per_page = (int)$items_per_page;
    $this->items_total_count = (int)$items_total_count;


  }//End of __construct() Method

  public function next(){
    return $this->current_page + 1;
  }//End of next() Method

  public function previous(){

    return $this->current_page - 1;
  }//End of previous() Method

  public function page_total(){
    return ceil($this->items_total_count/$this->items_per_page);
  }//End of page_total() Method

  public function has_previous(){
    return $this->previous() >= 1 ? true : false;
  }//End of has_previous() Method

  public function has_next(){
    return $this->next() <= $this->page_total() ? true : false;
  }//End of has_next() Method

  public function offset(){
    return ($this->current_page-1) * $this->items_per_page;
  }//End of offset() Method





























}//End of Paginate Class












 ?>
