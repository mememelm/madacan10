<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\QuestionTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\QuestionTable Test Case
 */
class QuestionTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\QuestionTable
     */
    protected $Question;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Question',
        'app.Module',
        'app.Evaluation',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Question') ? [] : ['className' => QuestionTable::class];
        $this->Question = $this->getTableLocator()->get('Question', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Question);

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
