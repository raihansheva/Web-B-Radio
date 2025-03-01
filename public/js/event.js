// // countdown event
// const daysElement = document.getElementById('days');
// const hoursElement = document.getElementById('hours');
// const minutesElement = document.getElementById('minutes');
// const secondsElement = document.getElementById('seconds');

// const countdownDate = new Date('2024-10-5 23:59:59').getTime();

// function updateCountdown() {
//     const now = new Date().getTime();
//     const timeRemaining = countdownDate - now;

//     const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
//     const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//     const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
//     const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

//     daysElement.innerText = days < 10 ? '0' + days : days;
//     hoursElement.innerText = hours < 10 ? '0' + hours : hours;
//     minutesElement.innerText = minutes < 10 ? '0' + minutes : minutes;
//     secondsElement.innerText = seconds < 10 ? '0' + seconds : seconds;

//     if (timeRemaining < 0) {
//         clearInterval(countdownInterval);
//         daysElement.innerText = "00";
//         hoursElement.innerText = "00";
//         minutesElement.innerText = "00";
//         secondsElement.innerText = "00";
//         alert('Countdown selesai!');
//     }
// }

// const countdownInterval = setInterval(updateCountdown, 1000);
// // ---------------------------------------


// pop up event
function showPopupEvent(element) {
    console.log("Fungsi showPopupEvent dipanggil"); // Log ini akan menunjukkan apakah fungsi dipanggil
    const description = element.getAttribute("data-description");
    const date = element.getAttribute("data-date");
    const slug = element.getAttribute("data-slug"); // Ambil slug dari data attribute

    // Log untuk melihat nilai yang diambil
    console.log("Deskripsi:", description);
    console.log("Tanggal:", date);
    console.log("Slug:", slug);

    // Menampilkan data di dalam pop-up
    document.querySelector(".desk-event").textContent =
        description || "Deskripsi tidak tersedia";
    document.querySelector(".title-box-event").textContent =
        date || "Tanggal tidak tersedia";

    // Set href pada link "See detail"
    const detailLink = document.querySelector(".detail-link");
    detailLink.href = `/event/${slug}`; // Update URL sesuai dengan slug

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
// -----------


// pop up program
function showPopup(element) {
    document.getElementById("popup").style.display = "flex"; // Tampilkan popup

    const title = element.getAttribute("data-title");
    const description = element.getAttribute("data-description");
    const time = element.getAttribute("data-time");
    const slug = element.getAttribute("data-slugP");
    const deskP =element.getAttribute("data-deskP");

    // Log data untuk debug
    console.log("Title:", title); // Pastikan ini mencetak judul
    console.log("Description:", description); // Pastikan ini mencetak deskripsi
    console.log("Time:", time); // Pastikan ini mencetak waktu
    console.log("Time:", deskP); // Pastikan ini mencetak waktu

    document.querySelector(".title-box-program").textContent = title || "Deskripsi tidak tersedia";
    document.querySelector(".desk-program").textContent = description || "Deskripsi tidak tersedia";
    document.querySelector(".jam-program").textContent = time || "Deskripsi tidak tersedia";

    const detailLink = document.querySelector(".detail-link-program");

    if (deskP) {
        // Tampilkan detailLink jika deskShort ada
        detailLink.style.display = "block";
        detailLink.href = `/program/${slug}`; // Update URL sesuai dengan slug
    } else {
        // Sembunyikan detailLink jika deskShort tidak ada
        detailLink.style.display = "none";
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
// -----------