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
Код страницы переноса нити.

Описание переменных:
    $DIR_PATH - путь от корня документов к директории, где хранится index.php (см. config.default).
    $STYLESHEET - стиль оформления (см. config.default).
    $boards - доски.
*}
{include file='header.tpl' page_title='Перенос нити' DIR_PATH=$DIR_PATH STYLESHEET=$STYLESHEET}
<form action="{$DIR_PATH}/admin/move_thread.php" method="post">
<table border="1">
<tr>
    <td colspan="3">Чтобы перенсти нить выберите доску, на которой она расположена
    и введите номер нити. Затем выберите доску, на которую нужно перенести нить.</td>
</tr>
<tr>
    <td><select name="src_board">
        <option value="" selected></option>
    {section name=m loop=$boards}
        <option value="{$boards[m].id}">{$boards[m].name}</option>

    {/section}</td>
    <td><input type="text" name="thread" value=""></td>
    <td><select name="dst_board">
        <option value="" selected></option>
    {section name=m loop=$boards}
        <option value="{$boards[m].id}">{$boards[m].name}</option>

    {/section}</td>
</tr>
</table><br>
<input type="hidden" name="submited" value="1">
<input type="reset" value="Сброс"> <input type="submit" value="Перенести">
</form>
<br><br><a href="{$DIR_PATH}/">На главную</a>
{include file='footer.tpl'}