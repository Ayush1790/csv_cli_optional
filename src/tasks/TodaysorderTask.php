<?php

declare(strict_types=1);

namespace MyApp\Tasks;

use Phalcon\Cli\Task;

class TodaysorderTask extends Task
{
    public function mainAction()
    {
        $date = date('Y-m-d');
        $orders = $this->db->fetchAll(
            "SELECT * FROM orders  where date = '$date' ",
            \Phalcon\Db\Enum::FETCH_ASSOC
        );
        print_r($orders);
    }
}
