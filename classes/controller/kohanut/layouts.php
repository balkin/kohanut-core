<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Layouts controller
 * Modified for Jelly modelling system
 *
 * @package    Kohanut
 * @author     Michael Peters
 * @author     Alexander Kupreyeu (Kupreev)
 * @copyright  (c) Michael Peters
 * @license    http://kohanut.com/license
 */
class Controller_Kohanut_Layouts extends Controller_Kohanut_Admin {

	public function action_index()
	{
		$this->view->title = __('Layouts');
		$this->view->body = new View('kohanut/layouts/list');
		
		// Get the list of layouts
		$this->view->body->layouts = Jelly::select('kohanut_layout')->execute();
	}
	
	public function action_edit($id)
	{
		// Find the layout
		$layout = Jelly::select('kohanut_layout')
            ->where('id', '=', $id)
            ->limit(1)
            ->execute();
		
		if ( ! $layout->loaded())
		{
			return $this->admin_error(__('Could not find layout with ID :id.',array(':id'=>$id)));
		}
		
		// Create the view
		$this->view->title = __('Edit Layout');
		$this->view->body = new View('kohanut/layouts/edit',array('layout'=>$layout,'errors'=>false,'success'=>false));

		if ($_POST)
		{
			$layout->set($_POST);
			
			// Try to save the layout
			try
			{
				$layout->save();
				$this->view->body->success = __('Updated Successfully');
			}
			catch (Validate_Exception $e)
			{
				$this->view->body->errors = $e->array->errors('layout');
			}
			catch (Kohanut_Exception $e)
			{
				$this->view->body->errors = array($e->getMessage());
			}
		}
	}
	
	public function action_new()
	{
		$layout = Jelly::factory('kohanut_layout');
		
		// Create the view
		$this->view->title = "New Layout";
		$this->view->body = new View('kohanut/layouts/new',array('layout'=>$layout,'errors'=>false));
		
		if ($_POST)
		{
			$layout->set($_POST);
			
			// Try to save the layout
			try
			{
				$layout->save();
				$this->request->redirect(Route::get('kohanut-admin')->uri(array('controller'=>'layouts')));
			}
			catch (Validate_Exception $e)
			{
				$this->view->body->errors = $e->array->errors('layout');
			}
			catch (Kohanut_Exception $e)
			{
				$this->view->body->errors = array($e->getMessage());
			}
		}
	}
	
	public function action_delete($id)
	{
		// Find the layout
		$layout = Jelly::select('kohanut_layout')
            ->where('id', '=', $id)
            ->limit(1)
            ->execute();
		
		if ( ! $layout->loaded())
		{
			return $this->admin_error(__('Could not find layout with ID :id.',array(':id'=>$id)));
		}
		
		// Create the view
		$this->view->title = "Delete Layout";
		$this->view->body = new View('kohanut/layouts/delete',array('errors'=>false,'layout'=>$layout));
		
		if ($_POST)
		{
			try
			{
				$layout->delete();
				$this->request->redirect(Route::get('kohanut-admin')->uri(array('controller'=>'layouts')));
			}
			catch (Exception $e)
			{
				$this->view->body->errors = array('submit'=>__('Delete failed! This is most likely caused because this template is still being used by one or more pages.'));
			}
		}
	}
}