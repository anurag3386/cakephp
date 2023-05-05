<?php 
  // src/Model/Entity/User.php
  namespace App\Model\Entity;

  use Cake\Auth\DefaultPasswordHasher;
  use Cake\ORM\Entity;

  class User extends Entity
  {
      // Make all fields mass assignable except for primary key field "id".
      protected $_accessible = [
          '*' => true,
          'id' => false
      ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
      protected $_hidden = [
        'password'
      ];

      protected function _setPassword($password)
      {
          if (strlen($password) > 0) {
              return (new DefaultPasswordHasher)->hash($password);
          }
      }

      // ...
  }
?>