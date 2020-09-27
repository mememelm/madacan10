<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Controller\Component\RequestHandler;

/**
 * Evaluation Controller
 *
 * @property \App\Model\Table\EvaluationTable $Evaluation
 * @method \App\Model\Entity\Evaluation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EvaluationController extends AppController
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
        $this->paginate = [
            'contain' => ['User', 'Question'],
        ];
        $evaluation = $this->paginate($this->Evaluation);

        $this->set(compact('evaluation'));
        $this->set('_serialize', ['evaluation']);
    }

    /**
     * View method
     *
     * @param string|null $id Evaluation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $evaluation = $this->Evaluation->get($id, [
            'contain' => ['User', 'Question'],
        ]);

        $this->set(compact('evaluation'));
        $this->set('_serialize', ['evaluation']);

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $res = array();
        $evaluation = $this->Evaluation->newEmptyEntity();

        //$data = $this->request->input('json_decode');
        if ($this->request->is('post')) {
            $evaluation = $this->Evaluation->patchEntity($evaluation, $this->request->getData());

            if ($this->Evaluation->save($evaluation)) {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 1;
                    $res['msg'] = 'The Evaluation has been saved.';
                }else{
                    $this->Flash->success(__('The Evaluation has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 0;
                    $res['msg'] = 'The Evaluation could not be saved. Please, try again.';
                }else{
                    $this->Flash->error(__('The Evaluation could not be saved. Please, try again.'));
                }
            }
        }
        $user = $this->Evaluation->User->find('list', ['limit' => 200]);
        $question = $this->Evaluation->Question->find('list', ['limit' => 200]);
        $this->set(compact('evaluation', 'user', 'question', 'res'));
        $this->set('_serialize', true);
    }

    /**
     * Edit method
     *
     * @param string|null $id Evaluation id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $evaluation = $this->Evaluation->get($id, [
            'contain' => [],
        ]);
        $res = array();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $evaluation = $this->Evaluation->patchEntity($evaluation, $this->request->getData());
            if ($this->Evaluation->save($evaluation)) {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 1;
                    $res['msg'] = 'The Evaluation has been saved.';
                }else{
                    $this->Flash->success(__('The Evaluation has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 0;
                    $res['msg'] = 'The Evaluation could not be saved. Please, try again.';
                }else{
                    $this->Flash->error(__('The Evaluation could not be saved. Please, try again.'));
                }
            }
        }
        $user = $this->Evaluation->User->find('list', ['limit' => 200]);
        $question = $this->Evaluation->Question->find('list', ['limit' => 200]);
        $this->set(compact('evaluation', 'user', 'question', 'res'));
        $this->set('_serialize', true);
    }

    /**
     * Delete method
     *
     * @param string|null $id Evaluation id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $evaluation = $this->Evaluation->get($id);
        if ($this->Evaluation->delete($evaluation)) {
            if (!isset($_SERVER['HTTP_REFERER'])) {
                $res['status'] = 1;
                $res['msg'] = 'The Evaluation has been deleted.';
            }else{
                $this->Flash->success(__('The Evaluation has been deleted.'));
                return $this->redirect(['action' => 'index']);
            }
        } else {
            if (!$_SERVER['HTTP_REFERER']) {
                $res['status'] = 0;
                $res['msg'] = 'The Evaluation could not be deleted. Please, try again.';
            } else {
                $this->Flash->error(__('The Evaluation could not be deleted. Please, try again.'));
            }
        }
        $this->set(compact('res'));
        $this->set('_serialize', ['res']);
    }
}
