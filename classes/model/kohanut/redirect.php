<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Kohanut Redirect Model
 * Modified for Jelly modelling system
 *
 * @package    Kohanut
 * @author     Michael Peters
 * @author     Alexander Kupreyeu (Kupreev)
 * @copyright  (c) Michael Peters
 * @license    http://kohanut.com/license
 */
class Model_Kohanut_Redirect extends Jelly_Model {

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->fields(array(
			'id' => new Field_Primary,
			'url' => new Field_String(array(
				'empty' => TRUE,
				'default' => NULL,
			    )),
			'newurl' => new Field_String(array(
				
			    )),
			'type' => new Field_Enum(array(
				'choices' => array('301'=> '301 ('.__('permanent').')' ,'302'=> '302 ('.__('temporary').')' ),
			    )),
		    ));
	}
	
	/**
	 * Find a redirect from $url
	 *
	 * @return  boolean   true if found, false if not
	 */
	public function find($url) 
    {
		// Check for a redirect at $url
        return Jelly::select($this)
            ->where('url', '=', $url)
            ->limit(1)
            ->execute();
	}
	
	public function go() {
		
		// Make sure this redirect is loaded
		if ( $this->loaded())
		{
			
			if ($this->type == '301' || $this->type == '302')
			{
				// Redirect to the new url
				Kohana::$log->add('INFO', "Kohanut - Redirected '$this->url' to '$this->newurl' ($this->type)."); 
				Request::instance()->redirect($this->newurl,$this->type);
			}
			else
			{
				// This should never happen, log an error and display an error
				Kohana::$log->add('ERROR', "Kohanut - Could not redirect '$this->url' to '$this->newurl'. Unknown redirect type: ($this->type)");
				throw new Kohanut_Exception("Unknown redirect type",array(),404);
			}
			
		}
	}
}