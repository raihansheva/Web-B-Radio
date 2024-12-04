@extends('layout.main')
<base href="{{ url('/') }}/">
<link rel="stylesheet" href="css/StyleContent/detailPodcast.css">
<link rel="stylesheet" href="css/ResponsiveStyle/responsiveDetailPodcast.css">
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
                            <audio src="" id="audio-podcast"></audio>
                        </div>
                        <div class="card-DP-header">
                            {{-- <div class="DP-author">
                            </div> --}}
                            <div class="DP-view" id="btn-tonton">
                                <p class="text-watchP">Tonton Podcast</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-DP-B">
                        <div class="card-body-DP-B">
                            <div class="video-container">
                                <video id="hlsPlayer" controls width="640" height="360"></video>
                                <div id="player" data-pl="{{ $detail_podcast->link_podcast }}"></div>
                            </div>
                        </div>
                        <div class="card-DP-footer">
                            <div class="view-DP-B">
                                <p class="text-watchP-B">Dengar Podcast</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-detail-podcast">
                    <div class="content-detail-kiri">
                        <div class="area-header-DP">
                            <div class="area-detail-genre">
                                <h2 class="detail-genre">{{ $detail_podcast->genre_podcast }}</h2>
                            </div>
                            <div class="area-detail-title-podcast">
                                <h2 class="detail-title">{{ $detail_podcast->judul_podcast }}</h2>
                            </div>
                        </div>
                        <div class="area-desk-detail-podcast">
                            <p class="desk-podcast">{{ $detail_podcast->deskripsi_podcast }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="area-detail-kanan">
                <div class="header-detail-kanan">
                    <h2 class="title-detail-kanan">Other Episode</h2>
                </div>
                <div class="area-episodeP" id="style-3">
                    @if ($eps_group && $eps_group->isNotEmpty())
                        @foreach ($eps_group as $epsgroupList)
                            <div class="card-episode">
                                <a href="/detail-podcast/{{ $epsgroupList->slug }}">
                                    <div class="card-body-episode">
                                        <div class="card-header-episode">
                                            <div class="genre-episode">
                                                <h1 class="title-genre-episode">{{ $epsgroupList->genre_podcast }}</h1>
                                            </div>
                                            <div class="area-card-text-episode">
                                                <h1 class="card-text-podcast-episode">{{ $epsgroupList->judul_podcast }}
                                                </h1>
                                            </div>
                                        </div>
                                        <div class="card-image-podcast-episode">
                                            <img src="./storage/{{ $epsgroupList->image_podcast }}" alt=""
                                                class="image-podcast">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <p>Data tidak tersedia</p>
                    @endif
                </div>
                <div class="area-see-more">
                    <h2 class="text-see-more" id="toggleSeeMore">See more</h2>
                </div>
            </div>
        </div>
        <div class="line-detail-podcast"></div>
    </section>
    <section class="page-detail-2">
        <div class="area-other-podcast">
            <div class="area-content-OP">
                <div class="header-OP">
                    <h1 class="title-OP">Other Podcast</h1>
                </div>
                <div class="content-OP">
                    <div class="area-tombol-OP">
                        <div class="tombol-kiri-OP"></div>
                        <div class="tombol-kanan-OP"></div>
                    </div>
                    <div class="area-content-card-OP">
                        @foreach ($all_podcast as $allpodcastList)
                            <div class="card-podcast">
                                <div class="card-body-podcast">
                                    <div class="head-body-podcast">
                                        <div class="genre">
                                            <h1 class="title-genre">{{ $allpodcastList->genre_podcast }}</h1>
                                        </div>
                                        <div class="area-card-text">
                                            <h1 class="card-text-podcast">{{ $allpodcastList->judul_podcast }}</h1>
                                        </div>
                                    </div>
                                    <div class="card-image-podcast">
                                        <img src="./storage/{{ $allpodcastList->image_podcast }}" alt=""
                                            class="image-podcast">
                                    </div>
                                </div>
                                <div class="card-header-podcast">
                                    <div class="author-podcast">
                                    </div>
                                    <a class="link-podcast" href="/detail-podcast/{{ $allpodcastList->slug }}">
                                        <div class="view-podcast">
                                            <p class="text-watch-podcast">View Podcast</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="page-detail-3">
        <div class="area-video-news-stream">
            <div class="area-content-VNS">
                <div class="area-content-VNS-kiri">
                    <div class="header-content-kiri">
                        <h2 class="title-video">Video</h2>
                    </div>
                    <div class="content-kiri-video">
                        <div class="area-video-top">
                            @foreach (collect($videos)->slice(0, 2) as $video)
                                <div class="box-video" data-video-id="{{ $video['snippet']['resourceId']['videoId'] }}">
                                    <img class="video-thumbnail"
                                        src="https://img.youtube.com/vi/{{ $video['snippet']['resourceId']['videoId'] }}/hqdefault.jpg"
                                        alt="Thumbnail">
                                    <div class="btn-play-video"
                                        onclick="showPopupYT('{{ $video['snippet']['resourceId']['videoId'] }}')">
                                        <span class="material-symbols-rounded">play_arrow</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="area-video-mid">
                            @foreach (collect($videos)->slice(2, 1) as $video)
                                <div class="box-video-mid"
                                    data-video-id="{{ $video['snippet']['resourceId']['videoId'] }}">
                                    <img class="video-thumbnail"
                                        src="https://img.youtube.com/vi/{{ $video['snippet']['resourceId']['videoId'] }}/hqdefault.jpg"
                                        alt="Thumbnail">
                                    <div class="btn-play-video-mid"
                                        onclick="showPopupYT('{{ $video['snippet']['resourceId']['videoId'] }}')">
                                        <span class="material-symbols-rounded">play_arrow</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="area-video-bottom">
                            @foreach (collect($videos)->slice(3, 2) as $video)
                                <div class="box-video" data-video-id="{{ $video['snippet']['resourceId']['videoId'] }}">
                                    <img class="video-thumbnail"
                                        src="https://img.youtube.com/vi/{{ $video['snippet']['resourceId']['videoId'] }}/hqdefault.jpg"
                                        alt="Thumbnail">
                                    <div class="btn-play-video"
                                        onclick="showPopupYT('{{ $video['snippet']['resourceId']['videoId'] }}')">
                                        <span class="material-symbols-rounded">play_arrow</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="popup-player-yt" id="popup-player" style="display:none;">
                    <div class="popup-content-yt">
                        {{-- <span id="close-popup" onclick="hidePopup()">X</span> --}}
                        <div id="player-yt"></div>
                    </div>
                </div>
                <div class="area-content-VNS-kanan">
                    <div class="area-content-news">
                        <div class="header-news">
                            <h1 class="title-news">Top News</h1>
                        </div>
                        <div class="content-news">
                            @foreach ($top_info as $topInfoList)
                                <a class="link-box-news" href="/info-detail/{{ $topInfoList->slug }}">
                                    <div class="box-news">
                                        <div class="area-image">
                                            <img class="image-top-info" src="./storage/{{ $topInfoList->image_info }}"
                                                alt="">
                                        </div>
                                        <div class="area-text-desk-top-info">
                                            <div class="area-tag">
                                                @if (is_array($topInfoList->tag_info))
                                                    @foreach ($topInfoList->tag_info as $tag)
                                                        <h2 class="tag-top-info">#{{ $tag }}</h2>
                                                    @endforeach
                                                @else
                                                    <h2 class="tag-top-info">#-</h2>
                                                @endif
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
                    </div>
                    <div class="area-content-streaming">
                        <div class="header-streaming">
                            <h2 class="title-streaming">Streaming</h2>
                        </div>
                        <div class="content-streaming">
                            <div class="box-streaming">
                                <img class="image-streaming" src="./storage/{{ $stream->image_stream }}" alt=""
                                    srcset="">
                                <div class="btn-play-streaming" id="BtnStream"
                                    data-audio-src="{{ $stream->stream_audio_url }}">
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
    <script src="js/detailPodcast.js"></script>
@endsection
