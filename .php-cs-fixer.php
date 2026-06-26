<?php

$finder = PhpCsFixer\Finder::create()
    ->in(['Kata', 'Tests'])
    ->notPath('vendor');

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'no_unused_imports' => true,
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
    ])
    ->setFinder($finder)
    ->setCacheFile('.php-cs-fixer.cache');
