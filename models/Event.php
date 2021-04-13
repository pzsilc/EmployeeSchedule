<?php
require_once __dir__.'/../engine/model.php';
require_once __dir__.'/../engine/fields.php';

class Event extends Model
{
    const TABLE = 'events';
    public function __construct()
    {
        $this->subject = CharField::init('subject', ['max' => 256]);
        $this->datetime = DateTimeField::init('datetime');
        $this->leader_id = IntegerField::init('leader_id');
        $this->employee_id = IntegerField::init('employee_id');
    }

    public function get_date(){
        return explode(' ', $this->datetime)[0];
    }

    public function get_time(){
        return explode(' ', $this->datetime)[1];
    }

    public function get_leader(){
        global $database;
        $conn = new mysqli($database['host'], $database['user'], $database['password'], 'ppp');
        $res = $conn->query("SELECT first_name, last_name FROM people WHERE id=$this->leader_id");
        if($res->num_rows === 0) throw new Exception('Coś poszło nie tak.');
        $res = $res->fetch_assoc();
        return $res['first_name'].' '.$res['last_name'];
    }
}

?>