// DOM Element References
const content = document.querySelector(".content"),
    Playimage = content.querySelector(".music-image img"),
    musicName = content.querySelector(".music-titles .name"),
    musicArtist = content.querySelector(".music-titles .artist"),
    Audio = document.querySelector(".main-song"),
    playBtn = document.querySelectorAll(
        ".play-pause, .play-pause-mobile, .btn-play-streaming, .btn-play-chart, .btn-play-DP"
    ),
    prevBtn = content.querySelector("#prev"),
    nextBtn = content.querySelector("#next"),
    progressBar = content.querySelector(".progress-bar"),
    progressDetails = content.querySelector(".progress-details"),
    currentTimeDisplay = content.querySelector(".current-time"),
    durationTimeDisplay = content.querySelector(".duration-time");

// Global Variables
let currentIndex = null;
let eps = 1;
let isPlaying = false;
let isStreamingPlaying = false;
let lastStreamingSrc = "";
let podcastId = document.getElementById("id_podcast")
    ? document.getElementById("id_podcast").textContent
    : null;
let IdP = document.getElementById("idP")
    ? document.getElementById("idP").textContent
    : null;
let isAudioPaused = false;
let isChartPlaying = false;
let lastAudioSrc = "";

// ----------------------------
// Event Listeners
// ----------------------------

// Load podcast details on page load
window.addEventListener("load", () => {
    if (IdP) {
        loadPodcastDetails(IdP);
    }
});

// Play/Pause Button Click Event
// playBtn.forEach((button) => {
//     button.addEventListener("click", () => {
//         if (isPlaying) {
//             pauseSong();
//             if (isStreamingPlaying) {
//                 pauseStreaming();
//             }
//         } else {
//             playSong();
//         }
//     });
// });

// ----------------------------
// Podcast Functions
// ----------------------------

// Status play/pause untuk setiap podcast berdasarkan ID podcast
let playPodcastStatus = {};
let currentPodcastId = null; // Simpan ID podcast yang sedang dimainkan

function loadPodcastDetails(idP) {
    fetch(`/podcast/details/${idP}`)
        .then((response) => response.json())
        .then((data) => {
            if (data) {
                musicName.innerHTML = data.judul_podcast;
                musicArtist.innerHTML = data.genre_podcast;
                Playimage.src = "./storage/" + data.image_podcast;
                Audio.src = "./storage/" + data.file;
                Audio.load(); // Load hanya saat pertama kali
                playPodcastStatus[idP] = { isPlaying: false }; // Reset status
                currentPodcastId = idP; // Set current podcast
            } else {
                console.error("Podcast not found.");
            }
        })
        .catch((error) => console.error("Failed to load podcast data:", error));
}

// Fungsi play podcast
function playPodcast(idP) {
    if (!playPodcastStatus[idP]?.isPlaying) {
        Audio.play()
            .then(() => {
                playPodcastStatus[idP].isPlaying = true;
                currentPodcastId = idP; // Update current podcast ID
                updatePodcastPlayButtonState(idP);
            })
            .catch((error) => {
                console.error("Audio play error:", error);
            });
    }
}

// Fungsi pause podcast
function pausePodcast(idP) {
    if (!Audio.paused) {
        Audio.pause();
        playPodcastStatus[idP].isPlaying = false;
        updatePodcastPlayButtonState(idP);
    }
}

// Update status tombol play/pause
function updatePodcastPlayButtonState(idP) {
    document.querySelectorAll(".btn-play-DP, .play-pause").forEach((button) => {
        const icon = button.querySelector("span");
        const buttonId = button.getAttribute("data-id");

        if (buttonId === idP || button.classList.contains("play-pause")) {
            icon.textContent = playPodcastStatus[idP]?.isPlaying ? "pause" : "play_arrow";
            button.classList.toggle("active", playPodcastStatus[idP]?.isPlaying);
        } else if (button.classList.contains("btn-play-DP")) {
            icon.textContent = "play_arrow"; // Reset ikon tombol lainnya
            button.classList.remove("active");
        }
    });
}

