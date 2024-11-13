function basename(path) {
    return path.split('/').reverse()[0];
}
function sleep(ms){
    return new Promise(resolve => setTimeout(resolve, ms));
}


$(document).ready( function () {
    console.log("go");
    var table = $("#hedexTopTitles").DataTable({
        language: {
            url: 'js/fr-FR.json',
        },
        scrollY: '55vh',
        dom: 'Bfrtip',
        buttons: ['pdf', 'excel', 'copy', 'csv', 'print']
    });
    $("#hedexTopTitles").show();

    table.on('page.dt', function () {
        setPreviewPlayers();
    } );
    table.on('draw.dt', function () {
        setPreviewPlayers();
    })
    
});

var audio = new Audio();
var volume = 0;
var firstPlay = 1;
function clearButtons(){
    document.querySelectorAll(".audioPlayer").forEach(button => {
        button.innerText = "▶️";
    });
}
function setPreviewPlayers(){
    audio.pause();
    clearButtons();
    document.querySelectorAll(".audioPlayer").forEach(button => {
        button.addEventListener("click", () => {
            if(!audio.paused){
                audio.pause();
                audio.currentTime = 0;
                var playing = true;
            }
            if(basename(audio.src) != basename(button.value)){
                audio.src = button.value;
                playAudio();
            } else if(!playing) playAudio();

            clearButtons();
            if(audio.paused) button.innerText = "▶️";
            else button.innerText = "⏸️";

            audio.addEventListener("ended", (event) => {
                clearButtons();
            });
        });
    });
}
function playAudio(){
    audio.addEventListener("progress", () => {
        if(firstPlay){
            slowVolumeUp();
            firstPlay = 0;
        }
    })
    
    audio.play();
}
var stopAutoVolumeUp = 0;
function slowVolumeUp(){
    popUp = document.getElementById("info");
    popUp.classList.remove("inactive");
    audio.volume = 0;
    popUp.querySelector("p").innerHTML = '<input onclick="stopAutoVolumeUp = 1;" onchange="updateVolume();" oninput="updateVolume();" type="range" id="volume-slider"><span onclick="this.parentNode.parentNode.style.display = `none`;"><img src="./images/croix-petit.png" alt="Fermer l\'info-bulle."></span>';
    document.getElementById("volume-slider").value = 0;
    autoVolumeUp();
}
function autoVolumeUp(){
    if(stopAutoVolumeUp) return;
    if(audio.volume * 100 >= 67) return;
    var volumeSlider = document.getElementById("volume-slider");
    volumeSlider.value = audio.volume * 100 + 1;
    audio.volume = volumeSlider.value / 100;
    sleep(60).then((() => {autoVolumeUp();}))
}
function updateVolume(){
    var volumeSlider = document.getElementById("volume-slider");
    audio.volume = volumeSlider.value / 100;
    stopAutoVolumeUp = 1;
}