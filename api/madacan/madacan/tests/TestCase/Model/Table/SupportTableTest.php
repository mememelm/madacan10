<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SupportTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SupportTable Test Case
 */
class SupportTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SupportTable
     */
    protected $Support;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Support',
        'app.Module',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Support') ? [] : ['className' => SupportTable::class];
        $this->Support = $this->getTableLocator()->get('Support', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Support);

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
