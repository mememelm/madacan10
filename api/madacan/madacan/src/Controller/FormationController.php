<?php
declare(strict_types = 1);

namespace App\Controller;
use Cake\Controller\Component\RequestHandler;
/**
 * Formation Controller
 *
 * @property \App\Model\Table\FormationTable $Formation
 * @method \App\Model\Entity\Formation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FormationController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $formation = $this->paginate($this->Formation);

        $this->set(compact('formation'));
        $this->set('_serialize', ['formation']);
    }

    /**
     * View method
     *
     * @param string|null $id Formation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $formation = $this->Formation->get($id, [
            'contain' => ['User', 'Module'],
        ]);

        $this->set(compact('formation'));
        $this->set('_serialize', ['formation']);

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $res = array();
        $formation = $this->Formation->newEmptyEntity();
        if ($this->request->is('post')) {
            $formation = $this->Formation->patchEntity($formation, $this->request->getData());
            if ($this->Formation->save($formation)) {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 1;
                    $res['msg'] = 'The Formation has been saved.';
                }else{
                    $this->Flash->success(__('The Formation has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 0;
                    $res['msg'] = 'The Formation could not be saved. Please, try again.';
                }else{
                    $this->Flash->error(__('The Formation could not be saved. Please, try again.'));
                }
            }
        }
        $user = $this->Formation->User->find('list', ['limit' => 200]);
        $this->set(compact('formation','user','res'));
        $this->set('_serialize', true);
    }

    /**
     * Edit method
     *
     * @param string|null $id Formation id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $formation = $this->Formation->get($id, [
            'contain' => ['User'],
        ]);
        $res = array();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $formation = $this->Formation->patchEntity($formation, $this->request->getData());
            if ($this->Formation->save($formation)) {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 1;
                    $res['msg'] = 'The Formation has been saved.';
                }else{
                    $this->Flash->success(__('The Formation has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 0;
                    $res['msg'] = 'The Formation could not be saved. Please, try again.';
                }else{
                    $this->Flash->error(__('The Formation could not be saved. Please, try again.'));
                }
            }
        }
        $user = $this->Formation->User->find('list', ['limit' => 200]);
        $this->set(compact('formation','user','res'));
        $this->set('_serialize', true);
    }

    /**
     * Delete method
     *
     * @param string|null $id Formation id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $res = array();
        $this->request->allowMethod(['post', 'delete']);
        $formation = $this->Formation->get($id);
        if ($this->Formation->delete($formation)) {
            if (!isset($_SERVER['HTTP_REFERER'])) {
                $res['status'] = 1;
                $res['msg'] = 'The Formation has been deleted.';
            }else{
                $this->Flash->success(__('The Formation has been deleted.'));
                return $this->redirect(['action' => 'index']);
            }
        } else {
            if (!$_SERVER['HTTP_REFERER']) {
                $res['status'] = 0;
                $res['msg'] = 'The Formation could not be deleted. Please, try again.';
            }else{
                $this->Flash->error(__('The Formation could not be deleted. Please, try again.'));
            }
        }

        $this->set(compact('res'));
        $this->set('_serialize', ['res']);
    }
}
