<?php

declare(strict_types=1);

namespace MyApp\Tasks;

use Phalcon\Cli\Task;

class ProductTask extends Task
{
    public function mainAction()
    {
        $count = $this->db->fetchAll(
            "SELECT COUNT(*) FROM products as count where stock <= 10",
            \Phalcon\Db\Enum::FETCH_ASSOC
        );
        echo ($count[0]['COUNT(*)']);
    }
}
