<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question $question
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Question'), ['action' => 'edit', $question->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Question'), ['action' => 'delete', $question->id], ['confirm' => __('Are you sure you want to delete # {0}?', $question->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Question'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Question'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="question view content">
            <h3><?= h($question->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Module') ?></th>
                    <td><?= $question->has('module') ? $this->Html->link($question->module->id, ['controller' => 'Module', 'action' => 'view', $question->module->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($question->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= $this->Number->format($question->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($question->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($question->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= h($question->deleted) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Enonce') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($question->enonce)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Reponse') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($question->reponse)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Evaluation') ?></h4>
                <?php if (!empty($question->evaluation)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Question Id') ?></th>
                            <th><?= __('Reponse') ?></th>
                            <th><?= __('Note') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($question->evaluation as $evaluation) : ?>
                        <tr>
                            <td><?= h($evaluation->id) ?></td>
                            <td><?= h($evaluation->user_id) ?></td>
                            <td><?= h($evaluation->question_id) ?></td>
                            <td><?= h($evaluation->reponse) ?></td>
                            <td><?= h($evaluation->note) ?></td>
                            <td><?= h($evaluation->date) ?></td>
                            <td><?= h($evaluation->created) ?></td>
                            <td><?= h($evaluation->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Evaluation', 'action' => 'view', $evaluation->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Evaluation', 'action' => 'edit', $evaluation->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Evaluation', 'action' => 'delete', $evaluation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evaluation->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
