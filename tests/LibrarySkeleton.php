<?php

namespace Test;

use PHPUnit\Framework\TestCase;

class LibrarySkeleton extends TestCase
{
    /**
     * @test
     */
    public function checkFiles()
    {
        $rootDir = dirname(__DIR__);
        $this->assertFileExists($rootDir . '/.coveralls.yml');
        $this->assertFileExists($rootDir . '/.gitignore');
        $this->assertFileExists($rootDir . '/.travis.yml');
        $this->assertFileExists($rootDir . '/Makefile');
        $this->assertFileExists($rootDir . '/README.md');
        $this->assertFileExists($rootDir . '/LICENSE');
        $this->assertFileExists($rootDir . '/src/Installer.php');
    }
}
