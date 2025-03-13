<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function generateSitemap()
    {
        $sitemap = Sitemap::create()
            ->add(
                Url::create('https://ardanradio.com')
                    ->setLastModificationDate(Carbon::now()) // Set tanggal terbaru
                    ->setChangeFrequency('daily')
                    ->setPriority(1.0)
            )
            ->add(
                Url::create('https://ardanradio.com/bradioYoutube')
                    ->setLastModificationDate(Carbon::now()->subDay()) // Contoh: 1 hari lalu
                    ->setChangeFrequency('weekly')
                    ->setPriority(0.8)
            )
            ->add(
                Url::create('https://ardanradio.com/chart')
                    ->setLastModificationDate(Carbon::now()->subDays(2))
                    ->setChangeFrequency('weekly')
                    ->setPriority(0.7)
            )
            ->add(
                Url::create('https://ardanradio.com/infoNews')
                    ->setLastModificationDate(Carbon::now())
                    ->setChangeFrequency('daily')
                    ->setPriority(0.9)
            )
            ->add(
                Url::create('https://ardanradio.com/infoTag')
                    ->setLastModificationDate(Carbon::now())
                    ->setChangeFrequency('daily')
                    ->setPriority(0.9)
            )
            // ->add(Url::create('https://ardanradio.com/info-detail')
            //     ->setLastModificationDate(Carbon::now())
            //     ->setChangeFrequency('daily')
            //     ->setPriority(0.9)
            // )
            ->add(
                Url::create('https://ardanradio.com/event')
                    ->setLastModificationDate(Carbon::now()->subWeek())
                    ->setChangeFrequency('monthly')
                    ->setPriority(0.6)
            )
            // ->add(Url::create('https://ardanradio.com/detail-event')
            //     ->setLastModificationDate(Carbon::now()->subWeek())
            //     ->setChangeFrequency('monthly')
            //     ->setPriority(0.6)
            // )
            ->add(
                Url::create('https://ardanradio.com/podcast')
                    ->setLastModificationDate(Carbon::now()->subDays(3))
                    ->setChangeFrequency('weekly')
                    ->setPriority(0.7)
            );
        // ->add(Url::create('https://ardanradio.com/detail-podcast')
        //     ->setLastModificationDate(Carbon::now()->subDays(3))
        //     ->setChangeFrequency('weekly')
        //     ->setPriority(0.7)
        // )
        // ->add(Url::create('https://ardanradio.com/detail-program')
        //     ->setLastModificationDate(Carbon::now()->subDays(3))
        //     ->setChangeFrequency('weekly')
        //     ->setPriority(0.7)
        // );

        $sitemap->writeToDisk('public', 'sitemap.xml');

        return response()->json(['message' => 'Sitemap berhasil dibuat!']);
    }
}
