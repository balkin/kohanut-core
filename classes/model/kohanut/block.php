<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Kohanut Block Model
 * Modified for Jelly modelling system
 *
 * @package    Kohanut
 * @author     Michael Peters
 * @author     Alexander Kupreyeu (Kupreev)
 * @author     Ruslan Balkin
 * @copyright  (c) Michael Peters
 * @license    http://kohanut.com/license
 *
 * // Completion:
 *
 * @property int                        $id
 * @property Model_Kohanut_Page         $page
 * @property int                        $area
 * @property int                        $order
 * @property Model_Kohanut_Elementtype  $elementtype
 * @property int                        $element
 */
class Model_Kohanut_Block extends Jelly_Model {

	public static function initialize(Jelly_Meta $meta)
	{

		$meta->fields(array(
			'id' => new Field_Primary,
			
			'page' => new Field_BelongsTo(array(
				'model' => 'kohanut_page',
				'column' => 'page',
				'foreign' => 'kohanut_page.id',
			)),
			
			'area' => new Field_Integer,
			
			'order' => new Field_Integer,
			
			'elementtype' => new Field_BelongsTo(array(
				'model' => 'kohanut_elementtype',
				'column' => 'elementtype',
				'foreign' => 'kohanut_elementtype.id',
			)),
			
			'element' => new Field_Integer,
		));
	
	}
	
	public function create($page, $area, $elementtype, $element)
	{
		if ($this->loaded())
			throw new Kohanut_Exception('Cannot add a block that already exists');
		
		$elementtype = Jelly::select('kohanut_elementtype')
			->where('name', '=', $elementtype)
			->limit(1)
			->execute();

		if ( ! $elementtype->loaded())
			throw new Kohanut_Exception('Could not find elementtype ' . $elementtype);

		// Get the highest 'order' from elements in the same page and area
		/** @var $block Model_Kohanut_Block */
		$block = Jelly::select('kohanut_block')
			->where('page', '=', (int) $page)
			->where('area', '=', (int) $area)
			->order_by('order', 'DESC')
			->limit(1)
			->execute();
		$order = ($block->order) + 1;

		// Create the block
		$this->set(array(
			'page' => $page,
			'area' => $area,
			'order' => $order,
			'elementtype' => $elementtype->id,
			'element' => $element,
		))->save();
	}
	
}