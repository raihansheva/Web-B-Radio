@extends('layout.main')

@push('meta-seo')
    <meta name="description" content="{{ \App\Helpers\Settings::get('site_description', 'Default Site Title') }}">
    <meta name="keyword" content="{{ \App\Helpers\Settings::get('site_keyword', 'Default Site Title') }}">
@endpush

@push('Style.css')
    <link rel="stylesheet" href="{{ asset('css/StyleContent/event.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('css/ResponsiveStyle/responsiveEvent.css?v=' . time()) }}">
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
@endpush

@section('title', 'EVENT | ' . \App\Helpers\Settings::get('site_title', 'Default Site Title'))

@section('content')
    <section class="page-event-1">
        <div class="area-event">
            <div class="header-event">
                <h2 class="title-event">Upcoming Event</h2>
            </div>
            <div class="content-event">
                @foreach ($event_soon as $eventSoonList)
                    <div class="content-event-CD" onclick="showPopupEvent(this)"
                        data-description="{{ $eventSoonList->deskripsi_event }}"
                        data-date="{{ \Carbon\Carbon::parse($eventSoonList->date_event)->format('d F Y') }}"
                        data-slug="{{ $eventSoonList->slug }}" data-deskShort="{{ $eventSoonList->deskripsi_event }}">
                        <span id="dataTime" style="display: none">{{ $eventSoonList->time_countdown }}</span>
                        <img class="image-CD" src="./storage/{{ $eventSoonList->image_event }}" alt="">
                        <div class="area-countdown">
                            <div class="area-content-countdown">
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
                                <div class="area-days-date">
                                    <div class="box-days-date">
                                        <h3 class="date-month">
                                            {{ \Carbon\Carbon::parse($eventSoonList->date_event)->format('d F Y') }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
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
    <section class="page-event-2">
        <div class="area-other-event">
            <div class="header-other-event">
                <h2 class="title-event-other">Other Upcoming Event</h2>
            </div>
            <swiper-container class="area-content-OV" loop="true" autoplay-delay="2500"
                autoplay-disable-on-interaction="false"
                breakpoints='{
                                    "480": { "slidesPerView": 1 },
                                    "768": { "slidesPerView": 2 },
                                    "1024": { "slidesPerView": 2 },
                                    "1280": { "slidesPerView": 2 },
                                    "2560": { "slidesPerView" : 2}
                                }'
                space-between="20">
                @foreach ($event_upcoming as $eventUpcomingList)
                    <swiper-slide class="content-event-OV"
                        style="background-image: url('./storage/{{ $eventUpcomingList->image_event }}')"
                        onclick="showPopupEvent(this)" data-description="{{ $eventUpcomingList->deskripsi_pendek }}"
                        data-date="{{ \Carbon\Carbon::parse($eventUpcomingList->date_event)->format('d F Y') }}"
                        data-slug="{{ $eventUpcomingList->slug }}"
                        data-deskShort="{{ $eventUpcomingList->deskripsi_event }}">
                        <img class="image-CD-OV" src="./storage/{{ $eventUpcomingList->image_event }}" alt="">
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
        </div>
        <div class="line-event"></div>
        </div>
    </section>
    <section class="section-banner {{ $banner->where('position', 'middle')->count() > 0 ? '' : 'hidden' }}">
        <div class="area-banner">
            <swiper-container class="mySwiper" id="swiper-xl" centered-slides="true" autoplay-delay="2000"
                autoplay-disable-on-interaction="false" loop="true">
                @foreach ($banner->where('position', 'middle') as $list)
                    <swiper-slide><a class="link-ads-banner" href="{{ $list->link_ads }}">
                            <img class="image-banner" src="{{ asset('storage/' . $list->image_banner) }}" alt=""
                                loading="lazy">
                        </a></swiper-slide>
                @endforeach
            </swiper-container>
        </div>
    </section>
    <section class="page-event-3">
        <div class="area-programE">
            <div class="header-programE">
                <h2 class="title-programE">Program B-Radio</h2>
            </div>
            <div class="content-programE">
                {{-- @foreach ($program as $programList)
                    <div class="box-programE"
                        style="" class="box-program"
                        data-title="{{ $programList->judul_program }}"
                        data-description="{{ $programList->deskripsi_pendek }}"
                        data-time="{{ $programList->jam_mulai }} - {{ $programList->jam_selesai }}"
                        data-slugP="{{ $programList->slug }}" data-deskP="{{ $programList->deskripsi_program }}"
                        onclick="showPopup(this)">
                        <img class="image-programE" src="./storage/{{ $programList->image_program }}" alt="">
                    </div>
                @endforeach --}}
                <div class="area-content-programE">
                    <swiper-container class="area-content-box-programE" loop="true" autoplay-delay="2800"
                        autoplay-disable-on-interaction="false"
                        breakpoints='{
                            "320": { "slidesPerView": 1 },
                            "340": { "slidesPerView": 1 },
                            "375": { "slidesPerView": 1 },
                            "480": { "slidesPerView": 1 },
                            "768": { "slidesPerView": 3 },
                            "1024": { "slidesPerView": 3 },
                            "1280": { "slidesPerView": 3 },
                            "2560": { "slidesPerView" : 3}
                        }'
                        space-between="20">
                        @foreach ($program as $programList)
                            <swiper-slide class="box-programE" data-title="{{ $programList->judul_program }}"
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
                                <img class="image-programE" src="./storage/{{ $programList->image_program }}"
                                    alt="">
                            </swiper-slide>
                        @endforeach
                    </swiper-container>
                </div>
            </div>
        </div>
        <div id="popup" class="popup" style="display: none;" onclick="closePopupOutside(event)">
            <div class="popup-content">
                <span class="close" onclick="closePopup()">&times;</span>
                <div class="area-info-program">
                    <p class="desk-program">Program Description</p> <!-- Pastikan elemen ini ada -->
                    <h2 class="title-box-program">Program Title</h2> <!-- Pastikan elemen ini ada -->
                    <p class="jam-program">Program Time</p>
                    <a href="#" class="detail-link-program">
                        <p class="link-program">See detail</p>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/event.js?v=' . time()) }}"></script>

@endsection
