<?php


namespace functions;


class Sale
{
    private $sum =1;
    public function lists(){
        echo 'im sale lists';
    }

    /**
     * @return int
     */
    public function getSum(): int
    {
        return $this->sum;
    }

    /**
     * @param int $sum
     */
    public function setSum(int $sum)
    {
        $this->sum = $sum;
    }
}
