<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 *
 */
class Controller_Kohanut_Admin_Settings_Site extends Controller_Kohanut_Admin {

	public function before()
	{
		parent::before();
	}

	public function action_index()
	{
		
		$this->view->body = "Here is a list of site settings you can change:";
		
	}
}