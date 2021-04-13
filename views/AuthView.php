<?php
require_once __dir__.'/../engine/view.php';
require_once __dir__.'/../forms/AdminForm.php';
require_once __dir__.'/../models/Admin.php';

class AuthView extends View
{


    public function login()
    {
        if($this->request->session('auth') || $this->request->session('admin'))
            return $this->redirect('/');
        
        if($this->request->method === 'POST')
        {
            $token = $this->request->post('token');
            global $database;
            $conn = new mysqli($database['host'], $database['user'], $database['password'], 'ppp');
            $user = $conn->query("
                SELECT p1.id as id, p1.first_name as first_name, p1.last_name as last_name, p1.email as email, sc.name as section, CONCAT(p2.first_name, ' ', p2.last_name) as manager, p1.statement as statement
                FROM people p1 
                LEFT JOIN people p2 ON p1.manager_id = p2.id 
                LEFT JOIN sections sc ON p1.section_id = sc.id
                WHERE p1.token='$token'
            ");
            if($user->num_rows === 1){
                $user = $user->fetch_assoc();
                $this->request->set_session('auth', [
                    'id' => $user['id'],
                    'fname' => $user['first_name'],
                    'lname' => $user['last_name'],
                    'email' => $user['email'],
                    'section' => $user['section'],
                    'manager' => $user['manager'],
                    'statement' => $user['statement']
                ]);
                return $this->redirect('/');
            }
            $this->add_message('error', 'Dane są nieprawidłowe');
        }
        return $this->render('auth.login');
    }



    public function login_admin()
    {
        if($this->request->session('admin') || $this->request->session('auth'))
            return $this->redirect('/');

        if($this->request->method === 'POST'){
            $data = $this->request->post;
            $admin = Admin::filter([
                ['name', '=', $data['name']],
                ['password', '=', $data['password']]
            ]);
            if($admin){
                $this->request->set_session('admin', [
                    'id' => $admin[0]->id,
                    'name' => $admin[0]->name
                ]);
                return $this->redirect('/admin');
            }
            $this->add_message('error', 'Dane są nieprawidłowe');
        }

        $form = new AdminForm();
        return $this->render('auth.login_admin', ['form' => $form]);
    }



    public function logout()
    {
        $this->request->unset_session('auth');
        $this->request->unset_session('admin');
        return $this->redirect('/');
    }
}

?>