// Event listener untuk tombol .btn-play-DP
document.querySelectorAll(".btn-play-DP").forEach((button) => {
    button.addEventListener("click", () => {
        const podcastId = button.getAttribute("data-id");
        if (!playPodcastStatus[podcastId]?.isPlaying) {
            playPodcast(podcastId);
        } else {
            pausePodcast(podcastId);
        }
    });
});

// Event listener untuk tombol .play-pause di audio player
document.querySelectorAll(".play-pause").forEach((button) => {
    button.addEventListener("click", () => {
        if (currentPodcastId) {
            if (Audio.paused) {
                playPodcast(currentPodcastId);
            } else {
                pausePodcast(currentPodcastId);
            }
        }
    });
});

// Update status ketika Audio dijeda atau dimainkan
Audio.onpause = () => {
    if (currentPodcastId) {
        playPodcastStatus[currentPodcastId].isPlaying = false;
        updatePodcastPlayButtonState(currentPodcastId);
    }
};

Audio.onplay = () => {
    if (currentPodcastId) {
        playPodcastStatus[currentPodcastId].isPlaying = true;
        updatePodcastPlayButtonState(currentPodcastId);
    }
};

// Event listener untuk tombol next dan prev
nextBtn.addEventListener("click", () => {
    eps++; // Increment episode number
    loadEpisode(podcastId, eps, "next");
});

prevBtn.addEventListener("click", () => {
    eps = Math.max(1, eps - 1); // Ensure eps doesn't go below 1
    loadEpisode(podcastId, eps, "previous");
});

// Streaming Functions
// ----------------------------
// Update the streaming audio when it's loaded
function loadStreamingAudio(streamingSrc, streamName, streamArtist) {
    if (streamingSrc) {
        console.log("Attempting to load streaming audio from:", streamingSrc);

        // If new source or paused, load and play the audio
        if (streamingSrc !== lastStreamingSrc || !isStreamingPlaying) {
            Audio.src = streamingSrc;
            Audio.crossOrigin = "anonymous";

            // Load audio and update UI on successful load
            Audio.load();
            lastStreamingSrc = streamingSrc;

            // Handle errors if audio fails to load
            Audio.onerror = (error) => {
                console.error("Streaming audio failed to load:", error);
            };

            // Start playback once audio is ready
            Audio.oncanplay = () => {
                musicName.innerHTML = streamName;
                musicArtist.innerHTML = streamArtist;
                playStreaming();  // Play the audio
            };
        } else {
            pauseStreaming();  // Pause the streaming if the same audio is already playing
        }
    } else {
        console.error("Streaming source not found.");
    }
}


function updateStreamingPlayButtonState() {
    // Update tombol play/pause untuk semua tombol streaming
    document.querySelectorAll(".btn-play-streaming").forEach((button) => {
        const streamingSrc = button.getAttribute("data-audio-src");  // Dapatkan sumber audio untuk tombol ini
        const icon = button.querySelector("span");  // Ambil elemen span yang ada di dalam tombol untuk ikon

        // Pastikan elemen icon ada
        if (!icon) {
            console.error("Icon not found in button: ", button);  // Debugging jika span tidak ditemukan
            return;
        }

        // Jika sumber audio yang sedang dimainkan sama dengan tombol ini
        if (streamingSrc === lastStreamingSrc) {
            // Jika audio sedang diputar, ubah ikon menjadi 'pause'
            if (isStreamingPlaying) {
                icon.textContent = "pause";  // Ganti ikon menjadi 'pause'
            } else {
                // Jika audio dijeda, ubah ikon menjadi 'play_arrow'
                icon.textContent = "play_arrow";  // Ganti ikon menjadi 'play_arrow'
            }
        } else {
            // Jika tombol ini tidak terkait dengan audio yang sedang diputar, reset ikon ke 'play_arrow'
            icon.textContent = "play_arrow";  // Ganti ikon menjadi 'play_arrow'
        }
    });
}


