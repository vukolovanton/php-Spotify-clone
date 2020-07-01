let currentPlayList = [];
let tempPlayList = [];
let audioElement;
let mouseDown = false;
let currentIndex = 0;
let repeat = false;
let timer;

function formatTime(duration) {
    let time = Math.round(duration);
    let minutes = Math.floor(time / 60);
    let seconds = time - minutes * 60;

    const extraZero = (seconds < 10) ? "0" : "";
    return minutes + ":" + extraZero + seconds;
};

function openPage(url) {
    if(timer != null) {
        clearTimeout(timer);
    }

    if(url.indexOf("?") == -1 ) {
        url = url + "?";
    }

    let encodedUrl = encodeURI(url + "&userLoggedIn=" + userLoggedIn);
    $("mainContent").load(encodedUrl);
    $("body").scrollTop(0);
}

function updateTimeProgressBar(audio) {
    $(".progressTime.current").text(formatTime(audio.currentTime));
    $(".progressTime.remaining").text(formatTime(audio.duration - audio.currentTime));

    const progress = audio.currentTime / audio.duration * 100;
    $(".progress").css("width", progress + "%");
};

class Audio {
    constructor() {
        this.currentlyPlaying;
        this.audio = document.createElement('audio');

        this.audio.addEventListener("ended", function() {
            nextSong();
        })

        this.audio.addEventListener("canplay", function() {
            let duration = formatTime(this.duration)
            $(".progressTime.remaining").text(duration);
        });

        this.audio.addEventListener("timeupdate", function() {
            if(this.duration) {
                updateTimeProgressBar(this);
            }
        })

        this.setTrack = function (track) {
            this.currentlyPlaying = track;
            this.audio.src = track.path;
            // this.audio.play();
        };

        this.play = function () {
            this.audio.play();
        };

        this.pause = function () {
            this.audio.pause();
        };

        this.setTime = function(seconds) {
            this.audio.currentTime = seconds;
        }
    }
}
