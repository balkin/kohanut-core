<?php defined('SYSPATH') or die('No direct script access.');
/**
 * This is the Elements controller, it's responsible for moving, editing and adding elements, using the drivers.
 * Modified for Jelly modelling system                                                       
 * 
 * @package    Kohanut
 * @author     Michael Peters
 * @author     Alexander Kupreyeu (Kupreev)
 * @copyright  (c) Michael Peters
 * @license    http://kohanut.com/license
 */
class Controller_Kohanut_Elements extends Controller_Kohanut_Admin {

	/**
	 * This class doesn't need an index
	 *
	 * @return  void
	 */
	public function action_index()
	{
		return $this->admin_error('Nothing to see here.');
	}
	
	/**
	 * Move a block up in its area
	 *
	 * @param   int   The id of the block to move
	 * @return  redirects back to editing the page
	 */
	public function action_moveup($id)
	{
		// Sanitize
		$id = (int) $id;
		
		// Load the block and ensure it exists
		$block = Jelly::select('kohanut_block', $id);
            
		if ( ! $block->loaded())
			return $this->admin_error(__('Couldn\'t find block ID :id.',array(':id'=>$id)));
		
        // Find a block on the same page and area, with a lower order.
		$other = Jelly::select('kohanut_block')
            ->where('order','<', $block->order)
            ->where('area', '=', $block->area)
            ->where('page', '=', $block->page->id)
            ->order_by('order','DESC')
            ->limit(1)
            ->execute();
		
		// If other isn't loaded it means there wasn't an element above this one
		if ($other->loaded())
		{
			// Swap their orders
			$temp = $block->order;
			$block->order = $other->order;
			$other->order = $temp;
			
			$block->save();
			$other->save();
		}
		
		// Redirect back to edit page
		Request::instance()->redirect('/admin/pages/edit/' . $block->page->id);
	}
	
	/**
	 * Move a block down in its area
	 *
	 * @param   int   The id of the block to move
	 * @return  redirects back to editing the page
	 */
	public function action_movedown($id)
	{
		// Sanitize
		$id = (int) $id;
		
		// Load the block and ensure it exists
		$block = Jelly::select('kohanut_block', $id);
            
		if ( ! $block->loaded())
			return $this->admin_error(__('Couldn\'t find block ID :id.',array(':id'=>$id)));
			
		// Find a block on the same page and area, with a lower order.
		$other = Jelly::select('kohanut_block')
            ->where('order','>',$block->order)
            ->where('area', '=', $block->area)
            ->where('page', '=', $block->page->id)
            ->order_by('order','ASC')
            ->limit(1)
            ->execute();
		
		// If other isn't loaded it means there wasn't an element above this one
		if ($other->loaded())
		{
			// Swap their orders
			$temp = $block->order;
			$block->order = $other->order;
			$other->order = $temp;
			
			$block->save();
			$other->save();
		}
		
		// Redirect back to edit page
		Request::instance()->redirect('/admin/pages/edit/' . $block->page->id);
	}
	
	/**
	 * Gives a form for adding an element to a page, the three params are actually one.
	 *
	 * @param   string   type/page/area Ex: 3/89/1
	 * @return  void
	 */
	public function action_add($params)
	{
		$params = explode('/',$params);
		$type = Arr::get($params,0,NULL);
		$page = Arr::get($params,1,NULL);
		$area = Arr::get($params,2,NULL);
		
		if ($page == NULL OR $type == NULL OR $area == NULL)
			return $this->admin_error(__('Add requires 3 parameters, type, page and area.'));
		
		$type = (int) $type;
		$page = (int) $page;
		$area = (int) $area;
		
		$type = Jelly::select('kohanut_elementtype', $type);
		
		if ( ! $type->loaded())
			return $this->admin_error(__('Elementtype :type could not be loaded.', array(':type'=> (int) $block->elementtype->id)));
		
        $class_name = 'Kohanut_Element_'.ucfirst($type->name);
        
		$class = Jelly::factory($class_name);
		
		$this->view->title = __('Add Element');
		$this->view->body = $class->action_add((int) $page, (int) $area);
		$this->view->body->page = $page;
	}
	
	/**
	 * Gives a form for editing an element on a page.
	 *
	 * @param   int   Block id to edit
	 * @return  void
	 */
	public function action_edit($id)
	{
		// Sanitize
		$id = (int) $id;
		
		// Load the block
		$block = Jelly::select('kohanut_block', $id);
        
		if ( ! $block->loaded())
			return $this->admin_error(__('Couldn\'t find block ID :id.',array(':id'=>$id)));
			
		// Load the type
		$type = $block->elementtype;
		
		if ( ! $type->loaded())
			return $this->admin_error(__('Elementtype :type could not be loaded.',array(':type'=> (int) $block->elementtype->id)));
		
		$class_name = 'Kohanut_Element_'.ucfirst($type->name);

        $class = Jelly::select($class_name, intval($block->element));
            
		$class->block = $block;
        
        if ( ! $class->loaded())
			return $this->admin_error(__(':type with ID :id could not be found.',array(':type'=>$type->name,':id'=>(int)$block->element)));
		
		$this->view->title = __('Editing :element',array(':element'=>__(ucfirst($type->name))));
		$this->view->body = $class->action_edit();
        $this->view->body->page = $block->page->id;
	}
	
	/**
	 * Gives a form for confirming deleting of an element
	 *
	 * @param   int   Block id to delete
	 * @return  void
	 */
	public function action_delete($id)
	{
		// Sanitize
		$id = (int) $id;
		
		// Load the block
		$block = Jelly::select('kohanut_block', $id);
		
		if ( ! $block->loaded())
			return $this->admin_error(__('Couldn\'t find block ID :id.',array(':id'=>$id)));
		
		// Load the type
		$type = $block->elementtype;
		
		if ( ! $type->loaded())
			return $this->admin_error(__('Elementtype :type could not be loaded.',array(':type'=> (int) $block->elementtype->id)));
			
		$class_name = 'Kohanut_Element_'.ucfirst($type->name);
        
        $class = Jelly::select($class_name)
            ->where('id', '=', $block->element)
            //->where('block', '=', $block->id)
            ->limit(1)
            ->execute();
            
        $class->block = $block;
		
		if ( ! $class->loaded())
			return $this->admin_error(__(':type with ID :id could not be found.',array(':type'=>$type->name,':id'=>(int)$block->element)));
		
		$this->view->title = __('Delete :element',array(':element'=>__(ucfirst($type->name))));
		$this->view->body = $class->action_delete();
		
	}
	
}