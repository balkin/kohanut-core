<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Kohanut_Elements are the blood of Kohanut. Every page is made up of elements.
 * Modified for Jelly modelling system
 *
 * @package    Kohanut
 * @author     Michael Peters
 * @author     Alexander Kupreyeu (Kupreev)
 * @copyright  (c) Michael Peters
 * @license    http://kohanut.com/license
 */
abstract class Kohanut_Element extends Jelly_Model
{

	/**
	 * @var  bool  Whether an element is unique. If this is false, an element can be in more than one place, like a snippet (as in one row in the element_snippet table, but it has several rows in the blocks table). If this is true deleting a block will delete the element itself, rather than just the block.
	 */
	protected $_unique = TRUE;

	/**
	 * @var  object  The sprig model of the block that is linking to this element.  This is null if an element is not represented by a block, for example if it was called via Kohanut::element('snippet','footer')
	 */
	public $block = NULL;
	
	/**
	 * Render the element
	 *
	 * @return string
	 */
	abstract protected function _render();
	
	/**
	 * This should return a discriptive title like "Content" or "Snippet: Footer"
	 *
	 * @return string
	 */
	abstract public function title();
	
	/**
	 * Add this element to a page. This should act very similar to a controller method.
	 *
	 * @param  int  Which page to add to
	 * @param  int  Which area to add to
	 * @return view
	 */
	public function action_add($page, $area)
	{
		$view = View::factory('kohanut/elements/add',array('element'=>$this, 'page'=>$page, 'area'=>$area));
		
		if ($_POST)
		{
			try
			{
				$this->set($_POST);
				$this->save();
				$this->create_block($page, $area);
				Request::instance()->redirect(Route::get('kohanut-admin')->uri(array('controller'=>'pages','action'=>'edit','params'=>$page)));
			}
			catch (Validate_Exception $e)
			{
				$view->errors = $e->array->errors('page');
			}
		}
		return $view;
	}
	
	/**
	 * Edit this element. This should act very similar to a controller method.
	 *
	 * @return view
	 */
	public function action_edit()
	{
		$view = View::factory('kohanut/elements/edit', array('element'=>$this));
		
		if ($_POST)
		{
			try
			{
				$this->set($_POST);
				$this->save();
				$view->success = "Update successfully";
			}
			catch (Validate_Exception $e)
			{
				$view->errors = $e->array->errors('page');
			}
		}
		
		return $view;
	}
	
	/**
	 * Delete this element. This should act very similar to a controller method.
	 *
	 * @return view
	 */
	public function action_delete()
	{
		$view = View::factory('kohanut/elements/delete',array('element'=>$this));
		
		if ($_POST)
		{
			// If this element is unique, delete the element from it's table
			if ($this->_unique == true)
			{
				$this->delete();
			}
			
            $page_id = $this->block->page->id;
			// Delete the block
			$this->block->delete();
			Request::instance()->redirect(Route::get('kohanut-admin')->uri(array('controller'=>'pages','action'=>'edit','params'=>$page_id)));
		}
		
		return $view;
	}
	
	// Final functions are below here
	
	/**
	 * Return the type of the element.
	 *
	 * @param  string  The type of element to create
	 * @return Kohanut_Element
	 */
	final public function type()
	{
		return str_replace('Model_Kohanut_Element_','',get_class($this));
	}
	
	/**
	 * Return an element of a certain type.
	 *
	 * @param  string  The type of element to create
	 * @return Kohanut_Element object
	 */
	final public static function factory($name, $values = NULL)
	{
		$model = 'Model_Kohanut_Element_' . $name;
		
        return new $model($values);
    }
    
    /**
	 * Render the element, including the panel if we are in admin mode
	 *
	 * @return string
	 */
	final public function render()
	{
		// Ensure the element is loaded.
		if ( ! $this->loaded())
		{
			// Load the element
			$element = Jelly::select($this, $this->block->element);

			// If its still not loaded, something is wrong.
			if ( ! $element->loaded())
			{
				throw new Kohanut_Exception('Rendering of element failed, element could not be loaded. Block id # :id',array('id',$this->block->id));
			}
            
            // FIXME
            $element->block = $this->block;
		} else {
            $element = $this;
        }
        
        $out = "";
		
		// If admin mode, render the panel
		if (Kohanut::$adminmode)
		{
			$out .= $element->render_panel();
		}
		
		// And render the actual element
		try
		{
			$out .= $element->_render();
		}
		catch (Exception $e)
		{
			$out .= "<p>There was an error while rendering the element: " . $e->getMessage() . "</p>";
		}
		
		return $out;
	}
	
	/**
	 * Render the admin panel
	 *
	 * @return view
	 */
	final public function render_panel()
	{
		// Block is null when this element was not called from Kohanut::element_area(), so don't draw the content area controls
		if ($this->block == NULL)
			return;
		
		return new View('kohanut/elements/panel',array('title'=>$this->title(),'block'=>$this->block)); 
	}
	
	/**
	 * Create a block for this element on the specified page and area
	 * (Maybe add_block or create_block is a better name)
	 *
	 * @param  int  The page to add this to
	 * @param  int  The area to add this to
	 * @return view
	 */
	final public function create_block($page,$area)
	{
		// You can only create a block for an element that exists
		if ( ! $this->loaded())
			throw new Kohanut_Exception("Attempting to create a block for an element that does not exist, or has not been created yet.");
		
        Jelly::factory('kohanut_block')->create($page, $area, $this->type(), $this->id);
	
	}
	
	final public function unique()
	{
		return $this->_unique;
	}

}