<h1><?= __("Jobs offers for department #$dept_no") ?></1>
<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th><?= __("Job's name") ?></th>
                <th><?= __("Description") ?></th>
                <th><?= __("Quantity") ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($vacancies as $vacancie) : ?>
                <tr>
                    <td><?= $vacancie->titles[0]->title ?></td>
                    <td><?= $vacancie->titles[0]->description ?></td>
                    <td><?=  $vacancie->quantity ?></td>
                    <td>
                        <?= $this->Html->link(__('Apply'), 
                        ['controller' => 'assign', 'action' => 'apply', $vacancie->dept_no, $vacancie->title_no]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>