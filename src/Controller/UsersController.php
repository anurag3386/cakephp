<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class UsersController extends AppController
{
  public function beforeFilter(\Cake\Event\EventInterface $event)
  {
      parent::beforeFilter($event);
      // Configure the login action to not require authentication, preventing
      // the infinite redirect loop issue
      $this->Authentication->addUnauthenticatedActions(['login']);
  }
  
  public function view($id)
  {
      $user = $this->Users->get($id);
      $this->set(compact('user'));
  }

  
  public function register()
  {
    $user = $this->Users->newEmptyEntity();
    if ($this->request->is('post')) {
        $user = $this->Users->patchEntity($user, $this->request->getData());

        if ($this->Users->save($user)) {
            $this->Flash->success(__('Your registration was successful.'));

            return $this->redirect('/');
        }

        $this->Flash->error(__('Your registration failed.'));
    }
    $this->set('user', $user);
  }

  public function login()
  {
      $this->request->allowMethod(['get', 'post']);
      $result = $this->Authentication->getResult();
      // regardless of POST or GET, redirect if user is logged in
      if ($result->isValid()) {
          // redirect to /students after login success
          $redirect = $this->request->getQuery('redirect', [
              'controller' => 'Students',
              'action' => 'index',
          ]);
  
          return $this->redirect($redirect);
      }
      // display error if user submitted and authentication failed
      if ($this->request->is('post') && !$result->isValid()) {
          $this->Flash->error(__('Invalid email or password'));
      }
  }

  public function logout()
  {
      $result = $this->Authentication->getResult();
      // regardless of POST or GET, redirect if user is logged in
      if ($result->isValid()) {
          $this->Authentication->logout();
          return $this->redirect(['controller' => 'Users', 'action' => 'login']);
      }
  }
  
}
