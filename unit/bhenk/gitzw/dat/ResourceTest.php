<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\ResourceDo;
use bhenk\logger\unit\ConsoleLoggerTrait;
use bhenk\logger\unit\LogAttribute;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertNull;
use function PHPUnit\Framework\assertTrue;

#[LogAttribute(false)]
class ResourceTest extends TestCase {
    use ConsoleLoggerTrait {
        setUp as public traitSetUp;
    }

    private Resource $res;

    public function setUp(): void {
        $this->traitSetUp();
        $this->res = new Resource();
    }

    public function testSetHeight() {
        $this->res->setHeight(12);
        assertEquals(12, $this->res->getHeight());
    }

    public function testGetID() {
        assertNull($this->res->getID());
    }

    public function testGetTitles() {
        $this->res->setTitleNl("een titel");
        $this->res->setPreferredLanguage("en");
        assertEquals("een titel", $this->res->getTitles());

        $this->res->setTitleEn("a title");
        assertEquals("a title (een titel)", $this->res->getTitles());
    }

    #[LogAttribute(true)]
    public function testGetDate() {
        assertTrue($this->res->setDate("2020"));
        assertEquals("2020", $this->res->getDate());
        assertTrue($this->res->setDate("2020-03"));
        assertEquals("2020-03", $this->res->getDate());
        assertTrue($this->res->setDate("2020-04-07"));
        assertEquals("2020-04-07", $this->res->getDate());

        assertFalse($this->res->setDate("07-04-2020"));
    }

    public function testSetHidden() {
        $this->res->setHidden(true);
        assertTrue($this->res->isHidden());
        $this->res->setHidden(false);
        assertFalse($this->res->isHidden());
    }

    public function testGetMedia() {
        $this->res->setMedia("Acrylic on canvas");
        assertEquals("Acrylic on canvas", $this->res->getMedia());
    }

    public function testSetWidth() {
        $this->res->setWidth(23);
        assertEquals(23, $this->res->getWidth());
    }

    public function test__construct() {
        $do = new ResourceDo(25, "resid");
        $this->res = new Resource($do);
        assertEquals(25, $this->res->getID());
        assertEquals("resid", $this->res->getRESID());
    }

    public function testSetOrdinal() {
        $this->res->setOrdinal(42);
        assertEquals(42, $this->res->getOrdinal());
    }

    public function testGetRESID() {
        assertNull($this->res->getRESID());
        $this->res->setRESID("hnq/work/paint/2020/0000");
        assertEquals("hnq/work/paint/2020/0000", $this->res->getRESID());
    }

    public function testGetDimensions() {
        $this->res->setWidth(25);
        $this->res->setHeight(50);
        assertEquals("25 x 50 cm. [w x h] 9.8 x 19.7 in.", $this->res->getDimensions());
    }

    public function testSetPreferredLanguage() {
        assertEquals("nl", $this->res->getPreferredLanguage());
        assertFalse($this->res->setPreferredLanguage("fr"));
        assertEquals("nl", $this->res->getPreferredLanguage());
        $this->res->setPreferredLanguage("en");
        assertEquals("en", $this->res->getPreferredLanguage());
        assertFalse($this->res->setPreferredLanguage(""));
        assertEquals("en", $this->res->getPreferredLanguage());
    }

    public function testSetDepth() {
        $this->res->setDepth(40);
        assertEquals(40, $this->res->getDepth());
    }

    public function testGetPreferredTitle() {
        assertEquals("", $this->res->getPreferredTitle());
        $this->res->setTitleNl("titel");
        $this->res->setTitleEn("title");
        assertEquals("titel", $this->res->getPreferredTitle());
        $this->res->setPreferredLanguage("en");
        assertEquals("title", $this->res->getPreferredTitle());
    }

    public function testGetCategory() {
        assertNull($this->res->getCategory());
        assertFalse($this->res->setCategory("foo"));
        assertTrue($this->res->setCategory("painting"));
        assertEquals(ResourceCategories::paint, $this->res->getCategory());
        assertTrue($this->res->setCategory("dry"));
        assertEquals(ResourceCategories::dry, $this->res->getCategory());
        assertTrue($this->res->setCategory(ResourceCategories::draw));
        assertEquals(ResourceCategories::draw, $this->res->getCategory());
    }

}