// Function to play streaming audio
function playStreaming() {
    Audio.play()
        .then(() => {
            isStreamingPlaying = true;
            console.log("Audio is streaming and playing, updating button state.");
            updateStreamingPlayButtonState();  // Update the play button state for streaming
        })
        .catch((error) => {
            console.error("Streaming audio play error:", error);
        });
}

// Function to pause streaming audio
function pauseStreaming() {
    Audio.pause();
    isStreamingPlaying = false;
    console.log("Audio is paused, updating button state.");
    updateStreamingPlayButtonState();  // Update the play button state for streaming
}

// Event listener for streaming play/pause button
document.querySelectorAll(".btn-play-streaming").forEach((button) => {
    button.addEventListener("click", () => {
        const streamingSrc = button.getAttribute("data-audio-src");
        const streamName = "Streaming Audio";
        const streamArtist = "Live Stream";

        // Toggle play/pause based on the current state of the streaming audio
        if (isStreamingPlaying && lastStreamingSrc === streamingSrc) {
            pauseStreaming();  // Pause streaming if the same audio is playing
        } else {
            loadStreamingAudio(streamingSrc, streamName, streamArtist);  // Load and play new streaming audio
        }
    });
});

// Ensure autoplay doesn't happen on pause
Audio.onpause = () => {
    isStreamingPlaying = false;
    updateStreamingPlayButtonState(); // Update button state when paused
};

// Ensure play button updates on play
Audio.onplay = () => {
    isStreamingPlaying = true;
    updateStreamingPlayButtonState(); // Update button state when playing
};
// ----------------------------
// chart
// ----------------------------
let currentChartId = null;  // Menyimpan ID chart yang sedang diputar
let playStatus = {};  // Menyimpan status play/pause per chart
let lastClickedBtnId = null;  // Variabel untuk menyimpan ID tombol yang terakhir diklik

// Fungsi untuk memutar chart audio
function playChartAudio(audioSrc, chartName, chartArtist, chartId) {
    if (audioSrc) {
        // Jika audio yang diputar berbeda, stop audio yang sedang diputar dan mulai yang baru
        if (Audio.src !== audioSrc) {
            Audio.pause();
            if (currentChartId) {
                playStatus[currentChartId] = { isPlaying: false };  // Set tombol sebelumnya jadi pause
            }

            // Set audio baru dan mulai memutar
            Audio.src = audioSrc;
            Audio.load();
            Audio.play()
                .then(() => {
                    musicName.innerHTML = chartName;
                    musicArtist.innerHTML = chartArtist;
                    if (!playStatus[chartId]) {
                        playStatus[chartId] = {};  // Inisialisasi jika belum ada
                    }
                    playStatus[chartId].isPlaying = true;
                    currentChartId = chartId;  // Update ID chart yang sedang diputar
                    updatePlayButtonState();  // Update status tombol play/pause
                })
                .catch((error) => console.error("Audio play error:", error));
        } else {
            // Jika audio yang sama, toggle antara play dan pause
            if (Audio.paused) {
                Audio.play();
                if (!playStatus[chartId]) {
                    playStatus[chartId] = {};  // Inisialisasi jika belum ada
                }
                playStatus[chartId].isPlaying = true;
            } else {
                Audio.pause();
                if (!playStatus[chartId]) {
                    playStatus[chartId] = {};  // Inisialisasi jika belum ada
                }
                playStatus[chartId].isPlaying = false;
            }
            updatePlayButtonState();  // Update status tombol play/pause
        }
    }
}

// Fungsi untuk memperbarui status tombol play/pause berdasarkan playStatus[chartId]
function updatePlayButtonState() {
    // Update tombol play/pause untuk semua chart
    document.querySelectorAll(".btn-play-chart, .play-pause").forEach((button) => {
        const chartId = button.getAttribute("data-id");  // ID chart atau null untuk tombol utama
        const icon = button.querySelector("span");

        // Periksa apakah tombol adalah tombol chart spesifik atau tombol utama
        const isMainPlayPauseButton = button.classList.contains("play-pause");

        if ((chartId === currentChartId && playStatus[chartId]?.isPlaying) || (isMainPlayPauseButton && !Audio.paused)) {
            // Jika audio sedang diputar, ikon diubah ke "pause"
            icon.textContent = "pause";
        } else {
            // Jika audio dijeda atau tidak diputar, ikon diubah ke "play_arrow"
            icon.textContent = "play_arrow";
        }
    });
}

