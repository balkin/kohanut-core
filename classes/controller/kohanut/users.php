<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Users Controller
 * Modified for Jelly modelling system
 *
 * @package    Kohanut
 * @author     Michael Peters
 * @author     Alexander Kupreyeu (Kupreev)
 * @copyright  (c) Michael Peters
 * @license    http://kohanut.com/license
 */
class Controller_Kohanut_Users extends Controller_Kohanut_Admin {

	public function before()
	{
		parent::before();
	}

	public function action_index()
	{
		$users = Jelly::select('kohanut_user')->execute();
		$this->view->body = View::factory('kohanut/users/list',array('users'=>$users));
	}
	
	public function action_new()
	{
        $user = Jelly::factory('kohanut_user');
		
		$errors = false;
		
		if ($_POST)
		{
			try
			{
				$user->set($_POST);
                $user->set(array(
                    'roles' => Jelly::select('kohanut_role')
                        ->where('name', '=', 'login')
                        ->limit(1)
                        ->execute()
                    ));
                $user->save();
                
				Request::instance()->redirect(Route::get('kohanut-admin')->uri(array('controller'=>'users')));
			}
			catch (Validate_Exception $e)
			{
				$errors = $e->array->errors('user');
			}
		}
		
		$this->view->title = "Create New User";
		$this->view->body = new View('kohanut/users/new');
	
		$this->view->body->user = $user;
		$this->view->body->errors = $errors;
	}
	
	public function action_edit($id)
	{
		// Sanitize
		$id = (int) $id;
		
		// Find the user
        $user = Jelly::select('kohanut_user', $id);
        		
		if ( ! $user->loaded())
			return $this->admin_error("Could not find user with id <strong>$id</strong>");
	
		$errors = false;
		$success = false;
		
		if ($_POST)
		{
			try
			{
				if (empty($_POST['password']))
                {
                    unset($_POST['password'], $_POST['password_confirm']);
                }
                
                $user->set($_POST);
				$user->save();
				$success = "Updated Successfully";
			}
			catch (Validate_Exception $e)
			{
				$errors = $e->array->errors('users');
			}
		}
		
		$this->view->title = "Editing User";
		$this->view->body = new View('kohanut/users/edit');
	
		$this->view->body->user = $user;
		$this->view->body->errors = $errors;
		$this->view->body->success = $success;
	}
	
	public function action_delete($id)
	{
		// Sanitize
		$id = (int) $id;
		
		// Find the user
        $user = Jelly::select('kohanut_user', $id);
		
		if ( ! $user->loaded())
			return $this->admin_error("Could not find user with id <strong>$id</strong>");
		
		$errors = false;
		
		// If the form was submitted, delete the user.
		if ($_POST)
		{

			try
			{
				$user->delete();
				Request::instance()->redirect(Route::get('kohanut-admin')->uri(array('controller'=>'users')));
			}
			catch (Exception $e)
			{
				$errors = array('submit'=>"Could not delete user.");
			}
			
		}
		
		$this->view->title = "Delete User";
		$this->view->body = new View('kohanut/users/delete');
	
		$this->view->body->user = $user;
		$this->view->body->errors = $errors;
	}
}