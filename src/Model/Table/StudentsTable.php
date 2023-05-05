<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class StudentsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('students');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Subjects', [
          'through' => 'StudentSubjects',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
      return $validator
      ->notEmptyString('firstName', 'An Firstname is required')
      ->notEmptyString('lastName', 'An Lastname is required')
      ->notEmptyString('phone', 'Phone Number is required')
      ->email('email')
      ->notEmptyString('email', 'An email is required')
      ->notEmptyDate('dob', 'DOB is required')
      ;
      return $validator;
    }

    public function saveSubjects($selected_subjects=[],$student_id) {
      if($selected_subjects){
        $query = $this->StudentSubjects->query();
        foreach ($selected_subjects as $subject_id) {
            $query
                ->insert(['student_id', 'subject_id'])
                ->values([
                    'student_id' => $student_id,
                    'subject_id' => $subject_id,
                ]);
        }
        $query->execute();
      }
    }
}