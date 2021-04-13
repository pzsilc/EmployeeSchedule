<?php
require_once __dir__.'/../engine/form.php';
require_once __dir__.'/../models/Admin.php';

class AdminForm extends Form
{
    const MODEL = Admin::class;
    public function custom()
    {
        $this->attrs('name', ['class' => 'form-control', 'placeholder' => 'Nazwa']);
        $this->attrs('password', ['class' => 'form-control mt-1', 'placeholder' => 'Hasło']);
    }
}

?>