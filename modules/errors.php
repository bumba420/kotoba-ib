<?php
/*************************************
 * Этот файл является частью Kotoba. *
 * Файл license.txt содержит условия *
 * распространения Kotoba.           *
 *************************************/
/*********************************
 * This file is part of Kotoba.  *
 * See license.txt for more info.*
 *********************************/

/*
 * Скрипт расширений стандартного исключения.
 */

class CommonException extends Exception
{
	static $messages;
	private $reason;
	/**
	 * Создаёт новое исключение с сообщением $message.
	 *
	 * Аргументы:
	 * $message - сообщение.
	 */
	public function __construct($message)
	{
		$this->reason = $message;
		parent::__construct($message);
	}
	/*
	 * Возвращает данные об исключении.
	 */
	public function __toString()
	{
		return str_replace("\n", "<br>\n", htmlentities(parent::__toString(), ENT_QUOTES, Config::MB_ENCODING));
	}
	/**
	 * Возвращает причину произошедшуей ошибки.
	 */
	public function getReason()
	{
		return $this->reason;
	}
}
/**
 * Ошибки отсутствия данных.
 */
class NodataException extends Exception
{
	static $messages;
	private $reason;
	/**
	 * Создаёт новое исключение с сообщением $message.
	 *
	 * Аргументы:
	 * $message - сообщение.
	 */
	public function __construct($message)
	{
		$this->reason = $message;
		parent::__construct($message);
	}
	/*
	 * Возвращает данные об исключении.
	 */
	public function __toString()
	{
		return str_replace("\n", "<br>\n", htmlentities(parent::__toString(), ENT_QUOTES, Config::MB_ENCODING));
	}
	/**
	 * Возвращает причину произошедшуей ошибки.
	 */
	public function getReason()
	{
		return $this->reason;
	}
}
/**
 * Ошибки формата данных.
 */
class FormatException extends Exception
{
	static $messages;
	private $reason;
	/**
	 * Создаёт новое исключение с сообщением $message.
	 *
	 * Аргументы:
	 * $message - сообщение.
	 */
	public function __construct($message)
	{
		$this->reason = $message;
		parent::__construct($message);
	}
	/*
	 * Возвращает данные об исключении.
	 */
	public function __toString()
	{
		return str_replace("\n", "<br>\n", htmlentities(parent::__toString(), ENT_QUOTES, Config::MB_ENCODING));
	}
	/**
	 * Возвращает причину произошедшуей ошибки.
	 */
	public function getReason()
	{
		return $this->reason;
	}
}
/**
 * Ошибки при регистрации, авторизация, идентификация и прав доступа.
 */
class PremissionException extends Exception
{
	static $messages;
	private $reason;
	/**
	 * Создаёт новое исключение с сообщением $message.
	 *
	 * Аргументы:
	 * $message - сообщение.
	 */
	public function __construct($message)
	{
		$this->reason = $message;
		parent::__construct($message);
	}
	/*
	 * Возвращает данные об исключении.
	 */
	public function __toString()
	{
		return str_replace("\n", "<br>\n", htmlentities(parent::__toString(), ENT_QUOTES, Config::MB_ENCODING));
	}
	/**
	 * Возвращает причину произошедшуей ошибки.
	 */
	public function getReason()
	{
		return $this->reason;
	}
}
/**
 * Ошибки обмена данными с хранилищем.
 */
class DataExchangeException extends Exception
{
	static $messages;
	private $reason;
	/**
	 * Создаёт новое исключение с сообщением $message.
	 *
	 * Аргументы:
	 * $message - сообщение.
	 */
	public function __construct($message)
	{
		$this->reason = $message;
		parent::__construct($message);
	}
	/*
	 * Возвращает данные об исключении.
	 */
	public function __toString()
	{
		return str_replace("\n", "<br>\n", htmlentities(parent::__toString(), ENT_QUOTES, Config::MB_ENCODING));
	}
	/**
	 * Возвращает причину произошедшуей ошибки.
	 */
	public function getReason()
	{
		return $this->reason;
	}
}
/**
 * Ошибки загрузки файла.
 */
class UploadException extends Exception
{
	static $messages;
	private $reason;
	/**
	 * Создаёт новое исключение с сообщением $message.
	 *
	 * Аргументы:
	 * $message - сообщение.
	 */
	public function __construct($message)
	{
		$this->reason = $message;
		parent::__construct($message);
	}
	/*
	 * Возвращает данные об исключении.
	 */
	public function __toString()
	{
		return str_replace("\n", "<br>\n", htmlentities(parent::__toString(), ENT_QUOTES, Config::MB_ENCODING));
	}
	/**
	 * Возвращает причину произошедшуей ошибки.
	 */
	public function getReason()
	{
		return $this->reason;
	}
}
/**
 * Нарушение ограничений.
 */
class LimitException extends Exception
{
	static $messages;
	private $reason;
	/**
	 * Создаёт новое исключение с сообщением $message.
	 *
	 * Аргументы:
	 * $message - сообщение.
	 */
	public function __construct($message)
	{
		$this->reason = $message;
		parent::__construct($message);
	}
	/*
	 * Возвращает данные об исключении.
	 */
	public function __toString()
	{
		return str_replace("\n", "<br>\n", htmlentities(parent::__toString(), ENT_QUOTES, Config::MB_ENCODING));
	}
	/**
	 * Возвращает причину произошедшуей ошибки.
	 */
	public function getReason()
	{
		return $this->reason;
	}
}
?>