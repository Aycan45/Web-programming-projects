<?php 
require 'includes/init.inc'; 
$link_text = '';
$gid =  (int)$_REQUEST['kid']; 
if($gid) { 
	$query = "SELECT * FROM album_genres WHERE album_genre_id=".$gid; 
	$result = $mysqli->query($query);
	$row = $result->fetch_assoc();
	$link_text = htmlspecialchars(stripcslashes($row['genre']));
}
// Конфигуриране на променливите $navigation и $page_title
$navigation = ' / <a href="'.$_SERVER['PHP_SELF'].($gid?'?gid='.$gid:'').'">'.$link_text.'</a>';
$page_title = $link_text.' - Музикален магазин';

require 'includes/header.inc';

print'<h1>'.$link_text.'</h1>';
// Заявка за извличане на информацията за животните от определен вид
  $query = "SELECT albums.*, album_genres.genre FROM albums "
  		." JOIN album_genres ON albums.album_genre_id=album_genres.album_genre_id "
  		.($gid?" WHERE albums.album_genre_id=".$gid:"")." ORDER BY album_id ASC";
  $result = $mysqli->query($query);
  $num_results = $result->num_rows;
  if($num_results>0){
	print'<table class="table-view"><tr>';
    $j=0;
    while($row = $result->fetch_assoc()){
	print'<td>';
		 $object_title = htmlspecialchars(stripslashes($row['name']));
		 $pic = $row['picture'];
		 $pic_exists = file_exists($pic); // съществува ли снимка
        print'<a href="album.php?id='.$row['album_id'].'">
        	<img class="img-album" src="'.$pic.'" alt="'.$object_title.'" title="'.$object_title.'">
        </a>              
        <h2 class="album-name">'.htmlspecialchars(stripslashes($row['name'])).'</h2>';
        if($row["price"]){
           	print'<div class="album-price">'.$row["price"].' лв.</div>';
        }
        print'<a href="album.php?id='.$row["album_id"].'" class="more-info">Повече информация</a>
    </td>';
	$i=0;
	  if($j==2)
	  {
	    if(($i+1)<$num_results)
	      print '</tr><tr>';
		$j = 0;
	  }
	  else
	    $j++;  
	}
  print'</tr></table>';
  }
require 'includes/footer.inc'; 
?>