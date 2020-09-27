<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Support $support
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Support'), ['action' => 'edit', $support->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Support'), ['action' => 'delete', $support->id], ['confirm' => __('Are you sure you want to delete # {0}?', $support->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Support'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Support'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="support view content">
            <h3><?= h($support->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Module') ?></th>
                    <td><?= $support->has('module') ? $this->Html->link($support->module->id, ['controller' => 'Module', 'action' => 'view', $support->module->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Origine') ?></th>
                    <td><?= h($support->origine) ?></td>
                </tr>
                <tr>
                    <th><?= __('Url') ?></th>
                    <td><?= h($support->url) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($support->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= $this->Number->format($support->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($support->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($support->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($support->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
