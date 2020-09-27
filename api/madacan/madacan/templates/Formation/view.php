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
            <?= $this->Html->link(__('Edit Formation'), ['action' => 'edit', $formation->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Formation'), ['action' => 'delete', $formation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $formation->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Formation'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Formation'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="formation view content">
            <h3><?= h($formation->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Intitule') ?></th>
                    <td><?= h($formation->intitule) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($formation->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($formation->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($formation->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($formation->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related User') ?></h4>
                <?php if (!empty($formation->user)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Nom') ?></th>
                            <th><?= __('Prenom') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Phone') ?></th>
                            <th><?= __('Adresse') ?></th>
                            <th><?= __('Naissance') ?></th>
                            <th><?= __('Inscription') ?></th>
                            <th><?= __('Level') ?></th>
                            <th><?= __('Active') ?></th>
                            <th><?= __('Password') ?></th>
                            <th><?= __('Connected') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Deleted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($formation->user as $user) : ?>
                        <tr>
                            <td><?= h($user->id) ?></td>
                            <td><?= h($user->nom) ?></td>
                            <td><?= h($user->prenom) ?></td>
                            <td><?= h($user->email) ?></td>
                            <td><?= h($user->phone) ?></td>
                            <td><?= h($user->adresse) ?></td>
                            <td><?= h($user->naissance) ?></td>
                            <td><?= h($user->inscription) ?></td>
                            <td><?= h($user->level) ?></td>
                            <td><?= h($user->active) ?></td>
                            <td><?= h($user->password) ?></td>
                            <td><?= h($user->connected) ?></td>
                            <td><?= h($user->created) ?></td>
                            <td><?= h($user->modified) ?></td>
                            <td><?= h($user->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'User', 'action' => 'view', $user->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'User', 'action' => 'edit', $user->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'User', 'action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Module') ?></h4>
                <?php if (!empty($formation->module)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Formation Id') ?></th>
                            <th><?= __('Intitule') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($formation->module as $module) : ?>
                        <tr>
                            <td><?= h($module->id) ?></td>
                            <td><?= h($module->formation_id) ?></td>
                            <td><?= h($module->intitule) ?></td>
                            <td><?= h($module->description) ?></td>
                            <td><?= h($module->created) ?></td>
                            <td><?= h($module->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Module', 'action' => 'view', $module->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Module', 'action' => 'edit', $module->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Module', 'action' => 'delete', $module->id], ['confirm' => __('Are you sure you want to delete # {0}?', $module->id)]) ?>
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
