
function nextSong(songid) {
    window.location.href = window.location.origin + "/index.php?songid=" + (parseInt(songid) + 1);

}

function previousSong(songid) {
    window.location.href = window.location.origin = "/index.php?songid=" + (parseInt(songid) - 1);
}


function triarcanco(songid) {
    console.log(songid)
    window.location.href = window.location.origin = "/index.php?songid=" + songid;

}


function randomSong(idmax, songid) {


    let random = (parseInt(Math.random() * idmax));
    do {
        random = (parseInt(Math.random() * idmax));
    }
    while (random == songid)
    //  Canvia al seguent valor que es random
    window.location.href = window.location.origin + "/index.php?songid=" + random;
}

fetch("playlists.json")
    .then(resposta => resposta.json())
    .then(playlists => {
        fetch("songs.json")
            .then(resposta => resposta.json())
            .then(songs => {
                carregarPlaylists(playlists, songs)
            })
    })

function carregarPlaylists(playlists, songs) {
    const divPlaylists = document.getElementById("playlists");

    playlists.forEach(playlist => {
        var divSongs = "";

        playlist.songs.forEach(songid => {
            divSongs += `
                <div class="song">
                    <img src="${songs[songid].image}" alt="${songs[songid].title}" class="song-image">
                
                    <a class="botocanco" onclick="triarcanco(${songid})">   
                        ${songs[songid].num} - ${songs[songid].title}
                    </a>
                </div>
            `;
        })


        divPlaylists.innerHTML += `
        
        <div class="playlist">

        <details>
            <summary><h3>${playlist.name}</h3></summary>
            <p><ul class="songsplaylist">${divSongs}</p>
        </details>
        </div>
        
        `;
    });
}

let audioElement = document.getElementById('player');
let queryString = window.location.search;

let urlParams = new URLSearchParams(queryString);

// Asignar el valor del parámetro 'songid' a 'currentSong'
let currentSong = urlParams.get('songid');

// Convertirlo a número (si sabes que siempre será un número)
currentSong = Number(currentSong);

let songs = [];

// Cargar canciones desde songs.json
fetch('songs.json')
    .then(response => response.json())
    .then(data => {
        songs = data;
    });


// Crear una variable para rastrear si el audio ya está cargado o no.
let isAudioLoaded = false;


