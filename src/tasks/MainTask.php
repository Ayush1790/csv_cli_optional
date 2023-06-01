<?php

declare(strict_types=1);

namespace MyApp\Tasks;

use Phalcon\Cli\Task;

class MainTask extends Task
{
    public function insertAction($id, $name, $qty, $price, $date) {
        $this->mongo->insertOne(["id" => $id, "name" => $name, "qty" => $qty, "price" => $price, "date" => strtotime($date)]);
    }
    
    public function mainAction($start, $end)
    {
        $start = strtotime($start);
        $end = strtotime($end);
        // echo $start; die;
        $response = $this->mongo->find(['date'=>['$gte' => $start, '$lte' => $end]]);
        // print_r($response);
        foreach ($response as $key => $value) {
            # code...
            print_r($value->id);
        }
    }
}
