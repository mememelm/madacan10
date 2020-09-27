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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $userFormation->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $userFormation->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List User Formation'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="userFormation form content">
            <?= $this->Form->create($userFormation) ?>
            <fieldset>
                <legend><?= __('Edit User Formation') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $user]);
                    echo $this->Form->control('formation_id', ['options' => $formation]);
                    echo $this->Form->control('date_debut');
                    echo $this->Form->control('date_fin');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
