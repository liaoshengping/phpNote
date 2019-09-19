<?php


$obj = new DFA();
$obj->addKeyWord('周杰伦的歌');
$obj->addKeyWord('林俊杰');
$obj->addKeyWord('周杰伦的老婆');
$obj->addKeyWord('老盖伦的女儿');
$obj->getHashMap();

var_dump($obj->searchKey('林俊杰'));
//var_dump($obj->searchKey('盖伦'));

/**
 * Class DFA   DFA 算法  确定有穷自动机
 */
class DFA
{
    private $arrHashMap = [];

    public function getHashMap()
    {
        return $this->arrHashMap;
    }

    public function addKeyWord($strWord)
    {
        $len = mb_strlen($strWord, 'UTF-8');

        // 传址
        $arrHashMap = &$this->arrHashMap;
        for ($i = 0; $i < $len; $i++) {
            $word = mb_substr($strWord, $i, 1, 'UTF-8');
            // 已存在
            if (isset($arrHashMap[$word])) {
                if ($i == ($len - 1)) {
                    $arrHashMap[$word]['end'] = 1;
                }
            } else {
                // 不存在
                if ($i == ($len - 1)) {
                    $arrHashMap[$word] = [];
                    $arrHashMap[$word]['end'] = 1;
                } else {
                    $arrHashMap[$word] = [];
                    $arrHashMap[$word]['end'] = 0;
                }
            }
            // 传址
            $arrHashMap = &$arrHashMap[$word];
        }
    }

    public function searchKey($strWord)
    {
        $len = mb_strlen($strWord, 'UTF-8');
        $arrHashMap = $this->arrHashMap;
        for ($i = 0; $i < $len; $i++) {
            $word = mb_substr($strWord, $i, 1, 'UTF-8');
            if (!isset($arrHashMap[$word])) {
                // reset hashmap
                $arrHashMap = $this->arrHashMap;
                continue;
            }
            if ($arrHashMap[$word]['end']) {
                return true;
            }
            $arrHashMap = $arrHashMap[$word];
        }
        return false;
    }
}

