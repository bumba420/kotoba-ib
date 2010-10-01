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
Код страницы редактирования настроек пользователя.

Описание переменных:
    $DIR_PATH - путь от корня документов к директории, где хранится index.php (см. config.default).
    $STYLESHEET - стиль (см. config.default).
    $show_control - показывать ссылку на страницу административных фукнций и фукнций модераторов в панели администратора.
    $boards - доски.
    $banner - баннер.
    $threads_per_page - число нитей на странице просмотра доски (см. config.default).
    $posts_per_thread - число сообщений в нити на странице просмотра доски (см. config.default).
    $lines_per_post - сообщения, в которых число строк превышает это число, будут урезаны при просмотре доски (см. config.default).
    $languages - языки.
    $language - текущий язык.
    $stylesheets - стили.
    $goto - перенаправление.
    $favorites - избранные нити.
    $hidden_threads - скрытые пользователем нити.
*}
{include file='header.tpl' DIR_PATH=$DIR_PATH STYLESHEET=$STYLESHEET page_title='Мои настройки'}

{include file='adminbar.tpl' DIR_PATH=$DIR_PATH show_control=$show_control}

{include file='navbar.tpl' DIR_PATH=$DIR_PATH boards=$boards}

{if isset($banner)}{include file='banner.tpl' DIR_PATH=$DIR_PATH banner=$banner}{/if}

<br/><form action="{$DIR_PATH}/edit_settings.php" method="post">
<i>Введите ключевое слово, чтобы загрузить ваши настройки.</i><br/>
    <input type="text" name="keyword_load" size="32">
    <input type="submit" value="Загрузить">
</form>
<form action="{$DIR_PATH}/edit_settings.php" method="post">
<h4>Опции предпросмотра доски:</h4>
    <table border="0">
        <tr valign="top"><td>Число нитей на странице просмотра доски: </td><td><input type="text" name="threads_per_page" size="10" value="{$threads_per_page}"></td></tr>
        <tr valign="top"><td>Число сообщений в нити на странице просмотра доски: </td><td><input type="text" name="posts_per_thread" size="10" value="{$posts_per_thread}"></td></tr>
        <tr valign="top"><td>Сообщения, в которых число строк превышает это число,<br/>будут урезаны при просмотре доски: </td><td><input type="text" name="lines_per_post" size="10" value="{$lines_per_post}"></td></tr>
        <tr valign="top"><td>Перенаправление: </td><td>
            <select name="goto">
                <option value="t"{if $goto == 't'} selected{/if}>К нити</option>
                <option value="b"{if $goto == 'b'} selected{/if}>К доске</option>
            </select>
        </td></tr>
    </table>
<h4>Другое:</h4>
    <table border="0">
        <tr valign="top"><td>Язык: </td><td><select name="language_id">{section name=j loop=$languages}<option value="{$languages[j].id}"{if $language == $languages[j].code} selected{/if}>{$languages[j].code}</option>{/section}</select></td></tr>
        <tr valign="top"><td>Стиль оформления: </td><td><select name="stylesheet_id">{section name=i loop=$stylesheets}<option value="{$stylesheets[i].id}"{if $STYLESHEET == $stylesheets[i].name} selected{/if}>{$stylesheets[i].name}</option>{/section}</select></td></tr>
    </table>
<i>Введите ключевое слово, чтобы сохранить эти настройки.<br/>
В дальнейшем вы сможете загрузить их, введя ключевое слово.</i><br/>
    <input type="text" name="keyword_save" size="32">
    <input type="submit" value="Сохранить">
</form>
<h4>Избранные нити:</h4>
{if count($favorites) > 0}
{section name=i loop=$favorites}
<a href="" title="Нажмите, чтобы перейти к нити">/{$favorites[i].board}/{$favorites[i].thread}/</a> <span class="filetitle">{$favorites[i].subject}</span> <span class="postername">{$favorites[i].name}</span> {if $favorites[i].unread > 0}<span style="color:red;">{$favorites[i].unread} новых сообщений!</span>{else}0 новых сообщений.{/if} <a href="" title="Удалить из избранного">[X]</a><br/>
{/section}
{else}
У вас нет избранных нитей.<br/>
{/if}
<h4>Скрытые нити:</h4>
{if count($hidden_threads) > 0}
{section name=i loop=$hidden_threads}
<a href="{$DIR_PATH}/unhide_thread.php?thread={$hidden_threads[i].thread}&board_name={$hidden_threads[i].board_name}" title="Нажмите, чтобы отменить скрытие нити">/{$hidden_threads[i].board_name}/{$hidden_threads[i].thread_number}</a>
{/section}<br/>
{else}
У вас нет скрытых нитей.<br/>
{/if}
{include file='footer.tpl'}