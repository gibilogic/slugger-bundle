<?php

/**
 * @package     Gibilogic\SluggerBundle\Test
 * @author      GiBiLogic <info@gibilogic.com>
 * @authorUrl   http://www.gibilogic.com
 */

namespace Gibilogic\SluggerBundle\Test;

use Gibilogic\SluggerBundle\Service\Slugger;

/**
 * Class SluggerTest.
 *
 * @see \PHPUnit_Framework_TestCase
 */
class SluggerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Gibilogic\SluggerBundle\Service\Slugger $slugger
     */
    private static $slugger = null;

    /**
     * Test for lowercase conversion.
     */
    public function testLowercase()
    {
        $this->assertEquals('testlowercase', $this->getSlugger()->slugify('TESTLOWERCASE'));
    }

    /**
     * Test for new lines removal.
     */
    public function testNewLines()
    {
        $this->assertEquals('testnewlines', $this->getSlugger()->slugify("test\nnew\rlines\n\r"));
    }

    /**
     * Test for dot (.) conversion.
     */
    public function testDot()
    {
        $this->assertEquals('test-dot', $this->getSlugger()->slugify('test.dot'));
    }

    /**
     * Test for whitespaces trimming.
     */
    public function testWhitespacesTrimming()
    {
        $this->assertEquals('testtrimming', $this->getSlugger()->slugify(" testtrimming\t "));
    }

    /**
     * @return \Gibilogic\SluggerBundle\Service\Slugger
     */
    protected function getSlugger()
    {
        if (null === self::$slugger) {
            self::$slugger = new Slugger();
        }

        return self::$slugger;
    }
}
