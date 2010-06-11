<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Kohanut Role Model. Modified for Jelly modelling system
 *
 * @package    Kohanut
 * @author     Michael Peters
 * @author     Alexander Kupreyeu (Kupreev)
 * @copyright  (c) Michael Peters
 * @license    http://kohanut.com/license
 */
class Model_Kohanut_Role extends Model_Auth_Role {
    
    public static function initialize(Jelly_Meta $meta)
    {
        $meta->table('kohanut_roles');
        
        parent::initialize($meta);
    }
}