{* Smarty *}
{*************************************
 * Этот файл является частью Kotoba. *
 * Файл license.txt содержит условия *
 * распространения Kotoba.           *
 *************************************
 *********************************
 * This file is part of Kotoba.  *
 * See license.txt for more info.*
 *********************************}
{*
Описание переменных:
    $DIR_PATH - путь от корня документов к директории, где хранится index.php (см. config.default).
	$STYLESHEET - стиль оформления.
	$boards - список досок.
	$rempass - пароль на удаление своих сообщений и нитей.
	$board_name - имя просматриваемой доски.
	$board_title - заголовок просматриваемой доски.
	$upload_types - типы файлов, доступных для загрузки на просматриваемой доске.
	$is_guest - пользователь является гостем или нет.
	$bump_limit - бамплимит вцелом для доски.
	$pages - массив номеров страниц.
	$page - номер текущей страницы.
*}
{assign var="page_title" value="Предпросмотр доски $board_name страница $page"}
{include file='header.tpl' page_title=$page_title DIR_PATH=$DIR_PATH STYLESHEET=$STYLESHEET}
Список досок: {include file='board_list.tpl' board_list=$boards DIR_PATH=$DIR_PATH}<br>
<a href="{$DIR_PATH}/edit_settings.php"{if $is_guest} title="Отредактируйте ваши настройки."{/if}>Мои настройки</a><br>

<h4 align=center>kotoba</h4>
<center><b>/{$board_name}/ {$board_title}</b></center><br><br>
Глобальный бамплимит: {$bump_limit}<br>
{include file='pages_list.tpl' board_name=$board_name pages=$pages page=$page}
<hr>

<form action="{$DIR_PATH}/createthread.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="1560576">
<table align="center" border="0">
<tr valign="top"><td>Имя: </td><td><input type="text" name="message_name" size="30"></td></tr>
<tr valign="top"><td>Тема: </td><td><input type="text" name="message_theme" size="48"> <input type="submit" value="Создать нить"></td></tr>
<tr valign="top"><td>Сообщение: </td><td><textarea name="message_text" rows="7" cols="50"></textarea></td></tr>
<tr valign="top"><td>Файл: </td><td><input type="file" name="message_img" size="54"></td></tr>
<tr valign="top"><td>Пароль: </td><td><input type="password" name="message_pass" size="30" value="{$rempass}"></td></tr>
<tr valign="top"><td>Перейти: </td><td>(нить: <input type="radio" name="goto" value="t">) (доска: <input type="radio" name="goto" value="b" checked>)</td></tr>
<tr valign="top"><td colspan = "2">Типы файлов, доступных для загрузки:{section name=i loop=$upload_types} {$upload_types[i].extension}{/section}</td></tr>
</table>
<input type="hidden" name="b" value="$board_name">
</form>
<hr>
