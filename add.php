<?php 
include 'elems/init.php';
function getPage(){
	if(isset($_POST['title']) and isset($_POST['years']) and isset($_POST['autor'])){
		$title = $_POST['title'];
		$years = $_POST['years'];
		$autor = $_POST['autor'];
	}
		else{
		$title = '';
		$years = '';
		$autor = '';
		}
	$title = 'Добавить страницу';
	$content = "
	<form action=\"\" method=\"POST\">
	<span>Название</span></br>
	<input name=\"title\" value=".$title."><br><br>
	<span>Год</span></br>
	<input name=\"years\" value=".$years."><br><br>
	<span>Фамилия автора</span></br>
	<input name=\"autor\" value=".$autor."><br><br>
	<input type=\"submit\" value=\"Подтвердить\">
	</form>
	<p>Вернуться на <a href=\"/library\">главную</a></p>";
	include 'elems/layot.php';
}
function addPage($link){
	if(isset($_POST['title']) and isset($_POST['years']) and isset($_POST['autor']) ){
		$title = $_POST['title'];
		$years = $_POST['years'];
		$autor = $_POST['autor'];
		$query = "SELECT COUNT(*) as count FROM books WHERE title='$title' AND autor='$autor'";
		$result = mysqli_query($link, $query) or die (mysqli_error($link));
		$isPage = mysqli_fetch_assoc($result)['count'];
		if($isPage){
		$_SESSION['message'] = ['text'=>'Книга с таким названием и автором уже существует', 'status'=>'error'];
		}else{
			$query = "INSERT INTO books (title, years, autor) VALUES ('$title', '$years', '$autor')";
			mysqli_query($link, $query) or die (mysqli_error($link));
			$_SESSION['message'] = ['text'=>'Книга добавлена', 'status'=>'success'];
			header('Location: /library/'); die();
		}
	}
	else{
		return '';
	}
}
addPage($link);
getPage();