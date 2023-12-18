<?php

namespace TypechoPlugin\Example;

use Typecho\Plugin\PluginInterface;

if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

/**
 * Example plugin.
 *
 * @package Example
 * @author Typecho
 * @version %version%
 * @link https://typecho.org
 */
class Plugin implements PluginInterface
{
    /**
     * Activate plugin method, if activated failed, throw exception will disable this plugin.
     */
    public static function activate()
    {
        // TODO: Implement activate() method.
    }

    /**
     * Deactivate plugin method, if deactivated failed, throw exception will enable this plugin.
     */
    public static function deactivate()
    {
        // TODO: Implement deactivate() method.
    }

    /**
     * Plugin config panel render method.
     *
     * @param Form $form
     */
    public static function config(Form $form)
    {
        // TODO: Implement config() method.
    }

    /**
     * Plugin personal config panel render method.
     *
     * @param Form $form
     */
    public static function personalConfig(Form $form)
    {
        // TODO: Implement personalConfig() method.
    }
}

