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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $module->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $module->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Module'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="module form content">
            <?= $this->Form->create($module) ?>
            <fieldset>
                <legend><?= __('Edit Module') ?></legend>
                <?php
                    echo $this->Form->control('formation_id', ['options' => $formation, 'empty' => true]);
                    echo $this->Form->control('intitule');
                    echo $this->Form->control('description');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
