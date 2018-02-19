<?php

namespace App\Controllers;

use Slim\Http\Request;
use samdark\sitemap\Sitemap;
use samdark\sitemap\Index;

/**
 * Controller for sitemap
 */
class SitemapController extends Controller
{

    /**
     * Create a sitemap.xml
     * @return bool
     */
    public function create()
    {
        $sitemap = new Sitemap(__DIR__ . '/../../public/sitemap.xml');
        $sitemap->addItem(getenv("APP_URL"));
        $sitemap->write();
        echo 'Sitemap created!';
        return true;
    }
}
