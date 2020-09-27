<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EvaluationTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EvaluationTable Test Case
 */
class EvaluationTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EvaluationTable
     */
    protected $Evaluation;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Evaluation',
        'app.User',
        'app.Question',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Evaluation') ? [] : ['className' => EvaluationTable::class];
        $this->Evaluation = $this->getTableLocator()->get('Evaluation', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Evaluation);

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
