<?php

namespace Zero;

use Composer\Script\Event;
use RuntimeException;

/**
 * Class Installer
 * @author Mohos Tamás <tomi@mohos.name>
 * @package Zero
 */
class Installer
{
    public static function postCreateProject(Event $event)
    {
        $root = dirname(__DIR__);
        $io = $event->getIO();
        $name = $io->ask('Package Name: ');

        if($name === '') {
            throw new RuntimeException('Name can not be empty');
        }

        $autoAlias = str_replace(' ', '-', strtolower($name));

        $alias = $io->ask(sprintf('Package Alias [%s]: ', $autoAlias)) ?: $autoAlias;

        file_put_contents($root . '/README.md', self::getReplacedFileContents($root . '/README.md', $name, $alias));
        file_put_contents($root . '/composer.json',
            preg_replace('/(,\s+"post-create-project-cmd".*")/', '',
                self::getReplacedFileContents($root . '/composer.json', $name, $alias)
            )
        );

        unlink($root . '/test/LibrarySkeleton.php');
        unlink(__FILE__);
    }

    private static function getReplacedFileContents($file, $name, $alias) {
        return strtr(file_get_contents($file), [
            'Library Skeleton' => $name,
            'library-skeleton' => $alias
        ]);
    }
}