<?php
namespace NNGames\Entities;
class User {
    public $id;
    public $firstname;
    public $surname;
    public $email;
    public $password;
    public $role;
    public $active;

    public function getFullName($order) {
        if ($order == 'firstname')
            return $this->firstname . ' ' . $this->surname;
        elseif ($order == 'surname')
            return $this->surname . ', ' . $this->firstname;
    }
}
?>