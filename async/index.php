<?php
require_once ("../vendor/autoload.php");


use Spatie\Async\Pool;

$pool = Pool::create();

foreach (range(1, 5) as $i) {
    $pool[] = async(function () use ($i) {
        $output = $i * 2;
         sleep(2);
        return $output;
    })->then(function ( $output) {
        echo $output . "\n";
    });
}

await($pool);
