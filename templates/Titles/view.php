<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Title $title
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Title'), ['action' => 'edit', $title->title], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Title'), ['action' => 'delete', $title->title], ['confirm' => __('Are you sure you want to delete # {0}?', $title->title), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Titles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Title'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="titles view content">
            <h3><?= h($title->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($title->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($title->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Title No') ?></th>
                    <td><?= $this->Number->format($title->title_no) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Employee Title') ?></h4>
                <?php if (!empty($title->employee_title)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Emp No') ?></th>
                            <th><?= __('Title No') ?></th>
                            <th><?= __('From Date') ?></th>
                            <th><?= __('To Date') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($title->employee_title as $employeeTitle) : ?>
                        <tr>
                            <td><?= h($employeeTitle->emp_no) ?></td>
                            <td><?= h($employeeTitle->title_no) ?></td>
                            <td><?= h($employeeTitle->from_date) ?></td>
                            <td><?= h($employeeTitle->to_date) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Employee_title', 'action' => 'view', $employeeTitle->emp_no]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Employee_title', 'action' => 'edit', $employeeTitle->emp_no]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Employee_title', 'action' => 'delete', $employeeTitle->emp_no], ['confirm' => __('Are you sure you want to delete # {0}?', $employeeTitle->emp_no)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Vacancies') ?></h4>
                <?php if (!empty($title->vacancies)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Dept No') ?></th>
                            <th><?= __('Title No') ?></th>
                            <th><?= __('Quantity') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($title->vacancies as $vacancies) : ?>
                        <tr>
                            <td><?= h($vacancies->dept_no) ?></td>
                            <td><?= h($vacancies->title_no) ?></td>
                            <td><?= h($vacancies->quantity) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Vacancies', 'action' => 'view', $vacancies->dept_no]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Vacancies', 'action' => 'edit', $vacancies->dept_no]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Vacancies', 'action' => 'delete', $vacancies->dept_no], ['confirm' => __('Are you sure you want to delete # {0}?', $vacancies->dept_no)]) ?>
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
