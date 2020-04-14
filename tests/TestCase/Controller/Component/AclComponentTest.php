<?php
declare(strict_types=1);

namespace MakvilleAcl\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;
use MakvilleAcl\Controller\Component\AclComponent;

/**
 * MakvilleAcl\Controller\Component\AclComponent Test Case
 */
class AclComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \MakvilleAcl\Controller\Component\AclComponent
     */
    protected $Acl;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Acl = new AclComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Acl);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
