<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ARDAN</title>
    <link rel="stylesheet" href="css/StyleMain/main.css">
    <link rel="stylesheet" href="css/StyleMain/responsiveMain.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    {{-- navbar area --}}
    <nav class="navbar">
        <div class="area-kiri-navbar">
            <img class="image-brand" src="image/imageHeader/logoArdan.png" alt="">
        </div>
        <div class="area-kanan-navbar">
            <div class="menu-link-navbar">
                <a class="link" href="#home">
                    <p>Home</p>
                </a>
                <div class="dropdown">
                    <a class="link dropText" id="dropdown-toggle">Media & Program<i class="arrow-down"></i></a>
                    <div class="dropdown-content" id="dropdown-menu">
                        <a href="#program">Program</a>
                        <div class="line"></div>
                        <a href="#info-news">Info News</a>
                        <div class="line"></div>
                        <a href="/event">Event</a>
                        <div class="line"></div>
                        <a href="/ardan-youtube">Playlist Youtube</a>
                        <div class="line"></div>
                        <a href="/podcast">Podcast</a>
                        <div class="line"></div>
                    </div>
                </div>
                <a class="link" href="#announcer">
                    <p>Announcer</p>
                </a>
                <a class="link" href="/chart">
                    <p>Chart</p>
                </a>
                <a class="link" href="#schedule">
                    <p>Schedule</p>
                </a>
                <a class="link" href="#contact">
                    <p>Contact</p>
                </a>
            </div>
        </div>
        <!-- Hamburger Icon -->
        <div class="hamburger" id="hamburger-icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <!-- Mobile Menu -->
        <div class="mobile-menu" id="mobile-menu">
            <div class="close-menu" id="close-menu">
                &times; <!-- Symbol for 'X' close button -->
            </div>
            <div class="area-menu-mobile">
                <a class="link-mobile" href="#home">Home</a>
                <a class="link-mobile" href="#program">Program</a>
                <a class="link-mobile" href="#info-news">Info News</a>
                <a class="link-mobile" href="/event">Event</a>
                <a class="link-mobile" href="#s">Playlist Youtube</a>
                <a class="link-mobile" href="#s">Podcast</a>
                <a class="link-mobile" href="#announcer">Announcer</a>
                <a class="link-mobile" href="#chart">Chart</a>
                <a class="link-mobile" href="#schedule">Schedule</a>
                <a class="link-mobile" href="#contact">Contact</a>
            </div>
            <div class="area-audio-mobile">
                <div class="area-image-audio-mobile">
                    <div class="image-audio-mobile"></div>
                </div>
                <div class="area-line-progress-mobile">
                    <div class="progress-details-mobile">
                        <div class="progress-bar-mobile">
                            <span></span>
                        </div>
                    </div>
                </div>
                <div class="control-btn-mobile">
                    <!-- <span class="material-symbols-rounded" id="repeat">repeat</span> -->
                    <span class="material-symbols-rounded" id="prev-mobile">skip_previous</span>
                    <div class="play-pause-mobile">
                        <span class="btn-play-mobile material-symbols-rounded">play_arrow</span>
                    </div>
                    <span class="material-symbols-rounded" id="next-mobile">skip_next</span>
                    <!-- <span class="material-symbols-rounded" id="shuffle">shuffle</span> -->
                </div>
                <audio src="music/music1.mp3" class="main-song-mobile" id="audio"></audio>
            </div>
        </div>

    </nav>

    {{-- ------- --}}


    {{-- main content area --}}
    <main class="main">
        @yield('content')
    </main>
    {{-- ------- --}}
    <div id="scrollToTopBtn"><img onclick="scrollToTop()" src="image/vinyl.png" alt="">
    </div>
    {{-- audio player --}}
    <div class="audio-player-container">
        <svg id="visual" viewBox="0 0 900 600" width="1200" height="600" xmlns="http://www.w3.org/2000/svg">
            <path id="layer1" fill="#FF004D" stroke="#FF004D" stroke-width="2" stroke-linecap="round"></path>
        </svg>
        <div class="content">
            <div class="area-control-btn">
                <div class="control-btn">
                    <!-- <span class="material-symbols-rounded" id="repeat">repeat</span> -->
                    <span class="material-symbols-rounded" id="prev">skip_previous</span>
                    <div class="play-pause" id="play-pause">
                        <span class="btn-play material-symbols-rounded">play_arrow</span>
                    </div>
                    <span class="material-symbols-rounded" id="next">skip_next</span>
                    <span class="icon-menu" id="show-hide-player"><i class='bx bx-menu'></i></span>
                    <!-- <span class="material-symbols-rounded" id="shuffle">shuffle</span> -->
                </div>
            </div>
            <div class="area-control-progres">
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

        </div>

        <audio src="music/music1.mp3" class="main-song" id="audio"></audio>
    </div>
    {{-- ------- --}}
    <footer class="footer" id="contact">
        <div class="top-footer">
            <div class="area-kiri-footer">
                <div class="area-group-kiri">
                    <div class="area-text-contact">
                        <h1 class="text-contact">CONTACT US</h1>
                    </div>
                    <div class="area-footer-address">
                        <p class="footer-address">Email : example@gmail.com</p>
                        <p class="footer-address">Telepon : +62 085862839923 </p>
                        <p class="footer-address">Alamat :lorem ipsum dolor sit amet</p>
                    </div>
                </div>
            </div>
            <div class="area-kanan-footer">
                <div class="area-group-kanan">
                    <div class="area-text-socmed">
                        <h1 class="text-socmed">Social Media</h1>
                    </div>
                    <div class="area-footer-socmed">
                        <div class="kotak-socmed"></div>
                        <div class="kotak-socmed"></div>
                        <div class="kotak-socmed"></div>
                        <div class="kotak-socmed"></div>
                    </div>
                    <div class="area-text-socmed2">
                        <h1 class="text-socmed2">Get it on</h1>
                    </div>
                    <div class="area-footer-download">
                        <div class="kotak-download"></div>
                        <div class="kotak-download"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-footer">
            <h1 class="text-copyRight">CopyRight 2024</h1>
        </div>
    </footer>
</body>
<script src="js/main/playlist.js"></script>
<script src="js/main/main.js"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</html>
