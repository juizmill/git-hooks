<?php

namespace PreCommit\Composer\Script;

use Composer\Script\Event;

define('ROOT_DIR', __DIR__ . '/../../../../../');

class Hooks
{
    public static function preHooks(Event $event)
    {
        $io = $event->getIO();
        $gitHook = ROOT_DIR.'.git/hooks/pre-commit';

        if (file_exists($gitHook)) {
            unlink($gitHook);
            $io->write('<info>Pre-commit removed!</info>');
        }

        return true;
    }

    public static function postHooks(Event $event)
    {
        $io = $event->getIO();
        $gitHook = ROOT_DIR.'.git/hooks/pre-commit';
        $docHook = ROOT_DIR.'vendor/juizmill/pre-commit/hooks/pre-commit';

        copy($docHook, $gitHook);
        chmod($gitHook, 0777);

        $io->write('<info>Pre-commit created!</info>');

        return true;
    }
}
