<?php

require "ContactList.php";

class Contact
{
    public $email;
    public $name;
    public $address;
    public function __construct($email, $name, $address)
    {

        $this->email = $email;
        $this->name = $name;
        $this->address = $address;
    }

}
