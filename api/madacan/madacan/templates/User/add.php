<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List User'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="user form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Add User') ?></legend>
                <?php
                    echo $this->Form->control('nom');
                    echo $this->Form->control('prenom');
                    echo $this->Form->control('email');
                    echo $this->Form->control('phone');
                    echo $this->Form->control('adresse');
                    echo $this->Form->control('naissance', ['empty' => true]);
                    echo $this->Form->control('inscription');
                    echo $this->Form->control('level');
                    echo $this->Form->control('active');
                    echo $this->Form->control('password');
                    echo $this->Form->control('connected');
                    echo $this->Form->control('deleted', ['empty' => true]);
                    echo $this->Form->control('formation._ids', ['options' => $formation]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
