<?php

require_once __dir__.'/../engine/model.php';
require_once __dir__.'/../engine/fields.php';

class Admin extends Model
{
    const TABLE = 'admins';
    public function __construct()
    {
        $this->name = CharField::init('name', ['unique' => true, 'max' => 64]);
        $this->password = PasswordField::init('password', ['max' => 256]);
    }
}

?>