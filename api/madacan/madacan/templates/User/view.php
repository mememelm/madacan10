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
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List User'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="user view content">
            <h3><?= h($user->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nom') ?></th>
                    <td><?= h($user->nom) ?></td>
                </tr>
                <tr>
                    <th><?= __('Prenom') ?></th>
                    <td><?= h($user->prenom) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone') ?></th>
                    <td><?= h($user->phone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Adresse') ?></th>
                    <td><?= h($user->adresse) ?></td>
                </tr>
                <tr>
                    <th><?= __('Password') ?></th>
                    <td><?= h($user->password) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Level') ?></th>
                    <td><?= $this->Number->format($user->level) ?></td>
                </tr>
                <tr>
                    <th><?= __('Naissance') ?></th>
                    <td><?= h($user->naissance) ?></td>
                </tr>
                <tr>
                    <th><?= __('Inscription') ?></th>
                    <td><?= h($user->inscription) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($user->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= h($user->deleted) ?></td>
                </tr>
                <tr>
                    <th><?= __('Active') ?></th>
                    <td><?= $user->active ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Connected') ?></th>
                    <td><?= $user->connected ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Formation') ?></h4>
                <?php if (!empty($user->formation)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Intitule') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->formation as $formation) : ?>
                        <tr>
                            <td><?= h($formation->id) ?></td>
                            <td><?= h($formation->intitule) ?></td>
                            <td><?= h($formation->description) ?></td>
                            <td><?= h($formation->created) ?></td>
                            <td><?= h($formation->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Formation', 'action' => 'view', $formation->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Formation', 'action' => 'edit', $formation->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Formation', 'action' => 'delete', $formation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $formation->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Evaluation') ?></h4>
                <?php if (!empty($user->evaluation)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Question Id') ?></th>
                            <th><?= __('Reponse') ?></th>
                            <th><?= __('Note') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->evaluation as $evaluation) : ?>
                        <tr>
                            <td><?= h($evaluation->id) ?></td>
                            <td><?= h($evaluation->user_id) ?></td>
                            <td><?= h($evaluation->question_id) ?></td>
                            <td><?= h($evaluation->reponse) ?></td>
                            <td><?= h($evaluation->note) ?></td>
                            <td><?= h($evaluation->date) ?></td>
                            <td><?= h($evaluation->created) ?></td>
                            <td><?= h($evaluation->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Evaluation', 'action' => 'view', $evaluation->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Evaluation', 'action' => 'edit', $evaluation->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Evaluation', 'action' => 'delete', $evaluation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evaluation->id)]) ?>
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
