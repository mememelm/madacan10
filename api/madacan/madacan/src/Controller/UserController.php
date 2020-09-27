<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * User Controller
 *
 * @property \App\Model\Table\UserTable $User
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $user = $this->paginate($this->User);

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->User->get($id, [
            'contain' => ['Formation', 'Evaluation'],
        ]);

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $res = array();
        $user = $this->User->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->User->patchEntity($user, $this->request->getData());
            if ($this->User->save($user)) {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 1;
                    $res['msg'] = 'The User has been saved.';
                }else{
                    $this->Flash->success(__('The User has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 0;
                    $res['msg'] = 'The User could not be saved. Please, try again.';
                }else{
                    $this->Flash->error(__('The User could not be saved. Please, try again.'));
                }
            }
        }
        $formation = $this->User->Formation->find('list', ['limit' => 200]);
        $this->set(compact('user', 'formation', 'res'));
        $this->set('_serialize', true);

    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->User->get($id, [
            'contain' => ['Formation'],
        ]);
        $res = array();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->User->patchEntity($user, $this->request->getData());
            if ($this->User->save($user)) {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 1;
                    $res['msg'] = 'The User has been saved.';
                }else{
                    $this->Flash->success(__('The Userhas been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 0;
                    $res['msg'] = 'The User could not be saved. Please, try again.';
                }else{
                    $this->Flash->error(__('The User could not be saved. Please, try again.'));
                }
            }
        }
        $formation = $this->User->Formation->find('list', ['limit' => 200]);
        $this->set(compact('user', 'formation', 'res'));
        $this->set('_serialize', true);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $res = array();
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->User->get($id);
        if ($this->User->delete($user)) {
            if (!isset($_SERVER['HTTP_REFERER'])) {
                $res['status'] = 1;
                $res['msg'] = 'The User has been deleted.';
            }else{
                $this->Flash->success(__('The User has been deleted.'));
                return $this->redirect(['action' => 'index']);
            }
        } else {
            if (!$_SERVER['HTTP_REFERER']) {
                $res['status'] = 0;
                $res['msg'] = 'The User could not be deleted. Please, try again.';
            } else {
                $this->Flash->error(__('The User could not be deleted. Please, try again.'));
            }
        }
        $this->set(compact('res'));
        $this->set('_serialize', ['res']);
    }
}
