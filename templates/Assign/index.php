<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Assign[]|\Cake\Collection\CollectionInterface $assign
 */
?>
<div class="assign index content">
    <?= $this->Html->link(__('New Assign'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Assign') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('dept_no') ?></th>
                    <th><?= $this->Paginator->sort('title_no') ?></th>
                    <th><?= $this->Paginator->sort('last_name') ?></th>
                    <th><?= $this->Paginator->sort('first_name') ?></th>
                    <th><?= $this->Paginator->sort('gender') ?></th>
                    <th><?= $this->Paginator->sort('birthdate') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('cv') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($assign as $assign): ?>
                <tr>
                    <td><?= $this->Number->format($assign->id) ?></td>
                    <td><?= h($assign->dept_no) ?></td>
                    <td><?= $this->Number->format($assign->title_no) ?></td>
                    <td><?= h($assign->last_name) ?></td>
                    <td><?= h($assign->first_name) ?></td>
                    <td><?= h($assign->gender) ?></td>
                    <td><?= h($assign->birthdate) ?></td>
                    <td><?= h($assign->email) ?></td>
                    <td><?= h($assign->cv) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $assign->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assign->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assign->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assign->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
