<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Kohanut User Model. Modified for Jelly modelling system
 *
 * @package    Kohanut
 * @author     Michael Peters
 * @author     Alexander Kupreyeu (Kupreev)
 * @copyright  (c) Michael Peters
 * @license    http://kohanut.com/license
 */
class Model_Kohanut_User extends Model_Auth_User {
    
    public static function initialize(Jelly_Meta $meta)
    {
        $meta
            ->table('kohanut_users')
            ->fields(array(
            'roles' => new Field_ManyToMany(array(
                'through' => array(
                    'model'   => 'kohanut_roles_users',
                    'columns' => array('user_id', 'role_id'),
                ),
                'foreign' => 'kohanut_role',
                ))
            ));
        
        parent::initialize($meta);
    }
} 