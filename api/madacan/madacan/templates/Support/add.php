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
            <?= $this->Html->link(__('List Support'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="support form content">
            <?= $this->Form->create($support) ?>
            <fieldset>
                <legend><?= __('Add Support') ?></legend>
                <?php
                    echo $this->Form->control('module_id', ['options' => $module]);
                    echo $this->Form->control('description');
                    echo $this->Form->control('type');
                    echo $this->Form->control('origine');
                    echo $this->Form->control('url');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
