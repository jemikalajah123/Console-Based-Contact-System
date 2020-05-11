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
                $this->deleteContact();
                break;
            case 4:
                $this->findContact();
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

    public function runApp()
    {

        $this->contactList = new ContactList;
        $this->error = new ErrorHandler;

        while (true) {
            $this->displayStartMenu();
            $option = readline("Enter any Option here: ");
            $this->startMenu($option);
        }
    }

    public function showAllContact()
    {

        print_r($this->contactList->contact_list);
    }

    public function addContact()
    {
            $email = readline("Enter any Email here: ");
            $this->error->contactEmail($email);
            
            $name = readline("Enter Full Name here: ");
            $this->error->contactName($name);

            $address = readline("Enter any Address details here: ");
            $this->error->contactAddress($address);

        $this->newContact = new Contact($email, $name, $address);
        $this->contactList->saveContact($this->newContact);
        echo "New contact, $name created successfully\n";

    }

    public function deleteContact()
    {

        $email = readline("Enter any Email here: ");
        $this->contactList->removeContact($email);
        echo "$email deleted successfully\n";
    }

    public function findContact()
    {

        $name = readline("Enter any name here: ");
        $this->contactList->searched_contact = [];
        $this->contactList->searchContact($name);
        print_r($this->contactList->searched_contact);

    }

}

$start = new UserInterface;
$start->runApp();
