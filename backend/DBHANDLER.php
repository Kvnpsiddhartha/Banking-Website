<?php

class DBHANDLER
{
    private $connection;
    function __construct()
    {
        require_once dirname(__FILE__) . '/DBCONNECT.php';
        // opening db connection
        $db = new DBCONNECT();
        $this->connection = $db->connect();
        mysqli_set_charset($this->connection, "utf8");
    }

    //     function getTopics(){
    //         $stmt=$this->connection->prepare("select tid,tname,notests from topics");
    //           $d=array();
    //           $d['status']=false;  
    //           $data=array();
    //     if($stmt->execute()){
    //         $stmt->bind_result($tid,$tname,$ntests);
    //         $stmt->store_result();
    //         if($stmt->num_rows > 0){
    //             $d['status']=true;

    //             while($stmt->fetch()){
    //                 array_push($data,array('tid'=>$tid,'tname'=>$tname,'notests'=>$ntests));
    //             }
    //             $d['data']=$data;
    //         }

    //     }
    //     return $d;
    // }
    // function getSubtopics($tid){
    //         $stmt=$this->connection->prepare("select stid,sname from subtopics where tid=?");
    //           $d=array();
    //           $data=array();
    //           $d['status']=false;  
    //           $stmt->bind_param('i',$tid);
    //     if($stmt->execute()){
    //         $stmt->bind_result($stid,$sname);
    //         $stmt->store_result();
    //         if($stmt->num_rows > 0){
    //             $d['status']=true;

    //             while($stmt->fetch()){
    //                 array_push($data,array('stid'=>$stid,'sname'=>$sname));
    //             }
    //             $d['data']=$data;
    //         }

    //     }
    //     return $d;
    // }
    function transact($from, $to, $amount)
    {
        $response = array();
        $response['status'] = false;
        $from = (int)$from;
        $to = (int)$to;
        $amount = (int)$amount;
        $stmt1 = $this->connection->prepare("update user_account set amount= amount-$amount where id=?;");

        $stmt1->bind_param("i", $from);
        $stmt2 = $this->connection->prepare("update user_account set amount= amount+$amount where id=?;");
        $stmt2->bind_param("i", $to);
        if ($stmt1->execute() && $stmt2->execute()) {
            $response['status'] = true;
        }
        return $response;
    }
    function getUserDetails($id)
    {
        $response = array();
        $response['status'] = false;
        $data = array();
        $stmt = $this->connection->prepare("SELECT name,email,amount name FROM user_account where id=?;");
        $id = (int)$id;
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $stmt->bind_result($name, $email, $amount);
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $response['status'] = true;
                $stmt->fetch();
                $data["name"] = $name;
                $data["email"] = $email;
                $data["id"] = $id;
                $data["amount"] = $amount;
                $response['data'] = $data;
            }
        }
        return $response;
    }
    function getCustomers()
    {
        $response = array();
        $response['status'] = false;
        $data = array();
        $stmt = $this->connection->prepare("SELECT id,name FROM user_account;");

        if ($stmt->execute()) {
            $stmt->bind_result($id, $name);
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $response['status'] = true;
                while ($stmt->fetch()) {
                    array_push($data, array("id" => $id, "name" => $name));
                }
                $response['data'] = $data;
            }
        }
        return $response;
    }
    function getLogin($mail, $pswd)
    {
        $response = array();
        $response['status'] = false;
        $stmt = $this->connection->prepare("SELECT id FROM user_account  where email = ? and password = ?;");
        $stmt->bind_param("ss", $mail, $pswd);
        if ($stmt->execute()) {
            $stmt->bind_result($id);
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $stmt->fetch();
                $response['status'] = true;
                $response['userid'] = $id;
            }
        }
        return $response;
    }

    function getRegister($name, $mail, $pswd, $amount)
    {
        $response = array();
        $response['status'] = false;
        $stmt = $this->connection->prepare("insert into user_account(name,email,password,amount) values(?,?,?,?);");
        $stmt->bind_param("sssi", $name, $mail, $pswd, $amount);
        if ($stmt->execute()) {
            $response['status'] = true;
            $response['userid'] = $this->connection->insert_id;
        }
        return $response;
    }



    function getStuds($bid)
    {
        $stmt = $this->connection->prepare("select id,roll_number from admin_student where branch_id=?");
        $d = array();
        $data = array();
        $d['status'] = false;
        $stmt->bind_param('i', $bid);
        if ($stmt->execute()) {
            $stmt->bind_result($id, $rno);
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $d['status'] = true;

                while ($stmt->fetch()) {
                    array_push($data, array('id' => $id, 'rno' => $rno));
                }
                $d['data'] = $data;
            }
        }
        return $d;
    }
    function storeAttendance($a)
    {
        //$s=0;
        $date = date("Y/m/d");
        //$ids=explode(",",$a);
        $stmt = $this->connection->prepare("insert into admin_attendance(attendance_ids,dated) values(?,?);");
        $response = array();
        $response['status'] = false;
        //$count=count($ids);
        //for($i=0;$i<$count;$i++){  
        //$stmt->bind_param('ss',$ids[$i],$date);
        //     if($stmt->execute()){
        //         $s++;
        //     }
        // }
        // if($s==$count){
        //     $response['status']=true;
        // }
        $stmt->bind_param('ss', $a, $date);
        if ($stmt->execute()) {
            $response['status'] = true;
        }
        return $response;
    }
}
