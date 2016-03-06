<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 */
class CustomersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('customers', $this->paginate($this->Customers));
        $this->set('_serialize', ['customers']);

        /* authenticate 
         * customers cant see other customers */
        if ($this->Auth->user('role') == 'customer') {
        $this->Flash->error('you can not see that.');
        return $this->redirect(['action' => 'View', $this->Auth->user('id')]);
        }
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => ['Reports']
        ]);
        $this->set('customer', $customer);
        $this->set('_serialize', ['customer']);


        /* authenticate 
         * if looged as customer
         * it must be your profile */
        if ($this->Auth->user('role') == 'customer') {

            if ($this->Auth->user('id') != $customer->id) {
            $this->Flash->error('you can not see that.');
            return $this->redirect(['action' => 'View', $this->Auth->user('id')]);
            }

        }
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customer = $this->Customers->newEntity();
        if ($this->request->is('post')) {
            $customer = $this->Customers->patchEntity($customer, $this->request->data);
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The customer could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('customer'));
        $this->set('_serialize', ['customer']);

        /* authenticate 
         * customers cant add Customers */
        if ($this->Auth->user('role') == 'customer') {
        $this->Flash->error('you can not see that.');
        return $this->redirect(['action' => 'View', $this->Auth->user('id')]);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customers->patchEntity($customer, $this->request->data);
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The customer could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('customer'));
        $this->set('_serialize', ['customer']);

        /* authenticate 
         * if logged as a customer
         * only you can edit your own profile */
        if ($this->Auth->user('role') == 'customer') {

            if ($this->Auth->user('id') != $customer->id) {
            $this->Flash->error('you can not see that.');
            return $this->redirect(['action' => 'View', $this->Auth->user('id')]);
            }
            
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customer = $this->Customers->get($id);
        if ($this->Customers->delete($customer)) {
            $this->Flash->success(__('The customer has been deleted.'));
        } else {
            $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);

        /*authenticate
         * only admin can delete
         */
        if ($this->Auth->user('role') == 'customer') {
            $this->Flash->error('you can not do that.');
            return $this->redirect(['action' => 'View', $this->Auth->user('id')]);
            }

        if ($this->Auth->user('role') != 'employee') {
            $this->Flash->error('you can not do that.');
            return $this->redirect(['action' => 'index']);            
        }
    }
}
