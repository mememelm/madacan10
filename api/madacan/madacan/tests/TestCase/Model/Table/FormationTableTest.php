<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FormationTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FormationTable Test Case
 */
class FormationTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FormationTable
     */
    protected $Formation;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Formation',
        'app.Module',
        'app.User',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Formation') ? [] : ['className' => FormationTable::class];
        $this->Formation = $this->getTableLocator()->get('Formation', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Formation);

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
