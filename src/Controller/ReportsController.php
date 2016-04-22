<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;

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

    public function search()
    {
      $query = $this->Reports
        // Use the plugins 'search' custom finder and pass in the
        // processed query params
        ->find('search', $this->Reports->filterParams($this->request->query))
        // You can add extra things to the query if you need to
        // ->contain(['Comments'])
        ->where(['id IS NOT' => null]);

    // $this->set('Reports', $this->paginate($query));
    //           $this->paginate = [
    //         //20 per ppage
    //         'limit' => 20,
    //         //order descing Id => Last on top
    //         'order' => ['Reports.id' => 'desc'],
    //         //Contain Users and Customers objects 
    //         'contain' => ['Users', 'Customers']
    //     ];

    //     $this->set('reports', $this->paginate($this->Reports));
    //     $this->set('_serialize', ['reports']);



    }
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

        $openTickets = $this->Reports->find()
                      ->where(['finished !=' => 1])
                      ->count();


        $this->set('open', $openTickets);
        $this->set('reports', $this->paginate($this->Reports));
        $this->set('_serialize', ['reports']);

        /* authenticate 
         * customers cant see reports
         */
        if ($this->Auth->user('role') == 'customer') {
        $this->Flash->error('you can not see that.');
        return $this->redirect(['controller' => 'Customers', 'action' => 'View', $this->Auth->user('customerId')]);
        }
    }

    public function collected()
    {
        $unCollected = $this->Reports->find()
                ->where(['finished =' => '1'])
                ->where(['collected =' => '0']);

        // $query = $this->Reports->find()
        //          ->select(['customer_id'])
        //          ->where(['finished =' => '1'])
        //         ->where(['collected =' => '0']);

        // $q = $this->Reports->Customers->find()
        //       ->where(['customer_id =' => 'q'])

        $this->set('unCollected', $unCollected);
        // $this->set('q', $q);
        $this->set('_serialize', ['reports']);

        /* authenticate 
         * customers cant see reports
         */
        if ($this->Auth->user('role') == 'customer') {
        $this->Flash->error('you can not see that.');
        return $this->redirect(['controller' => 'Customers', 'action' => 'View', $this->Auth->user('customerId')]);
        }
    }

        public function kpi()
    {
        $distinctEmplyee = $this->Reports->find()
                      ->distinct('user_id')
                      ->where(['finished' => 0])
                      ->count();
        $openTickets = $this->Reports->find()
                      ->where(['finished' => 0])
                      ->count();

        $closedTickets = $this->Reports->find()
                      ->select(['id', 'created', 'completed_date'])
                      ->where(['finished' => 1]);

        $this->set('open', $openTickets);
        $this->set('distinct', $distinctEmplyee);
        $this->set('closed', $closedTickets);
        $this->set('_serialize', ['reports']);

        /* authenticate 
         * customers cant see reports
         */
        if ($this->Auth->user('role') == 'customer') {
        $this->Flash->error('you can not see that.');
        return $this->redirect(['controller' => 'Customers', 'action' => 'View', $this->Auth->user('customerId')]);
        }
    }

    public function export() {

    $reports = $this->Reports->find('all');
    $_serialize = 'reports';
    $_header = ['ID', "user_id", "customer_id", "items_id", "equipment", "brand", "description", "accessories", "notes", "priority", "created", "modified", "finished", "conclusion", "completed_date", "paid_status", "amount_due", "sms_list", "email_list", "smsSendDate", "emailSendDate"];
    $_extract = ['id', "user_id", "customer_id", "items_id", "equipment", "brand", "description", "accessories", "notes", "priority", "created", "modified", "finished", "conclusion", "completed_date", "paid_status", "amount_due", "sms_list", "email_list", "smsSendDate", "emailSendDate"];

    $this->viewClass = 'CsvView.Csv';
    $this->set(compact('reports', '_serialize', '_header', '_extract'));
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
            
            if ($this->Auth->user('customerId') != $report->customer_id) {
            $this->Flash->error('you can not see that.');
            return $this->redirect(['controller' => 'Customers', 'action' => 'View', $this->Auth->user('customerId')]);
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


        $users = $this->Reports->Users
                    ->find()
                    ->select(['id', 'email', 'role'])
                    //dont get list of customers
                    ->where(['role !=' => 'customer']);

        $customers = $this->Reports->Customers->find()
                                              ->select(['id', 'fName', 'sName', 'mobile', 'email']);


        $items = $this->Reports->Items->find()
                                        ->select(['id', 'Name']);
       
        $this->set(compact('report', 'users', 'customers', 'items'));
        $this->set('_serialize', ['report']);

        /* authenticate 
         * customers cant see admin */
        if ($this->Auth->user('role') == 'customer') {
        $this->Flash->error('you can not see that.');
        return $this->redirect(['action' => 'View', $this->Auth->user('customerId')]);
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

    public function email()
    {
      $email = new Email('default');
$email->from(['me@example.com' => 'My Site'])
    ->to('you@example.com')
    ->subject('About')
    ->send('My message');
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
