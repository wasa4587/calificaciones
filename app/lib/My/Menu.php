<?php
namespace My;


class Menu
{
    protected static $acl;
    protected static $menu;

    public static function setAcl($acl) {
    	self::$acl = $acl;
    }
    public static function getAcl() {
    	return self::$acl;
    }

    public static function setMenu($menu) {
    	self::$menu = $menu;
    }
    public static function getMenu() {
    	return self::$menu;
    }

    public static function toHTML() {
    $acl = Acl::getInstance();
	$res='<div id="navbar" class="navbar-collapse collapse">';
    $res.='<ul class="nav navbar-nav">';
    foreach (self::$menu as $menu) {
		if (is_array($menu['to'])) {

            $res.='<li class="dropdown">';
            $res.='<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>';
            $res.='<ul class="dropdown-menu" role="menu">';
			foreach ($menu['to'] as $submenu) {
                if ($acl->checkManually($submenu['to'],'GET')) {
	   	           $res.='<li><a href="'.$submenu['to'].'">'.$submenu['tittle'].'</a></li>';
               }
			}
            $res.='</ul>';
            $res.='</li>';

		} else {
            if ($acl->checkManually($menu['to'],'GET')) {
    	        $res.='<li><a href="'.$menu['to'].'">'.$menu['tittle'].'</a></li>';
            }
		}
    }            
	$res.='</ul>';
	$res.='</div>';
	return $res;

    }

}