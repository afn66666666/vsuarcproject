<!DOCTYPE html>
<html>
<head>
<title>Математика в археологии</title>
<meta http-equiv="Content-Type" content="text/html" charset="utf8"/>
<meta content="nofollow"/>
	</head>
<body>
<nav id="cardMenu">
<?php include "cardMenu.html"; ?>
</nav>
<?php 
$objectId = $_GET['objectId'];
if (isset($objectId)) {
    echo "Редактирование карточки № ".$objectId;
    //тут надо грузить в форму поля из БД
}
?>
<pre><code class=" html"></code></pre>
<form id="inputForm" enctype="multipart/form-data" action="cardWrite.php" method="POST">
<p><strong>КАРТОЧКА ЭКСКУРСИОННОГО ОБЪЕКТА</strong></p>
<p>
<label for="objectName">Наименование объекта required</label>
<input name="objectName" id="objectName" type="text" value="Предмет кремневый" />
</p>
<p>
<label for="objectCommonName">Обиходные названия*</label>
<input name="objectCommonName" id="objectCommonName" type="text" value="" /></p>
<p>Место размещения объекта <input name="objectPlace" type="text" value="Археологический музей ВГУ" required/></p>
<p>Время возникновения, открытия объекта <input name="objectCreationTime" type="text" value="Эпоха камня (верхний палеолит)" /></p>
<p>
<label for="objectShortStory">Краткая история объекта</label>
<textarea name="objectShortStory" id="objectShortStory" style="width: 50%;">Найден в 2005 г. при раскопках в музее-заповеднике &laquo;Костёнки&raquo; </textarea></p>
<p>
<label for="objectShortStory">Внешние признаки (особенности стиля, общая характеристика, сохранность) </label>
<textarea name="objectFeatures" id="objectFeatures" style="width: 50%;">Камень (светло-серый валунный кремень), Ретушь. Без видимых повреждений. required</textarea></p>
<p>
<label for="objectAuthorsData">Данные об авторах объекта</label>
<input name="objectAuthorsData" id="objectAuthorsData" type="text" value="Нет данных" style="width: 50%;"/></p>
<p>Источники сведений об объекте <input name="objectInformationSource" type="text" value="Археологические раскопки" style="width: 50%;"/></p>
<p>Фотографии или видеоматериалы <input name="objectMedia" type="file" value="" multiple/></p>
<p>Дата составления карточки <input name="objectCardDate" id="ObjectCardDate" type="date" value="" required /></p>
<p style="text-align: center;"><input name="objectSubmit" type="submit" value="Записать карточку" onclick = "checkDate()"/></p>
</form>
<p>* данная строка используется при необходимости</p>
</body>
</html>
