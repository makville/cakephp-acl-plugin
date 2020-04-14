<?php
declare(strict_types=1);

namespace MakvilleAcl\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use MakvilleAcl\Model\Table\UserProfilesTable;

/**
 * MakvilleAcl\Model\Table\UserProfilesTable Test Case
 */
class UserProfilesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \MakvilleAcl\Model\Table\UserProfilesTable
     */
    protected $UserProfiles;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.MakvilleAcl.UserProfiles',
        'plugin.MakvilleAcl.Users',
        'plugin.MakvilleAcl.UserProfileFields',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UserProfiles') ? [] : ['className' => UserProfilesTable::class];
        $this->UserProfiles = TableRegistry::getTableLocator()->get('UserProfiles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->UserProfiles);

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
