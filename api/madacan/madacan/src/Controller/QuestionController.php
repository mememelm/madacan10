<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Question Controller
 *
 * @property \App\Model\Table\QuestionTable $Question
 * @method \App\Model\Entity\Question[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class QuestionController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Module'],
        ];
        $question = $this->paginate($this->Question);

        $this->set(compact('question'));
        $this->set('_serialize', ['question']);

    }

    /**
     * View method
     *
     * @param string|null $id Question id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $question = $this->Question->get($id, [
            'contain' => ['Module', 'Evaluation'],
        ]);

        $this->set(compact('question'));
        $this->set('_serialize', ['question']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $res = array();
        $question = $this->Question->newEmptyEntity();
        if ($this->request->is('post')) {
            $question = $this->Question->patchEntity($question, $this->request->getData());
            if ($this->Question->save($question)) {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 1;
                    $res['msg'] = 'The Question has been saved.';
                }else{
                    $this->Flash->success(__('The Question has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 0;
                    $res['msg'] = 'The Question could not be saved. Please, try again.';
                }else{
                    $this->Flash->error(__('The Question could not be saved. Please, try again.'));
                }
            }
        }
        $module = $this->Question->Module->find('list', ['limit' => 200]);
        $this->set(compact('question', 'module', 'res'));
        $this->set('_serialize', true);

    }

    /**
     * Edit method
     *
     * @param string|null $id Question id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $question = $this->Question->get($id, [
            'contain' => [],
        ]);
        $res = array();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $question = $this->Question->patchEntity($question, $this->request->getData());
            if ($this->Question->save($question)) {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 1;
                    $res['msg'] = 'The Question has been saved.';
                }else{
                    $this->Flash->success(__('The Question has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 0;
                    $res['msg'] = 'The Question could not be saved. Please, try again.';
                }else{
                    $this->Flash->error(__('The Question could not be saved. Please, try again.'));
                }
            }
        }
        $module = $this->Question->Module->find('list', ['limit' => 200]);
        $this->set(compact('question', 'module', 'res'));
        $this->set('_serialize', true);
    }

    /**
     * Delete method
     *
     * @param string|null $id Question id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $res = array();
        $this->request->allowMethod(['post', 'delete']);
        $question = $this->Question->get($id);
        if ($this->Question->delete($question)) {
            if (!isset($_SERVER['HTTP_REFERER'])) {
                $res['status'] = 1;
                $res['msg'] = 'The question has been deleted.';
            }else{
                $this->Flash->success(__('The question has been deleted.'));
                return $this->redirect(['action' => 'index']);
            }
        } else {
            if (!$_SERVER['HTTP_REFERER']) {
                $res['status'] = 0;
                $res['msg'] = 'The question could not be deleted. Please, try again.';
            } else {
                $this->Flash->error(__('The question could not be deleted. Please, try again.'));
            }
        }
        $this->set(compact('res'));
        $this->set('_serialize', ['res']);
    }
}
