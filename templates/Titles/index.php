<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Title[]|\Cake\Collection\CollectionInterface $titles
 */
?>
<div class="titles index content">
    <?= $this->Html->link(__('New Title'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Titles') ?></h3>
    <div class="table-responsive">
    <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('title_no') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($titles as $title): ?>
                <tr>
                    <td><?= $this->Number->format($title->title_no) ?></td>
                    <td><?= h($title->title) ?></td>
                    <td><?= h($title->description) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $title->title]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $title->title]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $title->title], ['confirm' => __('Are you sure you want to delete # {0}?', $title->title)]) ?>
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
