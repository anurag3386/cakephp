<?php
declare(strict_types=1);

namespace App\Model\Table;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;

class SubjectsTable extends Table
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

        $this->setTable('subjects');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Students', [
          'through' => 'StudentSubjects',
        ]);
    }

    public function getSubjectList(){
      $query = $this->find('list',['keyField' => 'id','valueField' => 'name']);
      if(!empty($query)){
        $data = $query->toArray();
        return $data;
      }
    }    
    
}