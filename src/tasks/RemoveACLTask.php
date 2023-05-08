<?php
//deleting all log files
declare(strict_types=1);

namespace MyApp\Tasks;

use Phalcon\Cli\Task;
use Phalcon\Acl\Adapter\Memory;
use Phalcon\Acl\Role;
use Phalcon\Acl\Component;

class RemoveACLTask extends Task
{
    public function mainAction()
    {
        $acl = new Memory();

        /**
         * Setup the ACL
         */
        $acl->addRole('user');

        $acl->addComponent(
            'MainTask',
            [
                'main',
            ]
        );
        $this->cache->set('mykey', serialize($acl));
    }
    public function removeAction()
    {
        $this->cache->delete('mykey');
    }
}
