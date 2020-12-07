

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee[]|\Cake\Collection\CollectionInterface $employees
 */
?>
<div class="employees index content">
    <h3><?= __('Employees') ?></h3>
    
    <?= $this->Form->create($employees, ['url' => ['action' => 'search'], 'class' =>'form-inline my-2 my-lg-0']) ?>
    <?= $this->Form->text('employee', ['class' => 'form-control mr-sm-2', 'type' => 'search', 'placeholder' => 'Search', 'aria-label'=>'Search']); ?>
    <?= $this->Form->button(__('Search'), ['class' => 'btn btn-outline-success my-2 my-sm-0', 'type' => 'submit'] ) ?>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= __('emp_no') ?></th>
                    <th><?= __('birth_date') ?></th>
                    <th><?= __('first_name') ?></th>
                    <th><?= __('last_name') ?></th>
                    <th><?= __('gender') ?></th>
                    <th><?= __('hire_date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                    
                </tr>
            </thead>
            <tbody>
                
                <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?= $this->Number->format($employee->emp_no) ?></td>
                    <td><?= h($employee->birth_date) ?></td>
                    <td><?= h($employee->first_name) ?></td>
                    <td><?= h($employee->last_name) ?></td>
                    <td><?= h($employee->gender) ?></td>
                    <td><?= h($employee->hire_date) ?></td>
                    <td class="actions">
                        <?= $this->Html->image("view.png", ["alt" => "View employees","width" => "40", "height" => "40", 'url' => ['controller' => 'Employees', 'action' => 'view', $employee->emp_no]] ); ?>
                        <?= $this->Html->image("edit.png", ["alt" => "Edit employees","width" => "40", "height" => "40", 'url' => ['controller' => 'Employees', 'action' => 'edit', $employee->emp_no]]); ?>
                          <?= $this->Form->postLink(
                            $this->Html->image('delete.png',
                            ['alt' => __('Effacer'),"width" => "40", "height" => "40"]), //le image
                            ['action' => 'delete', $employee->emp_no], //le url
                            ['escape' => false, 'confirm'=>__('Are you sure you want to delete # {0}?', $employee->emp_no)] //le confirm
                        ) ?>
                         
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
</div>



