<?php

/**
*
* @package RegistationDeny
* @copyright (c) 2021 Smartceo.ru
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*
*/

namespace smartceo\registrationdeny\event;

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit();
}

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{

	/** @var string phpEx */
	protected $php_ext;

	/** @var \phpbb\request\request_interface */
	protected $request;


	public function __construct($php_ext, \phpbb\request\request_interface $request)
	{
		$this->php_ext = $php_ext;
		$this->request = $request;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup' => 'check_page',
		);
	}

	public function check_page($event)
	{
		if ($this->request->server('REQUEST_URI') == "/ucp.php?mode=register") {
			$url=$board_url.'/ucp.'.$this->php_ext.'?mode=login';
			header("Location: $url");
			exit();
		}
	}
}
