<?php
function arrayToXml($data) {
    $xml = '';
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $xml .= "<$key>" . arrayToXml($value) . "</$key>";
        } else {
            $xml .= "<$key>$value</$key>";
        }
    }
    return $xml;
}

$data = [
    'body' => [
        'name' => 'lihua',
        'arr' => [
            'age' => '12'
        ]
    ]
];

$xml = arrayToXml($data);
echo $xml;exit;