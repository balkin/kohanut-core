<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Kohanut Layout Model
 * Modified for Jelly modelling system
 *
 * @package    Kohanut
 * @author     Michael Peters
 * @author     Alexander Kupreyeu (Kupreev)
 * @copyright  (c) Michael Peters
 * @license    http://kohanut.com/license
 */
class Model_Kohanut_Layout extends Jelly_Model {

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->fields(array(
			'id' => new Field_Primary,
			
			'name' => new Field_String(array('label'=>'Name')),
			'desc' => new Field_String(array('label'=>'Description')),
			'code' => new Field_Text(array('label'=>'Code')),
			
			'pages' => new Field_HasMany(array(
				'model' => 'page',
			    )),
			
		    ));
	}
	
	public function create()
	{
		// Make sure there are no twig syntax errors
		try
		{
			$test = Kohanut_Twig::render($this->code);
		}
		catch (Twig_SyntaxError $e)
		{
			$e->setFilename('code');
			throw new Kohanut_Exception("There was a Twig Syntax error: " . $e->getMessage());
		}
		catch (Exception $e)
		{
			throw new Kohanut_Exception("There was an error: " . $e->getMessage() . " on line " . $e->getLine());
		}
        
        $this->save();
	
	}
	
	public function update()
	{
		// Make sure there are no twig syntax errors
		try
		{
			$test = Kohanut_Twig::render($this->code);
		}
		catch (Twig_SyntaxError $e)
		{
			$e->setFilename('code');
			throw new Kohanut_Exception("There was a Twig Syntax error: " . $e->getMessage());
		}
		catch (Exception $e)
		{
			throw new Kohanut_Exception("There was an error: " . $e->getMessage() . " on line " . $e->getLine());
		}
		
        $this->save();
	}
	
	public function render()
	{
		// Ensure the layout is loaded
		if ( ! $this->loaded())
		{
			return "Layout Failed to render because it wasn't loaded.";
		}
		
		if (Kohana::$profiling === TRUE)
		{
			// Start a new benchmark
			$benchmark = Profiler::start('Kohanut', 'Render Layout');
		}
		
        $out = Kohanut_Twig::render($this->code);
        
        if (isset($benchmark))
		{
			// Stop the benchmark
			Profiler::stop($benchmark);
		}
		return $out;
	}

}