<?php
declare(strict_types=1);

namespace MakvilleAcl\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use MakvilleAcl\Model\Table\DutiesTable;

/**
 * MakvilleAcl\Model\Table\DutiesTable Test Case
 */
class DutiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \MakvilleAcl\Model\Table\DutiesTable
     */
    protected $Duties;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.MakvilleAcl.Duties',
        'plugin.MakvilleAcl.Modules',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Duties') ? [] : ['className' => DutiesTable::class];
        $this->Duties = TableRegistry::getTableLocator()->get('Duties', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Duties);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
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
