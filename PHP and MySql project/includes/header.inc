<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8">
    	<title><?php $page_title ?></title>
    	<link href="style/style.css" type="text/css" rel="stylesheet">
    </head>
    <body>
    	<div align="center"> 
    		<div id="site"> 			
    			<!-- заглавна част - може и съдържание да има - не само background -->
    			<div id="head" title="Музикален магазин"></div>		
    			<div id="tmenu"> 
    				<a href="." class="top_menu_a">Начало</a>
                    <?php  
    					if(!isset($_SESSION['person_type'])){
							print '<span style="padding-left:800px;"><a href="login.php" class="top_menu_a">Вход</a></span>'; 				
						} else {
						
						if($_SESSION['person_type']==1){	
							print '<a href="albums_edit.php" class="top_menu_a">Албуми</a>
								   <a href="album_edit.php" class="top_menu_a">Нов албум</a>';						
						}
						print' <span style="padding-left:570px;"><a href="logout.php" class="top_menu_a">Изход</a></span>';
						}
                     ?>		
				</div>
    			<div id="left_menu">
                    <?php 
				    $res = $mysqli->query("SELECT * FROM album_genres");
				    while($row = $res->fetch_assoc()){
						print'<a href="albums.php?kid='.$row['album_genre_id'].'" 
						   class="left_menu_a">'.htmlspecialchars(stripslashes($row['genre'])).'</a>';
				    } 
                    ?>
    			</div>
    			<div id="content"> 
    				<div id="navigation"> 
    					<a href=".">Начало</a>
    					
    			</div>
