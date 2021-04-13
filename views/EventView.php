<?php
require_once __dir__.'/../engine/view.php';
require_once __dir__.'/../views/ExternalDBHandle.php';
require_once __dir__.'/../models/Event.php';

class EventView extends View
{
    
    private $user;
    private $employee_id;
    private $employees;
    use ExternalDBHandle;


    public function __construct()
    {
        parent::__construct();
        if(!$this->request->session('auth') || $this->request->method !== 'POST'){
            return $this->render('/');
        }
        $this->user = $this->request->session('auth');
        $this->employees = $this->external_query("SELECT * FROM people WHERE manager_id=".$this->user['id']);
        $this->employee_id = $this->request->get('employee_id');
        if(!in_array($this->employee_id, array_map(function($e){ 
            return $e['id'];
        }, $this->employees)));
    }


    public function add()
    {
        $data = $this->request->post;
        $event = new Event();
        $event->subject = $data['subject'];
        $event->leader_id = $data['leader_id'];
        $event->datetime = $data['datetime'];
        $event->employee_id = $this->employee_id;
        $event->save();
        $this->add_message('success', 'Dodano wydarzenie');
        return $this->redirect("/employees/view?id=$this->employee_id");
    }


    public function delete()
    {
        $event_id = $this->request->get('event_id');
        $event = Event::get_object_or_404($event_id);
        if($event->employee_id !== $this->employee_id)
            return $this->redirect('/');
        $event->delete();
        $this->add_message('success', 'Usunięto wydarzenie');
        return $this->redirect("/employees/view?id=$this->employee_id");
    }
}

?>