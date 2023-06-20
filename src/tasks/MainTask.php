<?php

declare(strict_types=1);

namespace MyApp\Tasks;

use Phalcon\Cli\Task;

class MainTask extends Task
{
    public function insertAction($id, $name, $qty, $price, $date) {
        $this->mongo->insertOne(["id" => $id, "name" => $name, "qty" => $qty,
         "price" => $price, "date" => strtotime((string)$date),"rating"=>0]);
        $main=new MainTask();
        $main->rating($id);
    }
    
    public function mainAction()
    {
        $val=(int)readline("Enter 1 for order \nEnter 2 for show product with rating ");
        $main=new MainTask();
        if($val==1){
            $id=(int)readline("Enter id ");
            $name=(string)readline("Enter name ");
            $qty=(int)readline("Enter qty ");
            $price=(int)readline("Enter price ");
            $date=(string)readline("Enter date ");
            $main->insertAction($id, $name, $qty, $price, $date);
        }elseif ($val==2) {
            $res=$this->mongo->find([],['sort'=>['rating'=>-1]]);
           foreach ($res as $value) {
            echo "Name => ".$value->name."\nPrice => ".$value->price."\nRating => ".$value->rating;
            echo "\n\n";
           }
        }else{
            echo "Wrong Choice";
        }
    }

    public function rating($id){
        $rating =(int)readline("Please give rating of this product in the range of 0-5");
        if($rating>5 || $rating<0){
            $this->rating($id);
        }else{
            $this->mongo->updateOne(["id"=>$id],['$set' =>["rating"=>$rating]]);
        }
    }
}