// Fungsi untuk memutar lagu di chart tertentu
function playSong(chartId, audioSrc, chartName, chartArtist) {
    if (Audio.paused) {
        currentChartId = chartId;
        Audio.src = audioSrc;
        Audio.load();
        Audio.play()
            .then(() => {
                musicName.innerHTML = chartName;
                musicArtist.innerHTML = chartArtist;
                playStatus[chartId] = { isPlaying: true };
                updatePlayButtonState();  // Update tombol play/pause
            })
            .catch((error) => console.error("Audio play error:", error));
    }
}

// Fungsi untuk menjeda lagu di chart tertentu
function pauseSong(chartId) {
    if (!Audio.paused) {
        Audio.pause();
        playStatus[chartId] = { isPlaying: false };  // Update status play/pause untuk chart ini
        updatePlayButtonState();  // Update tombol play/pause
    }
}

// Event listener untuk tombol .btn-play-chart
document.querySelectorAll(".btn-play-chart").forEach((button) => {
    button.addEventListener("click", () => {
        const audioSrc = button.getAttribute("data-audio-src");
        const chartName = button.getAttribute("data-name");
        const chartArtist = button.getAttribute("data-kategori");
        const chartId = button.getAttribute("data-id");

        // Jika tombol yang sama diklik lagi
        if (lastClickedBtnId === chartId) {
            if (playStatus[chartId]?.isPlaying) {
                // Jika audio sedang diputar, pause audio
                pauseSong(chartId);
                currentChartId = null;  // Reset chart yang sedang diputar
            } else {
                // Jika audio sedang dipause, lanjutkan memutar (tetapi jangan reset ke awal)
                playSong(chartId, audioSrc, chartName, chartArtist);
            }
            return;  // Tidak perlu lanjutkan ke logika lain jika tombol yang sama diklik lagi
        }

        // Simpan ID tombol yang sedang diklik
        lastClickedBtnId = chartId;

        // Jika chart lain sedang diputar, pause audio yang sedang diputar sebelumnya
        if (currentChartId && currentChartId !== chartId) {
            pauseSong(currentChartId);  // Pause audio yang sedang diputar sebelumnya
            currentChartId = null;  // Reset chart yang sedang diputar
        }

        // Putar chart baru
        playSong(chartId, audioSrc, chartName, chartArtist);
    });
});


// Event listener untuk tombol play/pause utama
document.querySelector(".play-pause").addEventListener("click", () => {
    if (Audio.paused) {
        // Jika audio dijeda, mainkan audio
        Audio.play()
            .then(() => {
                // Setelah audio mulai diputar, perbarui status
                if (currentChartId) {
                    playStatus[currentChartId].isPlaying = true;
                }
                updatePlayButtonState();  // Update ikon play/pause
            })
            .catch((error) => console.error("Audio play error:", error)); // Tangani error jika play gagal
    } else {
        // Jika audio sedang diputar, jeda audio
        Audio.pause();
        if (currentChartId) {
            playStatus[currentChartId].isPlaying = false;
        }
        updatePlayButtonState();  // Update ikon play/pause
    }
});


// Ketika audio dijeda, perbarui status dan ikon tombol
Audio.onplay = () => {
    if (currentChartId) {
        if (!playStatus[currentChartId]) {
            playStatus[currentChartId] = {};  // Inisialisasi jika belum ada
        }
        playStatus[currentChartId].isPlaying = true;
    }
    updatePlayButtonState();  // Panggil update untuk memperbarui ikon
};

