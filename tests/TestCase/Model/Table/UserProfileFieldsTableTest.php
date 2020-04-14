<?php
declare(strict_types=1);

namespace MakvilleAcl\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use MakvilleAcl\Model\Table\UserProfileFieldsTable;

/**
 * MakvilleAcl\Model\Table\UserProfileFieldsTable Test Case
 */
class UserProfileFieldsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \MakvilleAcl\Model\Table\UserProfileFieldsTable
     */
    protected $UserProfileFields;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.MakvilleAcl.UserProfileFields',
        'plugin.MakvilleAcl.UserProfiles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UserProfileFields') ? [] : ['className' => UserProfileFieldsTable::class];
        $this->UserProfileFields = TableRegistry::getTableLocator()->get('UserProfileFields', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->UserProfileFields);

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
}
