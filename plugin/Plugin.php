<?php

namespace TypechoPlugin\Sitemap;

use Typecho\Plugin\PluginInterface;
use Typecho\Widget\Helper\Form;
use Utils\Helper;

if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

/**
 * Sitemap Plugin. Generate sitemap.xml for search engine.
 * The url of sitemap.xml is http(s)://yourdomain.com/sitemap.xml
 *
 * @package Sitemap
 * @author JoyQi
 * @version %version%
 * @since 1.2.1
 * @link https://joyqi.com/typecho/plugin-sitemap.html
 */
class Plugin implements PluginInterface
{
    /**
     * Activate plugin method, if activated failed, throw exception will disable this plugin.
     */
    public static function activate()
    {
        Helper::addRoute(
            'sitemap',
            '/sitemap.xml',
            Generator::class,
            'generate',
            'index'
        );
    }

    /**
     * Deactivate plugin method, if deactivated failed, throw exception will enable this plugin.
     */
    public static function deactivate()
    {
        Helper::removeRoute('sitemap');
    }

    /**
     * Plugin config panel render method.
     *
     * @param Form $form
     */
    public static function config(Form $form)
    {
        $sitemapBlock = new Form\Element\Checkbox(
            'sitemapBlock',
            [
                'posts' => _t('生成文章链接'),
                'pages' => _t('生成独立页面链接'),
                'categories' => _t('生成分类链接'),
                'tags' => _t('生成标签链接'),
            ],
            ['posts', 'pages', 'categories', 'tags'],
            _t('站点地图显示')
        );

        $updateFreq = new Form\Element\Select(
            'updateFreq',
            [
                'daily' => _t('每天'),
                'weekly' => _t('每周'),
                'monthly' => _t('每月或更久'),
            ],
            'daily',
            _t('更新频率')
        );

        $form->addInput($sitemapBlock->multiMode());
        $form->addInput($updateFreq);
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

