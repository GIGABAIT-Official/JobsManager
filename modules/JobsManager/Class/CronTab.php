<?php

class CronTab
{

	static private function stringToArray($jobs = '')
	{
		$jobs = nl2br(trim($jobs));
		$jobs = explode('<br />', $jobs);
		$output = array();
		foreach ($jobs as $key => $value) {
			$output[$key] = trim($value);
		}
		return $output;
	}

	static private function arrayToString($jobs = array())
	{
		$string = implode(PHP_EOL, $jobs);
		return $string;
	}

	// return cron jobs array
	static public function getJobs()
	{
		$output = shell_exec('crontab -l');
		return self::stringToArray($output);
	}

	// save cron jobs array. arg1 = array cron jobs
	static public function saveJobs($jobs = array())
	{
		$output = shell_exec('echo \'' . self::arrayToString($jobs) . '\' | crontab -');
		return $output;
	}

	static public function doesJobExist($job = '')
	{
		$jobs = self::getJobs();
		if (in_array($job, $jobs)) {
			return true;
		} else {
			return false;
		}
	}

	// arg1 = str cron job
	static public function addJob($job = '')
	{
		if (self::doesJobExist($job)) {
			return false;
		} else {
			$jobs = self::getJobs();
			$jobs[] = $job;
			return self::saveJobs($jobs);
		}
	}

	// arg1 = str cron job
	static public function removeJob($job = '')
	{
		if (self::doesJobExist($job)) {
			$jobs = self::getJobs();
			unset($jobs[array_search($job, $jobs)]);
			return self::saveJobs($jobs);
		} else {
			return false;
		}
	}

	// replace cron jobs array key. arg1 = int key array edite job, arg2 = str command job
	static public function editJobId($job_arr_id = '', $job = '')
	{
		if (empty($job)) {
			return false;
		}
		if (is_int($job_arr_id)) {
			$jobs = self::getJobs();
			$jobs[$job_arr_id] = $job;
			return self::saveJobs($jobs);
		} else {
			return false;
		}
	}

	// get cron job, arg1 = int key array job
	static public function getJobId($job_arr_id = '')
	{
		if (is_int($job_arr_id)) {
			$jobs = self::getJobs();
			return $jobs[$job_arr_id];
		} else {
			return false;
		}
	}

	// remove cron job, arg1 = int key array job
	static public function removeJobId($job_arr_id = '')
	{
		if (is_int($job_arr_id)) {
			$jobs = self::getJobs();
			unset($jobs[$job_arr_id]);
			return self::saveJobs($jobs);
		} else {
			return false;
		}
	}

	// arg1 = int array key cron job, return associative array cron job elements
	static public function getJobElementsId($job_arr_id = '')
	{
		if (is_int($job_arr_id)) {

			$job = self::getJobId($job_arr_id);
			$job = explode(" ", $job);
			$job_array['minute'] = $job['0'];
			$job_array['hour'] = $job['1'];
			$job_array['day'] = $job['2'];
			$job_array['month'] = $job['3'];
			$job_array['day_week'] = $job['4'];
			foreach ($job as $key => $value) {
				if ($key < 5) {
					continue;
				}
				$ipm_arr[$key] = $value;
			}
			$job_array['command'] = implode(' ', $ipm_arr);
			return $job_array;
		} else {
			return false;
		}
	}

	// return str cron job. arg1 = associative array cron job elements
	static public function jobElementsArrayToString($job_array)
	{
		if (!isset($job_array['minute']) || !isset($job_array['hour']) || !isset($job_array['day']) || !isset($job_array['month']) || !isset($job_array['day_week']) || !isset($job_array['command'])) {
			// Incorect array
			return false;
		}
		$job = $job_array['minute'] . ' ' . $job_array['hour']  . ' ' . $job_array['day']  . ' ' . $job_array['month']  . ' ' . $job_array['day_week']  . ' ' . $job_array['command'];
		return $job;
	}
}
