@extends('layout.main')
<base href="{{ url('/') }}/">
@push('meta-seo')
    <meta name="description" content="{{ $detail_podcast->meta_description }}">
    <meta name="keyword" content="{{ $detail_podcast->meta_keyword }}">
@endpush

@push('Style.css')
    <link rel="stylesheet" href="{{ asset('css/StyleContent/detailPodcast.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('css/ResponsiveStyle/responsiveDetailPodcast.css?v=' . time()) }}">
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
<link href="https://vjs.zencdn.net/8.16.1/video-js.css" rel="stylesheet" />

@section('title', 'PODCAST | ' . $detail_podcast->meta_title)

@section('content')
    <section class="page-detail-1">
        <div class="area-detail-podcast">
            <div class="area-detail-kiri">
                <div class="area-image-DP">
                    <div class="card-DP">
                        <div class="card-DP-body">
                            <img class="image-podcast-detail" src="./storage/{{ $detail_podcast->image_podcast }}"
                                alt="" srcset="">
                            <div class="btn-play-DP" data-audio-src="./storage/{{ $detail_podcast->file }}"
                                data-id="{{ $detail_podcast->id }}">
                                <span class="material-symbols-rounded">play_arrow</span>
                                <p style="display: none;" id="id_podcast">{{ $detail_podcast->podcast_id }}</p>
                                <p style="display: none;" id="idP">{{ $detail_podcast->id }}</p>
                            </div>
                            <audio src="./storage/{{ $detail_podcast->file }}" id="audio-podcast"
                                preload="metadata"></audio>
                            <!--<audio src="" type="audio/mpeg" id="audio-podcast"></audio>-->
                        </div>
                        <div class="card-DP-header">
                            {{-- <div class="DP-author">
                            </div> --}}
                            <div class="DP-view" id="btn-tonton">
                                <p class="text-watchP">Watch <i class='bx bx-video'></i></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-DP-B">
                        <div class="card-body-DP-B">
                            <div class="video-container">
                                <!--@if (!empty($detail_podcast->link_podcast))
    -->
                                <!--    <video id="PlayerVid" class="video-js" controls preload="auto" poster=""-->
                                <!--        data-setup='{"fluid": true}'>-->
                                <!--        <source src="{{ $detail_podcast->link_podcast }}" />-->
                                <!--    </video>-->
                                <!--    <video id="PlayerVid" class="video-js" controls preload="auto"-->
                                <!--        poster=""-->
                                <!--        data-setup='{"techOrder": ["youtube", "html5"], "sources": [{"src": "{{ $detail_podcast->link_podcast }}?autoplay=1&mute=1&controls=1&showinfo=0&modestbranding=1", "type": "video/youtube"}]}'>-->
                                <!--    </video>-->
                            <!--@else-->
                                <!--    <p>Streaming URL tidak tersedia.</p>-->
                                <!--
    @endif-->
                                <!--{{-- <video id="hlsPlayer" controls width="640" height="360"></video>-->
                                <!--<div id="player" data-pl="{{ $detail_podcast->link_podcast }}"></div> --}}-->
                                <!--<div id="player" data-link="https://youtu.be/yBwnU7eQqDs?si=INQbh5OsLRfRN6Xe"></div>-->
                                @if (!empty($detail_podcast->link_podcast))
                                    <div id="player" data-link="{{ $detail_podcast->link_podcast }}"></div>
                                @elseif (!empty($youtubeId))
                                    {{-- Gunakan Video.js untuk YouTube --}}
                                    {{-- <video id="PlayerVid" class="video-js vjs-default-skin" controls preload="auto"
                                        data-setup='{"techOrder": ["youtube"], "sources": [{"type": "video/youtube", "src": "https://www.youtube.com/watch?v={{ $youtubeId }}"}]}'>
                                    </video> --}}

                                    {{-- Alternatif: Gunakan iframe YouTube --}}
                                    {{-- <iframe class="iframe-yt" src="https://www.youtube.com/embed/{{ $youtubeId }}"
                                        frameborder="0" allowfullscreen>
                                    </iframe> --}}
                                    <div class="iframe-yt" id="player-podcast-yt"
                                        data-link-youtube="https://www.youtube.com/embed/{{ $youtubeId }}"></div>
                                @elseif (!empty($detail_podcast->file_video))
                                    <div id="player" data-link="./storage/{{ $detail_podcast->file_video }}"></div>
                                @endif
                            </div>
                        </div>
                        <div class="card-DP-footer">
                            <div class="view-DP-B">
                                <p class="text-watchP-B">Hear <i class='bx bx-microphone'></i></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-detail-podcast">
                    <div class="content-detail-kiri">
                        <div class="area-header-DP">
                            <div class="area-detail-title-podcast">
                                <h2 class="detail-title">{{ $detail_podcast->judul_podcast }}</h2>
                            </div>
                            <div class="area-detail-genre">
                                @if (is_array($detail_podcast->genre_podcast))
                                    @foreach ($detail_podcast->genre_podcast as $genre)
                                        <h2 class="detail-genre">{{ $genre }}</h2>
                                    @endforeach
                                @else
                                    <h2 class="detail-genre">-</h2>
                                @endif
                            </div>
                        </div>
                        <div class="area-desk-detail-podcast">
                            {!! str($detail_podcast->deskripsi_podcast)->sanitizeHtml() !!}
                        </div>
                    </div>
                </div>
            </div>
            @if ($eps_group)
                <div class="area-detail-kanan">
                    <div class="header-detail-kanan">
                        <h2 class="title-detail-kanan">Other Episode</h2>
                    </div>
                    <swiper-container class="area-episodeP" loop="true" autoplay-delay="2500"
                        autoplay-disable-on-interaction="false"
                        breakpoints='{
                    "320": { "slidesPerView": 1 },
                    "340": { "slidesPerView": 1 },
                    "375": { "slidesPerView": 1 },
                    "425": { "slidesPerView": 2 },
                    "768": { "slidesPerView": 3 },
                    "1024": { "slidesPerView": 4 },
                    "1280": { "slidesPerView": 4 },
                    "2560": { "slidesPerView" : 4}
                }'
                        space-between="20">
                        @if ($eps_group)
                            @foreach ($eps_group as $epsgroupList)
                                <swiper-slide class="card-episode">
                                    {{-- <div class="card-episode">/ --}}
                                        <a href="/podcast/{{ $epsgroupList->slug }}">
                                            <div class="card-body-episode">

                                                <div class="card-image-podcast-episode">
                                                    <img src="./storage/{{ $epsgroupList->image_podcast }}" alt=""
                                                        class="image-podcast">
                                                </div>
                                                <div class="card-header-episode">
                                                    <div class="genre-episode">
                                                        @if (is_array($epsgroupList->genre_podcast))
                                                            @foreach ($epsgroupList->genre_podcast as $genre)
                                                                <h1 class="title-genre-episode">{{ $genre }}
                                                                </h1>
                                                            @endforeach
                                                        @else
                                                            <h1 class="title-genre-episode">-</h1>
                                                        @endif
                                                    </div>
                                                    <div class="area-card-text-episode">
                                                        <h1 class="card-text-podcast-episode">
                                                            {{ $epsgroupList->judul_podcast }}
                                                        </h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    {{-- </div>  --}}
                                </swiper-slide>
                            @endforeach
                        @else
                            <p></p>
                        @endif
                    </swiper-container>
                    {{-- <div class="area-see-more">
                        <h2 class="text-see-more" id="toggleSeeMore">See more</h2>
                    </div> --}}
                </div>
            @else
            @endif

        </div>
        {{-- @if ($eps_group && $eps_group->isNotEmpty())
            <div class="line-detail-podcast"></div>
        @else
        @endif --}}
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
    <section class="page-detail-2">
        <div class="area-other-podcast">
            <div class="area-content-OP">
                <div class="line-OP"></div>
                <div class="header-OP">
                    <h1 class="title-OP">Other Podcast</h1>
                </div>
                <div class="content-OP">
                    {{-- <div class="area-tombol-OP">
                        <div class="tombol-kiri-OP"></div>
                        <div class="tombol-kanan-OP"></div>
                    </div> --}}
                    <swiper-container class="area-content-card-OP" loop="true" autoplay-delay="2500"
                        autoplay-disable-on-interaction="false"
                        breakpoints='{
                        "480": { "slidesPerView": 1 },
                        "768": { "slidesPerView": 3 },
                        "1024": { "slidesPerView": 3 },
                        "1280": { "slidesPerView": 3 },
                        "2560": { "slidesPerView" : 3}
                    }'
                        space-between="20">
                        @foreach ($all_podcast as $allpodcastList)
                            <swiper-slide class="card-podcast" data-slug="{{ $allpodcastList->slug }}">
                                <div class="card-body-podcast">

                                    <div class="card-image-podcast">
                                        <img src="./storage/{{ $allpodcastList->image_podcast }}" alt=""
                                            class="image-podcast">
                                    </div>
                                    <div class="head-body-podcast">
                                        <div class="genre">
                                            @if (is_array($allpodcastList->genre_podcast))
                                                @foreach ($allpodcastList->genre_podcast as $genre)
                                                    <h1 class="title-genre">{{ $genre }}</h1>
                                                @endforeach
                                            @else
                                                <h1 class="title-genre">-</h1>
                                            @endif
                                        </div>
                                        <div class="area-card-text">
                                            <h1 class="card-text-podcast">{{ $allpodcastList->judul_podcast }}</h1>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="card-header-podcast">
                                    <div class="author-podcast">
                                    </div>
                                    <a class="link-podcast" href="/detail-podcast/{{ $allpodcastList->slug }}">
                                        <div class="view-podcast">
                                            <p class="text-watch-podcast">View Podcast</p>
                                        </div>
                                    </a>
                                </div> --}}
                            </swiper-slide>
                        @endforeach
                    </swiper-container>
                </div>
            </div>
        </div>
    </section>
    <section class="page-detail-3">
        <div class="area-video-news-stream">
            <div class="area-content-VNS">
                <div class="line-NS"></div>
                <div class="area-content-VNS-kanan">
                    <div class="area-content-news">
                        <div class="header-news">
                            <h1 class="title-news">Top Info</h1>
                            <a class="link-more-news" href="/infoNews">
                                <span class="more-news">More Info <i class='bx bx-right-arrow-alt'></i></span>
                            </a>
                        </div>
                        <div class="content-news">
                            @foreach ($top_info as $topInfoList)
                                <a class="link-box-news" href="/infoNews/{{ $topInfoList->slug }}">
                                    <div class="box-news">
                                        <div class="area-image">
                                            <img class="image-top-info" src="./storage/{{ $topInfoList->image_info }}"
                                                alt="">
                                        </div>
                                        <div class="area-text-desk-top-info">
                                            <div class="area-tag">
                                                <h2 class="tag-top-info">{{ $topInfoList->tagInfo->nama_kategori }}</h2>

                                            </div>
                                            <div class="area-text">
                                                <p class="desk-top-info">{{ $topInfoList->judul_info }}</p>
                                            </div>
                                            <div class="area-date">
                                                <p class="date-top-info">
                                                    {{ \Carbon\Carbon::parse($topInfoList->date_info)->translatedFormat('l, d F Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="line-NS"></div>
                    </div>
                    <div class="area-content-streaming">
                        <div class="header-streaming">
                            <h2 class="title-streaming">Streaming</h2>
                        </div>
                        <div class="content-streaming">
                            <div class="box-streaming">
                                <img class="image-streaming" src="./storage/{{ $streamAudio->image_stream }}">
                                <div class="btn-play-streaming" id="BtnStream"
                                    data-audio-src="{{ $streamAudio->stream_url }}">
                                    <span class="material-symbols-rounded">play_arrow</span>
                                </div>
                                {{-- <audio class="audio-streaming" id="audio-streaming" preload="auto">
                                    <source type="audio/mpeg" src="{{ $stream->stream_audio_url }}" />
                                </audio> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/detailPodcast.js?v=' . time()) }}"></script>
    <script src="{{ asset('js/playerjs.js?v=' . time()) }}"></script>
    <!--<script src="https://vjs.zencdn.net/8.16.1/video.min.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/videojs-youtube/dist/Youtube.min.js"></script>
    <script src="https://www.youtube.com/iframe_api"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Pilih semua elemen dengan class "card-podcast"
            const podcastCards = document.querySelectorAll(".card-podcast");

            podcastCards.forEach((card) => {
                card.addEventListener("click", () => {
                    // Ambil slug dari atribut data-slug
                    const slug = card.getAttribute("data-slug");

                    if (slug) {
                        // Redirect user ke halaman detail podcast sesuai slug
                        window.location.href = `/podcast/${slug}`;
                    }
                });
            });

            //  const player = videojs('PlayerVid', {
            //     controls: true,
            //     autoplay: true,
            //     preload: 'auto',
            //     fluid: true,
            //     aspectRatio: '16:9',
            //     sources: [{
            //         src: '{{ $detail_podcast->link_podcast }}',
            //         type: 'video/youtube', // Tipe untuk YouTube
            //     }, ],
            // });

            // pjs
            const playerElement = document.getElementById("player");
            const streamURL = playerElement ? playerElement.getAttribute("data-link") : null;
            // const imageStream = playerElement.getAttribute("data-poster");

            window.playerPJS = new Playerjs({
                id: "player", // ID elemen target
                file: streamURL, // URL streaming dari data-link
                // poster: imageStream, // Poster dari data-poster
            });

            // youtube api podcast
            const playerYoutube = document.getElementById("player-podcast-yt");
            const ytURL = playerYoutube ?
                playerYoutube.getAttribute("data-link-youtube") :
                null;

            let playerYT;

            if (ytURL) {
                // Membuat URL lengkap berdasarkan ytURL
                const urlLengkap = ytURL.split("/")[4]; // Mengambil ID dari URL
                playerYT = new YT.Player("player-podcast-yt", {
                    height: "360",
                    width: "640",
                    videoId: urlLengkap, // Menggunakan ID video saja
                    events: {
                        onReady: function(event) {
                            console.log("Player ready");
                        },
                    },
                });
            } else {
                console.log("URL video tidak ditemukan.");
            }

            // console.log("playerYT:", playerYT);
            // ------------------

            tontonSiaranBtnA.addEventListener("click", function() {
                hideCard(cardA);
                pausePodcast(idP)
                playerYT.playVideo();
                setTimeout(() => {
                    showCard(cardB);
                }, 500);
            });

            tontonSiaranBtnB.addEventListener("click", function() {
                hideCard(cardB);
                playerYT.pauseVideo();
                setTimeout(() => {
                    playPodcast(idP);
                    showCard(cardA);
                }, 500);
            });

        });
    </script>
@endsection
