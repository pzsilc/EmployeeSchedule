<?php
require_once __dir__.'/../engine/view.php';
require_once __dir__.'/../models/Event.php';
require_once __dir__.'/../views/ExternalDBHandle.php';


class UserView extends View
{

    private $user = null;
    private $events = [];
    private $employees = [];
    use ExternalDBHandle;


    public function __construct()
    {
        parent::__construct();
        if($this->request->session('admin'))
            return $this->redirect('/admin');
        if(!$this->request->session('auth'))
            return $this->redirect('/login');

        $this->user = $this->request->session('auth');
        $this->events = Event::filter([['employee_id', '=', $this->user['id']]]);
        $this->employees = $this->external_query("SELECT * FROM people WHERE manager_id=".$this->user['id']);
    }


    public function index()
    {
        return $this->render('user.index', [
            'user' => $this->user,
            'events' => $this->events,
            'employees' => $this->employees
        ]);
    }


    public function employee_view()
    {
        $employee_id = $this->request->get('id');
        $arr = array_map(function($x){ return $x['id']; }, $this->employees);
        if(!$employee_id || !in_array($employee_id, $arr)){
            return $this->redirect('/');
        }
        $employee = $this->external_query("SELECT people.id, people.first_name, people.last_name, people.statement, sections.name as section
            FROM people INNER JOIN sections ON people.section_id=sections.id WHERE people.id=$employee_id");
        if(!$employee) return $this->redirect('/');
        $employee = $employee[0];

        $all_employees = $this->external_query("SELECT * FROM people");
        $events = Event::filter([['employee_id', '=', $employee_id]]);
        return $this->render('user.employee_view', [
            'employee' => $employee,
            'user' => $this->user,
            'events' => $events,
            'all_employees' => $all_employees
        ]);
    }


    public function set_statement()
    {
        $employee_id = $this->request->get('id');
        $statement = $this->request->post('statement');
        if(!$employee_id || !in_array($employee_id, array_map(function($x){ return $x['id']; }, $this->employees)))
            return $this->redirect('/');
        $sql = "UPDATE people SET statement='$statement' WHERE id=$employee_id";
        $this->external_query($sql);
        $this->add_message('success', 'Zapisano');
        return $this->redirect("/employees/view?id=$employee_id");
    }
}

?>