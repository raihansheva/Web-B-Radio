// // audio spectrum
// const content = document.querySelector(".content"),
//     Playimage = content.querySelector(".music-image img"),
//     musicName = content.querySelector(".music-titles .name"),
//     musicArtist = content.querySelector(".music-titles .artist"),
//     Audio = document.querySelector(".main-song"),
//     playBtn = document.querySelectorAll('.play-pause, .play-pause-mobile, .btn-play-streaming'), // Mengambil semua tombol play
//     playBtnIcon = content.querySelector(".play-pause span"),
//     prevBtn = content.querySelector("#prev"),
//     nextBtn = content.querySelector("#next"),
//     progressBar = content.querySelector(".progress-bar"),
//     progressDetails = content.querySelector(".progress-details"),
//     repeatBtn = content.querySelector("#repeat"),
//     Shuffle = content.querySelector("#shuffle");

// const { default: Swiper } = require('swiper');

// let index = 1;

// // Memuat data saat halaman di-load
// window.addEventListener("load", () => {
//     loadData(index);
// });

// // Fungsi untuk memuat data lagu berdasarkan indeks
// function loadData(indexValue) {
//     musicName.innerHTML = songs[indexValue - 1].name;
//     musicArtist.innerHTML = songs[indexValue - 1].artist;
//     Playimage.src = "images/" + songs[indexValue - 1].img + ".jpg";
//     Audio.src = "music/" + songs[indexValue - 1].audio + ".mp3";
// }

// // Menambahkan event listener pada semua tombol play (baik versi web maupun mobile)
// playBtn.forEach(button => {
//     button.addEventListener("click", () => {
//         const isMusicPaused = content.classList.contains("paused");
//         if (isMusicPaused) {
//             pauseSong();
//         } else {
//             playSong();
//         }
//     });
// });

// // Fungsi untuk memainkan lagu
// function playSong() {
//     content.classList.add("paused");
//     updatePlayBtnIcon("pause"); // Memperbarui ikon play untuk semua tombol
//     Audio.play();
// }

// // Fungsi untuk menjeda lagu
// function pauseSong() {
//     content.classList.remove("paused");
//     updatePlayBtnIcon("play_arrow"); // Memperbarui ikon play untuk semua tombol
//     Audio.pause();
// }

// // Fungsi untuk memperbarui ikon tombol play
// function updatePlayBtnIcon(icon) {
//     playBtn.forEach(button => {
//         let iconElement = button.querySelector("span");
//         if (iconElement) {
//             iconElement.innerHTML = icon;
//         }
//     });
// }

// nextBtn.addEventListener("click", () => {
//     nextSong();
// });

// prevBtn.addEventListener("click", () => {
//     prevSong();
// });

// // Fungsi untuk memainkan lagu selanjutnya
// function nextSong() {
//     index++;
//     if (index > songs.length) {
//         index = 1;
//     }
//     loadData(index);
//     playSong();
// }

// // Fungsi untuk memainkan lagu sebelumnya
// function prevSong() {
//     index--;
//     if (index <= 0) {
//         index = songs.length;
//     }
//     loadData(index);
//     playSong();
// }

// // Memperbarui progress bar sesuai dengan waktu audio
// Audio.addEventListener("timeupdate", (e) => {
//     const initialTime = e.target.currentTime; // Waktu lagu saat ini
//     const finalTime = e.target.duration; // Total durasi lagu
//     let BarWidth = (initialTime / finalTime) * 100;
//     progressBar.style.width = BarWidth + "%";

//     // Memungkinkan pengguna untuk mengklik progress bar dan mengubah waktu lagu
//     progressDetails.addEventListener("click", (e) => {
//         let progressValue = progressDetails.clientWidth; // Lebar progress bar
//         let clickedOffsetX = e.offsetX; // Posisi klik
//         let MusicDuration = Audio.duration; // Total durasi musik

//         Audio.currentTime = (clickedOffsetX / progressValue) * MusicDuration;
//     });
// });

// // Ketika lagu berakhir, otomatis ke lagu berikutnya
// Audio.addEventListener("ended", () => {
//     nextSong();
// });

// // Spectrum Audio Visualization
// const svg = document.getElementById("visual");
// const audio = Audio;
// const path = svg.querySelector("#layer1");

// const audioContext = new (window.AudioContext || window.webkitAudioContext)();
// const analyser = audioContext.createAnalyser();
// analyser.fftSize = 2048;
// const bufferLength = analyser.frequencyBinCount;
// const dataArray = new Uint8Array(bufferLength);

