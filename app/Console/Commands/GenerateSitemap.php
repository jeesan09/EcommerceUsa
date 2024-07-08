<?php

namespace App\Console\Commands;

use App\Product;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'generate:sitemap';
    protected $description = 'Generate the sitemap for the website';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $sitemap = Sitemap::create();

        // Add URLs dynamically from your routes or database
        $sitemap->add(Url::create('/'));
        $sitemap->add(Url::create('/products'));
        $sitemap->add(Url::create('/about/page'));
        $sitemap->add(Url::create('/contact/page'));
        $sitemap->add(Url::create('/products/search'));
        $sitemap->add(Url::create('/product/brand/search'));
        $sitemap->add(Url::create('/product/soft/by'));

        // Assuming you have a Post model and you want to include each post in the sitemap
        $products = Product::all();
        foreach ($products as $product) {
            $sitemap->add(Url::create("/product/details/{$product->id}"));
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully.');
    }
}
