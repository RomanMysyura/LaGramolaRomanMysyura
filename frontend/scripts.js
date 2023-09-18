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
        <h3>${playlist.name}</h4>
            
            <ul class="songsplaylist">
                ${divSongs}
            </ul>
        </div>
        
        `;
    });
}

