sugarcrm-bundle
===============

Symfony2 bundle for accessing Sugar CRM REST v10 interface.

It's a Bundle for using spinegar/sugarcrm7-api-wrapper-class.

This can be used in two ways, the wrapper directly or through the NosqlBundle.

Choosing this is easy. 

In app/config/config.yml, pick one of these lines:

   - { resource: @RedpillLinproSugarCrmBundle/Resources/config/services.yml }

   - { resource: @RedpillLinproSugarCrmBundle/Resources/config/services\_wrapper.yml }

Parameters.yml needs the same parameters for either access method:

    sugarcrm_base_url: http://sugar.local.net
    sugarcrm_username: sugar
    sugarcrm_password: sugar

Remember your app/AppKernel.php entry:

    new RedpillLinpro\SugarCrmBundle\RedpillLinproSugarCrmBundle(),

And if you are going to use the Nosqlbundle, add it to your composer.json


Have fun,

Thomas.
