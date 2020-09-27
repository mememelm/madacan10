<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evaluation $evaluation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Evaluation'), ['action' => 'edit', $evaluation->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Evaluation'), ['action' => 'delete', $evaluation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evaluation->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Evaluation'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Evaluation'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="evaluation view content">
            <h3><?= h($evaluation->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $evaluation->has('user') ? $this->Html->link($evaluation->user->id, ['controller' => 'User', 'action' => 'view', $evaluation->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Question') ?></th>
                    <td><?= $evaluation->has('question') ? $this->Html->link($evaluation->question->id, ['controller' => 'Question', 'action' => 'view', $evaluation->question->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($evaluation->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Note') ?></th>
                    <td><?= $this->Number->format($evaluation->note) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($evaluation->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($evaluation->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Reponse') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($evaluation->reponse)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
