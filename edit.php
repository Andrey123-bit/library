<?php 
include 'elems/init.php';
function getPage($link){
	if(isset($_GET['id'])){
	$id = $_GET['id'];
	$query = "SELECT * FROM books WHERE id='$id'";
	$result = mysqli_query($link, $query) or die (mysqli_error($link));
	$isPage = mysqli_fetch_assoc($result);
	if($isPage){
		if (isset($_POST['title']) and isset($_POST['autor'])){
			$title = mysqli_real_escape_string($link, $_POST['title']);
			$years = mysqli_real_escape_string($link, $_POST['years']);
			$autor = mysqli_real_escape_string($link, $_POST['autor']);
			}else
			{
			$title = mysqli_real_escape_string($link, $isPage['title']);
			$years = mysqli_real_escape_string($link, $isPage['years']);
			$autor = mysqli_real_escape_string($link, $isPage['autor']);
			}		
		$content = "
		<h1>Внести изменения</h1>
		<form action=\"\" method=\"POST\">
		Название:<br>
		<input name=\"title\" value=".$title."><br><br>
		Год:<br>
		<input name=\"years\" value=".$years."><br><br>
		Фамилия автора:<br>
		<input name=\"autor\" value=".$autor."><br><br>
		<br>
		<input type=\"submit\" value=\"Подтвердить\">
		</form>
		<p>Вернуться на <a href=\"/library\">главную</a></p>";
	}else{
		$content = "Страница которую хотите изменить не существует";
	}
}else{
	$content = "Страница которую хотите изменить не существует";
}
	$title = 'Редактирование';
	include 'elems/layot.php';
}
function editPage($link){
	if(isset($_POST['title']) and isset($_POST['autor']) ){
		$title = $_POST['title'];
		$years = $_POST['years'];
		$autor = $_POST['autor'];		
		if(isset($_GET['id'])){
		$id = $_GET['id'];
		$query = "SELECT * FROM books WHERE id='$id'";
		$result = mysqli_query($link, $query) or die (mysqli_error($link));
		$page = mysqli_fetch_assoc($result);
			if ($page['title'] !== $title) {
			$query = "SELECT COUNT(*) as count FROM books WHERE title='$title' AND autor='$autor'";
			$result = mysqli_query($link, $query) or die (mysqli_error($link));
			$isPage = mysqli_fetch_assoc($result)['count'];
			if ($isPage == 1) {
				return $_SESSION['message'] = ['text'=>'Книга с таким названием этого автора уже существует', 'status'=>'error'];
			}
		}
		$query = "UPDATE books SET title='$title', years='$years', autor='$autor' WHERE id='$id'";
		mysqli_query($link, $query) or die (mysqli_error($link));
		$_SESSION['message'] = ['text'=>'Данные изменены', 'status'=>'success'];
		header('Location: /library/'); die();}
	}
	else{
		return '';
	}
}
editPage($link);
getPage($link);