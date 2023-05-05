<?php
declare(strict_types=1);

namespace App\Model\Table;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;

class StudentSubjectsTable extends Table
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

        $this->setTable('student_subjects');
        $this->setPrimaryKey('id');

        $this->belongsTo('Students');
        $this->belongsTo('Subjects');
    }

    
}