<?php

namespace GitHooks\Composer\Script;

use Exception;
use Composer\Script\Event;

define('ROOT_DIR', __DIR__ . '/../../../../../');

class Hooks
{
    public static function preHooks(Event $event)
    {
        $io = $event->getIO();
        $gitHook = ROOT_DIR.'.git/hooks/pre-push';

        if (file_exists($gitHook)) {
            unlink($gitHook);
            $io->write('<info>Pre-push removed!</info>');
        }

        return true;
    }

    public static function postHooks(Event $event)
    {
        if (!file_exists(ROOT_DIR.'.git')) {
            throw new Exception(sprintf('Opss! Repository Git local not found.'));
        }

        $io = $event->getIO();
        $gitHook = ROOT_DIR.'.git/hooks/pre-push';
        $docHook = ROOT_DIR.'vendor/juizmill/git-hooks/hooks/pre-push';

        copy($docHook, $gitHook);
        chmod($gitHook, 0777);

        $io->write('<info>Pre-push created!</info>');

        return true;
    }
}
