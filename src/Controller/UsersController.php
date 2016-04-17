<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        //show all admin/employees
        //dont show customer users
        $query = $this->Users->find();
        $query->where(['role !=' => 'customer']);

        $this->set('users', $this->paginate($query));
        $this->set('_serialize', ['users']);

        /* authenticate 
         * customers cant see admin */
        if ($this->Auth->user('role') == 'customer') {
        $this->Flash->error('you can not see that.');
        return $this->redirect(['controller' => 'Customers', 'action' => 'View', $this->Auth->user('customerId')]);
        }
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Reports']
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);

        /* authenticate 
         * customers cant see admin */
        if ($this->Auth->user('role') == 'customer') {
        $this->Flash->error('you can not see that.');
        return $this->redirect(['controller' => 'Customers', 'action' => 'View', $this->Auth->user('customerId')]);
        }
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);

        /* authenticate 
         * customers cant see admin */
        if ($this->Auth->user('role') == 'customer') {
        $this->Flash->error('you can not see that.');
        return $this->redirect(['controller' => 'Reports', 'action' => 'index']);
        }

        /* authenticate 
         * only admin can add */
        if ($this->Auth->user('role') == 'employee') {
        $this->Flash->error('you can not see that.');
        return $this->redirect(['action' => 'index']);
        }


    }
    /*Adding a customer to the user database
    * This allows customers to log in
    */
    public function addCustomer()
    {

        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['controller' => 'Reports', 'action' => 'add']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);

        /* authenticate 
         * customers cant see admin */
        if ($this->Auth->user('role') == 'customer') {
        $this->Flash->error('you can not see that.');
        return $this->redirect(['controller' => 'Customers', 'action' => 'View', $this->Auth->user('customerId')]);
        }


    }

    

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'View', $this->Auth->user('id')]);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);

        /* authenticate 
         * customers cant see admin */
        if ($this->Auth->user('role') == 'customer') {
        $this->Flash->error('you can not see that.');
        return $this->redirect(['controller' => 'Customers', 'action' => 'View', $this->Auth->user('customerId')]);
        }

        //employees can only edit their own
        //admin can edit all
        if ($this->Auth->user('role') == 'employee') {

            if ($this->Auth->user('customerId') != $user->id) {
                $this->Flash->error('you can not see that.');
                return $this->redirect(['action' => 'index']);
            }

        }

    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'View', $this->Auth->user('id')]);

        /* authenticate 
         * customers cant see admin */
        if ($this->Auth->user('role') != 'admin') {
        $this->Flash->error('you can do that.');
        return $this->redirect(['action' => 'index']);
        }
    }

    /**
    Adding controller for login
    **/
    public function login()
    {
    if ($this->request->is('post')) {
        $user = $this->Auth->identify();
        if ($user) {
        //get users status
        $logId = $this->Auth->user('id');
        $this->Auth->setUser($user);
        return $this->redirect($this->Auth->redirectUrl());
        }
        $this->Flash->error('Your username or password is incorrect.');
        }
    }

    /**
    Adding controller for logout
    **/
    public function logout()
    {
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
    }



}
