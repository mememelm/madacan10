<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Support Controller
 *
 * @property \App\Model\Table\SupportTable $Support
 * @method \App\Model\Entity\Support[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SupportController extends AppController
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
        $support = $this->paginate($this->Support);

        $this->set(compact('support'));
        $this->set('_serialize', ['support']);

    }

    /**
     * View method
     *
     * @param string|null $id Support id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $support = $this->Support->get($id, [
            'contain' => ['Module'],
        ]);

        $this->set(compact('support'));
        $this->set('_serialize', ['support']);

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $res = array();
        $support = $this->Support->newEmptyEntity();
        if ($this->request->is('post')) {
            $support = $this->Support->patchEntity($support, $this->request->getData());
            if ($this->Support->save($support)) {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 1;
                    $res['msg'] = 'The Support has been saved.';
                }else{
                    $this->Flash->success(__('The Support has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 0;
                    $res['msg'] = 'The Support could not be saved. Please, try again.';
                }else{
                    $this->Flash->error(__('The Support could not be saved. Please, try again.'));
                }
            }
        }
        $module = $this->Support->Module->find('list', ['limit' => 200]);
        $this->set(compact('support', 'module', 'res'));
        $this->set('_serialize', true);

    }

    /**
     * Edit method
     *
     * @param string|null $id Support id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $support = $this->Support->get($id, [
            'contain' => [],
        ]);
        $res = array();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $support = $this->Support->patchEntity($support, $this->request->getData());
            if ($this->Support->save($support)) {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 1;
                    $res['msg'] = 'The Support has been saved.';
                }else{
                    $this->Flash->success(__('The Support has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 0;
                    $res['msg'] = 'The Support could not be saved. Please, try again.';
                }else{
                    $this->Flash->error(__('The Support could not be saved. Please, try again.'));
                }
            }
        }
        $module = $this->Support->Module->find('list', ['limit' => 200]);
        $this->set(compact('support', 'module', 'res'));
        $this->set('_serialize', true);
    }

    /**
     * Delete method
     *
     * @param string|null $id Support id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $res = array();
        $this->request->allowMethod(['post', 'delete']);
        $support = $this->Support->get($id);
        if ($this->Support->delete($support)) {
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
