<?php

namespace bhenk\gitzw\dajson;

use DateTime;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertNotEmpty;
use function PHPUnit\Framework\assertTrue;
use function sleep;

class ActionRegistryTest extends TestCase {

    public function testLoad() {
        $registry = new ActionRegistry();
        $test = $registry->getActionByAcid("TEST");
        if ($test) {
            $registry->removeAction("TEST");
            $registry->persist();
        }
        $data = [
            "name" => "Update order of work",
            "location" => "Admin/System > Deploy",
            "path" => "/admin/system"
        ];
        $action = new Action("TEST", $data);
        $registry->addAction($action);
        $registry->persist();

        $registry = new ActionRegistry();
        assertNotEmpty($registry->getActions());
        $test = $registry->getActionByAcid("TEST");

        $test->setLastModified("gendan");
        $registry->persist();

        $registry = new ActionRegistry();
        $test = $registry->getActionByAcid("TEST");
        $lm = $test->getLastModified();
        assertInstanceOf(DateTime::class, $lm);
        assertEquals("gendan", $test->getLastModifiedBy());
        sleep(2);

        $test->setLastModified("tester");
        $registry->persist();

        $registry = new ActionRegistry();
        $test = $registry->getActionByAcid("TEST");
        assertEquals("tester", $test->getLastModifiedBy());
        assertEquals(2, count($test->getModified()));
        $registry->removeAction("TEST");
        $registry->persist();
        assertFalse($registry->getActionByAcid("TEST"));
    }

    public function testInsertRealActions() {
        date_default_timezone_set('Europe/Amsterdam');
        $actions = [
            "UOOW" => [
                "name" => "Update order of works",
                "location" => "Admin/System > Deploy",
                "path" => "/admin/deploy"
            ],
            "CACHE" => [
                "name" => "Create cache",
                "location" => "Admin/System > Deploy",
                "path" => "/admin/deploy"
            ],
            "SITEMAP" => [
                "name" => "Create sitemap",
                "location" => "Admin/System > Deploy",
                "path" => "/admin/deploy"
            ],
        ];
        $registry = new ActionRegistry();
        foreach ($actions as $acid => $data) {
            $action = $registry->getActionByAcid($acid);
            if (!$action) {
                $action = new Action($acid, $data);
                $action->setLastModified("creator");
                $registry->addAction($action);
            }
        }
        assertEquals(count($actions), count($registry->getActions()));
        $registry->persist();
    }

}
