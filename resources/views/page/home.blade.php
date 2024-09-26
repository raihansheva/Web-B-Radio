@extends('layout.main')
<link rel="stylesheet" href="css/StyleContent/home.css">
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@section('content')
    <section class="page-1" id="home">
        <div class="area-streaming">
            <div class="header-streaming">
                <h1 class="title-streaming">ON AIR</h1>
            </div>
            <div class="content-streaming">
                <div class="contentS-kiri">
                    <div class="card">
                        <div class="card-body">
                            <div class="btn-play">

                            </div>
                        </div>
                        <div class="card-header">
                            <div class="author">
                            </div>
                            <div class="view">
                                <p class="text-watchS">Tonton Siaran</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contentS-kanan">
                    <div class="area-nextP">
                        <div class="area-title-nextP">
                            <p class="title-nextP"> Next Program</p>
                        </div>
                        <div class="area-thumbnail-nextP">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="page-2" id="program">
        <div class="area-program">
            <div class="area-header-program">
                <h1 class="title-program">PROGRAM</h1>
            </div>
            <div class="area-content-program">
                <div class="area-tombol">
                    <div class="tombol-kiri"></div>
                    <div class="tombol-kanan"></div>
                </div>
                <div class="area-content-box-program">
                    <div class="box-program"></div>
                    <div class="box-program"></div>
                    <div class="box-program"></div>
                    <div class="box-program"></div>
                    <div class="box-program"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="page-3" id="info-news">
        <div class="area-info-news">
            <div class="line-info"></div>
            <div class="area-content-info-news">
                <div class="area-content-info">
                    <div class="header-info">
                        <h1 class="title-info">Info</h1>
                    </div>
                    <div class="content-info">
                        <div class="box-info"></div>
                        <div class="box-info"></div>
                        <div class="box-info"></div>
                        <div class="box-info"></div>
                        <div class="box-info"></div>
                        <div class="box-info"></div>
                        <div class="box-info"></div>
                        <div class="box-info"></div>
                        <div class="box-info"></div>
                    </div>
                    <div class="area-bottom-info">
                        <h1 class="title-bottom-info">Show more</h1>
                    </div>
                </div>
                <div class="area-content-news">
                    <div class="header-news">
                        <h1 class="title-news">Top News</h1>
                    </div>
                    <div class="content-news">
                        <div class="box-news">
                            <div class="area-image">

                            </div>
                            <div class="area-text">
                                <p class="desk-news">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim
                                    voluptatem error molestias dicta minima? Voluptas!</p>
                            </div>
                        </div>
                        <div class="box-news">
                            <div class="area-image">

                            </div>
                            <div class="area-text">
                                <p class="desk-news">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim
                                    voluptatem error molestias dicta minima? Voluptas!</p>
                            </div>
                        </div>
                        <div class="box-news">
                            <div class="area-image">

                            </div>
                            <div class="area-text">
                                <p class="desk-news">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim
                                    voluptatem error molestias dicta minima? Voluptas!</p>
                            </div>
                        </div>
                        <div class="box-news">
                            <div class="area-image">

                            </div>
                            <div class="area-text">
                                <p class="desk-news">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim
                                    voluptatem error molestias dicta minima? Voluptas!</p>
                            </div>
                        </div>
                        <div class="box-news">
                            <div class="area-image">

                            </div>
                            <div class="area-text">
                                <p class="desk-news">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim
                                    voluptatem error molestias dicta minima? Voluptas!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="page-4" id="event">
        <div class="area-event">
            <div class="line-event"></div>
            <div class="header-event">
                <h1 class="title-event">EVENT</h1>
            </div>
            <div class="area-content-event">
                <div class="area-content-event-kiri">
                    <div class="content-event-CD">
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
                            <div class="area-days-date">
                                <div class="box-days-date">
                                    <h3 class="date-month">5 Oktober</h3>
                                    <h3 class="year">2024</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="area-content-event-kanan">
                    <div class="content-event">
                        <div class="area-days-date-right">
                            <div class="content-days-date-right">
                                <div class="box-days-date-right">
                                    <h3 class="date-month-right">12 Oktober</h3>
                                    <h3 class="year-right">2024</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-event">
                        <div class="area-days-date-right">
                            <div class="content-days-date-right">
                                <div class="box-days-date-right">
                                    <h3 class="date-month-right">24 Oktober</h3>
                                    <h3 class="year-right">2024</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="page-5">
        <div class="area-podcast-video">
            <div class="area-content-PV">
                <div class="area-content-podcast">
                    <div class="header-podcast">
                        <div class="area-title-podcast">
                            <h1 class="title-podcast">Podcast</h1>
                        </div>
                        <div class="area-text-podcast">
                            <h1 class="text-podcast">Other podcast</h1>
                        </div>
                    </div>
                    <div class="content-podcast">
                        <div class="card-podcast">
                            <div class="card-body-podcast">
                                <div class="head-body-podcast">
                                    <div class="genre">
                                        <h1 class="title-genre">Comedy</h1>
                                    </div>
                                    <div class="area-card-text">
                                        <h1 class="card-text-podcast">Podcast Aseek</h1>
                                    </div>
                                </div>
                                <div class="card-image-podcast">

                                </div>
                            </div>
                            <div class="card-header-podcast">
                                <div class="author-podcast">
                                </div>
                                <div class="view-podcast">
                                    <p class="text-watch-podcast">View Podcast</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-podcast">
                            <div class="card-body-podcast">
                                <div class="head-body-podcast">
                                    <div class="genre">
                                        <h1 class="title-genre">Comedy</h1>
                                    </div>
                                    <div class="area-card-text">
                                        <h1 class="card-text-podcast">Podcast Aseek</h1>
                                    </div>
                                </div>
                                <div class="card-image-podcast">

                                </div>
                            </div>
                            <div class="card-header-podcast">
                                <div class="author-podcast">
                                </div>
                                <div class="view-podcast">
                                    <p class="text-watch-podcast">View Podcast</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="line-PV"></div>
                <div class="area-content-video">
                    <div class="area-header-video">
                        <h1 class="title-video">Youtube Video</h1>
                    </div>
                    <div class="content-video">
                        <div class="box-video">

                        </div>
                        <div class="box-video">

                        </div>
                        <div class="box-video">

                        </div>
                    </div>
                    <div class="link-text-video">
                        <h1 class="text-video">See more</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <section class="page-6">
        <div class="area-announcer">
            <div class="area-svg">
                <svg width="434" height="667" viewBox="0 0 434 667" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5015 596.014L17.5015 46.9919" stroke="#FFDB00" stroke-width="35" stroke-linecap="round" />
                    <path d="M68.0015 610L67.5265 18.0004" stroke="#FFDB00" stroke-width="35" stroke-linecap="round" />
                    <path d="M123.501 604.001L123.501 64.0012" stroke="#FFDB00" stroke-width="35" stroke-linecap="round" />
                    <path d="M181.001 627.003L181.001 47.0032" stroke="#FFDB00" stroke-width="35" stroke-linecap="round" />
                    <path d="M251.255 590L251.255 27.0034" stroke="#FFDB00" stroke-width="35" stroke-linecap="round" />
                    <path d="M309.001 616L309.001 47.0005" stroke="#FFDB00" stroke-width="35" stroke-linecap="round" />
                    <path d="M371.001 649L371.001 62.0005" stroke="#FFDB00" stroke-width="35" stroke-linecap="round" />
                    <path d="M415.533 610.001L415.533 81.9948" stroke="#FFDB00" stroke-width="35" stroke-linecap="round" />
                </svg>
            </div>
            <div class="area-content-announcer">
                <div class="header-announcer">
                    <h1 class="title-announcer">Announcer</h1>
                </div>
                <div class="content-announcer">
                    <div class="area-tombol-announcer">
                        <div class="tombol-kiri-announcer"></div>
                        <div class="tombol-kanan-announcer"></div>
                    </div>
                    <div class="area-content-box-announcer">
                        <div class="box-announcer"></div>
                        <div class="box-announcer"></div>
                        <div class="box-announcer"></div>
                        <div class="box-announcer"></div>
                        <div class="box-announcer"></div>
                        <div class="box-announcer"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="page-7">
        <div class="line-announcer"></div>
        <div class="area-chart-artis">
            <div class="area-content-chart-artis">
                <div class="area-content-chart">
                    <div class="content-chart">
                        <div class="header-chart">
                            <h1 class="title-chart">ARDAN CHART</h1>
                        </div>
                        <table class="chart">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>ARTIST</th>
                                    <th>-</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>John Doe</td>
                                    <td></td>
            
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jane Smith</td>
                                    <td></td>
                        
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Michael Brown</td>
                                    <td></td>
        
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Emily Davis</td>
                                    <td></td>
                                    
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Emily Davis</td>
                                    <td></td>
                                    
                                </tr>
                            </tbody>
                        </table>
                        <div class="bottom-chart">
                            <div class="area-btn-chart">
                                <h1 class="text-btn-chart">All Chart</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="area-content-artis">
                    <div class="header-artis">
                        <h1 class="title-artis">INFO ARTIS</h1>
                    </div>
                    <div class="content-artis">
                        <div class="box-artis"></div>
                        <div class="box-artis"></div>
                        <div class="box-artis"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    {{-- audio player --}}
    <div class="audio-player-container">
        <svg id="visual" viewBox="0 0 900 600" width="1200" height="600" xmlns="http://www.w3.org/2000/svg">
            <path id="layer1" fill="#FF004D" stroke="#FF004D" stroke-width="2" stroke-linecap="round"></path>
        </svg>
        <div class="content">
            <div class="control-btn">
                <!-- <span class="material-symbols-rounded" id="repeat">repeat</span> -->
                <span class="material-symbols-rounded" id="prev">skip_previous</span>
                <div class="play-pause">
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
    </div>
    {{-- ------- --}}
    <script src="js/playlist.js"></script>
    <script src="js/home.js"></script>
@endsection
