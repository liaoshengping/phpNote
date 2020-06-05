<?php

abstract class AbstractDisplayer
{
    abstract  public function display();
}

class init extends AbstractDisplayer {

    use BelongsToRelation;

    public function __construct()
    {
        $this->display();
    }
}

trait BelongsToRelation {

    public  function display($selectable =null,$column = '')
    {
        echo '实现belongsTo 的方法';
    }
}

new init();


