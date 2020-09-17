<?php 
// Начална страница
require 'includes/init.inc'; 
// горна и лява част на сайта
$page_title = 'Начало - Музикален магазин';
$navigation = NULL;
$gid=1;

require 'includes/header.inc'; 
// дясна част с основна информация 
print'<h1>Тук са най-добрите албуми на пазара!</h1>
      <h2>Най-новите албуми!</h2>';
// Заявка за извеждане на последните 3 въведени кучета. Използва се съединение от тип JOIN
   $query = "SELECT albums.*, album_genres.genre FROM albums 
             JOIN album_genres ON albums.album_genre_id=album_genres.album_genre_id "
  		     .($gid?" WHERE albums.album_genre_id=".$gid:"")." ORDER BY album_id DESC LIMIT 3";
  $result = $mysqli->query($query);
  $num_results = $result->num_rows;
// Ако има върнат резултат
  if($num_results>0){
	print'<table class="table-view"><tr>';
    $j=0;
    while($row = $result->fetch_assoc()){
	print'<td>';
		    $object_title = htmlspecialchars(stripslashes($row['name']));
			$pic = $row['picture'];
			$pic_exists = file_exists($pic); // съществува ли снимка
    print'
        <a href="album.php?id='.$row['album_id'].'">
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