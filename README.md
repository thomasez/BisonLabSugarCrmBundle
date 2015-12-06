sugarcrm-bundle
===============

Symfony2 bundle for accessing Sugar CRM REST v10 interface.

It's a Bundle for using spinegar/sugarcrm7-api-wrapper-class.

This can be used in two ways, the wrapper directly or through the NoOrmBundle.
You will most likely just use the wrapper as it gives you direct access to the sugar service and can use it directly as per it's documenatation. 

The other is for more complete objects and control but for now it basically
does the same as the wrapper but with the same API as other NoOrmBundle
adapters, which is a good idea if you are using NoOrmBundle but not much of a
reason to start using it.

Choosing this is easy. 

In app/config/config.yml, pick one of these lines:

   - { resource: @BisonLabSugarCrmBundle/Resources/config/services\_wrapper.yml }

   - { resource: @BisonLabSugarCrmBundle/Resources/config/services.yml }

Parameters.yml needs the same parameters for either access method:

    sugarcrm_base_url: http://sugar.local.net
    sugarcrm_username: sugar
    sugarcrm_password: sugar

Remember your app/AppKernel.php entry:

    new BisonLab\SugarCrmBundle\BisonLabSugarCrmBundle(),

And if you are going to use the NoOrmbundle, add it to your composer.json


Have fun,

Thomas.
