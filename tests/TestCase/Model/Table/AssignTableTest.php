<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssignTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssignTable Test Case
 */
class AssignTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AssignTable
     */
    protected $Assign;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Assign',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Assign') ? [] : ['className' => AssignTable::class];
        $this->Assign = $this->getTableLocator()->get('Assign', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Assign);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
