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
        $sitemap->add(Url::create('/all-products'));
        $sitemap->add(Url::create('/about-us'));
        $sitemap->add(Url::create('/contact-us'));
        $sitemap->add(Url::create('/brand-products'));
        $sitemap->add(Url::create('/products-search'));
        $sitemap->add(Url::create('/category-products'));
        $sitemap->add(Url::create('/login'));
        // Assuming you have a Post model and you want to include each post in the sitemap
        $products = Product::all();
        foreach ($products as $product) {
            $sitemap->add(Url::create("/product-details/{$product->product_slug}"));
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully.');
    }
}