function playPause() {








    let playImage = "images/tocar.svg";
    let pauseImage = "images/pausa.svg";
    let bcntrlplayImg = document.getElementById("bcntrlplay");

    var bcntrlbefore = document.getElementById('bcntrlbefore');
    var bcntrlrandom = document.getElementById('bcntrlrandom');
    var bcntrlnext = document.getElementById('bcntrlnext');

    var rotateiconasong = document.getElementById('rotateiconasong');
    rotateiconasong.classList.add('iconasong-rotating');

    var IDequalizer1 = document.getElementById('IDequalizer1');
    var IDequalizer2 = document.getElementById('IDequalizer2');
    var IDequalizer3 = document.getElementById('IDequalizer3');
    var IDequalizer4 = document.getElementById('IDequalizer4');
    var IDequalizer5 = document.getElementById('IDequalizer5');
    var IDequalizer6 = document.getElementById('IDequalizer6');
    var IDequalizer7 = document.getElementById('IDequalizer7');
    var IDequalizer8 = document.getElementById('IDequalizer8');


    IDequalizer1.classList.add('IDequalizer1Rotating');
    IDequalizer2.classList.add('IDequalizer2Rotating');
    IDequalizer3.classList.add('IDequalizer3Rotating');
    IDequalizer4.classList.add('IDequalizer4Rotating');
    IDequalizer5.classList.add('IDequalizer5Rotating');
    IDequalizer6.classList.add('IDequalizer6Rotating');
    IDequalizer7.classList.add('IDequalizer7Rotating');
    IDequalizer8.classList.add('IDequalizer8Rotating');

    if (audioElement.paused) {

        // Cada cop que cliquem el boto Play, fara que s'incrementa el valor "reproduccions" en el arxiu songs.json
        fetch('updateSong.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `currentSong=${currentSong}`, // Envía el valor de currentSong al archivo PHP
        })
            .then(response => response.text())
            .then(data => {
                // Aquí puedes manejar la respuesta del servidor si es necesario

            })
            .catch((error) => {
                console.error('Error, no sha guardat la reproducció:', error);
            });





        if (!isAudioLoaded) {
            audioElement.setAttribute('src', songs[currentSong].url);
            isAudioLoaded = true;

        }



        audioElement.play();

        bcntrlbefore.style.opacity = '0.4';
        bcntrlrandom.style.opacity = '0.4';
        bcntrlnext.style.opacity = '0.4';

        // Change the button image to 'detengase.svg' when playing
        bcntrlplayImg.setAttribute('src', pauseImage);



        cancion.addEventListener("loadedmetadata", () => {
            const divElement = document.getElementById("myDiv");

            // Aquí obtienes específicamente el width del elemento con id "myDiv"
            const divWidth = parseInt(getComputedStyle(divElement).width);
            const pxPerS = divWidth / cancion.duration;

            setInterval(
                function () {
                    let porcentaje = (cancion.currentTime / cancion.duration) * 100;

                    // // Actualizar el valor del input
                    progreso.value = porcentaje;

                    currentTimeElement.textContent = formatTime(cancion.currentTime);

                    const divElement = document.getElementById("myDiv");

                    // Obtener el padding-right actual y convertirlo a un número entero

                    console.log(cancion.currentTime * pxPerS)
                    divElement.style.width = (cancion.currentTime * pxPerS) + "px";
                }, 0);

        })









    } else {
        playing = false;
        audioElement.pause();

        // Change the button image back to 'tocar.svg' when paused
        bcntrlplayImg.setAttribute('src', playImage);
        bcntrlbefore.style.opacity = '1';
        bcntrlrandom.style.opacity = '1';
        bcntrlnext.style.opacity = '1';

        rotateiconasong.classList.remove('iconasong-rotating');

        IDequalizer1.classList.remove('IDequalizer1Rotating');
        IDequalizer2.classList.remove('IDequalizer2Rotating');
        IDequalizer3.classList.remove('IDequalizer3Rotating');
        IDequalizer4.classList.remove('IDequalizer4Rotating');
        IDequalizer5.classList.remove('IDequalizer5Rotating');
        IDequalizer6.classList.remove('IDequalizer6Rotating');
        IDequalizer7.classList.remove('IDequalizer7Rotating');
        IDequalizer8.classList.remove('IDequalizer8Rotating');




    }

}







function stopSong() {
    audioElement.pause();
    audioElement.currentTime = 0; // Fa reset a la posició de la cancó
    let playImage = "images/tocar.svg";
    let bcntrlplayImg = document.getElementById("bcntrlplay");
    bcntrlplayImg.setAttribute('src', playImage);

    var bcntrlbefore = document.getElementById('bcntrlbefore');
    var bcntrlrandom = document.getElementById('bcntrlrandom');
    var bcntrlnext = document.getElementById('bcntrlnext');

    bcntrlbefore.style.opacity = '1';
    bcntrlrandom.style.opacity = '1';
    bcntrlnext.style.opacity = '1';

    var rotateiconasong = document.getElementById('rotateiconasong');
    rotateiconasong.classList.remove('iconasong-rotating');


    IDequalizer1.classList.remove('IDequalizer1Rotating');
    IDequalizer2.classList.remove('IDequalizer2Rotating');
    IDequalizer3.classList.remove('IDequalizer3Rotating');
    IDequalizer4.classList.remove('IDequalizer4Rotating');
    IDequalizer5.classList.remove('IDequalizer5Rotating');
    IDequalizer6.classList.remove('IDequalizer6Rotating');
    IDequalizer7.classList.remove('IDequalizer7Rotating');
    IDequalizer8.classList.remove('IDequalizer8Rotating');


}




const cancion = document.getElementById('player');
const progreso = document.querySelector('.progreso');

// Asegúrate de que el rango máximo del input sea igual a la duración de la canción
cancion.addEventListener('loadedmetadata', function () {
    progreso.max = cancion.duration;
});



function formatTime(seconds) {
    let minutes = Math.floor(seconds / 60);
    seconds = Math.floor(seconds) % 60;
    return `${String(minutes).padStart(2, "0")}:${String(seconds).padStart(2, "0")}`;
}


const currentTimeElement = document.getElementById('currentTime');
const totalTimeElement = document.getElementById('totalTime');


cancion.addEventListener('loadedmetadata', function () {
    progreso.max = cancion.duration;

    // Actualizar el tiempo total en el reproductor
    totalTimeElement.textContent = formatTime(cancion.duration);
});


