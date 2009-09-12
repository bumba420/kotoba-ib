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
	$board_name - имя доски, предпросмотр которой разбивается на страницы.
	$pages - массив номеров страниц.
	$page - номер текущей страницы.
*}
Страницы:
{section name=i loop=$pages}
{if $pages[i] == $page} ({$pages[i]})
{else}
 <a href="{$DIR_PATH}/{$board_name}/p{$pages[i]}">({$pages[i]})</a>
{/if}
{/section}