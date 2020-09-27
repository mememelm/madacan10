<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserFormation $userFormation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User Formation'), ['action' => 'edit', $userFormation->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User Formation'), ['action' => 'delete', $userFormation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userFormation->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List User Formation'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User Formation'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="userFormation view content">
            <h3><?= h($userFormation->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $userFormation->has('user') ? $this->Html->link($userFormation->user->id, ['controller' => 'User', 'action' => 'view', $userFormation->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Formation') ?></th>
                    <td><?= $userFormation->has('formation') ? $this->Html->link($userFormation->formation->id, ['controller' => 'Formation', 'action' => 'view', $userFormation->formation->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($userFormation->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Debut') ?></th>
                    <td><?= h($userFormation->date_debut) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Fin') ?></th>
                    <td><?= h($userFormation->date_fin) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