Audio.onpause = () => {
    if (currentChartId) {
        if (!playStatus[currentChartId]) {
            playStatus[currentChartId] = {};  // Inisialisasi jika belum ada
        }
        playStatus[currentChartId].isPlaying = false;
    }
    updatePlayButtonState();  // Panggil update untuk memperbarui ikon
};
// ----------------------------
// progress bar
// ----------------------------

// Update progress bar based on audio time update
Audio.addEventListener("timeupdate", () => {
    if (Audio.duration) {
        const progressPercent = (Audio.currentTime / Audio.duration) * 100;
        progressBar.style.width = `${progressPercent}%`; // Update progress bar width
        // updateAudioTimeDisplay();
    }
});

// Format and display current and duration time
// function updateAudioTimeDisplay() {
//     const currentMinutes = Math.floor(Audio.currentTime / 60);
//     const currentSeconds = Math.floor(Audio.currentTime % 60);
//     const durationMinutes = Math.floor(Audio.duration / 60);
//     const durationSeconds = Math.floor(Audio.duration % 60);

//     // currentTimeDisplay.textContent = `${currentMinutes}:${currentSeconds < 10 ? "0" : ""}${currentSeconds}`;
//     durationTimeDisplay.textContent = `${durationMinutes}:${durationSeconds < 10 ? "0" : ""}${durationSeconds}`;
// }

// Seek functionality: Jump to clicked position on progress bar
progressDetails.addEventListener("click", (event) => {
    const clickPosition = event.offsetX / progressDetails.clientWidth;
    Audio.currentTime = clickPosition * Audio.duration;
});
// ----------------------------

// function updatePlayButtonState() {
//     playBtn.forEach((button) => {
//         const icon = button.querySelector("span");
//         const buttonId = button.getAttribute("data-id"); // Ambil data-id dari button

//         // Update hanya tombol yang sesuai dengan data-id yang sedang diputar
//         if (buttonId) {
//             // Jika audio sedang diputar untuk data-id ini
//             if (playStatus[buttonId] && playStatus[buttonId].isPlaying) {
//                 icon.textContent = "pause"; // Update menjadi pause jika audio sedang diputar
//             } else {
//                 icon.textContent = "play_arrow"; // Update menjadi play jika audio berhenti
//             }
//         }
//     });
// }

// ----------------------------
// Streaming Button Placeholder (Commented for now)
// document.querySelectorAll(".btn-play-streaming").forEach((button) => {
//     button.addEventListener("click", () => {
//         const streamingSrc = button.getAttribute("data-audio-src");
//         const streamName = button.getAttribute("data-name");
//         const streamArtist = button.getAttribute("data-artist");

//         if (isStreamingPlaying && Audio.src === streamingSrc) {
//             pauseStreaming();
//         } else {
//             loadStreamingAudio(streamingSrc, streamName, streamArtist);
//         }
//     });
// });

// Spectrum Audio Visualization
const svg = document.getElementById("visual");
const audio = Audio;
const path = svg.querySelector("#layer1");

const audioContext = new (window.AudioContext || window.webkitAudioContext)();
const analyser = audioContext.createAnalyser();
analyser.fftSize = 2048;
const bufferLength = analyser.frequencyBinCount;
const dataArray = new Uint8Array(bufferLength);

const source = audioContext.createMediaElementSource(audio);
source.connect(analyser);
analyser.connect(audioContext.destination);

