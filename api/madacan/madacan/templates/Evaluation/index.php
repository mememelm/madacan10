<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evaluation[]|\Cake\Collection\CollectionInterface $evaluation
 */
?>
<div class="evaluation index content">
    <?= $this->Html->link(__('New Evaluation'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Evaluation') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('question_id') ?></th>
                    <th><?= $this->Paginator->sort('note') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($evaluation as $evaluation): ?>
                <tr>
                    <td><?= $this->Number->format($evaluation->id) ?></td>
                    <td><?= $evaluation->has('user') ? $this->Html->link($evaluation->user->id, ['controller' => 'User', 'action' => 'view', $evaluation->user->id]) : '' ?></td>
                    <td><?= $evaluation->has('question') ? $this->Html->link($evaluation->question->id, ['controller' => 'Question', 'action' => 'view', $evaluation->question->id]) : '' ?></td>
                    <td><?= $this->Number->format($evaluation->note) ?></td>
                    <td><?= h($evaluation->created) ?></td>
                    <td><?= h($evaluation->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $evaluation->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $evaluation->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $evaluation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evaluation->id)]) ?>
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
