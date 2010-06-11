<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Kohanut Element Type Model
 * Modified for Jelly modelling system
 *
 * @package    Kohanut
 * @author     Michael Peters
 * @author     Alexander Kupreyeu (Kupreev)
 * @copyright  (c) Michael Peters
 * @license    http://kohanut.com/license
 */
class Model_Kohanut_Elementtype extends Jelly_Model {

	public static function initialize(Jelly_Meta $meta)
	{
    	$meta->fields(array(
			'id' => new Field_Primary,
			
			'name' => new Field_Text,
		    ));
	}
}