{* Smarty *}
{*********************************
 * This file is part of Kotoba.  *
 * See license.txt for more info.*
 *********************************}
{*
Code of edit upload types page.

Variables:
    $DIR_PATH - path from server document root to index.php directory (see config.default).
    $STYLESHEET - stylesheet (see config.default).
    $show_control - show link to manage page.
    $boards - boards.
    $upload_handlers - upload handlers.
    $upload_types - upload types.
*}
{include file='header.tpl' DIR_PATH=$DIR_PATH STYLESHEET=$STYLESHEET page_title="Edit upload types"}

{include file='adminbar.tpl' DIR_PATH=$DIR_PATH show_control=$show_control}

{include file='navbar.tpl' DIR_PATH=$DIR_PATH boards=$boards}

<div class="logo">Edit upload types</div>
<hr>
<form action="{$DIR_PATH}/admin/edit_upload_types.php" method="post">
<table border="1">
<tr>
    <td colspan="6">To change upload handler choose another one from list.<br>
    To change upload type attributes change correspond values in table.<br>
    To add new upload type input requed values. To delete upload type mark it.</td>
</tr>
<tr>
    <td>Extension (type)</td>
    <td>Stored extension</td>
    <td>Image flag</td>
    <td>Upload handler</td>
    <td>Thumbnail for nonimages</td>
    <td>Delete upload type</td>
</tr>
{section name=i loop=$upload_types}
<tr>
    <td>{$upload_types[i].extension}</td>
    <td><input type="text" name="store_extension_{$upload_types[i].id}" value="{$upload_types[i].store_extension}"></td>
    <td><input type="checkbox" name="is_image_{$upload_types[i].id}" value="1"{if $upload_types[i].is_image} checked{/if}></td>
    <td>
        <select name="upload_handler_{$upload_types[i].id}">
{section name=j loop=$upload_handlers}
        <option value="{$upload_handlers[j].id}"{if $upload_types[i].upload_handler == $upload_handlers[j].id} selected{/if}>{$upload_handlers[j].name}</option>{/section}

        </select>
    </td>
    <td><input type="text" name="thumbnail_image_{$upload_types[i].id}" value="{$upload_types[i].thumbnail_image}"></td>
    <td><input type="checkbox" name="delete_{$upload_types[i].id}" value="1"></td>
</tr>{/section}

<tr>
    <td><input type="text" name="new_extension"></td>
    <td><input type="text" name="new_store_extension"></td>
    <td><input type="checkbox" name="new_is_image" value="1"></td>
    <td>
        <select name="new_upload_handler">
{section name=j loop=$upload_handlers}
        <option value="{$upload_handlers[j].id}">{$upload_handlers[j].name}</option>{/section}

        </select>
    </td>
    <td colspan="3"><input type="text" name="new_thumbnail_image"></td>
</tr>
</table>
<br>
<input type="hidden" name="submited" value="1">
<input type="reset" value="Reset"> <input type="submit" value="Save">
</form>
{include file='footer.tpl'}