<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Kohanut Page Model
 * Modified for Jelly modelling system
 *
 * @package    Kohanut
 * @author     Michael Peters
 * @author     Alexander Kupreyeu (Kupreev)
 * @copyright  (c) Michael Peters
 * @license    http://kohanut.com/license
 */
class Model_Kohanut_Page extends Jelly_Model_MPTT {

	protected $_directory = '';

	public static function initialize(Jelly_Meta $meta)
	{
		
		$meta->fields(array(
			'id' => new Field_Primary,
			
			// url and display name
			'url' => new Field_String(array(
				'empty' => TRUE,
				'default' => NULL,
			    )),
			'name' => new Field_String,
			
			//layout
			'layout'  => new Field_BelongsTo(array(
				'model' => 'kohanut_layout',
                'foreign' => 'kohanut_layout.id',
				'column' => 'layout',
			    )),
			
			// nav info
			'islink'   => new Field_Boolean(array(/*'append_label'=>false,*/'default'=>FALSE)),
			'shownav'  => new Field_Boolean(array(/*'append_label'=>false,*/'default'=>TRUE)),
			'showmap'  => new Field_Boolean(array(/*'append_label'=>false,*/'default'=>TRUE)),
			
			// meta datums
			'title'    => new Field_String(array('empty'=>true)),
			'metadesc' => new Field_Text(array('empty'=>true)),
			'metakw'   => new Field_Text(array('empty'=>true)),
			
			//MPTT
			'lft' => new Jelly_Field_MPTT_Left,
			'rgt' => new Jelly_Field_MPTT_Right,
			'lvl' => new Jelly_Field_MPTT_Level,
			'scp' => new Jelly_Field_MPTT_Scope,
			
		));
        
        parent::initialize($meta);
	    
	}
	
	/**
	 * Create a new page in the tree as a child of $parent
	 *
	 *    if $location is "first" or "last" the page will be the first or last child
	 *    if $location is an int, the page will be the next sibling of page with id $location
	 * @param  Kohanut_Page  the parent
	 * @param  string/int    the location
	 * @return void
	 */
	public function create_at($parent, $location = 'last')
	{
		// Make sure a layout is set if this isn't an external link
		if ( ! $this->islink AND empty($this->layout->id))
		{
			throw new Kohanut_Exception("You must select a layout for a page that is not an external link.");
		}
		
        // Create the page as first child, last child, or as next sibling based on location
		if ($location == 'first')
		{
			$this->insert_as_first_child($parent);
		}
		else if ($location == 'last')
		{
			$this->insert_as_last_child($parent);
		}
		else
		{
			$target = Jelly::select('kohanut_page', (int) $location);
                
			if ( ! $target->loaded())
			{
				throw new Kohanut_Exception("Could not create page, could not find target for insert_as_next_sibling id: " . (int) $location);
			}
			$this->insert_as_next_sibling($target);
		}
	}
	
	public function move_to($action,$target)
	{
		// Find the target
		$target = Jelly::select('kohanut_page', $target);
		
		// Make sure it exists
		if ( ! $target->loaded())
		{
			throw new Kohanut_Exception("Could not move page, target page did not exist." . (int) $target->id );
		}
		
		if ($action == 'before')
			$this->move_to_prev_sibling($target);
		elseif ($action == 'after')
			$this->move_to_next_sibling($target);
		elseif ($action == 'first')
			$this->move_to_first_child($target);
		elseif ($action == 'last')
			$this->move_to_last_child($target);
		else
			throw new Kohanut_Exception("Could not move page, action should be 'before', 'after', 'first' or 'last'.");
	}
	
    
    public function save($key = NULL)
    {
        // Make sure a layout is set if this isn't an external link
        if ( ! $this->islink AND empty($this->layout->id))
        {
            throw new Kohanut_Exception("You must select a layout for a page that is not an external link.");
        }
        
        parent::save($key);
        
    }
	
	/**
	 * Renders the page
	 *
	 * @returns a view file
	 */
	public function render()
	{
		
		if ( ! $this->loaded())
		{
			throw new Kohanut_Exception("Page render failed because page was not loaded.",array(),404);
		}
		
		Kohanut::$page = $this;
		
		// Build the view
		return new View('kohanut/xhtml', array('layoutcode' => $this->layout->render()));
		
	}
	
	public function nav_nodes($depth)
	{
		$query = Jelly::select($this)
			->where($this->left_column, '>=', $this->{$this->left_column})
			->where($this->right_column, '<=', $this->{$this->right_column})
			->where($this->scope_column, '=', $this->{$this->scope_column})
			->where($this->level_column, '<=',$this->{$this->level_column} + $depth)
			->where('shownav','=',true)
			->order_by($this->left_column, 'ASC');
		
		return $query->execute();
	}
	
	
    public function set($values, $value = NULL)
    {
        if ($this->loaded())
        {
            $new = array(
                'islink'  => 0,
                'showmap' => 0,
                'shownav' => 0.
                );
                
            if (is_array($values))
            {
                return parent::set(array_merge($new, $values)); 
            }
            return parent::set(array_merge($new, array($values => $value)));
        }
        else
        {
            return parent::set($values);
        }
    }
}