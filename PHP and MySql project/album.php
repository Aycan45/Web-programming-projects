<?php 
require 'includes/init.inc';

$id = (int)$_REQUEST['id'];
if($id) { 
	$query = "SELECT albums.*, album_genres.genre"
	." FROM albums JOIN album_genres ON albums.album_genre_id=album_genres.album_genre_id WHERE album_id=".$id;
    $res = $mysqli->query($query);
	$row_album = $res->fetch_assoc();
	$nav = ' / <a href="albums.php'.($row_album['album_genre_id']?'?kid='.$row_album['album_genre_id']:'').'">'.htmlspecialchars(stripcslashes($row_album['genre'])).'</a>'
			.' / <a href="'.$_SERVER['PHP_SELF'].($id?'?id='.$id:'').'">'.htmlspecialchars(stripcslashes($row_album['name'])).'</a>';
	$page_title = 'Музикален магазин - '.htmlspecialchars(stripcslashes($row_album['name']));
}

require 'includes/header.inc'; 
?>
<div style="text-align: left">	
<table class="album-info-table">
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>
		<?php
		 print '<h1>'.htmlspecialchars(stripslashes($row_album['name'])).'</h1>';
			if($row_album["genre"]){
           		print'<div>Жанр: '.htmlspecialchars(stripslashes($row_album["genre"])).'</div>';
           	}
        	if($row_album["price"]){
           		print'<div>Цена: '.$row_album["price"].' лв.</div>';
        	}
        	if($row_album["description"]){
           		print'<div>Описание: '.htmlspecialchars(stripslashes($row_album["description"])).'</div>';
        	}     
        ?>		
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>
			<?php
			   $object_title = htmlspecialchars(stripslashes($row_album['name']));
			   $pic = $row_album['picture'];
			   $pic_exists = file_exists($pic); // съществува ли снимка
			print'<img class="img-album" src="'.$pic.'" alt="'.$object_title.'" title="'.$object_title.'">';
			?>
		</td>
	</tr>
</table>             
</div>
<?php
require 'includes/footer.inc'; 
 ?>