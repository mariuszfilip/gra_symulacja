<?php
/**
 * Date: 30.11.15
 * Time: 23:35
 * @author Mariusz Filipkowski
 */

namespace Admin\Repository;


interface NewsInterface{

    public function add();
    public function edit();
    public function getList();

}