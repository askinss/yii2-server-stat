<?php
	/**
	 * Created by.
	 * User: Akinsola
	 * Date: 04-10-2019
	 * Time: 22:25
	 */

	namespace askinss\serverStat;

	use askinss\serverStat\interfaces\StatInterface;

	class ServerStat
	{
		/**
		 * @return StatInterface
		 */
		public static function getStat()
		{
			$name = strtolower(php_uname('s'));

			if (strpos($name, 'linux') !== FALSE) {
				return __NAMESPACE__ . '\os\Linux';
			}

			return NULL;
		}
	}