function updateVisualization() {
    analyser.getByteFrequencyData(dataArray);

    const width = svg.clientWidth;
    const height = svg.clientHeight;

    const numPoints = 7; // Jumlah titik yang ditampilkan
    const step = width / (numPoints - 1);

    const waveHeight = height / 1.5; // Tinggi gelombang, dapat diatur sesuai kebutuhan

    let newPath = `M0 ${height / 2}`;

    for (let i = 1; i < numPoints; i++) {
        const index = Math.floor(i * (bufferLength / numPoints));
        const amplitude = dataArray[index] || 0;
        const scaledAmplitude = (amplitude / 255) * waveHeight; // Menggunakan waveHeight

        const x = i * step;
        const y = height / 2 - scaledAmplitude;

        if (i > 0) {
            const prevX = (i - 1) * step;
            const prevY =
                height / 2 -
                ((dataArray[Math.floor((i - 1) * (bufferLength / numPoints))] ||
                    0) /
                    255) *
                    waveHeight; // Menggunakan waveHeight

            // Menghitung kontrol titik untuk kurva Bezier
            const controlX1 = prevX + (x - prevX) * 0.4;
            const controlY1 = prevY;
            const controlX2 = prevX + (x - prevX) * 0.6;
            const controlY2 = y;

            // Menambahkan kurva Bezier
            newPath += `C${controlX1} ${controlY1}, ${controlX2} ${controlY2}, ${x} ${y}`;
        } else {
            newPath += `L${x} ${y}`;
        }
    }

    newPath += `L${width} ${height / 2}`;
    path.setAttribute("d", newPath);
    requestAnimationFrame(updateVisualization);
}

// function updateVisualization() {
//     analyser.getByteFrequencyData(dataArray);

//     const width = svg.clientWidth;
//     const height = svg.clientHeight;

//     const numBars = 64; // Jumlah bar yang ditampilkan
//     const barWidth = 50; // Lebar bar yang dapat diatur (misalnya, 5 piksel)

//     // Menghapus semua rectangle yang ada sebelumnya
//     while (svg.firstChild) {
//         svg.removeChild(svg.firstChild);
//     }

//     for (let i = 0; i < numBars; i++) {
//         const index = Math.floor(i * (bufferLength / numBars));
//         const amplitude = dataArray[index] || 0;
//         const scaledAmplitude = (amplitude / 255) * height;

//         const x = i * barWidth; // Posisi x dari bar
//         const y = height - scaledAmplitude; // Posisi y dari bar

//         // Membuat elemen rectangle
//         const rect = document.createElementNS("http://www.w3.org/2000/svg", "rect");
//         rect.setAttribute("x", x);
//         rect.setAttribute("y", y);
//         rect.setAttribute("width", barWidth - 1); // Lebar bar (kurangi sedikit agar tidak ada celah)
//         rect.setAttribute("height", scaledAmplitude); // Tinggi bar
//         rect.setAttribute("fill", "#FF004D"); // Warna bar

//         svg.appendChild(rect); // Menambahkan bar ke dalam SVG
//     }

//     requestAnimationFrame(updateVisualization);
// }

audio.addEventListener("play", () => {
    audioContext.resume().then(() => {
        updateVisualization();
    });
});

window.addEventListener("resize", () => {
    path.setAttribute("d", "");
});

document.addEventListener("DOMContentLoaded", function () {
    // Ambil elemen tombol prev dan next
    const prevButton = document.getElementById("prev");
    const nextButton = document.getElementById("next");
    const controlBtn = document.getElementById("control-btn");
    const img = document.getElementById("image");

    // Cek URL untuk memastikan apakah kita berada di halaman detail-podcast
    const currentPage = window.location.pathname;

    // Jika halaman adalah 'detail-podcast', tampilkan tombol prev dan next
    if (currentPage.includes("detail-podcast")) {
        prevButton.style.display = "flex"; // Menampilkan tombol prev
        nextButton.style.display = "flex"; // Menampilkan tombol next
    } else {
        prevButton.style.display = "none"; // Menyembunyikan tombol prev
        nextButton.style.display = "none"; // Menyembunyikan tombol next
        controlBtn.style.width = "170px";
        controlBtn.style.gap = "20px";
        img.style.display = "none";
    }
});

// ----------------------------------------------

// JavaScript untuk toggle dropdown saat diklik
document
    .getElementById("dropdown-toggle")
    .addEventListener("click", function (event) {
        // Toggle class 'show' untuk menampilkan atau menyembunyikan dropdown
        document.getElementById("dropdown-menu").classList.toggle("show");

        // Mencegah link default jika ada di dropdown-text
        event.preventDefault();
    });

// Tutup dropdown jika klik di luar dropdown
window.onclick = function (event) {
    if (!event.target.matches(".arrow-down")) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains("show")) {
                openDropdown.classList.remove("show");
            }
        }
    }
};