// const source = audioContext.createMediaElementSource(audio);
// source.connect(analyser);
// analyser.connect(audioContext.destination);

// function updateVisualization() {
//     analyser.getByteFrequencyData(dataArray);

//     const width = svg.clientWidth;
//     const height = svg.clientHeight;

//     const numPoints = 7;
//     const step = width / (numPoints - 1);

//     let newPath = `M0 ${height / 2}`;

//     for (let i = 1; i < numPoints; i++) {
//         const index = Math.floor(i * (bufferLength / numPoints));
//         const amplitude = dataArray[index] || 0;
//         const scaledAmplitude = (amplitude / 255) * (height / 2);

//         const x = i * step;
//         const y = height / 2 - scaledAmplitude;

//         if (i > 0) {
//             const prevX = (i - 1) * step;
//             const prevY =
//                 height / 2 -
//                 ((dataArray[Math.floor((i - 1) * (bufferLength / numPoints))] ||
//                     0) /
//                     255) *
//                     (height / 2);

//             // Menghitung kontrol titik untuk kurva Bezier
//             const controlX1 = prevX + (x - prevX) * 0.4;
//             const controlY1 = prevY;
//             const controlX2 = prevX + (x - prevX) * 0.6;
//             const controlY2 = y;

//             // Menambahkan kurva Bezier
//             newPath += ` C${controlX1} ${controlY1}, ${controlX2} ${controlY2}, ${x} ${y}`;
//         } else {
//             newPath += ` L${x} ${y}`;
//         }
//     }

//     newPath += ` L${width} ${height / 2}`;
//     path.setAttribute("d", newPath);
//     requestAnimationFrame(updateVisualization);
// }

// audio.addEventListener("play", () => {
//     audioContext.resume().then(() => {
//         updateVisualization();
//     });
// });

// window.addEventListener("resize", () => {
//     path.setAttribute("d", "");
// });
// // ----------------------------------------------

// caraousel program
const tombolKiri = document.querySelector(".tombol-kiri");
const tombolKanan = document.querySelector(".tombol-kanan");
const areaContentBox = document.querySelector(".area-content-box-program");

const getScrollAmount = () => {
    if (window.matchMedia("(max-width: 480px)").matches) {
        return 360;
    } else if (window.matchMedia("(max-width: 768px)").matches) {
        return 350;
    } else if (window.matchMedia("(max-width: 1024px)").matches) {
        return 310;
    } else {
        return 330;
    }
};

tombolKiri.addEventListener("click", () => {
    if (areaContentBox.scrollLeft === 0) {
        areaContentBox.scrollLeft = areaContentBox.scrollWidth; // Kembali ke akhir
    } else {
        areaContentBox.scrollBy({
            left: -getScrollAmount(),
            behavior: "smooth",
        });
    }
});

tombolKanan.addEventListener("click", () => {
    if (
        areaContentBox.scrollLeft + areaContentBox.clientWidth >=
        areaContentBox.scrollWidth
    ) {
        areaContentBox.scrollLeft = 0; // Kembali ke awal
    } else {
        areaContentBox.scrollBy({
            left: getScrollAmount(),
            behavior: "smooth",
        });
    }
});

// ---------------------------------------

// carousel announcer
const tombolKiriA = document.querySelector(".tombol-kiri-announcer");
const tombolKananA = document.querySelector(".tombol-kanan-announcer");
const areaContentBoxA = document.querySelector(".area-content-box-announcer");

const getScrollAmountA = () => {
    if (window.matchMedia("(max-width: 480px)").matches) {
        return 358;
    } else if (window.matchMedia("(max-width: 768px)").matches) {
        return 234;
    } else if (window.matchMedia("(max-width: 1024px)").matches) {
        return 240;
    } else {
        return 330;
    }
};

tombolKiriA.addEventListener("click", () => {
    areaContentBoxA.scrollBy({
        left: -getScrollAmountA(),
        behavior: "smooth",
    });
});

tombolKananA.addEventListener("click", () => {
    areaContentBoxA.scrollBy({
        left: getScrollAmountA(),
        behavior: "smooth",
    });
});
// ----------------------------------------

// card-streaming
const cardA = document.querySelector(".card-A");
const cardB = document.querySelector(".card-B");
const tontonSiaranBtnA = document.querySelector(".card-A .view");
const tontonSiaranBtnB = document.querySelector(".card-B .view-B");

