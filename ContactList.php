<?php

class ContactList{

    public $contact_list = [];
    public $searched_contact = [];

    public function saveContact(Contact $contact){

        $this->contact_list[] = $contact;
  
    }
    
    public function listContact(){

        return $this->contact_list;
    }

    public function removeContact($email){

        foreach($this->contact_list as $key => $value) {
            if ($value->email === $email) {
              unset($this->contact_list[$key]);
            }
        }
        
    }

    public function searchContact($name){
        foreach($this->contact_list as $items) {
            if ($items->name === $name){
                $this->searched_contact[] = $items;
            }
            return false;
    
        }
  
    }

    public function getSearchContact(){
        return $this->searched_contact;

    }

    }    

?>