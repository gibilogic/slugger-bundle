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
     * Test for whitespaces removal.
     */
    public function testNoWhitespaces()
    {
        $this->assertTrue(strpos($this->getSlugger()->slugify("test white spaces"), ' ') === false);
    }

    /**
     * Test for invalid characters removal.
     */
    public function testInvalidCharacterRemoval()
    {
        $strings = array(
            'à', 'á', 'â', 'ã', 'å', 'À', 'Á', 'Â', 'Ã', 'Å',
            'æ', 'Æ', 'ä', 'Ä',
            '&amp;', '&',
            'ç', 'Ç', '©',
            '∂',
            'è', 'é', 'ê', 'ë', 'È', 'É', 'Ê', 'Ë', '€',
            'ì', 'í', 'î', 'ï', 'Ì', 'Í', 'Î', 'Ï',
            'ñ', 'Ñ',
            'ò', 'ó', 'ô', 'õ', 'ø', 'Ò', 'Ó', 'Ô', 'Õ', 'Ø',
            'œ', 'Œ', 'ö', 'Ö',
            '®',
            '$',
            'ß',
            'ù', 'ú', 'û', 'µ', 'Ù', 'Ú', 'Û',
            'ü', 'Ü',
            'ÿ', 'Ÿ', '¥',
            '™',
            '∏', 'π', 'Π',
            "'", "`", '"'
        );

        foreach ($strings as $string) {
            $slug = $this->getSlugger()->slugify($string);
            $this->assertTrue(
                preg_match('/[^a-z0-9\s-]/', $slug) === 0,
                sprintf("testInvalidCharacterRemoval failed for '%s' from '%s'", $slug, $string)
            );
        }
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
