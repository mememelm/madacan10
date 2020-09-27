<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserFormation[]|\Cake\Collection\CollectionInterface $userFormation
 */
?>
<div class="userFormation index content">
    <?= $this->Html->link(__('New User Formation'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('User Formation') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('formation_id') ?></th>
                    <th><?= $this->Paginator->sort('date_debut') ?></th>
                    <th><?= $this->Paginator->sort('date_fin') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userFormation as $userFormation): ?>
                <tr>
                    <td><?= $this->Number->format($userFormation->id) ?></td>
                    <td><?= $userFormation->has('user') ? $this->Html->link($userFormation->user->id, ['controller' => 'User', 'action' => 'view', $userFormation->user->id]) : '' ?></td>
                    <td><?= $userFormation->has('formation') ? $this->Html->link($userFormation->formation->id, ['controller' => 'Formation', 'action' => 'view', $userFormation->formation->id]) : '' ?></td>
                    <td><?= h($userFormation->date_debut) ?></td>
                    <td><?= h($userFormation->date_fin) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $userFormation->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userFormation->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userFormation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userFormation->id)]) ?>
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
