<?php
	/**
	 * Created by
	 * User: Akinsola Akinwale
	 * Date: 04-11-2019
	 * Time: 22:22
	 */

	namespace askinss\serverStat\interfaces;

	/**
	 * Interface StatInterface
	 *
	 * @package askinss\interfaces
	 */
	interface StatInterface
	{
		/**
		 * Gets the name of the Operating System
		 *
		 * @return string
		 */
		public static function getOS();

		/**
		 * Gets the Kernel Version of the Operating System
		 *
		 * @return string
		 */
		public static function getUserConnectStat();

		/**
		 * Gets the hostname
		 *
		 * @return string
		 */
		public static function getHostname();

		/**
		 * Gets LastLog
		 *
		 * @return string
		 */
		public static function getLastLog();

		/**
		 * Gets Processor's Frequency
		 *
		 * @return string
		 */
		public static function getCpuFreq();

		/**
		 * Gets current system load
		 *
		 * @return string
		 */
		public static function getLoad();

		/**
		 * Gets system up-time
		 *
		 * @return string
		 */
		public static function getUpTime();
	}