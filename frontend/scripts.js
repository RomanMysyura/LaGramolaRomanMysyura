
// Funció que redirigeix ​​l'usuari a la cançó següent basant-se en el songid
function nextSong(songid) {
    window.location.href = window.location.origin + "/index.php?songid=" + (parseInt(songid) + 1);
}
// Funció que redirigeix ​​l'usuari a la cançó anterior
function previousSong(songid) {
    window.location.href = window.location.origin = "/index.php?songid=" + (parseInt(songid) - 1);
}
// Funció que redirigeix ​​l'usuari a la cançó seleccionada
function triarcanco(songid) {
    console.log(songid)
    window.location.href = window.location.origin = "/index.php?songid=" + songid;
}

// Funció que redirigeix ​​l'usuari a la cançó aleatoria
function randomSong(idmax, songid) {


    let random = (parseInt(Math.random() * idmax));
    do {
        random = (parseInt(Math.random() * idmax));
    }
    while (random == songid)
    //  Canvia al seguent valor que es random
    window.location.href = window.location.origin + "/index.php?songid=" + random;
}
//Carreguem la informacio de las playlists i las cançons
fetch("playlists.json")
    .then(resposta => resposta.json())
    .then(playlists => {
        fetch("songs.json")
            .then(resposta => resposta.json())
            .then(songs => {
                carregarPlaylists(playlists, songs)
                audioElement.setAttribute('src', songs[currentSong].url);
                audioElement.addEventListener("loadedmetadata", () => {
                    const totalTimeElement = document.getElementById('totalTime');
                    totalTimeElement.textContent = formatTime(audioElement.duration);
                })
            })
    })
//Funció per carregar les playlists y las cançons de cada playlist
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

// Asigna el valor del parametre 'songid' a 'currentSong'
let currentSong = urlParams.get('songid');

// Converteix a numero 
currentSong = Number(currentSong);
let songs = [];

// Carrega cançons desde songs.json
fetch('songs.json')
    .then(response => response.json())
    .then(data => {
        songs = data;
    });


// Funció que permet reproduir o pausar la cançó actual
function playPause() {

    cancion.addEventListener('timeupdate', function () {
        progreso.value = cancion.currentTime;  // Actualitza el valor del slider
    });
    progreso.addEventListener('input', function () {
        cancion.currentTime = progreso.value;  // Actualitza la posició de la cançò
    });
    cancion.addEventListener('loadedmetadata', function () {
        progreso.max = cancion.duration;

        // Actualitza el temps total del reproductor
        const totalTimeElement = document.getElementById('totalTime');
        totalTimeElement.textContent = formatTime(cancion.duration);
    });

    // Actualitza el temps real de la cançó
    cancion.addEventListener('timeupdate', function () {
        const currentTimeElement = document.getElementById('currentTime');
        currentTimeElement.textContent = formatTime(cancion.currentTime);
    });


    let playImage = "images/tocar.svg";
    let pauseImage = "images/pausa.svg";
    let bcntrlplayImg = document.getElementById("bcntrlplay");
    var bcntrlbefore = document.getElementById('bcntrlbefore');
    var bcntrlrandom = document.getElementById('bcntrlrandom');
    var bcntrlnext = document.getElementById('bcntrlnext');

    //Executa la animació de rotació de la imatge
    var rotateiconasong = document.getElementById('rotateiconasong');
    rotateiconasong.classList.add('iconasong-rotating');

    //Aquesta part serveix per moure les barras del volum fals
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

    //Aquesta funció s'executa quan la cançó esta reproduint
    if (audioElement.paused) {
        // S'incrementa el valor "reproduccions" en el arxiu songs.json
        fetch('updateSong.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `currentSong=${currentSong}`, // Envia el valor de currentSong al arxiu PHP
        })
            .then(response => response.text())
            .then(data => {
            })
            .catch((error) => {
                console.error('Error, no sha guardat la reproducció:', error);
            });

        audioElement.play();

        // Cambia la transparencia dels buttons
        bcntrlbefore.style.opacity = '0.4';
        bcntrlrandom.style.opacity = '0.4';
        bcntrlnext.style.opacity = '0.4';

        // Cambia la imatge del botó
        bcntrlplayImg.setAttribute('src', pauseImage);

        //Aquesta funció s'executa quan la cançó esta pausada
    } else {
        playing = false;
        audioElement.pause();

        // Cambia la imatge del botó
        bcntrlplayImg.setAttribute('src', playImage);

        // Cambia la transparencia dels buttons
        bcntrlbefore.style.opacity = '1';
        bcntrlrandom.style.opacity = '1';
        bcntrlnext.style.opacity = '1';

        // Para el moviment de rotació per la imatge
        rotateiconasong.classList.remove('iconasong-rotating');

        // Elimina les classes de les barres per parar el moviment, ja que la cançó esta parada
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

// Aquesta funció s'executa quan la cançó esta parada
function stopSong() {
    audioElement.pause();
    audioElement.currentTime = 0; // Fa reset a la posició de la cancó
    let playImage = "images/tocar.svg";
    let bcntrlplayImg = document.getElementById("bcntrlplay");
    bcntrlplayImg.setAttribute('src', playImage);

    var bcntrlbefore = document.getElementById('bcntrlbefore');
    var bcntrlrandom = document.getElementById('bcntrlrandom');
    var bcntrlnext = document.getElementById('bcntrlnext');

    // Cambia la transparencia dels botons
    bcntrlbefore.style.opacity = '1';
    bcntrlrandom.style.opacity = '1';
    bcntrlnext.style.opacity = '1';

    // Para la animació de la rotació de la imatge
    var rotateiconasong = document.getElementById('rotateiconasong');
    rotateiconasong.classList.remove('iconasong-rotating');

    // Para la animació de les barres falses
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


// cancion.addEventListener('loadedmetadata', function () {
//     progreso.max = cancion.duration;
// });

// Serveix per cambiar el format del temps de segons normals a per exemple 00:24
function formatTime(seconds) {
    let minutes = Math.floor(seconds / 60);
    seconds = Math.floor(seconds) % 60;
    return `${String(minutes).padStart(2, "0")}:${String(seconds).padStart(2, "0")}`;
}

//Aquesta part serveix per actualitzar els valors de temps real de la cançó i temps total de la cançó
const currentTimeElement = document.getElementById('currentTime');
const totalTimeElement = document.getElementById('totalTime');
cancion.addEventListener('loadedmetadata', function () {
    progreso.max = cancion.duration;
    totalTimeElement.textContent = formatTime(cancion.duration);
});
