<?php

require "Contact.php";
require "ErrorHandler.php";

class UserInterface
{

    public $newContact;
    public $contactList;
    public $error;

    public function startMenu($option)
    {
        switch ($option) {

            case 1:
                $this->addContact();
                break;
            case 2:
                $this->showAllContact();
                break;
            case 3:
                if(empty($this->contactList->contact_list)){
                    echo "No contact created yet for this action\n";
                }else{
                    $this->deleteContact();
                }
                break;
            case 4:
                if(empty($this->contactList->contact_list)){
                    echo "No contact created yet for this action\n";
                }else{
                    $this->findContact();

                }
                break;
            case 5:
                exit();
                break;
            default:
                echo "Wrong Input!\n";
        }
    }

    public function displayStartMenu()
    {
        echo "===========================================\n";
        echo "Hello, WELCOME TO MY CONTACT SYSTEM\n";
        echo "===========================================\n";
        echo "Press 1: To Save a Contact\n";
        echo "Press 2: To View Contact list\n";
        echo "Press 3: To Delete a Contact\n";
        echo "Press 4: To Search for a Contact\n";
        echo "Press 5: To Quit\n";
    }

    public function collectInput($var, $question)
    {
        while (true) {
            $input = readline($question . "\n");
            if ($var == 'name') {
                $name = $input;
                $this->error->contactName($name);
            } elseif ($var == 'email') {
                $email = $input;
                $this->error->contactEmail($email);
            } elseif($var == 'address') {
                $address = $input;
                $this->error->contactAddress($address);
            }
            return $input;
        }
    }

    public function showAllContact()
    {
        print_r($this->contactList->contact_list);
    }

    public function addContact()
    {
        $this->error->errorList = [];
        $name = $this->collectInput('name', 'What is Your lastname: ');
        $email = $this->collectInput('email', 'What is Your email: ');
        $address = $this->collectInput('address', 'What is Your address: ');

        if (empty($this->error->errorList)) {

            $this->newContact = new Contact($email, $name, $address);
            $this->contactList->saveContact($this->newContact);
            echo "New contact, $name created successfully\n";
        } else {
            print_r($this->error->errorList);
        }
    }

    public function deleteContact()
    {
        $email = $this->collectInput("email", 'Enter any Email here:  ');
        foreach ($this->contactList->contact_list as $value) {
            if ($value->email === $email) {
                $this->contactList->removeContact($email);
                echo "$email deleted successfully\n";
            } else {
                echo "$email does not exist\n";
            }
        }
    }

    public function findContact()
    {
        $name = $this->collectInput("name", 'Enter any registered lastname here:  ');
        foreach ($this->contactList->contact_list as $value) {
            if ($value->name === $name) {
                $this->contactList->searched_contact = [];
                $this->contactList->searchContact($name);
                print_r($this->contactList->searched_contact);
            } else {
                echo "$name does not exist\n";
            }
        }
    }

    
    public function runApp()
    {
        $this->contactList = new ContactList;
        $this->error = new ErrorHandler;

        while (true) {
            $this->displayStartMenu();
            $option =$this->collectInput('option', 'Enter any Option here:  ');
            $this->startMenu($option);
        }
    }
}

$start = new UserInterface;
$start->runApp();
