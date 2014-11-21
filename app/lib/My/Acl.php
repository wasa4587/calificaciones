<?php
namespace My;


class Acl
{
	private static $instance;
	protected static $resources;

	public static function getInstance() {
		if (null==self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	public static function setResources($resources) {
		self::$resources = $resources;
	}
	public function check() {
		foreach (self::$resources as $resource) {
			if (   \Request::is($resource['recurso']) 
				&& \Request::isMethod($resource['method']))
			{
				return true;
			}
		}
		return false;
	}
	public function checkManually($url, $method) {
		foreach (self::$resources as $resource) {
			if (   $url == $resource['recurso']
				&& $method ==$resource['method'])
			{
				return true;
			}
		}
		return false;
	}


}