// document.querySelectorAll(".link").forEach((anchor) => {
//     anchor.addEventListener("click", function (e) {
//         e.preventDefault();

//         const target = document.querySelector(this.getAttribute("href"));
//         const navbarHeight = document.querySelector(".navbar").offsetHeight;
//         const targetTop =
//             target.getBoundingClientRect().top + window.pageYOffset;

//         // Sesuaikan posisi scroll dengan menambahkan offset height dari navbar
//         window.scrollTo({
//             top: targetTop - navbarHeight,
//             behavior: "smooth",
//         });
//     });
// });

// Toggle mobile menu on hamburger icon click
document
    .getElementById("hamburger-icon")
    .addEventListener("click", function () {
        const mobileMenu = document.getElementById("mobile-menu");
        mobileMenu.classList.toggle("active");
    });

// Close the mobile menu on close icon click
document.getElementById("close-menu").addEventListener("click", function () {
    const mobileMenu = document.getElementById("mobile-menu");
    mobileMenu.classList.remove("active");
});

// Close menu when clicking outside of the mobile menu
document.addEventListener("click", function (event) {
    const mobileMenu = document.getElementById("mobile-menu");
    const hamburgerIcon = document.getElementById("hamburger-icon");

    const isClickInsideMenu = mobileMenu.contains(event.target);
    const isClickInsideHamburger = hamburgerIcon.contains(event.target);

    // console.log("Clicked inside menu: ", isClickInsideMenu);
    // console.log("Clicked inside hamburger: ", isClickInsideHamburger);

    if (
        !isClickInsideMenu &&
        !isClickInsideHamburger &&
        mobileMenu.classList.contains("active")
    ) {
        // console.log("Closing mobile menu");
        mobileMenu.classList.remove("active");
    }
});
window.onload = function () {
    checkScrollPosition();
};

window.onscroll = function () {
    checkScrollPosition();
};

function checkScrollPosition() {
    var scrollToTopBtn = document.getElementById("scrollToTopBtn");
    if (
        document.body.scrollTop > 100 ||
        document.documentElement.scrollTop > 100
    ) {
        scrollToTopBtn.style.display = "block";
    } else {
        scrollToTopBtn.style.display = "none";
    }
}

// Fungsi untuk scroll ke atas
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: "smooth", // Scroll secara halus
    });
}

// show hide audio player

const btnhideshow = document.getElementById("show-hide-player");
var Comaudioplayer = document.querySelector(".content"),
    ComCP = document.querySelector(".area-control-progres"),
    Comcontrolbtn = document.querySelector(".area-control-btn");

let isVisible = true;

btnhideshow.addEventListener("click", function () {
    // audio first muncul
    if (isVisible) {
        // Comaudioplayer.classList.add("fade-out"); // Tambahkan kelas fade-out
        ComCP.classList.add("slide-out");

        Comcontrolbtn.style.backgroundColor = "transparent";
        setTimeout(() => {
            ComCP.style.display = "none";
            // Comaudioplayer.classList.remove("fade-out");
            ComCP.classList.remove("slide-out");
        }, 500);
    } else {
        ComCP.style.display = "flex";
        // Comaudioplayer.classList.add("fade-in");
        ComCP.classList.add("slide-in");

        setTimeout(() => {
            // Comaudioplayer.classList.remove("fade-in");
            ComCP.classList.remove("slide-in");
            Comimage.classList.remove("slide-in");
            Commusictitle.classList.remove("slide-in");
        }, 500);

        setTimeout(() => {
            Comcontrolbtn.style.backgroundColor = "";
        }, 280);
    }

    isVisible = !isVisible;
    // ----------------------

    // audio player first hide
    // if (isVisible) {
    //     // Comaudioplayer.classList.add("fade-out"); // Tambahkan kelas fade-out
    //     ComCP.style.display = "flex";
    //     ComCP.classList.add("slide-in");

    //     setTimeout(() => {
    //         // Comaudioplayer.classList.remove("fade-out");
    //         ComCP.classList.remove("slide-in");
    //     }, 500);

    //     setTimeout(() =>{
    //         Comcontrolbtn.style.backgroundColor = "#17171769";

    //     }, 280);
    // } else {
    //     // Comaudioplayer.classList.add("fade-in");
    //     ComCP.classList.add("slide-out");

    //     Comcontrolbtn.style.backgroundColor = "transparent";
    //     setTimeout(() => {
    //         ComCP.style.display = "none";
    //         // Comaudioplayer.classList.remove("fade-in");
    //         ComCP.classList.remove("slide-out");
    //         Comimage.classList.remove("slide-out");
    //         Commusictitle.classList.remove("slide-out");
    //     }, 500);

    // }

    // isVisible = !isVisible;
    // ----------------------
});

