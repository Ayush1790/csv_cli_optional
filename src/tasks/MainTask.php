<?php

declare(strict_types=1);

namespace MyApp\Tasks;

use Phalcon\Cli\Task;

class MainTask extends Task
{

    public function mainAction()
    {
        echo "default task and default action";
    }
    public function importAction()
    {
        if (($open = fopen(BASE_PATH."/file/color_srgb.csv", "r")) !== false) {
            while (($data = fgetcsv($open, 1000, ",")) !== false) {
                $array[] = $data;
            }
         
            fclose($open);
        }
        fclose($open);
        print_r($array);
        $this->mongo->insertOne([$array]);
    }
    public function exportAction(){
        $res=$this->mongo->find();
        // Open a file in write mode ('w')
        $fp = fopen(BASE_PATH.'/file/data.csv', 'w');
        // Loop through file pointer and a line
        foreach ($res as $fields) {
            foreach ($fields[0] as $data) {
            $arr = [
                'name'=>$data[0],
                'hex_code'=>$data[1],
                'rgb'=>$data[2]
            ];
            fputcsv($fp, $arr);
            }
        }
          
        fclose($fp);
    }
}
