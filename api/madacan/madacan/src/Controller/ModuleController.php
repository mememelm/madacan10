<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Module Controller
 *
 * @property \App\Model\Table\ModuleTable $Module
 * @method \App\Model\Entity\Module[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ModuleController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Formation'],
        ];
        $module = $this->paginate($this->Module);

        $this->set(compact('module'));
        $this->set('_serialize', ['module']);
    }

    /**
     * View method
     *
     * @param string|null $id Module id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $module = $this->Module->get($id, [
            'contain' => ['Formation', 'Question', 'Support'],
        ]);

        $this->set(compact('module'));
        $this->set('_serialize', ['module']);

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $res = array();
        $module = $this->Module->newEmptyEntity();
        if ($this->request->is('post')) {
            $module = $this->Module->patchEntity($module, $this->request->getData());
            if ($this->Module->save($module)) {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 1;
                    $res['msg'] = 'The module has been saved.';
                }else{
                    $this->Flash->success(__('The module has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 0;
                    $res['msg'] = 'The module could not be saved. Please, try again.';
                }else{
                    $this->Flash->error(__('The module could not be saved. Please, try again.'));
                }
            }
        }
        $formation = $this->Module->Formation->find('list', ['limit' => 200]);
        $this->set(compact('module', 'formation', 'res'));
        $this->set('_serialize', true);

    }

    /**
     * Edit method
     *
     * @param string|null $id Module id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $module = $this->Module->get($id, [
            'contain' => [],
        ]);
        $res = array();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $module = $this->Module->patchEntity($module, $this->request->getData());
            if ($this->Module->save($module)) {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 1;
                    $res['msg'] = 'The module has been saved.';
                }else{
                    $this->Flash->success(__('The module has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                if (!isset($_SERVER['HTTP_REFERER'])) {
                    $res['status'] = 0;
                    $res['msg'] = 'The module could not be saved. Please, try again.';
                }else{
                    $this->Flash->error(__('The module could not be saved. Please, try again.'));
                }
            }
        }
        $formation = $this->Module->Formation->find('list', ['limit' => 200]);
        $this->set(compact('module', 'formation', 'res'));
        $this->set('_serialize', true);

    }

    /**
     * Delete method
     *
     * @param string|null $id Module id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $res = array();
        $this->request->allowMethod(['post', 'delete']);
        $module = $this->Module->get($id);
        if ($this->Module->delete($module)) {
            if (!isset($_SERVER['HTTP_REFERER'])) {
                $res['status'] = 1;
                $res['msg'] = 'The module has been deleted.';
            }else{
                $this->Flash->success(__('The module has been deleted.'));
                return $this->redirect(['action' => 'index']);
            }
        } else {
            if (!$_SERVER['HTTP_REFERER']) {
                $res['status'] = 0;
                $res['msg'] = 'The module could not be deleted. Please, try again.';
            } else {
                $this->Flash->error(__('The module could not be deleted. Please, try again.'));
            }
        }

        $this->set(compact('res'));
        $this->set('_serialize', ['res']);
    }
}
