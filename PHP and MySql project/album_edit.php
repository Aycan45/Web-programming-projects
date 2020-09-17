<?php 
require 'includes/init.inc';
 $errMsg = NULL;
 $infMsg = NULL;
 $operation_type = 'Нов албум';
  if($_REQUEST){ 
  	$id = (int)$_REQUEST['id'];
  } else { 
  	$id = NULL; 
  } 
  
  if($_POST){
 $operation_type = 'Редактиране на албум';
	$id = $mysqli->escape_string(trim($_POST['id']));
	$name = $mysqli->escape_string(trim($_POST['name']));
	$album_genre_id = $mysqli->escape_string($_POST['album_genre_id']); 
	$price = $mysqli->escape_string((int)trim($_POST['price']));
	$description = $mysqli->escape_string(trim($_POST['description']));
	$picture = $mysqli->escape_string(trim($_POST['picture']));

    if(!$_POST['name'] || !$_POST['picture']){
    	$errMsg = 'Не сте задали задължителните полета.';
	} else {	
		$picture=$picture.'.jpg';
  		if($id){ 
  			$query = "UPDATE albums SET "
					." name= ".($name?"'".$name."'":"NULL").", "
					." album_genre_id= ".($album_genre_id?"'".$album_genre_id."'":"NULL").", "
					." price= ".($price?"'".$price."'":"NULL").", "
					." picture= ".($picture?"'".$picture."'":"NULL").", "
					." description= ".($description?"'".$description."'":"NULL")
					." WHERE album_id=".$id." AND album_id>5";
  		} else { 
			$query = "INSERT INTO albums(name, album_genre_id, price, picture, description) VALUES ("
					.($name?"'".$name."'":"NULL").", "
					.($album_genre_id?"'".$album_genre_id."'":"NULL").", "
					.($price?"'".$price."'":"NULL").", "
					.($picture?"'".$picture."'":"NULL").", "
					.($description?"'".$description."'":"NULL")
					.")";	
		} 
		$mysqli->query($query);
		$id = $id?$id:$mysqli->insert_id;
		$infMsg = 'Данните са записани!';
	}
  } else { 
  } 
  	if($id) { 
	  $query = "SELECT * FROM albums WHERE album_id=".$id;
	  $result = $mysqli->query($query);
	  if($row = $result->fetch_assoc()){
	  	$operation_type = 'Редактиране на албум';
	  	$name = $row['name'];
		$album_genre_id = $row['album_genre_id'];
		$price = $row['price'];
		$description = $row['description'];
		$picture = $row['picture'];
	  }
	}
  $nav = ' / <a href="albums_edit.php">Албуми</a>'.' / '.$operation_type;
  $page_title = $operation_type.' - Музикален албум';

require 'includes/header.inc';

print' <div align="center"> ';
if($id>=1 && $id<=5){
	print'<div style="color:red; margin-top:20px;">(Само в online-версията, за първите 5 албуми e забраненa операциията UPDATE.)</div>';
} 
    
    if($errMsg){
		print'<div class="errorBlock">'.$errMsg.'</div>';
	} 
	if($infMsg){
		print'<div class="infoBlock">'.$infMsg.'</div>';
	} 
	if($_POST || $_REQUEST){ 

print '	<form method="post" name="f" action="'.$_SERVER['PHP_SELF'].'" class="form">
		<input type="hidden" name="id" value="'.$id.'">
		<input type="hidden" name="picture" value="'.$picture.'">
	    <div class="form-title"><?php echo $operation_type ?></div>';  
	       $pic = $picture;
		   $pic_exists = file_exists($small_pic); 
		   print $pic_exists?'<div class="form-row" style="text-align:center"><img src="'.$pic.'" title="" alt=""></div>':'';
		 
	print'<div class="form-row">
	        <label for="name">* Име</label>
	        <input type="text" maxlength="64" name="name" id="name" value="'.htmlspecialchars(stripslashes($name)).'">
	    </div>
	    <div class="form-row">
	        <label for="album_genre_id">* Жанр</label>
	        <select name="album_genre_id" id="album_genre_id">';
		          $query = 'SELECT * FROM album_genres ORDER BY genre';
		          $result = $mysqli->query($query);
		          while($row = $result->fetch_assoc()){	
					$sel=''; 
					if($row['album_genre_id']==$album_genre_id){$sel=' selected';}
		             print'<option value="'.$row['album_genre_id'].'"'.$sel.'>'.htmlspecialchars(stripslashes($row["genre"])).'</option>';
		          }
	      	print'</select>
	    </div>
	    <div class="form-row">
	        <label for="price">Цена (цяло число)</label>
	        <input type="text" maxlength="4" name="price" id="price" value="'.htmlspecialchars(stripslashes($price)).'"> лв.
	    </div>';
		$picture=str_replace('.jpg','',$picture);
		print'<div class="form-row">
	        <label for="picture">* Снимка</label>
	        <input type="text" maxlength="64" name="picture" id="picture" value="'.htmlspecialchars(stripslashes($picture)).'"> .jpg
	    </div>		
	    <div class="form-row">	    
	    	<label for="info">Описание</label>   
	    </div>
	    <div class="form-row">
	        <textarea name="description" id="description">'.htmlspecialchars(stripslashes($description)).'</textarea>
	    </div>
	    <div class="form-row">
	        <input type="submit" name="submit" value="Запис">
	    </div>    
	</form>';
	} else {
	
	print'<form method="post" name="new" action="'.$_SERVER['PHP_SELF'].'" class="form">
		<input type="hidden" name="id" value="">
	    <div class="form-title"><?php  echo $operation_type ?></div>
	    <div class="form-row">
	        <label for="name">* Име</label>
	        <input type="text" maxlength="64" name="name" id="name" value="">
	    </div>
	    <div class="form-row">
	        <label for="album_genre_id">* Жанр</label>
	        <select name="album_genre_id" id="album_genre_id">';
		          $query = 'SELECT * FROM album_genres ORDER BY album_genre_id';
		          $result = $mysqli->query($query);
		          while($row = $result->fetch_assoc()){
		            print'<option value="'.$row['album_genre_id'].'">'.htmlspecialchars(stripslashes($row["genre"])).'</option>';
		          }
	      	print'</select>
	    </div>
	    <div class="form-row">
	        <label for="price">Цена (цяло число)</label>
	        <input type="text" maxlength="4" name="price" id="price" value=""> лв.
	    </div>
		<div class="form-row">
	        <label for="picture">* Снимка</label>
	        <input type="text" maxlength="64" name="picture" id="picture" value=""> .jpg
	    </div>
	    <div class="form-row">	    
	    	<label for="info">Описание</label>   
	    </div>
	    <div class="form-row">
	        <textarea name="description" id="description"></textarea>
	    </div>
	    <div class="form-row">
	        <input type="submit" name="submit" value="Запис">
	    </div>    
		</form>';
	}
print'</div>';
require 'includes/footer.inc'; 
?>