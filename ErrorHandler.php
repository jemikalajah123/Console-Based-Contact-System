<?php
class EmailErrException extends Exception
{};
class EmailValidErrException extends Exception
{};
class NameErrException extends Exception
{};
class NameValidErrException extends Exception
{};
class AddressErrException extends Exception
{};
class AddressValidErrException extends Exception
{};

class ErrorHandler
{

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
                throw new EmailErrException();

            } else {
                $email = $this->test_input($email);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new EmailValidErrException();
                }
            }

        } catch (EmailErrException $e) {
            echo "Email is required";
        } catch (EmailValidErrException $e) {
            echo "Invalid email format";
        }
    }

    public function contactName($name)
    {

        try {

            if (empty($name)) {
                throw new NameErrException();
            } else {
                $name = $this->test_input($name);
                if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                    throw new NameValidErrException();
                }
            }

        } catch (NameErrException $e) {
            echo "Name is required";
        } catch (NameValidErrException $e) {
            echo "Only letters and white space allowed";
        }

    }

    public function contactAddress($address)
    {

        try {

            if (empty($address)) {
                throw new AddressErrException();
            } else {
                $address = $this->test_input($address);if (!preg_match('/^(?:\\d+ [a-zA-Z ]+, ){2}[a-zA-Z ]+$/', $address)) {
                    throw new AddressValidErrException();
                }
            }

        } catch (AddressErrException $e) {
            echo "Address is required";
        } catch (AddressValidErrException $e) {
            echo "Please enter a valid house address";
        }

    }
}
