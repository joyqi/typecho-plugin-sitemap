<?php

namespace TypechoPlugin\Sitemap;

use Widget\Base\Contents;
use Widget\Contents\Page\Rows;
use Widget\Contents\Post\Recent;
use Widget\Metas\Category\Rows as CategoryRows;
use Widget\Metas\Tag\Cloud;

if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

/**
 * Sitemap Generator
 */
class Generator extends Contents
{
    /**
     * @return void
     */
    public function generate()
    {
        $sitemap = '<?xml version="1.0" encoding="' . $this->options->charset . '"?>' . PHP_EOL;
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"'
            . ' xmlns:news="http://www.google.com/schemas/sitemap-news/0.9"'
            . ' xmlns:xhtml="http://www.w3.org/1999/xhtml"'
            . ' xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"'
            . ' xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">' . PHP_EOL;

        // add homepage
        $sitemap .= <<<EOF
        <url>
            <loc>{$this->options->siteUrl}</loc>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
EOF;

        // add posts
        if (in_array('posts', $this->options->plugin('Sitemap')->sitemapBlock)) {
            $postsCount = $this->size($this->select()
                ->where('table.contents.status = ?', 'publish')
                ->where('table.contents.created < ?', $this->options->time)
                ->where('table.contents.type = ?', 'post'));

            $posts = Recent::alloc(['pageSize' => $postsCount]);
            $freq = $this->options->plugin('Sitemap')->updateFreq ==='monthly' ? 'monthly' : 'weekly';

            while ($posts->next()) {
                $sitemap .= <<<EOF
            <url>
                <loc>{$posts->permalink}</loc>
                <changefreq>{$freq}</changefreq>
                <lastmod>{$posts->date->format('c')}</lastmod>
                <priority>0.8</priority>
            </url>
EOF;
            }
        }

        // add pages
        if (in_array('pages', $this->options->plugin('Sitemap')->sitemapBlock)) {
            $pages = Rows::alloc();
            $freq = $this->options->plugin('Sitemap')->updateFreq ==='monthly' ? 'yearly' : 'monthly';

            while ($pages->next()) {
                $sitemap .= <<<EOF
            <url>
                <loc>{$pages->permalink}</loc>
                <changefreq>{$freq}</changefreq>
                <lastmod>{$pages->date->format('c')}</lastmod>
                <priority>0.5</priority>
            </url>
EOF;
            }
        }

        // add categories
        if (in_array('categories', $this->options->plugin('Sitemap')->sitemapBlock)) {
            $categories = CategoryRows::alloc();
            $freq = $this->options->plugin('Sitemap')->updateFreq;

            while ($categories->next()) {
                $sitemap .= <<<EOF
            <url>
                <loc>{$categories->permalink}</loc>
                <changefreq>{$freq}</changefreq>
                <priority>0.6</priority>
            </url>
EOF;
            }
        }

        // add tags
        if (in_array('tags', $this->options->plugin('Sitemap')->sitemapBlock)) {
            $tags = Cloud::alloc();
            $freq = $this->options->plugin('Sitemap')->updateFreq;

            while ($tags->next()) {
                $sitemap .= <<<EOF
            <url>
                <loc>{$tags->permalink}</loc>
                <changefreq>{$freq}</changefreq>
                <priority>0.4</priority>
            </url>
EOF;
            }
        }

        $sitemap .= '</urlset>';

        $this->response->throwContent($sitemap, 'text/xml');
    }
}
