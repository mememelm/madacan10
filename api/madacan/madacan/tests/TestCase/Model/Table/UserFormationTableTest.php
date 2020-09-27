<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserFormationTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserFormationTable Test Case
 */
class UserFormationTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserFormationTable
     */
    protected $UserFormation;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.UserFormation',
        'app.User',
        'app.Formation',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('UserFormation') ? [] : ['className' => UserFormationTable::class];
        $this->UserFormation = $this->getTableLocator()->get('UserFormation', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->UserFormation);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
