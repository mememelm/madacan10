<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Module $module
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Module'), ['action' => 'edit', $module->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Module'), ['action' => 'delete', $module->id], ['confirm' => __('Are you sure you want to delete # {0}?', $module->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Module'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Module'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="module view content">
            <h3><?= h($module->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Formation') ?></th>
                    <td><?= $module->has('formation') ? $this->Html->link($module->formation->id, ['controller' => 'Formation', 'action' => 'view', $module->formation->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Intitule') ?></th>
                    <td><?= h($module->intitule) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($module->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($module->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($module->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($module->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Question') ?></h4>
                <?php if (!empty($module->question)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Module Id') ?></th>
                            <th><?= __('Enonce') ?></th>
                            <th><?= __('Type') ?></th>
                            <th><?= __('Reponse') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($module->question as $question) : ?>
                        <tr>
                            <td><?= h($question->id) ?></td>
                            <td><?= h($question->module_id) ?></td>
                            <td><?= h($question->enonce) ?></td>
                            <td><?= h($question->type) ?></td>
                            <td><?= h($question->reponse) ?></td>
                            <td><?= h($question->created) ?></td>
                            <td><?= h($question->modified) ?></td>
                            <td><?= h($question->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Question', 'action' => 'view', $question->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Question', 'action' => 'edit', $question->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Question', 'action' => 'delete', $question->id], ['confirm' => __('Are you sure you want to delete # {0}?', $question->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Support') ?></h4>
                <?php if (!empty($module->support)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Module Id') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Type') ?></th>
                            <th><?= __('Origine') ?></th>
                            <th><?= __('Url') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($module->support as $support) : ?>
                        <tr>
                            <td><?= h($support->id) ?></td>
                            <td><?= h($support->module_id) ?></td>
                            <td><?= h($support->description) ?></td>
                            <td><?= h($support->type) ?></td>
                            <td><?= h($support->origine) ?></td>
                            <td><?= h($support->url) ?></td>
                            <td><?= h($support->created) ?></td>
                            <td><?= h($support->modified) ?></td>
                            <td><?= h($support->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Support', 'action' => 'view', $support->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Support', 'action' => 'edit', $support->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Support', 'action' => 'delete', $support->id], ['confirm' => __('Are you sure you want to delete # {0}?', $support->id)]) ?>
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
