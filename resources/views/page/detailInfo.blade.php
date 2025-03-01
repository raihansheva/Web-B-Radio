@extends('layout.main')
<base href="{{ url('/') }}/">

@push('meta-seo')
    <meta name="description" content="{{ $info->meta_description }}">
    <meta name="keyword" content="{{ $info->meta_keywords }}">
@endpush

@push('Style.css')
    <link rel="stylesheet" href="{{ asset('css/StyleContent/detailInfo.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('css/ResponsiveStyle/responsivedetailInfo.css?v=' . time()) }}">
        <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-BHYYVVYF3D"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-BHYYVVYF3D');
</script>
@endpush

@section('title',  $info->meta_title)
@section('content')
    {{-- <section class="page-news-1">
        <div class="header-info-news">
            @foreach ($bannerInfo as $bannerInfoList)
                <div class="image-header-info-news">
                    <h2 class="title-header">#{{ $bannerInfoList->title_banner_info }}</h2>
                    <img class="banner-info" src="../storage/{{ $bannerInfoList->banner_info }}" alt=""
                        srcset="">
                </div>
            @endforeach
        </div>
    </section> --}}
    <section class="page-news-2">
        <div class="area-info-news">
            <div class="content-info-news">
                <div class="content-IN-kiri" id="style-3">
                    <div class="area-info">
                        <div class="area-detail-kiri">
                            <div class="area-header-detail-info">
                                <div class="area-url-info">
                                    <h2 class="url-info">
                                        <a class="link-url-info" href="{{ url('/') }}">Home</a> >
                                        {{ str_replace('-', ' ', request()->segment(1)) }} >
                                        {{ str_replace('-', ' ', $info->slug) }}
                                    </h2>
                                </div>
                                <div class="area-span-info">
                                    <p class="text-span-info">{{ $info->tagInfo->nama_kategori }}</p>
                                </div>
                                <div class="area-title-info">
                                    <h2 class="title-info">{{ $info->judul_info }}</h2>
                                </div>
                                <div class="area-date-info">
                                    <p class="date-info">
                                        {{ \Carbon\Carbon::parse($info->date_info)->translatedFormat('l, d F Y') }}
                                    </p>
                                </div>
                                <div class="area-image-info">
                                    <img class="image-info" src="../storage/{{ $info->image_info }}" alt="">
                                </div>
                            </div>
                            <div class="area-detail-desk-info">
                                <div class="area-desk-info">
                                    {!! str($info->deskripsi_info)->sanitizeHtml() !!}
                                </div>
    
                                <div class="area-tagar-info">
                                    <div class="header-tagar">
                                        <h2 class="text-header-tagar">Tags</h2>
                                    </div>
                                    <div class="area-text-tagar">
                                        @if (is_array($info->tag_info))
                                            @foreach ($info->tag_info as $tag)
                                                <h2 class="tagar-info">{{ $tag }}</h2>
                                            @endforeach
                                        @else
                                            <h2 class="tagar-info">-</h2>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="area-detail-kanan">
                            <div class="header-top-news">
                                <h1 class="title-top-news">Top News</h1>
                            </div>
                            <div class="content-more-info">
                                @foreach ($top_info as $topInfoList)
                                    <a class="link-box-info" href="/infoNews/{{ $topInfoList->slug }}">
                                        <div class="box-info">
                                            <div class="area-text-desk-more-info">
                                                <div class="area-date">
                                                    <p class="date-more-info">
                                                        {{ \Carbon\Carbon::parse($topInfoList->date_info)->translatedFormat('l, d F Y') }}
                                                    </p>
                                                </div>
                                                <div class="area-text">
                                                    <p class="desk-more-info">{{ $topInfoList->judul_info }}</p>
                                                </div>
                                                <div class="area-tag-more-info">
                                                    <h2 class="tag-more-info">{{ $topInfoList->tagInfo->nama_kategori }}</h2>
                                                </div>
                                            </div>
                                            <div class="area-image-more-info">
                                                <img class="image-more-info" src="./storage/{{ $topInfoList->image_info }}"
                                                    alt="">
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="line-box-info"></div>
                        </div>
                    </div>
                    <div class="line-detail-info"></div>
                    <div class="area-trending-kategori">
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
                                                    <h2 class="tag-trending-info">
                                                        {{ $trendingInfoList->tagInfo->nama_kategori }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="area-kategori">
                            <div class="area-news">
                                <div class="area-header-news">
                                    <h2 class="header-news">Kategori Info</h2>
                                </div>
                                <div class="area-box-news">
                                    @foreach ($kategoriInfo as $kategoriInfoList)
                                        <div class="box-news">
                                            <a href="/infoTag/{{ $kategoriInfoList->nama_kategori }}">
                                                <div class="area-tag-news">
                                                    <h3 class="tag-news">{{ $kategoriInfoList->nama_kategori }}</h3>
                                                </div>
                                                {{-- @if ($kategoriInfoList->info->isNotEmpty())
                                                    <img class="image-news"
                                                        src="{{ asset('storage/' . $kategoriInfoList->info->first()->image_info) }}"
                                                        alt="">
                                                @else
                                                    <p>Tidak ada info untuk tag ini.</p>
                                                @endif --}}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                {{-- <div class="line-news"></div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="line-info-news"></div>
        </div>
    </section>
    <section class="page-news-3">
        <div class="area-stream-event">
            <div class="content-IN-kanan">
                <div class="area-streaming">
                    <div class="area-header-streaming">
                        <h2 class="title-streaming">Streaming</h2>
                    </div>
                    <div class="area-thumbnail">
                        <img class="image-streaming" src="./storage/{{ $streamAudio->image_stream }}">
                        <div class="btn-play-streaming" id="BtnStream" data-audio-src="{{ $streamAudio->stream_url }}">
                            <span class="material-symbols-rounded">play_arrow</span>
                        </div>

                        <!-- Ganti dengan MediaElement.js -->
                        {{-- <audio class="audio-streaming" id="audio-streaming" preload="auto" crossorigin="anonymous">
                            <source type="audio/mpeg" src="{{ $stream->stream_audio_url }}" />
                        </audio> --}}
                    </div>
                    <div class="line-streaming"></div>
                </div>
                {{-- <div class="area-top-news">
                    <div class="header-top-news">
                        <h1 class="title-top-news">Top News</h1>
                    </div>
                    <div class="content-top-news">
                        @foreach ($top_info as $topInfoList)
                            <a class="link-box-top-info" href="/info-detail/{{ $topInfoList->slug }}">
                                <div class="box-top-info">
                                    <div class="area-top-image">
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
                </div> --}}
                <div class="area-event">
                    <div class="area-header-event">
                        <h2 class="title-event">Event</h2>
                        <a href="/event">
                            {{-- <h2 class="see-more">See More</h2> --}}
                            <h2 class="see-more">See More <i class='bx bx-right-arrow-alt'></i></h2>
                        </a>
                    </div>
                    <div class="area-event-bottom">
                        @foreach ($event_upcoming as $eventUpcomingList)
                            <div class="box-event"
                                style="background-image: url('./storage/{{ $eventUpcomingList->image_event }}')"
                                onclick="showPopupEvent(this)"
                                data-description="{{ $eventUpcomingList->deskripsi_pendek }}"
                                data-date="{{ \Carbon\Carbon::parse($eventUpcomingList->date_event)->format('d F Y') }}"
                                data-slug="{{ $eventUpcomingList->slug }}"
                                data-deskShort="{{ $eventUpcomingList->deskripsi_event }}">
                                <div class="area-days-date-right">
                                    <div class="content-days-date-right">
                                        <div class="box-days-date-right">
                                            <h3 class="date-month-right">
                                                {{ \Carbon\Carbon::parse($eventUpcomingList->date_event)->format('d F Y') }}
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
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
            <div class="line-info-artis"></div>
        </div>
    </section>
    <script src="{{ asset('js/infoNews.js?v=' . time()) }}"></script>

@endsection
