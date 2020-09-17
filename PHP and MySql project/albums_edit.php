<?php
 $confirm=NULL;
 if ($_POST) 
	{
	  if ($_POST['conf']=='YES') 
	  { 
		$nav = ' / <a href="albums_edit.php">Албуми</a>'; 
		$confirm='y';
	  }
	} 	
if ($_GET) 
	{ 
		$id=$_GET['id']; 
	} else {
		$id=NULL; 
	}
require 'includes/init.inc'; 
	if ($confirm==NULL) { $nav = ' / <a href="'.$_SERVER['PHP_SELF'].'">Албуми</a>'; } 
	$page_title = 'Албуми - Музикален магазин';
require 'includes/header.inc'; 
print'<h1>Албуми</h1><h2>(При повече албуми е добре да се разглеждат на отделни страници.)</h2>'; 

	if ($confirm=='y') {
	 $mysqli->query("DELETE FROM albums WHERE album_id=".(int)$_POST['id']); 
	 $aff_rows = $mysqli->affected_rows; 
		if($aff_rows){
			print'<div class="infoBlock">Изтрити записи: '.$aff_rows.'</div>';
		}else{
			print'<div class="errorBlock">Няма изтрити записи</div>';
			$confirm=NULL;
		}
	}	

 if ($id!=NULL) { 
		print'<div class="errorBlock" style="background-color:red;">
			<table><tr>
			 <td style="color:black;"><b>Потвърдете изтриване на албум:</b></td> 
			 <form method="post" name="conf" action="'.$_SERVER['PHP_SELF'].'" class="form">
			 <input type="hidden" name="id" value="'.$id.'">
			 <td><input type="submit" name="conf" value="YES"></td>
			 <td><input type="submit" name="conf" value="CANCEL"></td>	
			 </form>
			 </tr></table>
			</div>';
	} 
$result = $mysqli->query("SELECT * FROM albums");

if($result->num_rows>0){

	print'<table class="table-list">
		<tr>
			<th>Редактиране</th><!-- колона за редактиране -->
			<th>Снимка</th>
			<th>Пореден номер и име</th>
			<th>Изтриване</th><!-- колона за изтриване -->
		</tr>'; 
	while($row = $result->fetch_assoc()){
		$pic = $row['picture'];
		$pic_exists = file_exists($pic); 
		$name = htmlspecialchars(stripcslashes($row['name']));		
		print'<tr>
			<td><a href="album_edit.php?id='.$row['album_id'].'"><img src="img/pencil.png" alt="Редактиране" title="Редактиране">Редактиране</a></td>
			<td>';
			if ($pic_exists) { print'<img class="img-album" src="'.$pic.'" title="'.$name.'" alt="'.$name.'">';}
		print'</td> 
			<td>'.$row['album_id'].'. '.$name.'</td>
			<td><a href="'.$_SERVER['PHP_SELF'].'?id='.$row['album_id'].'"><img  src="img/trash.png" alt="Изтриване" title="Изтриване">Изтриване</a></td>	
		</tr>'; 
	}
	print'</table>';
}
require 'includes/footer.inc'; 
 ?>