<?php
declare(strict_types=1);

namespace MakvilleAcl\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;
use MakvilleAcl\Controller\Component\Auth2faComponent;

/**
 * MakvilleAcl\Controller\Component\Auth2faComponent Test Case
 */
class Auth2faComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \MakvilleAcl\Controller\Component\Auth2faComponent
     */
    protected $Auth2fa;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Auth2fa = new Auth2faComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Auth2fa);

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
