<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Kohanut Admin controller. This handles login and logout, ensures that the admin is logged in, does some auto-rendering and templating.
 * Modified for Jelly modelling system
 * 
 * @package    Kohanut
 * @author     Michael Peters
 * @author     Alexander Kupreyeu (Kupreev)
 * @copyright  (c) Michael Peters
 * @license    http://kohanut.com/license
 */
class Controller_Kohanut_Admin extends Controller {

	// The user thats logged in
	protected $user;
    
    // Auth object
    protected $auth;
	
	// The view to render
	protected $view;
	
	protected $auto_render = true;
	
	// admin pages require login
	protected $requires_login = true;
	
	public function before()
	{
		// Do not template media files
		if ($this->request->action === 'media')
		{
			$this->auto_render = FALSE;
		}
		
		// Do not require login for media or login/logout
		if ($this->request->action === 'media' OR $this->request->action === 'login' OR $this->request->action === 'logout')
		{
			$this->requires_login = FALSE;
		}
		
		// Set the default view
		$this->view = new View('kohanut/admin');
		
		if ($this->requires_login)
		{
			$this->auth = Auth::instance();
            
            if ( ! $this->auth->logged_in('login'))
            {
                $this->request->redirect(Route::get('kohanut-login')->uri(array('action'=>'login')));
            }
            
            $this->user = $this->auth->get_user();
            
            if ($this->user)
            {
                $this->view->user = $this->user->username;    
            }
		}
		
		// Check for language change
		if (isset($_GET['lang']))
		{
			$lang = $_GET['lang'];

			// Load the accepted language list
			$translations = array_keys(Kohana::message('kohanut', 'translations'));

			if (in_array($lang, $translations))
			{
				// Set the language cookie
				Cookie::set('kohanut_language', $lang, Date::YEAR);
			}

			// Reload the page
			$this->request->redirect(Route::get('kohanut-admin')->uri(array('controller'=>'pages')));
		}
		
		// Set the translation language
		I18n::$lang = Cookie::get('kohanut_language', Kohana::config('kohanut')->lang);
		
		// Include Twig if it hasn't been yet
		if ( ! class_exists('Twig_Autoloader'))
		{
			require Kohana::find_file('vendor', 'Twig/lib/Twig/Autoloader');
			Twig_Autoloader::register();
		}
		
		// Include Markdown Extra, if it hasn't been yet
		if ( ! function_exists('Markdown'))
		{
			require Kohana::find_file('vendor','Markdown/markdown');
		}
		
	}
	
	public function __call($method,$args)
	{
		$this->admin_error("Could not find the url you requested.");
	}
	
	
	public function admin_error($message)
	{
		$this->before();
		$this->view->body = new View('kohanut/admin-error');
		$this->view->body->message = $message;
	}

	public function after()
	{
		// If auto_render is true, send the response
		if ($this->auto_render)
		{
			$this->request->response = $this->view;
		}
	}
	
	public function action_media()
	{
		// Get the file path from the request
		$file = $this->request->param('file');
		
		// Find the file extension
		$ext = pathinfo($file, PATHINFO_EXTENSION);
		
		// Remove the extension from the filename
		$file = substr($file, 0, -(strlen($ext) + 1));
		
		// Find the file
		$file = Kohana::find_file('kohanut-media', $file, $ext);
		
		// If it wasn't found, send a 404
		if ( ! $file )
		{
			// Return a 404 status
			$this->request->status = 404;
			return;
		}
		
		// If the browser sent a "if modified since" header, and the file hasn't changed, send a 304
		if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) AND strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == filemtime($file))
		{
			$this->request->status = 304;
			return;
		}
		
		// Send the file content as the response, and send some basic headers
		$this->request->response = file_get_contents($file);
		$this->request->headers['Content-Type'] = File::mime_by_ext($ext);
		$this->request->headers['Content-Length'] = filesize($file);
		
		// Tell browsers to cache the file for an hour. Chrome especially seems to not want to cache things
		$cachefor = 3600;
		$this->request->headers['Cache-Control'] = 'max-age='.$cachefor.', must-revalidate, public';
		$this->request->headers['Expires'] = gmdate('D, d M Y H:i:s',time() + $cachefor).'GMT';
		$this->request->headers['Last-Modified'] = gmdate('D, d M Y H:i:s',filemtime($file)).' GMT';
	}
	
	public function action_login()
	{
		$this->auth = Auth::instance();
        
        // If the user is logged in, redirect them
		if ($this->user)
		{
			$this->request->redirect('admin/pages');
		}
		
		// Overide default view and bind with $user and $errors
		$this->view = View::factory('kohanut/login')
			->bind('username', $username)
            ->bind('errors', $errors);
		
		$this->view->title = "Login";
        
        if ($_POST)
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
 
            //$remember = isset($_POST['remember']) ? TRUE : FALSE;
            if ($this->auth->login($username, $password, FALSE))
            {
                $this->request->redirect(Route::get('kohanut-admin')->uri(array('controller'=>'pages')));
            } else {
                $errors = array('Login or password incorrect');
            }
        }
	}
	
	public function action_logout()
	{
		$this->auth = Auth::instance();
        
        $this->auth->logout();
			
		// Redirect to the login
		$this->request->redirect(Route::get('kohanut-login')->uri(array('action'=>'login')));
	}

	public function action_lang()
	{
		$this->view->body = View::factory('kohanut/lang',array('translations'=>Kohana::message('kohanut', 'translations')));
	}
}
