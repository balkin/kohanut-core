<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Kohanut Content Elemenent. Can render markdown and/or twig.
 * Modified for Jelly modelling system
 *
 * @package    Kohanut
 * @author     Michael Peters
 * @author     Alexander Kupreyeu (Kupreev)
 * @copyright  (c) Michael Peters
 * @license    http://kohanut.com/license
 */
class Model_Kohanut_Element_Content extends Kohanut_Element
{

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->table('kohanut_element_content')
            ->fields(array(
			'id' => new Field_Primary,
			
			'code' => new Field_Text,
			
			'markdown' => new Field_Boolean(array('default'=>true)),
			
			'twig' => new Field_Boolean(array('default'=>false)),
		    ));
	
	}
	
	public function title()
	{
		return "Content";
	}
	
	protected function _render()
	{
		$out = $this->code;
		
		// Should we run it through markdown?
		if ($this->markdown)
		{
			$out = Markdown($out);
		}
		
		// Should we run it through twig?
		if ($this->twig)
		{
			$out = Kohanut_Twig::render($out);
		}
		
		return $out;
	}
	
	public function action_edit()
	{
		$view = View::factory('kohanut/elements/content/edit',array('element'=>$this,'errors'=>false,'success'=>false));
		
		if ($_POST)
		{
			// Store the values in post either way, to preserve changes on the page
			$this->set($_POST);
			
			// Make sure there are no twig syntax errors
			if ($this->twig)
			{
				try
				{
					$test = Kohanut_Twig::render($_POST['code']);
				}
				catch (Twig_SyntaxError $e)
				{
					$e->setFilename('code');
					$view->errors[] = "There was a Twig Syntax error: " . $e->getMessage();
					return $view;
				}
			}
			
			// Try saving the element
			try
			{
				$this->save();
				$view->success = "Updated successfully";
			}
			catch (Validate_Exception $e)
			{
				$view->errors = $e->array->errors('page');
			}
		}
		
		return $view;
	}
	
	public function action_add($page,$area)
	{
		$view = View::factory('kohanut/elements/content/add',array('element'=>$this,'errors'=>false,'page'=>$page,'area'=>$area));
		
		if ($_POST)
		{
			$this->set($_POST);
			
			if ($this->twig)
			{
				try
				{
					$test = Kohanut_Twig::render($_POST['code']);
				}
				catch (Twig_SyntaxError $e)
				{
					$e->setFilename('code');
					$view->errors[] = "There was a Twig Syntax error: " . $e->getMessage();
					return $view;
				}
			}
			
			try
			{
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
	
    
    public function set($values, $value = NULL)
    {
        if ( ! is_array($values))
        {
            $values = array($values => $value);
        }
        
        if ($this->loaded()){
            $new = array(
                'twig'  => 0,
                'markdown' => 0,
            );
            return parent::set(array_merge($new, $values));
        }
        else
        {
            return parent::set($values);
        }
    }
}