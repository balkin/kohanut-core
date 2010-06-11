# Kohanut Core

This is just the module for the cms.  See [bluehawk/kohanut](http://github.com/bluehawk/kohanut) for the whole application, the documentation is on the [website](http://kohanut.com).

+++

This fork is the port of Kohanut core for [Jelly modelling system](http://github.com/jonathangeiger/kohana-jelly). Also [Jelly-Auth Kohana 3 authentication module](http://github.com/raeldc/jelly-auth) applied for user management (but all its possibilities are not implemented yet). 

This modification depends on such Kohana 3 modules as
* [Database](http://github.com/kohana/database)
* [Auth](http://github.com/kohana/auth)
* [Jelly](http://github.com/jonathangeiger/kohana-jelly)
* [Jelly-Auth](http://github.com/raeldc/jelly-auth)
* [Jelly-MPTT](http://github.com/AlexKupreev/jelly-mptt)

Here the example of my bootstrap Kohana::modules(), order of includind matters:

Kohana::modules(array(
	'database'    => MODPATH.'database',
    'jelly-mptt'  => MODPATH.'jelly-mptt',
    'kohanut'     => MODPATH.'kohanut', 
    'jelly-auth'  => MODPATH.'jelly-auth', 
    'auth'        => MODPATH.'auth',
	'jelly'       => MODPATH.'jelly',
));