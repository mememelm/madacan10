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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $evaluation->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $evaluation->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Evaluation'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="evaluation form content">
            <?= $this->Form->create($evaluation) ?>
            <fieldset>
                <legend><?= __('Edit Evaluation') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $user]);
                    echo $this->Form->control('question_id', ['options' => $question]);
                    echo $this->Form->control('reponse');
                    echo $this->Form->control('note');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
