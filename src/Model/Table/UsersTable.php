<?php 
  namespace App\Model\Table;

  use Cake\ORM\Table;
  use Cake\Validation\Validator;
  
  class UsersTable extends Table
  {
      public function validationDefault(Validator $validator): Validator
      {
          return $validator
              ->notEmptyString('email', 'An email is required')
              ->email('email')
              ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table','message' => 'Seems email already registed. Please use different one.'])
              ->notEmptyString('password', 'A password is required')
              ->notEmptyString('role', 'A role is required')
              ->add('role', 'inList', [
                  'rule' => ['inList', ['admin', 'author']],
                  'message' => 'Please enter a valid role'
              ]);
      }
  
  }
?>