<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeptEmp $deptEmp
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $deptEmp->emp_no],
                ['confirm' => __('Are you sure you want to delete # {0}?', $deptEmp->emp_no), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Dept Emp'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="deptEmp form content">
            <?= $this->Form->create($deptEmp) ?>
            <fieldset>
                <legend><?= __('Edit Dept Emp') ?></legend>
                <?php
                    echo $this->Form->control('from_date');
                    echo $this->Form->control('to_date');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