// countdown event
// Mendapatkan path URL saat ini
const currentPath = window.location.pathname;

// Mengecek apakah URL-nya /home, /event, atau /
if (
    currentPath === "/home" ||
    currentPath === "/event" ||
    currentPath === "/" ||
    currentPath == "/ardan-youtube"
) {
    // Eksekusi JavaScript countdown hanya jika path sesuai
    const daysElement = document.getElementById("days");
    const hoursElement = document.getElementById("hours");
    const minutesElement = document.getElementById("minutes");
    const secondsElement = document.getElementById("seconds");

    const countdownDateStr = document
        .getElementById("dataTime")
        .innerText.trim();
    const countdownDate = new Date(countdownDateStr).getTime();

    function updateCountdown() {
        const now = new Date().getTime();
        const timeRemaining = countdownDate - now;

        const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
        const hours = Math.floor(
            (timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
        );
        const minutes = Math.floor(
            (timeRemaining % (1000 * 60 * 60)) / (1000 * 60)
        );
        const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

        daysElement.innerText = days < 10 ? "0" + days : days;
        hoursElement.innerText = hours < 10 ? "0" + hours : hours;
        minutesElement.innerText = minutes < 10 ? "0" + minutes : minutes;
        secondsElement.innerText = seconds < 10 ? "0" + seconds : seconds;

        if (timeRemaining < 0) {
            clearInterval(countdownInterval);
            daysElement.innerText = "00";
            hoursElement.innerText = "00";
            minutesElement.innerText = "00";
            secondsElement.innerText = "00";
            alert("Countdown selesai!");
        }
    }

    const countdownInterval = setInterval(updateCountdown, 1000);
}

// ---------------------------------------

// pop up event
function showPopupEvent(element) {
    const popupEvent = document.getElementById("popupEvent");
    popupEvent.classList.add("muncul"); // Tambahkan kelas show untuk animasi muncul
    popupEvent.style.display = "flex"; // Tampilkan pop-up

    const description = element.getAttribute("data-description");
    const date = element.getAttribute("data-date");

    // Log untuk melihat nilai yang diambil
    console.log("Deskripsi:", description);
    console.log("Tanggal:", date);

    // Menampilkan data di dalam pop-up
    document.querySelector(".desk-event").textContent =
        description || "Deskripsi tidak tersedia";
    document.querySelector(".title-box-event").textContent =
        date || "Tanggal tidak tersedia";

    // Menampilkan pop-up
    document.getElementById("popupEvent").style.display = "flex";
}

function closePopupEvent() {
    const popupEvent = document.getElementById("popupEvent");
    popupEvent.classList.remove("muncul"); // Hilangkan kelas show
    popupEvent.classList.add("tutup"); // Tambahkan kelas hide untuk animasi keluar

    // Sembunyikan pop-up setelah animasi selesai
    setTimeout(() => {
        popupEvent.style.display = "none";
        popupEvent.classList.remove("tutup"); // Reset kelas hide setelah pop-up hilang
    }, 300); // 300ms sesuai dengan durasi animasi
}

function closePopupOutsideEvent(event) {
    if (event.target.id === "popupEvent") {
        closePopupEvent();
    }
}
// -----------

// tabel connect  db
