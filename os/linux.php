<?php
	/**
	 * Created by.
	 * User: Akinsola
	 * Date: 04-10-2019
	 * Time: 22:32
	 */

	namespace askinss\serverStat\os;

	use askinss\serverStat\interfaces\StatInterface;
	use Exception;

	class Linux implements StatInterface
	{
		public function __construct()
		{
			if (!is_dir('/sys') || !is_dir('/proc'))
				throw new Exception('Needs access to /proc and /sys to work.');
		}

		/**
		 * Gets the name of the Operating System
		 *
		 * @return string
		 */
		public static function getOS()
		{
			return 'Linux';
		}

		/**
		 * Gets the Kernel Version of the Operating System
		 *
		 * @return string
		 */
		public static function getKernelVersion()
		{
			return shell_exec('/usr/bin/lsb_release -ds');
        }
        
        /**
		 * Gets the UserConnection time
		 *
		 * @return string
		 */
		public static function getUserConnectStat()
        {
            return shell_exec('ac -d');
        }
		
		/**
		 * Gets the hostname
		 *
		 * @return string
		 */
		public static function getHostname()
		{
			return php_uname('n');
        }
        
        /**
		 * Gets the LastLog
		 *
		 * @return string
		 */
		public static function getLastLog()
        {
            return shell_exec('lastlog');
        }

		/**
		 * Gets Processor's Model
		 *
		 * @return string
		 */
		public static function getCpuModel()
		{
			return Linux::getCpuInfo()['Model'];
		}

		private static function getCpuInfo()
		{
			// File that has it
			$file = '/proc/cpuinfo';

			// Not there?
			if (!is_file($file) || !is_readable($file)) {
				return 'Unknown';
			}

			/*
			 * Get all info for all CPUs from the cpuinfo file
			 */

			// Get contents
			$contents = trim(@file_get_contents($file));

			// Lines
			$lines = explode("\n", $contents);

			// Holder for current CPU info
			$cur_cpu = [];

			// Go through lines in file
			$num_lines = count($lines);

			for ($i = 0; $i < $num_lines; $i++) {
				// Info here
				$line = explode(':', $lines[$i], 2);

				if (!array_key_exists(1, $line))
					continue;

				$key   = trim($line[0]);
				$value = trim($line[1]);


				// What we want are MHZ, Vendor, and Model.
				switch ($key) {

					// CPU model
					case 'model name':
					case 'cpu':
					case 'Processor':
						$cur_cpu['Model'] = $value;
						break;

					// Speed in MHz
					case 'cpu MHz':
						$cur_cpu['MHz'] = $value;
						break;

					case 'Cpu0ClkTck': // Old sun boxes
						$cur_cpu['MHz'] = hexdec($value) / 1000000;
						break;

					// Brand/vendor
					case 'vendor_id':
						$cur_cpu['Vendor'] = $value;
						break;
				}

			}

			// Return them
			return $cur_cpu;
		}

		/**
		 * Gets Processor's Frequency
		 *
		 * @return string
		 */
		public static function getCpuFreq()
		{
			return Linux::getCpuInfo()['MHz'];
		}

		/**
		 * Gets system average load
		 *
		 * @return string
		 */
		public static function getLoad()
		{
			return round(array_sum(sys_getloadavg()) / count(sys_getloadavg()), 2);
		}

		/**
		 * Gets system up-time
		 *
		 * @return string
		 */
		public static function getUpTime()
		{
			return shell_exec('uptime -p');
		}
	}