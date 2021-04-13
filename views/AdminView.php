<?php
require_once __dir__.'/../engine/view.php';
require_once __dir__.'/../views/ExternalDBHandle.php';
require_once __dir__.'/../models/Event.php';

class AdminView extends View
{
    private $admin = null;
    use ExternalDBHandle;

    public function __construct()
    {
        parent::__construct();
        if(!$this->request->session('admin'))
            return $this->redirect('/admin/login');
        $this->admin = $this->request->session('admin');
    }

    public function index()
    {
        $people = $this->external_query("SELECT * FROM people ORDER BY last_name");
        return $this->render('admin.index', [
            'admin' => $this->admin,
            'people' => $people
        ]);
    }

    public function single_view()
    {
        $id = $this->request->get('id');
        $employee = $this->external_query("
            SELECT 
            p1.id as id, 
            p1.first_name as fn, 
            p1.last_name as ln, 
            p1.statement as statement, 
            CONCAT(p2.first_name, ' ', p2.last_name) as manager, 
            sc.name as section 
            FROM people p1 
            LEFT JOIN people p2 ON p1.manager_id = p2.id 
            LEFT JOIN sections sc ON p1.section_id = sc.id 
            WHERE p1.id=$id
        ");
        if(!$employee) return $this->reidrect('/admin');
        $employee = $employee[0];
        $events = Event::filter([['employee_id', '=', $employee['id']]]);
        return $this->render('admin.single_view', [
            'admin' => $this->admin,
            'employee' => $employee,
            'events' => $events
        ]);
    }
}

?>