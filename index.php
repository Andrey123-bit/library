<?php
include 'elems/init.php';
//Функция для формирования главной страницы с переменными БД и пагинации :
function get_from_base($data, $page, $pagesCount){
$content = 
'<div class="container"><div class="table-responsive"><table class="table table-hover"><tr>
	<th>Номер</th>
	<th>Название</th>
	<th>Год</th>
	<th>Автор</th>
	<th>Изменить</th>
	<th>Удалить</th>
	</tr>';
	foreach ($data as $elem) {
		$content .= '<tr>';			
		$content .= '<td>' . $elem['id'] . '</td>';
		$content .= '<td>' . $elem['title'] . '</td>';
		$content .= '<td >' . $elem['years'] . '</td>';
		$content .= '<td>' . $elem['autor'] . '</td>';
		$content .= '<td><a href="/library/edit.php?id=' . $elem['id'] . '">редактировать</a></td>';
		$content .= '<td><a href="?del=' . $elem['id'] . '">удалить</a></td>';
		$content .= '</tr>';
	}   
$content.='</table></div></div>';
$title = 'Главная';
$add  = '<h3>Цифровая библиотека</h3><p class="menu"><a href="add.php">Добаватить новую книгу</a></p>';
include 'elems/layot.php';
};
// Функция удаления записи из таблицы и сайта
function deletePage($link){
if(isset($_GET['del'])){
$id = $_GET['del'];
$query = "DELETE FROM books WHERE id = $id";
mysqli_query($link, $query);
$_SESSION['message'] = ['text'=>'Страница удалена', 'status'=>'success'];
header('Location: /library/'); die();
}
}
//Запрос к БД:
// Фомрирование пагинации
if (isset($_GET['page']) and $_GET['page']!=1){
$page = $_GET['page']; // переменная хранящая ссылку на страницу перехода
}else
{
$page = 1;
}					
$notes = 5; // количество записей на странице
$from = ($page - 1) * $notes; // Определение с какой страницы начать вывод записей
$query = "SELECT * FROM books WHERE id > 0 ORDER BY id LIMIT $from,$notes";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
$query1 = "SELECT COUNT(*) as count FROM books";
$result = mysqli_query($link, $query1) or die(mysqli_error($link));
$count = mysqli_fetch_assoc($result)['count'];
$pagesCount = ceil($count / $notes);
// Вызов функции
deletePage($link);
get_from_base($data, $page, $pagesCount);