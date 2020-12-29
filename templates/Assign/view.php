<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Assign $assign
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Assign'), ['action' => 'edit', $assign->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Assign'), ['action' => 'delete', $assign->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assign->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Assign'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Assign'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="assign view content">
            <h3><?= h($assign->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Dept No') ?></th>
                    <td><?= h($assign->dept_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Name') ?></th>
                    <td><?= h($assign->last_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('First Name') ?></th>
                    <td><?= h($assign->first_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Gender') ?></th>
                    <td><?= h($assign->gender) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($assign->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cv') ?></th>
                    <td><?= h($assign->cv) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($assign->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Title No') ?></th>
                    <td><?= $this->Number->format($assign->title_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Birthdate') ?></th>
                    <td><?= h($assign->birthdate) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
