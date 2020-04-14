<?php
declare(strict_types=1);

namespace MakvilleAcl\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use MakvilleAcl\Model\Table\RoleActionsTable;

/**
 * MakvilleAcl\Model\Table\RoleActionsTable Test Case
 */
class RoleActionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \MakvilleAcl\Model\Table\RoleActionsTable
     */
    protected $RoleActions;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.MakvilleAcl.RoleActions',
        'plugin.MakvilleAcl.Roles',
        'plugin.MakvilleAcl.ModuleActions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RoleActions') ? [] : ['className' => RoleActionsTable::class];
        $this->RoleActions = TableRegistry::getTableLocator()->get('RoleActions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->RoleActions);

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
