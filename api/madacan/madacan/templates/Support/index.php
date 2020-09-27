<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Support[]|\Cake\Collection\CollectionInterface $support
 */
?>
<div class="support index content">
    <?= $this->Html->link(__('New Support'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Support') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('module_id') ?></th>
                    <th><?= $this->Paginator->sort('type') ?></th>
                    <th><?= $this->Paginator->sort('origine') ?></th>
                    <th><?= $this->Paginator->sort('url') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($support as $support): ?>
                <tr>
                    <td><?= $this->Number->format($support->id) ?></td>
                    <td><?= $support->has('module') ? $this->Html->link($support->module->id, ['controller' => 'Module', 'action' => 'view', $support->module->id]) : '' ?></td>
                    <td><?= $this->Number->format($support->type) ?></td>
                    <td><?= h($support->origine) ?></td>
                    <td><?= h($support->url) ?></td>
                    <td><?= h($support->created) ?></td>
                    <td><?= h($support->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $support->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $support->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $support->id], ['confirm' => __('Are you sure you want to delete # {0}?', $support->id)]) ?>
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
