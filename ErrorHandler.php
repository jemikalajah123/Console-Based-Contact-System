<?php
class EmailErrException extends Exception{};
class EmailValidErrException extends Exception{};
class NameErrException extends Exception{};
class NameValidErrException extends Exception{};
class AddressErrException extends Exception{};
class AddressValidErrException extends Exception{};

class ErrorHandler
{
    public $errorList = [];

    public function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function contactEmail($email)
    {

        try {

            if (empty($email)) {
                throw new EmailErrException("Email is required\n");
            } else {
                $email = $this->test_input($email);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                    throw new EmailValidErrException("Invalid email format\n");
                }
            }
        } catch (EmailErrException $e) {
            $this->errorList[] = "Email field is empty";
            echo $e->getMessage();
        } catch (EmailValidErrException $e) {
            $this->errorList[] = "Email is not valid";
            echo $e->getMessage();
        }

        return $email;
    }

    public function contactName($name)
    {
        try {

            if (empty($name)) {
                throw new NameErrException("Name is required\n");
            } else {
                $name = $this->test_input($name);
                if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                    throw new NameValidErrException("Only letters and white space allowed\n");
                }
            }
        } catch (NameErrException $e) {
            $this->errorList[] = "Name field is empty";
            echo $e->getMessage();
        } catch (NameValidErrException $e) {
            $this->errorList[] = "Name is not valid";
            echo $e->getMessage();
        }

        return $name;
    }

    public function contactAddress($address)
    {

        try {

            if (empty($address)) {

                throw new AddressErrException("Address is required\n");
            } else {
                $address = $this->test_input($address);
                if (!preg_match('/\d+ [0-9a-zA-Z ]+/', $address)) {

                    throw new AddressValidErrException("Please enter a valid house address\n");
                }
            }
        } catch (AddressErrException $e) {
            $this->errorList[] = "Adress field is empty";
            echo $e->getMessage();
        } catch (AddressValidErrException $e) {
            $this->errorList[] = "Address is not valid";
            echo $e->getMessage();
        }

        return $address;
    }
}
