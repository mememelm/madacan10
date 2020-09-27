<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * UserFormation Controller
 *
 * @property \App\Model\Table\UserFormationTable $UserFormation
 * @method \App\Model\Entity\UserFormation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserFormationController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['User', 'Formation'],
        ];
        $userFormation = $this->paginate($this->UserFormation);

        $this->set(compact('userFormation'));
        $this->set('_serialize', ['userFormation']);
    }

    /**
     * View method
     *
     * @param string|null $id User Formation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userFormation = $this->UserFormation->get($id, [
            'contain' => ['User', 'Formation'],
        ]);

        $this->set(compact('userFormation'));
        $this->set('_serialize', ['userFormation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $res = array();
        $userFormation = $this->UserFormation->newEmptyEntity();
        if ($this->request->is('post')) {
            $userFormation = $this->UserFormation->patchEntity($userFormation, $this->request->getData());
            if ($this->UserFormation->save($userFormation)) {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 1;
                    $res['msg'] = 'The User Formation has been saved.';
                }else{
                    $this->Flash->success(__('The User Formation has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 0;
                    $res['msg'] = 'The User Formation could not be saved. Please, try again.';
                }else{
                    $this->Flash->error(__('The User Formation could not be saved. Please, try again.'));
                }
            }
        }
        $user = $this->UserFormation->User->find('list', ['limit' => 200]);
        $formation = $this->UserFormation->Formation->find('list', ['limit' => 200]);
        $this->set(compact('userFormation', 'user', 'formation', 'res'));
        $this->set('_serialize', true);

    }

    /**
     * Edit method
     *
     * @param string|null $id User Formation id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userFormation = $this->UserFormation->get($id, [
            'contain' => [],
        ]);
        $res = array();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userFormation = $this->UserFormation->patchEntity($userFormation, $this->request->getData());
            if ($this->UserFormation->save($userFormation)) {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 1;
                    $res['msg'] = 'The User Formation has been saved.';
                }else{
                    $this->Flash->success(__('The User Formation has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 0;
                    $res['msg'] = 'The User Formation could not be saved. Please, try again.';
                }else{
                    $this->Flash->error(__('The User Formation could not be saved. Please, try again.'));
                }
            }
        }
        $user = $this->UserFormation->User->find('list', ['limit' => 200]);
        $formation = $this->UserFormation->Formation->find('list', ['limit' => 200]);
        $this->set(compact('userFormation', 'user', 'formation', 'res'));
        $this->set('_serialize', true);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Formation id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $res = array();
        $this->request->allowMethod(['post', 'delete']);
        $userFormation = $this->UserFormation->get($id);
        if ($this->UserFormation->delete($userFormation)) {
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
