<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Module[]|\Cake\Collection\CollectionInterface $module
 */
?>
<div class="module index content">
    <?= $this->Html->link(__('New Module'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Module') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('formation_id') ?></th>
                    <th><?= $this->Paginator->sort('intitule') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($module as $module): ?>
                <tr>
                    <td><?= $this->Number->format($module->id) ?></td>
                    <td><?= $module->has('formation') ? $this->Html->link($module->formation->id, ['controller' => 'Formation', 'action' => 'view', $module->formation->id]) : '' ?></td>
                    <td><?= h($module->intitule) ?></td>
                    <td><?= h($module->created) ?></td>
                    <td><?= h($module->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $module->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $module->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $module->id], ['confirm' => __('Are you sure you want to delete # {0}?', $module->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>