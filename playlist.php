<?php
$name='album';
include("includes/header.php");
include_once("includes/autoload.php");
$artistRepo=new ArtistRepository();
$albumRepo=new AlbumRepository();
$playlistRepo=new playlistRepository();
if(isset($_GET['id']))
{
    $playlistId=$_GET['id'];
}
else
{
    header("Location:index.php");
}
$data=1;
$data=$playlistRepo->findById($data);
$playlist=new Playlist($playlistId);
$owner=new User($playlist->getOwner());
?>
    <div class="square">
    <div class="col1">
        <div class="leftSection">

            <img src='assets/icons/cover.svg' alt='playlist'>

        </div>
        <div class="rightSection">

            <h2><?=$playlist->getName()?></h2>

            <h1>By </h1>
            <h0><?=$playlist->getOwner();?></h0>
            <button class="buttonDelete" onclick="deletePlaylist('<?php echo $playlistId; ?>')" >DELETE PLAYLIST</button>

        </div>
        <hr>
        <div class="bottomSection">

            <p class="bottomLeft bold"><?=$playlist->getNumberOfSongs()?></p>
            <p class="bottomRight"><span class="bold">45</span><span>min</span></p>
        </div>
        <div class="bottomSection1">

            <p class="bottomLeft">Songs</p>
            <p class="bottomRight">Playtime</p>
        </div>
    </div>
    <div class="col2">
        <div class="top">
            <div class="columnn1">#</div>
            <div class="columnn2">Title</div>
            <div class="columnn3">Duration</div>
            <div class="more"></div>
        </div>
        <div class='AlbumtracklistContainer'>
            <?php
            $i=1;
            $songIdArray=$playlist->getSongIds();
            foreach($songIdArray as $songId)
            {
                $song=new Song($songId);
                $artistSong=$song->getArtist();

                echo "
               <div class='tracklistRow'>
                        <div class='columnn1'>" . $i . "</div>
                        <div class='columnn2'>" . $playlistSong->getTitle() . "</div>
                        <div class='columnn3'>" . $playlistSong->getDuration() . "</div>
                       
                        <div class='more'>
                         <input type='hidden' class='songId' value='".$playlistSong->getId()."'>
                        <img  src='assets/icons/more.svg' alt='' class='moreImg' onclick='showOptionsMenu(this)'></div>
                    </div>

                 ";
                $i+=1;} ?>


        </div>
    </div>






<?php include("includes/footer.php");?>