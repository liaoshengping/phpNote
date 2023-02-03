<?php
include_once ('block.php');

class Blockchain
{
    public function __construct()
    {
        $this->blocks[] = new Block('', 'Genesis Block');
    }

    public $blocks = [];

    public function addBlock($data)
    {

        $prevBlock = $this->blocks[count($this->blocks)-1];
        $this->blocks[] = new Block($prevBlock->getBlockHash(), $data);
    }

}