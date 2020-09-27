<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Formation $formation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $formation->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $formation->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Formation'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="formation form content">
            <?= $this->Form->create($formation) ?>
            <fieldset>
                <legend><?= __('Edit Formation') ?></legend>
                <?php
                    echo $this->Form->control('intitule');
                    echo $this->Form->control('description');
                    echo $this->Form->control('user._ids', ['options' => $user]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