cardA.style.display = "block";
cardA.classList.add("show");

function showCard(card) {
    card.style.display = "block";
    setTimeout(() => {
        card.classList.add("show");
        card.classList.remove("hide");
    }, 10);
}

function hideCard(card) {
    card.classList.remove("show");
    card.classList.add("hide");
    setTimeout(() => {
        card.style.display = "none";
    }, 500);
}

tontonSiaranBtnA.addEventListener("click", function () {
    hideCard(cardA);
    setTimeout(() => {
        showCard(cardB);
    }, 500);
});

tontonSiaranBtnB.addEventListener("click", function () {
    hideCard(cardB);
    setTimeout(() => {
        showCard(cardA);
    }, 500);
});

// youtube-player
var tag = document.createElement("script");
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName("script")[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var player;
var playlistID = document.getElementById("player").getAttribute("data-pl");

function onYouTubeIframeAPIReady() {
    player = new YT.Player("player", {
        height: "360",
        width: "640",
        playerVars: {
            listType: "playlist",
            list: playlistID,
        },
        events: {
            onReady: onPlayerReady,
        },
    });
}

function onPlayerReady(event) {
    event.target.playVideo();
}

// Dapatkan semua elemen schedule dan box-schedule
// const scheduleItems = document.querySelectorAll('.schedule');
// const boxSchedules = document.querySelectorAll('.box-schedule');

// // Tambahkan event listener ke setiap item schedule
// scheduleItems.forEach(item => {
//     item.addEventListener('click', function() {
//         // Dapatkan hari dari elemen yang diklik
//         const day = this.getAttribute('data-day');

//         // Hapus kelas 'active' dari semua box-schedule
//         boxSchedules.forEach(box => {
//             box.classList.remove('active');
//         });

//         // Tampilkan box-schedule yang sesuai dengan hari yang diklik
//         const activeBox = document.querySelector(`.box-schedule[data-day="${day}"]`);
//         activeBox.classList.add('active');
//     });
// });

function showPopup(element) {
    const title = element.getAttribute("data-title");
    const description = element.getAttribute("data-description");
    const time = element.getAttribute("data-time");

    // Log data untuk debug
    console.log("Title:", title); // Pastikan ini mencetak judul
    console.log("Description:", description); // Pastikan ini mencetak deskripsi
    console.log("Time:", time); // Pastikan ini mencetak waktu

    if (title && description && time) {
        document.querySelector(".title-box-program").textContent = title;
        document.querySelector(".desk-program").textContent = description;
        document.querySelector(".jam-program").textContent = time;
        document.getElementById("popup").style.display = "flex"; // Tampilkan popup
    } else {
        console.error("Data tidak ditemukan untuk elemen yang diklik!");
    }
}

function closePopup() {
    const popup = document.getElementById("popup");
    popup.classList.remove("muncul"); // Hilangkan kelas show
    popup.classList.add("tutup"); // Tambahkan kelas hide untuk animasi keluar

    // Sembunyikan pop-up setelah animasi selesai
    popup.style.display = "none";
    popup.classList.remove("tutup"); // Reset kelas hide setelah pop-up hilang
}

function closePopupOutside(event) {
    if (event.target.id === "popup") {
        closePopup();
    }
}

function showPopupEvent(element) {
    console.log("Fungsi showPopupEvent dipanggil"); // Log ini akan menunjukkan apakah fungsi dipanggil
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
    popupEvent.style.display = "none";
    popupEvent.classList.remove("tutup"); // Reset kelas hide setelah pop-up hilang
}

function closePopupOutsideEvent(event) {
    if (event.target.id === "popupEvent") {
        closePopupEvent();
    }
}

// tab chart ardan
document.addEventListener("DOMContentLoaded", () => {
    const tabs = document.querySelectorAll(".tab-chart");
    const tables = document.querySelectorAll(".chart");

    // Menambahkan event listener ke setiap tab
    tabs.forEach((tab) => {
        tab.addEventListener("click", () => {
            // Menghapus kelas aktif dari semua tab
            tabs.forEach((t) => t.classList.remove("active"));
            // Menambahkan kelas aktif ke tab yang dipilih
            tab.classList.add("active");

            // Menyembunyikan semua tabel
            tables.forEach((table) => table.classList.add("hidden"));

            // Menampilkan tabel yang sesuai dengan tab yang dipilih
            const selectedTab = tab.getAttribute("data-tab");
            // console.log('Selected Tab ID:', selectedTab); // Log ID yang dipilih
            const selectedTable = document.getElementById(selectedTab);

            // Debugging log untuk memeriksa
            // console.log('Selected Table:', selectedTable);

            if (selectedTable) {
                selectedTable.classList.remove("hidden");
            } else {
                console.warn(`Table with ID '${selectedTab}' not found.`);
            }
        });
    });

    // Secara default, tampilkan tabel pertama
    const defaultTable = document.querySelector(".chart:not(.hidden)"); // Ambil tabel yang tidak tersembunyi
    if (defaultTable) {
        defaultTable.classList.remove("hidden");
    }
});

var player;

function showPopupYT(videoId) {
    document.getElementById("popup-player").style.display = "flex";

    if (!player) {
        player = new YT.Player("player-yt", {
            height: "360",
            width: "640",
            videoId: videoId,
            events: {
                onReady: function (event) {
                    event.target.playVideo();
                },
            },
        });
    } else {
        player.loadVideoById(videoId);
        player.playVideo();
    }
}

function hidePopup() {
    document.getElementById("popup-player").style.display = "none";
    player.stopVideo(); // Hentikan video saat popup ditutup
}

// Load YouTube IFrame API
var tag = document.createElement("script");
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName("script")[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

function onYouTubeIframeAPIReady() {
    // IFrame API siap
}
function onPlayerReady(event) {
    event.target.playVideo();
}

function hidePopup() {
    document.getElementById("popup-player").style.display = "none";
    if (player) {
        player.stopVideo();
    }
}

// Menambahkan event listener untuk klik di luar player
document
    .getElementById("popup-player")
    .addEventListener("click", function (event) {
        var popupContent = document.querySelector(".popup-content");

        // Jika user klik di luar area .popup-content, tutup popup
        if (!popupContent.contains(event.target)) {
            hidePopup();
        }
    });

// document.addEventListener("DOMContentLoaded", () => {
const tabS = document.querySelectorAll(".schedule");
const scheduleContent = document.querySelectorAll(".box-schedule");

// Array untuk mapping index hari ke nama hari dalam bahasa Indonesia
const dayMapping = [
    "minggu",
    "senin",
    "selasa",
    "rabu",
    "kamis",
    "jumat",
    "sabtu",
];

// Fungsi untuk menampilkan program sesuai dengan hari yang dipilih
function showScheduleForDay(day) {
    // Menyembunyikan semua konten schedule
    scheduleContent.forEach((content) => content.classList.add("hidden"));

    // Menampilkan konten yang sesuai dengan hari yang dipilih
    const selectedSchedule = document.querySelector(
        `.box-schedule[data-day="${day}"]`
    );

    if (selectedSchedule) {
        selectedSchedule.classList.remove("hidden");
    } else {
        console.warn(`Schedule for day '${day}' not found.`);
    }

    // Menandai tab hari sebagai aktif dan menghapus kelas aktif dari tab lainnya
    tabS.forEach((t) => t.classList.remove("active"));
    const selectedTab = document.querySelector(`.schedule[data-day="${day}"]`);
    if (selectedTab) {
        selectedTab.classList.add("active");
    }
}

// Event listener untuk setiap tab hari
tabS.forEach((tabSC) => {
    tabSC.addEventListener("click", () => {
        const selectedDay = tabSC.getAttribute("data-day");
        showScheduleForDay(selectedDay);
    });
});

// Dapatkan hari saat ini (0 = Minggu, 1 = Senin, dst.)
const currentDate = new Date();
const currentDayIndex = currentDate.getDay();
const currentDayName = dayMapping[currentDayIndex]; // Nama hari dalam bahasa Indonesia

// Secara otomatis tampilkan program untuk hari ini
showScheduleForDay(currentDayName);
// });

// Load YouTube API
document.addEventListener("DOMContentLoaded", function () {
    const video = document.getElementById("hlsPlayer");
    const hlsUrl = document.getElementById("player").getAttribute("data-pl");

    if (Hls.isSupported()) {
        const hls = new Hls();
        hls.loadSource(hlsUrl);
        hls.attachMedia(video);
        hls.on(Hls.Events.MANIFEST_PARSED, function () {
            video.play();
        });
    } else if (video.canPlayType("application/vnd.apple.mpegurl")) {
        video.src = hlsUrl;
        video.addEventListener("loadedmetadata", function () {
            video.play();
        });
    }
});
