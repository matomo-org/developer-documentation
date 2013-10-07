<small>Piwik</small>

Config
======

For general performance (and specifically, the Tracker), we use deferred (lazy) initialization and cache sections.

Description
-----------

We also avoid any dependency on Zend Framework&#039;s Zend_Config.

We use a parse_ini_file() wrapper to parse the configuration files, in case php&#039;s built-in
function is disabled.

Example reading a value from the configuration:

    $minValue = Piwik_Config::getInstance()-&gt;General[&#039;minimum_memory_limit&#039;];

will read the value minimum_memory_limit under the [General] section of the config file.

Example setting a section in the configuration:

   $brandingConfig = array(
       &#039;use_custom_logo&#039; =&gt; 1,
   );
   Piwik_Config::getInstance()-&gt;branding = $brandingConfig;

Example setting an option within a section in the configuration:

   $brandingConfig = Piwik_Config::getInstance()-&gt;branding;
   $brandingConfig[&#039;use_custom_logo&#039;] = 1;
   Piwik_Config::getInstance()-&gt;branding = $brandingConfig;

