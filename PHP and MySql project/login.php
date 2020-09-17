<?php 
// Страница за оторизация за влизане в административната част
require 'includes/init.inc';
	$errorMessage = NULL;
// Конфигуриране на променливите $navigation и $page_title
	$page_title = 'Вход - Магазин за албуми';
	$navigation = ' / <a href="'.$_SERVER['PHP_SELF'].'">Вход</a>';
	
	if($_POST){
	  $_POST['username'] = $mysqli->escape_string(trim($_POST['username']));
	  $_POST['pass'] = $mysqli->escape_string(trim($_POST['pass'])); 
	  $query = "SELECT * FROM persons WHERE username='".$_POST['username']."' AND pass='".$_POST['pass']."'";
	  $result = $mysqli->query($query);
	  if($row = $result->fetch_assoc() ) {
	  	 // записваме важни данни в сесията - ползват се в другите страници
		 $_SESSION['person_type'] = $row['person_type']; // ползва се за горното менюто и в админ-страниците  		
	  	 header("Location: albums_edit.php"); // отива се в страницата за редактиране на животни
		 exit;
	  } else {  
	  $errorMessage = 'Грешка: невалидни потребителско име и/или парола!';
	  }
	}	
	
	require 'includes/header.inc';
?>
	<div align="center"> 
	<?php	
	if($errorMessage!=NULL){
		print'<div class="errorBlock">'.$errorMessage.'</div>';
	}
	?>
	<form method="post" name="f" action="<?php echo $_SERVER['PHP_SELF']?>" class="form">
	    <div class="form-title">Вход</div>
	    <div class="form-row">
	        <label for="usernameid">Потребителско име</label>
	        <input type="text" maxlength="16" name="username" id="usernameid" value="">
	    </div>
	    <div class="form-row">
	        <label for="passid">Парола</label>
	        <input type="password" maxlength="16" name="pass" id="passid" value="">
	    </div>
	    <div class="form-row">
	        <input type="submit" name="submit" value="Вход">
	    </div>    
	</form>
</div>
<?php
require 'includes/footer.inc'; 
?> 