requestum/router-decoration-bundle
================

A Symfony Bundle created on July 19, 2016, 3:27 pm.

Bundle provides the ability to automatically replace the router parameters values to predefined system values.

**Installation:**
-----------------

Via Composer

    composer require requestum/router-decoration-bundle

**Configuration:**
------------------

To configure bundle in your own application you must add code in special format to your configuration file:

    # Requestum Router Decorator Configuration
    requestum_router_decoration:
          parameters_mapper:
                pattern: mask
                map:
                      <route mask 1>:
                            <parameter name 1>:
                                <route value 1>: <system value 1>
                                ...
                                <route value n>: <system value n>
                            ...
                            <parameter name n>
                      ...
                      <route mask n>:
                      
**Documentation:**
------------------

Bundle uses pattern mask input by default if `pattern` not specified in configuration file. 
If you want use regular expressions in configuration of route mask, you must typo 'regexp' in `pattern` option. 

If you using pattern `mask`, you must follow this example:

    ...
        pattern: mask
        map:
              #Route names 'route_name_' that has any sufix
              route_name_*:
                    ...
              
              #Route names 'route_name_' that has any prefix
              *_route_name:
                    ...
                    
              #Route names that has 'route_' prefix and '_name' sufix                    
              route_*_name:
                    ...
                    
If you using pattern `regexp`, you only need write some regular expression like this:

    ...
        pattern: regexp
        map:
              #Route names 'route_name_' that has any sufix
              /route_name_.*/:
                    ...
              
              #Route names 'route_name_' that has any prefix
              /.*_route_name/:
                    ...
                    
              #Route names that has 'route_' prefix and '_name' sufix                    
              /route_.*_name/:
                    ...
                    
**Advanced:**
-------------

