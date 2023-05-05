<?php 
  declare(strict_types=1);
  namespace App\Controller;
    /**
   * Students Controller
   *
   *
   */
  class StudentsController extends AppController
  {
     
      /**
       * Index method
       *
       * @return \Cake\Http\Response|null
       */
      public function index()
      {

          $searchQuery = $this->Students->find('all',['contain'=>['Subjects' => ['fields' => ['name']]]]);

          if ($this->request->is(['get','put'])) {
            $search_keyword = $this->request->getQuery('search_keyword');
            $conditionsArr  = [];
             
            if(!empty($search_keyword)){
              $conditionsArr['OR']['Students.firstName LIKE'] =  $search_keyword.'%';
              $conditionsArr['OR']['Students.lastName LIKE'] =  $search_keyword.'%';
              $conditionsArr['OR']['Students.email LIKE'] =  $search_keyword;
            }
            //final search query
            $searchQuery = $searchQuery->where([
              $conditionsArr
            ]);
          }
          $students = $this->paginate($searchQuery);
  
          $this->set(compact('students'));
  //pr($students);
         //echo json_encode($students);
  
          // exit();
      }
      /**
       * Add method
       *
      */
      public function add()
      {
          $student = $this->Students->newEmptyEntity();
          if ($this->request->is('post')) {
             
             
              $student = $this->Students->patchEntity($student, $this->request->getData(),['associated' => ['Subjects']]);
              if ($result	= $this->Students->save($student)) {

                $student_id        =  $result->id;

                $selected_subjects =  $this->request->getData()['subjects'] ?? [];
                $this->Students->saveSubjects($selected_subjects,$student_id);

                $this->Flash->success(__('The student has been saved.'));
                return $this->redirect(['action' => 'index']);
              }
              $this->Flash->error(__('The student could not be saved. Please, try again.'));
          }
          

          $this->loadModel('Subjects');
          $subjectsOptions  = $this->Subjects->find('list',['keyField' => 'id','valueField' => 'name','order' => 'name asc']);
          $this->set(compact('student','subjectsOptions'));
      }
  
      /**
       * Edit method
       *
       * @param string|null $id Student id.
      */
      public function edit($id = null)
      {
          $student = $this->Students->get($id, [
              'contain' => ['Subjects'],
          ]);

          if ($this->request->is(['patch', 'post', 'put'])) {
              $student = $this->Students->patchEntity($student, $this->request->getData());
              if ($this->Students->save($student)) {
                  $student_id   =  $id;

                  $this->Students->StudentSubjects->deleteAll(['student_id' => $student_id]);

                  $selected_subjects =  $this->request->getData()['subjects'] ?? [];
                  $this->Students->saveSubjects($selected_subjects,$student_id);

                  $this->Flash->success(__('The student has been saved.'));
  
                  return $this->redirect(['action' => 'index']);
              }
              $this->Flash->error(__('The student could not be saved. Please, try again.'));
          }

          $this->loadModel('Subjects');

          $selected_subjects =  []; 
          foreach($student->subjects as $subject){
              $selected_subjects[]  = $subject->id;
          }
          
          $subjectsOptions  = $this->Subjects->find('list',['keyField' => 'id','valueField' => 'name','order' => 'name asc']);
          $this->set(compact('student','subjectsOptions','selected_subjects'));
      }
  
      /**
       * Delete method
       *
       * @param string|null $id Student id.
       */
      public function delete($id = null)
      {
          $this->request->allowMethod(['post', 'delete']);
          $student = $this->Students->get($id);
          if ($this->Students->delete($student)) {
              $this->Flash->success(__('The student has been deleted.'));
          } else {
              $this->Flash->error(__('The student could not be deleted. Please, try again.'));
          }
  
          return $this->redirect(['action' => 'index']);
      }
  }
?>