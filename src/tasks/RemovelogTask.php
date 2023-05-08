<?php
//deleting all log files
declare(strict_types=1);

namespace MyApp\Tasks;

use Phalcon\Cli\Task;

class RemovelogTask extends Task
{
    public function mainAction()
    {
        foreach (glob(BASE_PATH . "/logs/*.log") as $file) {
            unlink($file);
        }
    }
}
