@extends('layout.main')

@section('title', \App\Helpers\Settings::get('site_title', 'Default Site Title'))

@push('meta-seo')
    <meta name="description" content="{{ \App\Helpers\Settings::get('site_description', 'Default Site Title') }}">
    <meta name="keyword" content="{{ \App\Helpers\Settings::get('site_keyword', 'Default Site Title') }}">
@endpush

@push('Style.css')
    <link rel="stylesheet" href="{{ asset('css/StyleContent/home.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('css/ResponsiveStyle/responsiveHome.css?v=' . time()) }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endpush

<style>
    @media (width: 2560px) {

        .card-A .card-body,
        .video-container,
        .videoPlayer-dimensions.vjs-fluid:not(.vjs-audio-only-mode) {
            all: unset;
            /* Reset semua gaya */
        }

        .card-A .card-body {
            height: 680px !important;
        }

        .video-container {
            position: relative;
            height: 680px !important;
            overflow: hidden;
            width: 100%;
            background-color: rgb(0, 0, 0);
        }

        .videoPlayer-dimensions.vjs-fluid:not(.vjs-audio-only-mode) {
            padding-top: 680px !important;
        }

    }
</style>

@livewireStyles
@section('content')
    {{-- @if ($banner->where('position', 'top')->count() > 0) --}}
    <section class="section-banner {{ $banner->where('position', 'top')->count() > 0 ? '' : 'hidden' }}">
        <div class="area-banner">
            <swiper-container class="mySwiper" id="swiper-xl" centered-slides="true" autoplay-delay="2000"
                autoplay-disable-on-interaction="false" loop="true">
                @foreach ($banner->where('position', 'top') as $list)
                    <swiper-slide> <a class="link-ads-banner" href="{{ $list->link_ads }}">
                            <img class="image-banner" src="{{ asset('storage/' . $list->image_banner) }}" alt=""
                                loading="lazy">
                        </a></swiper-slide>
                @endforeach
            </swiper-container>
        </div>
    </section>
    {{-- @endif --}}
    <section class="page-1" id="home">
        <div class="area-streaming">
            <div class="header-streaming">
                {{-- <h1 class="title-streaming">ON AIR</h1> --}}
                <img src="../image/giphy.gif" alt="GIF Image" width="140" height="140">
                {{-- <p><a href="https://giphy.com/stickers/RTLNL-transparent-A2cYA4qIR4XasAYORu">via GIPHY</a></p> --}}
            </div>
            <div class="content-streaming">
                <p id="setPlayer" style="display: none">{{ $activePlayer->active_player }}</p>
                <div class="contentS-kiri">
                    {{-- @foreach ($stream as $streamList) --}}
                    <div class="card-A">
                        <div class="card-body">
                            <img class="image-streaming" id="thumbnail-stream" src="">
                            <div class="btn-play-streaming" id="BtnStream" data-audio-src="{{ $streamAudio->stream_url }}">
                                <span class="material-symbols-rounded">play_arrow</span>
                            </div>

                            <!-- Ganti dengan MediaElement.js -->
                            {{-- <audio class="audio-streaming" id="audio-streaming" preload="auto" crossorigin="anonymous">
                                    <source type="audio/mpeg" src="{{ $streamList->stream_audio_url }}" />
                                </audio> --}}
                            {{-- <livewire:audio-player /> --}}
                        </div>
                        <div class="card-header">
                            <div class="view" id="btn-tonton">
                                <p class="text-watchS">Watch <i class='bx bx-video'></i></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-B">
                        <div class="card-body-B">
                            <div class="video-container">
                                <!-- Video.js Player -->
                                <!--@if (!empty($streamVideo->stream_url))
    -->
                                <!--    <video id="videoPlayer" class="video-js" controls preload="auto"-->
                                <!--        poster="./storage/{{ $streamVideo->image_stream }}" data-setup='{"fluid": true}'>-->
                                <!--        <source src="{{ $streamVideo->stream_url }}" type="application/x-mpegURL" />-->
                                <!--    </video>-->
                            <!--@else-->
                                <!--    <p>Streaming URL tidak tersedia.</p>-->
                                <!--
    @endif-->
                                <!--<video id="videoPlayer" class="video-js vjs-default-skin" controls width="640"-->
                                <!--    height="360" data-setup='{}' preload="metadata" autoplay>-->
                                <!-- Format HLS untuk stream -->
                                <!--    <source src="{{ $streamVideo->stream_url }}" type="application/x-mpegURL">-->
                                <!-- HLS stream -->
                                <!--    <p class="vjs-no-js">Untuk melihat video ini, aktifkan JavaScript atau gunakan browser-->
                                <!--        lain yang mendukung HTML5.</p>-->
                                <!--</video>-->
                                <!--<div style="position:relative;width:100%;overflow:hidden;padding-top:56.25%"> <iframe style="position:absolute;top:0;left:0;bottom:0;right:0;width:100%;height:100%;border:none" allow="autoplay; fullscreen" webkitallowfullscreen mozallowfullscreen allowfullscreen src="https://player.dyntube.com/live-embeds/live_ecded70ec571fa120245" title="Ardan+"></iframe><script src="https://embed.dyntube.com/v2/player/player.js"></script></div>-->
                                <div class="player-stream" id="player" data-link="{{ $streamVideo->stream_url }}"
                                    data-poster="./storage/{{ $streamVideo->image_stream }}"></div>
                                <!--<iframe src="https://live.ardangroup.fm/8265b4b5-8536-43f2-b799-6ae6a55dafc6.html" width="640" height="360" frameborder="no" scrolling="no" allowfullscreen="true"></iframe>-->
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="view-B">
                                <p class="text-watchS-B">Hear <i class='bx bx-microphone'></i></p>
                            </div>
                        </div>
                    </div>
                    {{-- @endforeach --}}
                </div>
                {{-- <div class="contentS-kanan">
                    <div class="area-nextP">
                        <div class="area-title-detail">
                            <div class="area-title-nextP">
                                <p class="title-nextP">Next Program</p>
                            </div>
                        </div>
                        <div class="area-thumbnail-nextP">
                            <img class="image-stream-upcoming" id="program-image" src="" alt="">
                        </div>
                    </div>
                </div> --}}
                <div class="contentS-kanan">
                    {{-- @if ($streamUpcoming)
                        @foreach ($streamUpcoming as $streamUpcomingList) --}}
                    {{-- <div class="area-nextP">
                        <div class="area-title-nextP">
                            <p class="title-nextP"> Next Program</p>
                        </div>
                        <div class="area-thumbnail-nextP">
                            <img class="image-stream-upcoming" id="program-image" src="" alt="">
                        </div>
                    </div> --}}
                    <div class="area-content-program">
                        <swiper-container class="area-content-box-program" loop="true" autoplay-delay="2500"
                            autoplay-disable-on-interaction="false"
                            breakpoints='{
                                "480": { "slidesPerView": 1 },
                                "768": { "slidesPerView": 1 },
                                "1024": { "slidesPerView": 1 },
                                "1280": { "slidesPerView": 1 },
                                "2560": { "slidesPerView" : 1}
                            }'>
                            @foreach ($program as $programList)
                                <swiper-slide class="box-program" data-title="{{ $programList->judul_program }}"
                                    data-description="{{ $programList->deskripsi_pendek }}"
                                    data-time="{{ $programList->jam_mulai }} - {{ $programList->jam_selesai }}"
                                    data-slugP="{{ $programList->slug }}"
                                    data-deskP="{{ $programList->deskripsi_program }}" onclick="showPopup(this)">
                                    {{-- <div class="container-program">
                                        <div class="area-header-desk-program">
                                            <span class="title-box-program">{{ $programList->judul_program }}</span>
                                        </div>
                                        <div class="area-time-desk-program">
                                            <span class="jam-program">{{ $programList->jam_mulai }} -
                                                {{ $programList->jam_selesai }}</span>
                                        </div>
                                    </div> --}}
                                    <img class="image-program" src="./storage/{{ $programList->image_program }}"
                                        alt="">
                                </swiper-slide>
                            @endforeach
                        </swiper-container>
                    </div>
                    {{-- @endforeach
                    @else
                    @endif --}}
                    <div id="popup" class="popup" style="display: none;" onclick="closePopupOutside(event)">
                        <div class="popup-content">
                            <span class="close" onclick="closePopup()">&times;</span>
                            <div class="area-info-program">
                                <p class="desk-program">Program Description</p> <!-- Pastikan elemen ini ada -->
                                <h2 class="title-box-program">Program Title</h2> <!-- Pastikan elemen ini ada -->
                                <p class="jam-program">Program Time</p> <!-- Pastikan elemen ini ada -->
                                <a href="#" class="detail-link-program">
                                    <p class="link-program">See detail</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="page-3" id="info-news">
        <div class="area-info-news">
            <div class="line-info"></div>
            <div class="area-content-info-news">
                <div class="area-content-news">
                    <div class="area-top-info">
                        <div class="header-top-info">
                            <h1 class="title-top-info">Top Info</h1>
                        </div>
                        <div class="content-top-info">
                            @foreach ($top_info as $topInfoList)
                                <a class="link-box-top-info" href="/infoNews/{{ $topInfoList->slug }}">
                                    <div class="box-top-info">
                                        <div class="area-image-top-info">
                                            <img class="image-top-info" src="./storage/{{ $topInfoList->image_info }}"
                                                alt="">
                                        </div>
                                        <div class="line-top-info"></div>
                                        <div class="area-text-desk-top-info">
                                            <div class="area-date">
                                                <p class="date-top-info">
                                                    {{ \Carbon\Carbon::parse($topInfoList->date_info)->translatedFormat('l, d F Y') }}
                                                </p>
                                            </div>
                                            <div class="area-text">
                                                <p class="desk-top-info">{{ $topInfoList->judul_info }}</p>
                                            </div>
                                            <div class="area-tag">
                                                <p class="tag-top-info">{{ $topInfoList->tagInfo->nama_kategori }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="header-news">
                        <h1 class="title-news">Info</h1>
                        <a class="link-see-all-news" href="">
                            <span class="see-all-news">See All <i class='bx bx-right-arrow-alt'></i></span>
                        </a>
                    </div>
                    <div class="content-news">
                        @foreach ($info as $InfoList)
                            <a class="link-box-news" href="/infoNews/{{ $InfoList->slug }}">
                                <div class="box-news">
                                    <div class="area-image">
                                        <img class="image-info" src="./storage/{{ $InfoList->image_info }}"
                                            alt="">
                                    </div>
                                    <div class="area-text-desk">
                                        <div class="area-date">
                                            <p class="date-news">
                                                {{ \Carbon\Carbon::parse($InfoList->date_info)->translatedFormat('l, d F Y') }}
                                            </p>
                                        </div>
                                        <div class="area-text">
                                            <p class="desk-news">{{ $InfoList->judul_info }}</p>
                                        </div>
                                        <div class="area-tag">
                                            <p class="tag-news">{{ $InfoList->tagInfo->nama_kategori }}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                </div>
                <div class="area-content-info">
                    <div class="area-trending-info">
                        <div class="header-trending-info">
                            <h1 class="title-trending-info">Trending Info</h1>
                        </div>
                        <div class="content-trending-info">
                            @foreach ($trending_info as $trendingInfoList)
                                <a class="link-box-trending-info" href="/infoNews/{{ $trendingInfoList->slug }}">
                                    <div class="box-trending-info">
                                        <div class="area-image-trending-info">
                                            <img class="image-trending-info"
                                                src="./storage/{{ $trendingInfoList->image_info }}" alt="">
                                        </div>
                                        <div class="line-trending-info"></div>
                                        <div class="area-text-desk-trending-info">
                                            <div class="area-date">
                                                <p class="date-trending-info">
                                                    {{ \Carbon\Carbon::parse($trendingInfoList->date_info)->translatedFormat('l, d F Y') }}
                                                </p>
                                            </div>
                                            <div class="area-text">
                                                <p class="desk-trending-info">{{ $trendingInfoList->judul_info }}</p>
                                            </div>
                                            <div class="area-tag">
                                                <p class="tag-trending-info">
                                                    {{ $trendingInfoList->tagInfo->nama_kategori }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="area-kategori-info">
                        <div class="header-info">
                            <h1 class="title-info">Kategori Info</h1>
                        </div>
                        <div class="content-info">
                            @foreach ($kategoriInfo as $kategoriInfoList)
                            <a class="link-kat-info" href="/infoTag/{{ $kategoriInfoList->nama_kategori }}">
                                <div class="box-info">
                                        <div class="area-tag-info">

                                            <h3 class="tag-info">#{{ $kategoriInfoList->nama_kategori }}</h3>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="area-bottom-info">
                            <div class="box-title-bottom">
                                <a href="/info-news">
                                    {{-- <span class="see-all-news">See All </span> --}}
                                    <span class="title-bottom-info">Show more <i class='bx bx-right-arrow-alt'></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <section class="page-2" id="program">
        <div class="area-program">
            <div class="area-header-program">
                <h1 class="title-program">PROGRAM</h1>
            </div>
            <div class="area-content-program">
                <swiper-container class="area-content-box-program" loop="true" autoplay-delay="2500"
                    autoplay-disable-on-interaction="false"
                    breakpoints='{
                        "480": { "slidesPerView": 1 },
                        "768": { "slidesPerView": 2 },
                        "1024": { "slidesPerView": 3 },
                        "1280": { "slidesPerView": 4 },
                        "2560": { "slidesPerView" : 4}
                    }'
                    space-between="20">
                    @foreach ($program as $programList)
                        <swiper-slide class="box-program" data-title="{{ $programList->judul_program }}"
                            data-description="{{ $programList->deskripsi_pendek }}"
                            data-time="{{ $programList->jam_mulai }} - {{ $programList->jam_selesai }}"
                            data-slugP="{{ $programList->slug }}" data-deskP="{{ $programList->deskripsi_program }}"
                            onclick="showPopup(this)">
                            <img class="image-program" src="./storage/{{ $programList->image_program }}" alt="">
                        </swiper-slide>
                    @endforeach
                </swiper-container>
            </div>
        </div>
        <div id="popup" class="popup" style="display: none;" onclick="closePopupOutside(event)">
            <div class="popup-content">
                <span class="close" onclick="closePopup()">&times;</span>
                <div class="area-info-program">
                    <p class="desk-program">Program Description</p> <!-- Pastikan elemen ini ada -->
                    <h2 class="title-box-program">Program Title</h2> <!-- Pastikan elemen ini ada -->
                    <p class="jam-program">Program Time</p> <!-- Pastikan elemen ini ada -->
                    <a href="#" class="detail-link-program">
                        <p class="link-program">See detail</p>
                    </a>
                </div>
            </div>
        </div>
    </section> --}}

    <!--<section class="page-ig-twitter" id="ig-twitter">-->
    <!--    <div class="area-ig-twitter">-->
    <!--        <div class="line-ig-twitter"></div>-->
    <!--        <div class="area-content-ig-twitter">-->
    <!--            <div class="area-content-feed-instagram">-->
    <!--                <div class="header-feed-instagram">-->
    <!--                    <h1 class="title-feed-instagram">Instagram</h1>-->
    <!--                </div>-->
    <!--                <div class="content-feed-instagram">-->
    <!--                    {{-- <div class="area-tombol">-->
    <!--                        <div class="tombol-kiri"></div>-->
    <!--                        <div class="tombol-kanan"></div>-->
    <!--                    </div> --}}-->
    <!--                    <swiper-container class="area-content-box-feed-instagram" loop="true" autoplay-delay="2500"-->
    <!--                        autoplay-disable-on-interaction="false"-->
    <!--                        breakpoints='{-->
    <!--                                "480": { "slidesPerView": 1 },-->
    <!--                                "768": { "slidesPerView": 3 },-->
    <!--                                "1024": { "slidesPerView": 3 },-->
    <!--                                "1280": { "slidesPerView": 4 },-->
    <!--                                "2560": { "slidesPerView" : 4}-->
    <!--                            }'-->
    <!--                        space-between="20">-->
    <!--                        <swiper-slide class="box-feed-instagram" data-title="" data-description="" data-time=""-->
    <!--                            onclick="showPopupFeed(this)">-->
    <!--                        </swiper-slide>-->
    <!--                        <swiper-slide class="box-feed-instagram" data-title="" data-description="" data-time=""-->
    <!--                            onclick="showPopupFeed(this)">-->
    <!--                        </swiper-slide>-->
    <!--                        <swiper-slide class="box-feed-instagram" data-title="" data-description="" data-time=""-->
    <!--                            onclick="showPopupFeed(this)">-->
    <!--                        </swiper-slide>-->
    <!--                        <swiper-slide class="box-feed-instagram" data-title="" data-description="" data-time=""-->
    <!--                            onclick="showPopupFeed(this)">-->
    <!--                        </swiper-slide>-->
    <!--                        <swiper-slide class="box-feed-instagram" data-title="" data-description="" data-time=""-->
    <!--                            onclick="showPopupFeed(this)">-->
    <!--                        </swiper-slide>-->
    <!--                        <swiper-slide class="box-feed-instagram" data-title="" data-description="" data-time=""-->
    <!--                            onclick="showPopupFeed(this)">-->
    <!--                        </swiper-slide>-->
    <!--                        <swiper-slide class="box-feed-instagram" data-title="" data-description="" data-time=""-->
    <!--                            onclick="showPopupFeed(this)">-->
    <!--                        </swiper-slide>-->
    <!--                    </swiper-container>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div id="popupFeed" class="popup-feed" style="display: none;" onclick="closePopupOutsideFeed(event)">-->
    <!--                <div class="popup-content-feed">-->
    <!--                    <span class="close" onclick="closePopupFeed()">&times;</span>-->
    <!--                    <div class="area-info-feed">-->

    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="area-content-twitter">-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->

    <section class="page-4" id="event">
        <div class="area-event">
            <div class="line-event"></div>
            <div class="area-content-event">
                <div class="area-group-event">
                    <div class="header-event">
                        <h1 class="title-event">EVENT</h1>
                    </div>
                    <div class="area-content-groupE">
                        <div class="area-content-event-kiri">
                            @foreach ($event_soon as $eventSoonList)
                                <div class="content-event-CD" onclick="showPopupEvent(this)"
                                    data-description="{{ $eventSoonList->deskripsi_pendek }}"
                                    data-date="{{ \Carbon\Carbon::parse($eventSoonList->date_event)->format('d F Y') }}"
                                    {{-- style="background-image: url('./storage/{{ $eventSoonList->image_event }}')" --}}
                                    data-slug="{{ $eventSoonList->slug }}"
                                    data-deskShort="{{ $eventSoonList->deskripsi_event }}">
                                    <div class="area-days-date">
                                        <div class="box-days-date">
                                            <h3 class="date-month">
                                                {{ \Carbon\Carbon::parse($eventSoonList->date_event)->format('d F Y') }}
                                            </h3>
                                        </div>
                                    </div>
                                    <span id="dataTime"
                                        style="display: none">{{ $eventSoonList->time_countdown }}</span>
                                    <img class="image-CD" src="./storage/{{ $eventSoonList->image_event }}"
                                        alt="">
                                    <div class="area-countdown">
                                        <div class="countdown">
                                            <div class="time-countdown">
                                                <h2 class="timer" id="days"></h2>
                                                <span class="title-timer">Days</span>
                                            </div>
                                            <div class="time-countdown">
                                                <h2 class="timer" id="hours"></h2>
                                                <span class="title-timer">Hours</span>
                                            </div>
                                            <div class="time-countdown">
                                                <h2 class="timer" id="minutes"></h2>
                                                <span class="title-timer">Minutes</span>
                                            </div>
                                            <div class="time-countdown">
                                                <h2 class="timer" id="seconds"></h2>
                                                <span class="title-timer">Second</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="area-content-event-kanan">
                            <swiper-container class="area-box-content-event-kanan" loop="true" autoplay-delay="2500"
                                autoplay-disable-on-interaction="false"
                                breakpoints='{
                                    "480": { "slidesPerView": 1 },
                                    "768": { "slidesPerView": 1 },
                                    "1024": { "slidesPerView": 1 },
                                    "1280": { "slidesPerView": 1 },
                                    "2560": { "slidesPerView" : 1}
                                }'
                                space-between="20">
                                @foreach ($event_upcoming as $eventUpcomingList)
                                    <swiper-slide class="content-event"
                                        onclick="showPopupEvent(this)"
                                        data-description="{{ $eventUpcomingList->deskripsi_pendek }}"
                                        data-date="{{ \Carbon\Carbon::parse($eventUpcomingList->date_event)->format('d F Y') }}"
                                        data-slug="{{ $eventUpcomingList->slug }}"
                                        data-deskShort="{{ $eventUpcomingList->deskripsi_event }}">
                                        <img class="image-UC" src="./storage/{{ $eventUpcomingList->image_event }}" alt="" srcset="">
                                        <div class="area-days-date-right">
                                            <div class="content-days-date-right">
                                                <div class="box-days-date-right">
                                                    <h3 class="date-month-right">
                                                        {{ \Carbon\Carbon::parse($eventUpcomingList->date_event)->format('d F Y') }}
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </swiper-slide>
                                @endforeach
                            </swiper-container>

                            <div id="popupEvent" class="popup-event" onclick="closePopupOutsideEvent(event)">
                                <div class="popup-content-event">
                                    <div class="area-info-event">
                                        <p class="desk-event"></p>
                                        <h2 class="title-box-event"></h2>
                                        <a href="#" class="detail-link">
                                            <p class="link-event">See detail</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="page-5" id="podcast-video">
        <div class="area-podcast-video">
            <div class="area-content-PV">
                <div class="area-content-podcast">
                    <div class="header-podcast">
                        <div class="area-title-podcast">
                            <h1 class="title-podcast">Podcast</h1>
                            {{-- <img class="logo-podcast" src="image/podcast.png" alt=""> --}}
                        </div>
                        <div class="area-text-podcast">
                            <a href="/podcast">
                                <h1 class="text-podcast">Other podcast <i class='bx bx-right-arrow-alt'></i></h1>
                            </a>
                        </div>
                    </div>
                    <div class="content-podcast">
                        @foreach ($podcast as $podcastList)
                            <div class="card-podcast" data-slug="{{ $podcastList->slug }}">
                                <div class="card-body-podcast">
                                    <a class="link-podcast" href="/podcast/{{ $podcastList->slug }}">
                                        <div class="card-image-podcast">
                                            <img src="./storage/{{ $podcastList->image_podcast }}" alt=""
                                            class="image-podcast">
                                        </div>
                                        <div class="head-body-podcast">
                                            <div class="area-card-text">
                                                <h1 class="card-text-podcast">{{ $podcastList->judul_podcast }}</h1>
                                            </div>
                                            <div class="genre">
                                                @if (is_array($podcastList->genre_podcast))
                                                    @foreach ($podcastList->genre_podcast as $genre)
                                                        <h1 class="title-genre">{{ $genre }}</h1>
                                                    @endforeach
                                                @else
                                                    <h1 class="title-genre">-</h1>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                {{-- <div class="card-header-podcast">
                                    <div class="author-podcast">
                                    </div>
                                    <a class="link-podcast" href="/detail-podcast/{{ $podcastList->slug }}">
                                        <div class="view-podcast">
                                            <p class="text-watch-podcast">View Podcast</p>
                                        </div>
                                    </a>
                                </div> --}}
                            </div>
                        @endforeach
                    </div>
                </div>
                {{-- <div class="line-PV"></div> --}}
                
            </div>
        </div>
    </section>
    {{-- --}}
    {{-- <br> --}}
    <section class="page-6" id="announcer">
        <div class="area-announcer">
            {{-- <div class="area-svg">
                <!-- SVG default untuk media lebih dari 1024px -->
                <svg class="svg-large" width="434" height="667" viewBox="0 0 434 667" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5015 596.014L17.5015 46.9919" stroke="#FFDB00" stroke-width="35"
                        stroke-linecap="round" />
                    <path d="M68.0015 610L67.5265 18.0004" stroke="#FFDB00" stroke-width="35" stroke-linecap="round" />
                    <path d="M123.501 604.001L123.501 64.0012" stroke="#FFDB00" stroke-width="35"
                        stroke-linecap="round" />
                    <path d="M181.001 627.003L181.001 47.0032" stroke="#FFDB00" stroke-width="35"
                        stroke-linecap="round" />
                    <path d="M251.255 590L251.255 27.0034" stroke="#FFDB00" stroke-width="35" stroke-linecap="round" />
                    <path d="M309.001 616L309.001 47.0005" stroke="#FFDB00" stroke-width="35" stroke-linecap="round" />
                    <path d="M371.001 649L371.001 62.0005" stroke="#FFDB00" stroke-width="35" stroke-linecap="round" />
                    <path d="M415.533 610.001L415.533 81.9948" stroke="#FFDB00" stroke-width="35"
                        stroke-linecap="round" />
                </svg>

                <!-- SVG untuk media dengan ukuran 1024px atau kurang -->
                <svg class="svg-small" width="332" height="510" viewBox="0 0 332 510" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 455.526L14 36.1455" stroke="#FFDB00" stroke-width="26.7353" stroke-linecap="round" />
                    <path d="M52.5752 466.209L52.2124 14" stroke="#FFDB00" stroke-width="26.7353"
                        stroke-linecap="round" />
                    <path d="M94.9697 461.626L94.9697 49.1384" stroke="#FFDB00" stroke-width="26.7353"
                        stroke-linecap="round" />
                    <path d="M138.892 479.197L138.892 36.1542" stroke="#FFDB00" stroke-width="26.7353"
                        stroke-linecap="round" />
                    <path d="M192.557 450.932V20.8771" stroke="#FFDB00" stroke-width="26.7353" stroke-linecap="round" />
                    <path d="M236.667 470.792L236.667 36.1521" stroke="#FFDB00" stroke-width="26.7353"
                        stroke-linecap="round" />
                    <path d="M284.027 496L284.027 47.6102" stroke="#FFDB00" stroke-width="26.7353"
                        stroke-linecap="round" />
                    <path d="M318.043 466.209L318.043 62.8831" stroke="#FFDB00" stroke-width="26.7353"
                        stroke-linecap="round" />
                </svg>

                <svg class="svg-small-mobile" width="259" height="452" viewBox="0 0 259 452" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 404.892L11 30.7564" stroke="#FFDB00" stroke-width="20.8121" stroke-linecap="round" />
                    <path d="M41.0288 414.423L40.7464 10.9999" stroke="#FFDB00" stroke-width="20.8121"
                        stroke-linecap="round" />
                    <path d="M74.0308 410.335L74.0308 42.3475" stroke="#FFDB00" stroke-width="20.8121"
                        stroke-linecap="round" />
                    <path d="M108.222 426.01L108.222 30.7641" stroke="#FFDB00" stroke-width="20.8121"
                        stroke-linecap="round" />
                    <path d="M149.998 400.794V17.1352" stroke="#FFDB00" stroke-width="20.8121" stroke-linecap="round" />
                    <path d="M184.335 418.512L184.335 30.7623" stroke="#FFDB00" stroke-width="20.8121"
                        stroke-linecap="round" />
                    <path d="M221.203 441L221.203 40.9842" stroke="#FFDB00" stroke-width="20.8121"
                        stroke-linecap="round" />
                    <path d="M247.683 414.423L247.683 54.6094" stroke="#FFDB00" stroke-width="20.8121"
                        stroke-linecap="round" />
                </svg>
            </div> --}}
            <div class="area-content-announcer">
                {{-- <img class="logo-announcer" src="image/micAnnouncer.png" alt=""> --}}
                <div class="header-announcer">
                    <h1 class="title-announcer">Announcer</h1>
                </div>
                <div class="content-announcer">
                    {{-- <div class="area-tombol-announcer">
                        <div class="tombol-kiri-announcer"></div>
                        <div class="tombol-kanan-announcer"></div>
                    </div> --}}
                    <swiper-container class="area-content-box-announcer" loop="true" autoplay-delay="2500"
                        autoplay-disable-on-interaction="false"
                        breakpoints='{
                        "320": { "slidesPerView": 1 },
                        "375": { "slidesPerView": 1 },
                        "390": { "slidesPerView": 2 },
                        "425": { "slidesPerView": 2 },
                        "480": { "slidesPerView": 2 },
                        "768": { "slidesPerView": 3 },
                        "1024": { "slidesPerView": 4 },
                        "1280": { "slidesPerView": 5 },
                        "1960": { "slidesPerView": 5 },
                        "2560": { "slidesPerView" : 5}
                    }'
                        space-between="20">
                        @foreach ($announcer as $announcerList)
                            <swiper-slide class="box-announcer" data-bio="{{ strip_tags($announcerList->bio) }}"
                                data-image="./storage/{{ $announcerList->image_announcer }}"
                                data-name="{{ $announcerList->name_announcer }}"
                                data-ig="{{ $announcerList->link_instagram }}"
                                data-tiktok="{{ $announcerList->link_tiktok }}"
                                data-twitter="{{ $announcerList->link_twitter }}" style="background-image: url('')"
                                onclick="showPopupAnnouncer(this)
                            ">
                                <img class="image-announcer" src="./storage/{{ $announcerList->image_announcer }}"
                                    alt="">
                                <div class="area-profile-announcer">
                                    {{-- @if ($announcerList->link_instagram)
                                        <a href="{{ $announcerList->link_instagram }}" target="_blank">
                                            <i class='bx bxl-instagram'></i>
                                        </a>
                                    @endif

                                    @if ($announcerList->link_facebook)
                                        <a href="{{ $announcerList->link_facebook }}" target="_blank">
                                            <i class='bx bxl-facebook'></i>
                                        </a>
                                    @endif

                                    @if ($announcerList->link_twitter)
                                        <a href="{{ $announcerList->link_twitter }}" target="_blank">
                                            <i class='bx bxl-twitter'></i>
                                        </a>
                                    @endif --}}
                                    {{-- <div class="area-name-announcer"> --}}
                                    {{-- <h3 class="name-announcer">{{ $announcerList->name_announcer }}</h3> --}}
                                    {{-- </div> --}}
                                </div>
                            </swiper-slide>
                        @endforeach
                    </swiper-container>
                    <div id="popupAnnouncer" class="popup-announcer" style="display: none;"
                        onclick="closePopupOutsideAnnouncer(event)">
                        <div class="popup-content-announcer">
                            <span class="close" onclick="closePopupAnnouncer()">&times;</span>
                            <div class="area-info-announcer">
                                <div class="area-IA-kiri">
                                    <img class="popUp-image-announcer" src="" alt="">
                                </div>
                                <div class="area-IA-kanan">
                                    <div class="area-name-announcer">
                                        <h3 class="title-name-announcer">Nama :</h3>
                                        <h3 class="name-announcer"></h3>
                                    </div>
                                    <div class="area-sosmed">
                                        <h3 class="title-sosmed">Social Media :</h3>
                                        <div class="area-profile-announcer">
                                            <a href="" target="_blank" data-social="instagram">
                                                <i class='bx bxl-instagram'></i>
                                            </a>
                                            <a href="" target="_blank" data-social="tiktok">
                                                <i class='bx bxl-tiktok'></i>
                                            </a>
                                            <a href="" target="_blank" data-social="twitter">
                                                <i class='bx bxl-twitter'></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="area-bio">
                                        <h3 class="title-bio">Bio :</h3>
                                        <div class="content-bio">
                                            <p class="bio-announcer"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <section class="page-7" id="chart">
        <div class="line-announcer"></div>
        <div class="area-chart-artis">
            <div class="area-content-chart-artis">
                <div class="area-content-chart">
                    <div class="content-chart">
                        <div class="header-chart">
                            <h1 class="title-chart">CHART B RADIO</h1>
                        </div>
                        <div class="area-top-chart">
                            {{-- <div class="tab-chart active" data-tab="top-20">
                                <h3 class="text-tab">TOP 20</h3>
                            </div>
                            <div class="tab-chart" data-tab="flight-40">
                                <h3 class="text-tab">FLIGTH 40</h3>
                            </div>
                            <div class="tab-chart" data-tab="indie-7">
                                <h3 class="text-tab">INDIE 7</h3>
                            </div>
                            <div class="tab-chart" data-tab="persada-7">
                                <h3 class="text-tab">PERSADA 7</h3>
                            </div> --}}
                            @foreach ($kategori as $kategoriList)
                                <div class="tab-chart {{ $loop->first ? 'active' : '' }}"
                                    data-tab="{{ $kategoriList->id }}">
                                    <h3 class="text-tab">{{ strtoupper($kategoriList->nama_kategori) }}</h3>
                                </div>
                            @endforeach
                        </div>
                        @foreach ($kategori as $kategoriList)
                            <table class="chart {{ $loop->first ? '' : 'hidden' }}" id="{{ $kategoriList->id }}">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>ARTIST</th>
                                        <th>-</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kategoriList->charts as $index => $chart)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $chart->name }}</td>
                                            <td>
                                                <div class="btn-play-chart"
                                                    data-audio-src="./storage/{{ $chart->link_audio }}"
                                                    data-name="{{ $chart->name }}"
                                                    data-kategori="{{ $kategoriList->nama_kategori }}"
                                                    data-id="{{ $chart->id }}">
                                                    <span class="material-symbols-rounded">play_arrow</span>
                                                </div>
                                                <audio src="" id="audio-chart" class="audio-chart"></audio>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                        <div class="bottom-chart">
                            <a href="/chart">
                                <div class="area-btn-chart">
                                    <h1 class="text-btn-chart">All Chart</h1>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="area-content-video">
                    <div class="area-header-video">
                        <h1 class="title-video">B Radio Video</h1>
                    </div>
                    <div class="content-video" id="content-video">
                        @foreach ($videos as $video)
                            <div class="box-video" data-video-url="{{ $video['videoUrl'] }}">
                                <img class="video-thumbnail"
                                    src="https://img.youtube.com/vi/{{ $video['videoId'] }}/hqdefault.jpg"
                                    alt="Thumbnail">
                                <div class="btn-play-video" onclick="showPopupYT('{{ $video['videoUrl'] }}')">
                                    <span class="material-symbols-rounded">play_arrow</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="popup-player-yt" id="popup-player" style="display:none;">
                        <div class="popup-content-yt">
                            <div id="player-yt"></div>
                        </div>
                    </div>
                    <div class="link-text-video">
                        <a href="/bradioYoutube">
                            <h1 class="text-video">See more</h1>
                        </a>
                    </div>
                </div> 
            </div>
        </div>
    </section>
    <section class="section-banner {{ $banner->where('position', 'middle')->count() > 0 ? '' : 'hidden' }}">
        <div class="area-banner">
            <swiper-container class="mySwiper " id="swiper-xl-bottom" centered-slides="true" autoplay-delay="2000"
                autoplay-disable-on-interaction="false" loop="true">
                @foreach ($banner->where('position', 'middle') as $list)
                    <swiper-slide> <a class="link-ads-banner" href="{{ $list->link_ads }}">
                            <img class="image-banner" src="{{ asset('storage/' . $list->image_banner) }}" alt=""
                                loading="lazy">
                        </a></swiper-slide>
                @endforeach
            </swiper-container>
        </div>
    </section>
    <section class="page-8" id="schedule">
        <div class="area-schedule">
            <div class="area-content-schedule">
                <div class="header-schedule">
                    <h1 class="title-schedule">Schedule</h1>
                </div>
                <div class="top-content-schedule">
                    <div class="schedule" data-day="senin">
                        <p class="schedule-day">Monday</p>
                    </div>
                    <div class="schedule" data-day="selasa">
                        <p class="schedule-day">Tuesday</p>
                    </div>
                    <div class="schedule" data-day="rabu">
                        <p class="schedule-day">Wednesday</p>
                    </div>
                    <div class="schedule" data-day="kamis">
                        <p class="schedule-day">Thursday</p>
                    </div>
                    <div class="schedule" data-day="jumat">
                        <p class="schedule-day">Friday</p>
                    </div>
                    <div class="schedule" data-day="sabtu">
                        <p class="schedule-day">Saturday</p>
                    </div>
                    <div class="schedule" data-day="minggu">
                        <p class="schedule-day">Sunday</p>
                    </div>
                </div>
                <div class="content-schedule">
                    <!-- Menampilkan konten berdasarkan hari yang dipilih -->
                    @foreach ($schedule as $scheduleList)
                        @php
                            // Periksa apakah hari sudah berupa array
                            $hariArray = is_array($scheduleList->hari)
                                ? $scheduleList->hari
                                : json_decode($scheduleList->hari, true);
                        @endphp

                        <!-- Pastikan $hariArray tidak kosong sebelum menampilkan konten -->
                        @if ($hariArray)
                            @foreach ($hariArray as $day)
                                <div class="box-schedule hidden" data-day="{{ strtolower($day) }}">
                                    <img class="image-schedule-program"
                                        src="./storage/{{ $scheduleList->program->image_program }}" alt="">
                                    <div class="area-bio-schedule">
                                        <div class="bio-schedule">
                                            <h4 class="nama-programS">{{ $scheduleList->program->judul_program }}</h4>
                                            <p class="jam-programS">Jam: {{ $scheduleList->jam_mulai }} -
                                                {{ $scheduleList->jam_selesai }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="top-content-schedule-mobile">
                <button id="prevDay" class="nav-button"><i class='bx bx-chevron-left'></i></button>
                <p id="currentDay" class="schedule-day-mobile"></p>
                <button id="nextDay" class="nav-button"><i class='bx bx-chevron-right'></i></i></button>
            </div>
            <div class="content-schedule-mobile">
                @foreach ($schedule as $scheduleList)
                    @php
                        // Periksa apakah hari sudah berupa array
                        $hariArray = is_array($scheduleList->hari)
                            ? $scheduleList->hari
                            : json_decode($scheduleList->hari, true);
                    @endphp

                    <!-- Pastikan $hariArray tidak kosong sebelum menampilkan konten -->
                    @if ($hariArray)
                        @foreach ($hariArray as $day)
                            <div class="box-schedule-mobile hidden" data-day="{{ strtolower($day) }}">
                                <img class="image-schedule-program"
                                    src="./storage/{{ $scheduleList->program->image_program }}" alt="">
                                <div class="area-bio-schedule">
                                    <div class="bio-schedule">
                                        <h4 class="nama-programS">{{ $scheduleList->program->judul_program }}</h4>
                                        <p class="jam-programS">Jam: {{ $scheduleList->jam_mulai }} -
                                            {{ $scheduleList->jam_selesai }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <br>

    {{-- audio player --}}
    {{-- <div class="audio-player-container">
        <svg id="visual" viewBox="0 0 900 600" width="1200" height="600" xmlns="http://www.w3.org/2000/svg">
            <path id="layer1" fill="#FF004D" stroke="#FF004D" stroke-width="2" stroke-linecap="round"></path>
        </svg>
        <div class="content">
            <div class="control-btn">
                <!-- <span class="material-symbols-rounded" id="repeat">repeat</span> -->
                <span class="material-symbols-rounded" id="prev">skip_previous</span>
                <div class="play-pause" id="play-pause">
                    <span class="btn-play material-symbols-rounded">play_arrow</span>
                </div>
                <span class="material-symbols-rounded" id="next">skip_next</span>
                <!-- <span class="material-symbols-rounded" id="shuffle">shuffle</span> -->
            </div>
            <div class="image-wrapper">
                <div class="music-image">
                    <img src="images/img1.jpg" />
                </div>
            </div>
            <div class="music-titles">
                <p class="name">Title music</p>
                <p class="artist">Titke music</p>
            </div>
            <div class="area-line">
                <div class="progress-details">
                    <div class="progress-bar">
                        <span></span>
                    </div>
                    <!-- <div class="time">
                                            <span class="current">0:00</span>
                                            <span class="final">5:30</span>
                                          </div> -->
                </div>
            </div>
            <div class="music-titles">
                <p class="name">Hamburger area</p>
            </div>
        </div>

        <audio src="music/music1.mp3" class="main-song" id="audio"></audio>
    </div> --}}
    {{-- ------- --}}
    {{-- <script src="js/playlist.js"></script> --}}
    @livewireScripts
    <script src="{{ asset('js/home.js?v=' . time()) }}"></script>
    <script src="{{ asset('js/playerjs.js?v=' . time()) }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-BHYYVVYF3D"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-BHYYVVYF3D');
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const playerElement = document.getElementById("player");
            const streamURL = playerElement.getAttribute("data-link");
            const imageStream = playerElement.getAttribute("data-poster");

            window.player = new Playerjs({
                id: "player",
                file: streamURL,
                poster: imageStream,
            });

            document.getElementById("videoPlayer").addEventListener("contextmenu", function(e) {
                e.preventDefault(); // Mencegah menu klik kanan muncul
            });


            // Menambahkan event listener 'play' ke player untuk melacak saat video mulai diputar
            player.on('play', function() {
                // Kirim event ke Google Analytics saat video diputar
                gtag('event', 'play', {
                    'event_category': 'Video',
                    'event_label': 'Video Play', // Label yang bisa disesuaikan
                    'value': 1
                });
                console.log("Video Play event tracked in Google Analytics");
            });


            // Pilih semua elemen dengan class "card-podcast"
            const podcastCards = document.querySelectorAll(".card-podcast");

            podcastCards.forEach((card) => {
                card.addEventListener("click", () => {
                    // Ambil slug dari atribut data-slug
                    const slug = card.getAttribute("data-slug");

                    if (slug) {
                        // Redirect user ke halaman detail podcast sesuai slug
                        window.location.href = `/detail-podcast/${slug}`;
                    }
                });
            });

            // var player = videojs("videoPlayer", {
            //     controls: true,
            //     autoplay: false,
            //     preload: "auto",
            //     fluid: true, // Membuat player fleksibel mengikuti ukuran kontainer
            //     aspectRatio: "16:9", // Rasio aspek untuk menjaga proporsi
            //     responsive: true,
            // });

            // let userInteracted = false; // Flag untuk memastikan interaksi pengguna pertama kali
            // let isManualPiPActive = false; // Flag untuk melacak jika PiP diaktifkan secara manual

            // // Deteksi apakah perangkat adalah iOS
            // const isIOS = /iPhone|iPad|iPod/.test(navigator.userAgent) && !window.MSStream;

            // // Fungsi untuk mengecek apakah elemen terlihat di viewport
            // function isElementInViewport(el) {
            //     if (!el) return false;
            //     const rect = el.getBoundingClientRect();
            //     return rect.top >= 0 && rect.bottom <= window.innerHeight;
            // }

            // // Fungsi untuk mengaktifkan PiP jika video tidak terlihat dan PiP belum aktif
            // async function activatePiPIfNeeded() {
            //     const videoElement = player.el().querySelector('video'); // Dapatkan elemen video dari player
            //     if (!videoElement) {
            //         console.error("Video element tidak ditemukan");
            //         return; // Keluar jika video element tidak ditemukan
            //     }

            //     // Jika perangkat adalah iOS, tidak mengaktifkan PiP otomatis
            //     if (isIOS) {
            //         console.log("PiP otomatis tidak didukung di iOS");
            //         return;
            //     }

            //     // Pastikan interaksi pengguna sudah terjadi, PiP belum aktif secara manual, dan video tidak terlihat
            //     if (
            //         userInteracted &&
            //         !isManualPiPActive &&
            //         !document.pictureInPictureElement &&
            //         !isElementInViewport(videoElement)
            //     ) {
            //         if (!videoElement.paused) {
            //             try {
            //                 await videoElement.requestPictureInPicture();
            //                 console.log("PiP diaktifkan otomatis");
            //             } catch (err) {
            //                 console.error("Gagal mengaktifkan PiP:", err);
            //             }
            //         }
            //     }
            // }

            // // Fungsi untuk keluar dari PiP jika video kembali terlihat
            // async function exitPiPIfNeeded() {
            //     const videoElement = player.el().querySelector('video'); // Dapatkan elemen video dari player
            //     if (document.pictureInPictureElement && videoElement && isElementInViewport(videoElement)) {
            //         try {
            //             await document.exitPictureInPicture();
            //             console.log("Keluar dari PiP");
            //         } catch (err) {
            //             console.error("Gagal keluar dari PiP:", err);
            //         }
            //     }
            // }

            // // Fungsi untuk menangani interaksi pengguna pertama kali
            // function handleUserInteraction() {
            //     if (!userInteracted) {
            //         userInteracted = true;
            //         console.log("Interaksi pertama terdeteksi");
            //     }
            // }

            // // Fungsi untuk menangani event Picture-in-Picture
            // function handlePiPEvents(videoElement) {
            //     videoElement.addEventListener("enterpictureinpicture", () => {
            //         isManualPiPActive = true; // Menandai bahwa PiP diaktifkan secara manual
            //         console.log("PiP diaktifkan secara manual");
            //     });

            //     videoElement.addEventListener("leavepictureinpicture", () => {
            //         isManualPiPActive = false; // Menandai bahwa PiP tidak lagi aktif secara manual
            //         console.log("PiP dimatikan");
            //     });
            // }

            // // Menambahkan event listener untuk interaksi pengguna pertama kali
            // player.on("play", handleUserInteraction); // Gunakan event "play" dari Video.js

            // // Menambahkan event listener untuk PiP
            // const videoElement = player.el().querySelector('video');
            // if (videoElement) {
            //     handlePiPEvents(videoElement);
            // }

            // // Panggil fungsi saat halaman dimuat, scroll, atau resize
            // document.addEventListener("DOMContentLoaded", () => {
            //     activatePiPIfNeeded(); // Pastikan PiP diaktifkan jika video tidak terlihat
            // });

            // // Event listener untuk menangani scroll dan resize
            // window.addEventListener("scroll", () => {
            //     activatePiPIfNeeded(); // Aktifkan PiP saat video tidak terlihat dan sedang diputar
            //     exitPiPIfNeeded(); // Keluar dari PiP jika video terlihat
            // });

            // window.addEventListener("resize", () => {
            //     activatePiPIfNeeded(); // Aktifkan PiP saat ukuran viewport berubah
            //     exitPiPIfNeeded(); // Keluar dari PiP jika video terlihat
            // });

            // // Tambahkan event listener untuk touch pada perangkat mobile
            // if ("ontouchstart" in window) {
            //     window.addEventListener("touchstart", () => {
            //         if (!userInteracted) {
            //             handleUserInteraction();
            //         }
            //     });
            // }




            // Tombol "Tonton Siaran"
            // tontonSiaranBtnA.addEventListener("click", function() {
            //     hideCard(cardA);
            //     pauseStreaming();
            //     setTimeout(() => {
            //         player.play();
            //         // handleUserInteraction();
            //         showCard(cardB);
            //     }, 500);
            // });

            // // Tombol "Dengar Siaran"
            // tontonSiaranBtnB.addEventListener("click", function() {
            //     hideCard(cardB);
            //     // Hentikan video
            //     player.pause();
            //     playStreaming();
            //     setTimeout(() => {
            //         showCard(cardA);
            //     }, 500);
            // });


        });
        // Function to fetch the next program's image
        async function fetchNextProgramImage() {
            try {
                const response = await fetch('/api/next-program-image');
                const data = await response.json();

                const programImage = document.getElementById('program-image');
                programImage.src = data.image;
                console.log(data.judul_program);

            } catch (error) {
                console.error('Error fetching next program image:', error);
            }
        }

        // Fetch image every 1 minute
        fetchNextProgramImage(); // Initial fetch
        setInterval(fetchNextProgramImage, 60000);

        async function fetchNextThumbnailImage() {
            try {
                const response = await fetch('/api/next-program-thumbnail');
                const data = await response.json();

                const thumbnailImage = document.getElementById('thumbnail-stream');
                thumbnailImage.src = data.image;
                console.log(data.image);

            } catch (error) {
                console.error('Error fetching next program image:', error);
            }
        }

        // Fetch image every 1 minute
        fetchNextThumbnailImage(); // Initial fetch
        setInterval(fetchNextThumbnailImage, 60000);
        // Refresh every 60 seconds
    </script>
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <script>
        var video = document.getElementById('videoPlayer');

        // Memeriksa apakah browser mendukung HLS.js
        if (Hls.isSupported()) {
            var hls = new Hls();

            // Memuat stream HLS
            hls.loadSource("{{ $streamVideo->stream_url }}");

            // Menghubungkan HLS.js dengan elemen video
            hls.attachMedia(video);

            // Pastikan video diputar saat HLS siap
            hls.on(Hls.Events.MANIFEST_PARSED, function() {
                video.play();
            });

            // Cegah buffering lebih lanjut dengan listener
            hls.on(Hls.Events.LEVEL_LOADED, function(event, data) {
                console.log('Loaded level: ', data.level);
            });
        } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
            // Jika browser mendukung HLS secara native, seperti Safari
            video.src = "{{ $streamVideo->stream_url }}";
            video.addEventListener('loadedmetadata', function() {
                video.play();
            });
        }
    </script>
@endsection
