<?php
require_once 'engine/url.php';

$urls = [
    url('/', 'UserView', 'index'),
    url('/login', 'AuthView', 'login'),
    url('/login', 'AuthView', 'login', 'POST'),
    url('/employees/view', 'UserView', 'employee_view'),
    url('/employees/view/events/add', 'EventView', 'add', 'POST'),
    url('/employees/view/events/delete', 'EventView', 'delete', 'POST'),
    url('/employees/statements/set', 'UserView', 'set_statement', 'POST'),
    url('/admin/login', 'AuthView', 'login_admin'),
    url('/admin/login', 'AuthView', 'login_admin', 'POST'),
    url('/admin', 'AdminView', 'index'),
    url('/admin/employees', 'AdminView', 'single_view'),
    url('/logout', 'AuthView', 'logout')
];

?>