<?php
declare(strict_types=1);

namespace MakvilleAcl\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use MakvilleAcl\View\Helper\AclHelper;

/**
 * MakvilleAcl\View\Helper\AclHelper Test Case
 */
class AclHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \MakvilleAcl\View\Helper\AclHelper
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
        $view = new View();
        $this->Acl = new AclHelper($view);
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
