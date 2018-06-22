<?php

/**
 * Description of task
 *
 * @author jmartinez
 */

require_once 'database.class.php';

class task {
    public $name; 
    public $total_time;
    private $db; 
    
    function __construct() {
        $this->db = Database::getInstance();
    }
    
    function getName() {
        return $this->name;
    }

    function getTotal_time() {
        return $this->total_time;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setTotal_time($total_time) {
        $this->total_time = $total_time;
    }

    
    function create($taskname, $time){
        $db = $this->db;
        $this->setName($taskname);
        $this->setTotal_time($time);
        
        //Checks if the task already exists, call update function
        $sql = "SELECT * FROM tasks WHERE taskname = :taskname";
        $statement = $db->prepare($sql);
        $statement->execute(['taskname' => $this->getName()]); 
        $result = $statement->fetch();
                        
        if ($result){
             $this->update($this->getName(), $this->getTotal_time());
             return "Time added to the existing task";
        } else {
            $sql = "INSERT INTO tasks (taskname, time) VALUES (:taskname, :total_time)";
            $statement = $db->prepare($sql);
            $statement->bindValue(":taskname", $this->getName());
            $statement->bindValue(":total_time", $this->getTotal_time());
            $statement->execute();
            return "New task created";
        }
        
    }
    
    private function update($taskname, $newtime){
        
        $db = $this->db;
        
        $sql = 'UPDATE tasks SET time = time + :newtime WHERE taskname = :taskname';
        
        $statement = $db->prepare($sql);
        $statement->bindValue(":taskname", $taskname);
        $statement->bindValue(":newtime", $newtime);
        $statement->execute();
    }
    
    function summary(){
        $db = $this->db;

        $statement = 'SELECT taskname, time FROM tasks WHERE DATE(creation_date) = DATE(NOW())';

        if ($result = $db->query($statement)) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
   
                $taskname = $row['taskname'];
                $time = $row['time'];
                
                $return_arr[] = array(
                    "taskname" => $taskname,
                    "time" => $time,  
                    );
            }
        }      
        return json_encode($return_arr);
    }
    
}
