<?php

declare(strict_types=1);

namespace MyApp\Tasks;

use Phalcon\Cli\Task;

class SettingTask extends Task
{
    public function mainAction($price, $stock)
    {
        $setting = $this->db->fetchAll(
            "SELECT * FROM seetingCli",
            \Phalcon\Db\Enum::FETCH_ASSOC
        );
        if (empty($setting)) {
            $connection = $this->container->get('db');
            $connection->query("insert into seetingCli values ($price,$stock) ");
        } else {
            $connection = $this->container->get('db');
            $connection->query("update `seetingCli` set `price`='$price' , `stock`='$stock'  ");
        }
    }
}
