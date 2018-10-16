<?php

function getReplacedFileContents($file, $name, $alias) {
    return strtr(file_get_contents($file), [
        'Library Skeleton' => $name,
        'library-skeleton' => $alias
    ]);
}

echo 'Package Name: ';
$name = trim(fgets(STDIN));

if($name === '') {
    throw new RuntimeException('Name can not be empty');
}

$autoAlias = str_replace(' ', '-', strtolower($name));

echo sprintf('Package Alias [%s]: ', $autoAlias);
$alias = trim(fgets(STDIN)) ?: $autoAlias;

file_put_contents('README.md', getReplacedFileContents('README.md', $name, $alias));
file_put_contents('composer.json',
    preg_replace('/(,\s+"post-create-project-cmd".*")/', '', getReplacedFileContents('composer.json', $name, $alias))
);

unlink('src/.gitkeep');
unlink('test/Test.php');
unlink(__FILE__);