<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeptManager $deptManager
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Dept Manager'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="deptManager form content">
            <?= $this->Form->create($deptManager) ?>
            <fieldset>
                <legend><?= __('Add Dept Manager') ?></legend>
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
