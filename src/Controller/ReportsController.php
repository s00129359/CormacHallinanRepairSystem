<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Reports Controller
 *
 * @property \App\Model\Table\ReportsTable $Reports
 */
class ReportsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            //20 per ppage
            'limit' => 20,
            //order descing Id => Last on top
            'order' => ['Reports.id' => 'desc'],
            //Contain Users and Customers objects 
            'contain' => ['Users', 'Customers']
        ];
        $this->set('reports', $this->paginate($this->Reports));
        $this->set('_serialize', ['reports']);

        /* authenticate 
         * customers cant see reports
         */
        if ($this->Auth->user('role') == 'customer') {
        $this->Flash->error('you can not see that.');
        return $this->redirect(['controller' => 'Customers', 'action' => 'View', $this->Auth->user('id')]);
        }
    }

    /**
     * View method
     *
     * @param string|null $id Report id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $report = $this->Reports->get($id, [
            'contain' => ['Users', 'Customers']
        ]);

        $this->set('report', $report);
        $this->set('_serialize', ['report']);

        /* authenticate 
         * customers can only see ther reports */
        if ($this->Auth->user('role') == 'customer') {
            
            if ($this->Auth->user('id') != $report->customer_id) {
            $this->Flash->error('you can not see that.');
            return $this->redirect(['controller' => 'Customers', 'action' => 'View', $this->Auth->user('id')]);
            }
        }
    }

    //My Controller for sending SMS
    public function sms($id = null)
    {
        $report = $this->Reports->get($id, [
            'contain' => ['Users', 'Customers']
        ]);

        $this->set('report', $report);
        $this->set('_serialize', ['report']);

        /* authenticate 
         * customers cant see admin */
        if ($this->Auth->user('role') == 'customer') {
        $this->Flash->error('you can not see that.');
        return $this->redirect(['controller' => 'Customers', 'action' => 'View', $this->Auth->user('id')]);
        }
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $report = $this->Reports->newEntity();
        if ($this->request->is('post')) {
            $report = $this->Reports->patchEntity($report, $this->request->data);
            if ($this->Reports->save($report)) {
                $this->Flash->success(__('The report has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The report could not be saved. Please, try again.'));
            }
        }

        $users = $this->Reports->Users->find()->select(['id', 'email']);
        $customers = $this->Reports->Customers->find()
                                              ->select(['id', 'fName', 'sName', 'mobile', 'email']);
       
        $this->set(compact('report', 'users', 'customers'));
        $this->set('_serialize', ['report']);

        /* authenticate 
         * customers cant see admin */
        if ($this->Auth->user('role') == 'customer') {
        $this->Flash->error('you can not see that.');
        return $this->redirect(['action' => 'View', $this->Auth->user('id')]);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Report id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $report = $this->Reports->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $report = $this->Reports->patchEntity($report, $this->request->data);
            if ($this->Reports->save($report)) {
                $this->Flash->success(__('The report has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The report could not be saved. Please, try again.'));
            }
        }
        $users = $this->Reports->Users->find('list', ['limit' => 200]);
        $customers = $this->Reports->Customers->find('list', ['limit' => 200]);
        $this->set(compact('report', 'users', 'customers'));
        $this->set('_serialize', ['report']);

        /* authenticate 
         * customers cant see admin */
        if ($this->Auth->user('role') == 'customer') {
        $this->Flash->error('you can not see that.');
        return $this->redirect(['action' => 'View', $this->Auth->user('id')]);
        }
    }




    /**
     * Delete method
     *
     * @param string|null $id Report id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $report = $this->Reports->get($id);
        if ($this->Reports->delete($report)) {
            $this->Flash->success(__('The report has been deleted.'));
        } else {
            $this->Flash->error(__('The report could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);

        /* authenticate 
         * only admin can delete
         */
        if ($this->Auth->user('role') == 'customer') {
        $this->Flash->error('you can not see that.');
        return $this->redirect(['action' => 'View', $this->Auth->user('id')]);
        }

        if ($this->Auth->user('role') == 'employee') {
        $this->Flash->error('you can not see that.');
        return $this->redirect(['action' => 'index']);
        }
    }
}
