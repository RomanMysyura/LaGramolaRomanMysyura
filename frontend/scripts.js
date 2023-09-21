function nextSong(songid) {
    window.location.href = window.location.origin + "/index.php?songid=" + (parseInt(songid) + 1);

}

function previousSong(songid) {
    window.location.href = window.location.origin = "/index.php?songid=" + (parseInt(songid) - 1);
}




function triarcanco(songid){
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
                <a class="botocanco" onclick="triarcanco(${songid})">   
                ${songs[songid].num} - 
                ${songs[songid].title}
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

console.log(currentSong); // Esto mostrará 0, 3



let songs = []; 




// Cargar canciones desde songs.json
fetch('songs.json')
    .then(response => response.json())
    .then(data => {
        songs = data;
    });

function playPause() {
    if (audioElement.paused) {
        audioElement.setAttribute('src', songs[currentSong].url);
        audioElement.play();
    } else {
        audioElement.pause();
    }
}

function stopSong() {
    audioElement.pause();
    audioElement.currentTime = 0; // Fa reset a la posició de la cancó
}

const cancion = document.getElementById('player');
const progreso = document.querySelector('.progreso');

cancion.addEventListener('timeupdate', function() {
    // Calcular el porcentaje de progreso de la canción
    let porcentaje = (cancion.currentTime / cancion.duration) * 100;
    
    
    // Actualizar el valor del input
    progreso.value = porcentaje;
});

progreso.addEventListener("input", function () {
    cancion.currentTime = progreso.value / 100 * cancion.duration;
});


// Asegúrate de que el rango máximo del input sea igual a la duración de la canción
cancion.addEventListener('loadedmetadata', function() {
    progreso.max = cancion.duration;
});