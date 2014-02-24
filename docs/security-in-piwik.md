# Security in Piwik

<!-- Meta (to be deleted)
Purpose: describe all security measures used and why they are used (use already written text as base)

Audience: 

Expected Result: 

Notes: 

What's missing? (stuff in my list that was not in when I wrote the 1st draft)
-->

## About this guide

**Read this guide if**

* you'd like to know **how to write secure code when extending Piwik or contributing to Piwik**

**Guide assumptions**

This guide assumes that you:

* can code in PHP, JavaScript and SQL,
* and have a general understanding of extending Piwik (if not, read our [Getting Started](#) guide).

## Introduction

If you plan on developing a Piwik plugin or [contributing to Piwik Core](#) your code must be secure. You should make an effort to avoid vulnerabilities.

This guide contains a list of methods to combat certain vulnerabilities. Follow all of them when creating your plugin or contribution.

## Preventing XSS

[XSS](http://en.wikipedia.org/wiki/Cross-site_scripting) is the injection of malicious scripts into a webapp's UI. Either by storing malicious scripts in entity data (like website names for Piwik), attackers can gain control of applications that do not take the proper precautions.

### Always load request parameters via [Common::getRequestVar](#)

In your PHP code, if you need access to a variable in `$_GET` or `$_POST`, always use [Common::getRequestVar](#) to get it. **getRequestVar** will sanitize the request variable so if an attacker passes `<script>...</script>` your code will end up using `&lt;script&gt;...&lt;/script&gt;`. This will help you avoid accidentally embedding unescaped text in HTML output.

For text you know may contain special characters or if you need to output text in a format that doesn't need XML/HTML sanitization (like JSON), call the [Piwik::unsanitizeInputValues](#) to undo the sanitization.

_Note: You can sanitize text that isn't in a request variable by calling [Piwik::sanitizeInputValues](#)._

### Use |raw sparingly in Twig templates

When creating [Twig](#) templates, try to avoid using the `|raw` filter when possible. As an alternative, try putting the HTML you want to reuse in a separate template and `{% include %}` it.

If you do use `|raw`, make sure what your inserting has been properly escaped.

### Be careful when using jQuery.html

In your JavaScript, be careful when using the `$.html` method to insert HTML into the DOM. Make sure the string you are inserting came from Piwik and has been escaped.

If you know that the text your inserting shouldn't be HTML, then **do not use `$.html`**, instead use the `$.text` or `$.val` methods. For example:

    var ajaxData = getDataFromAjax();
    $('#someLabel').text(ajaxData.labelToUse);

## Preventing CSRF

[CSRF](http://en.wikipedia.org/wiki/Cross-site_request_forgery) is a form of attack where an attacker gets a user to click a link on their website that does something the user would not want on the webapp the user uses. The link could, for example, point to a Piwik controller method that changes the user's password.

This attack can be prevented with one technique:

### Check for the **token_auth**

In every controller method you create that changes Piwik settings, changes a user's settings or does some other admin level function, call the [Controller::checkTokenInUrl](#) method. For example:

    // method in a controller
    public function doSomeAdminStuff()
    {
        $this->checkTokenInUrl();

        // ...
    }

In every API method that executes some admin level function, make sure to check for the proper user permissions by calling one of the [Piwik::check...](#) methods. For example:

    // method in an API class
    public function changeSettingsForUser($userLogin)
    {
        Piwik::checkUserHasSuperUserAccessOrIsTheUser($userLogin);
    }

#### **token_auth** in the browser

Your JavaScript should send the **token\_auth** to controller and API methods that need it, but you should make sure the **token\_auth** **never appears in the URL**. This way, it will never be saved by the browser in any way.

To keep the **token_auth** out of a browser cache, plugins can use POST requests.

TODO: make sure Reporting API guide has security stuff

## Preventing SQL Injection

[SQL Injection](http://en.wikipedia.org/wiki/SQL_Injection) is the manipulation of an app's SQL by sending SQL in fields an parameters that are used to construct SQL statements.

For example, if an app builds an SQL statement like this: `$sql = "SELECT * from mytable where id = " . $_GET['id']";`, an attacker could pass `"1 OR 1"` for the **id** query parameter to cause the query to output every row in **mytable**.

SQL injection can be prevented by doing one thing:

### Use placeholders in your SQL

When writing SQL statements, use [SQL placeholders](#) instead of directly inserting variables into your statement. In other words, **don't do this**:

    use Piwik\Db;

    $idSite = Common::getRequestVar('idSite');
    $sql = "SELECT * FROM " . Common::prefixTable('site') . " WHERE idsite = " . $idSite; // DON'T DO THIS!!

    $rows = Db::query($sql);

Instead, **do this**:

    use Piwik\Db;
    
    $idSite = Common::getRequestVar('idSite');
    $sql = "SELECT * FROM " . Common::prefixTable('site') . " WHERE idsite = ?";

    $rows = Db::query($sql, array($idSite));

There is a limit to the number of placeholders you can use. If you need to use more placeholders than the limit allows, you may have to concatenate the parameters directly. Make sure these parameters are obtained from a trusted source (such as from another query). The is done in **ArchiveSelector::getArchiveData** with archive IDs. Since the IDs are obtained from another query, it safe to use them in this way.

## Preventing Remote File Inclusion

[Remote File Inclusion](http://en.wikipedia.org/wiki/File_inclusion_vulnerability) is the inclusion and execution of source code that is not part of the webapp. It happens in PHP with `include` or `require` statements that use a path determined by the user.

In Piwik, the best way to prevent remote file inclusion attacks is to just never `require`/`include` files using data from the user. Instead, **put logic in classes that can be loaded by Piwik's autoloader** and instantiate/use different classes based on data obtained from the user. In other words, **don't do this**:

    $clientToUse = Common::getRequestVar('seoClient');

    require_once PIWIK_INCLUDE . '/plugins/MyPlugin/Clients/' . $clientToUse . '.php'; // DON'T DO THIS!!

    $client = new $clientToUse();

    // ... use $client ...

Instead, **do this**:

    $clientToUse = Common::getRequestVar('seoClient');

    if ($clientToUse == 'mySeoProvider') {
        $client = new Clients\MySeoProvider();
    } else if ($clientToUse == 'myOtherSeoProvider') {
        $client = new Clients\MyOtherSeoProvider();
    } else {
        throw new Exception("Invalid SEO provider client: $clientToUse!");
    }

    // ... use $client ...

## Preventing Direct Access

**Direct access** is simply the possibility of accessing one of your plugin's PHP files and having them execute. If some code does execute, it will display error messages that reveal valuable information to an attacker.

To prevent this type of vulnerability, put the following at the top of your PHP files that would execute something when run directly:

    <?php

    defined('PIWIK_INCLUDE_PATH') or die('Restricted access');

## Other Coding Guidelines

Here are some other coding guidelines that will help make your code more secure:

* **PHP files should start with a `<?php` tag that is never closed.**

* **Use the `.php` extension for all your PHP scripts.**

* **Avoid executing php code using one of the following functions: [eval](#), [exec](#), [passthru](#), [system](#), [popen](#) or [preg_replace](#) (with the `"e"` modifier).**

* **Make sure that accessing your files directly doesn't execute any code that could have an impact on your Piwik install.**

* **Make sure your code doesn't rely on `register_globals` set to `On`. Note: PHP5 sets `register_globals` to `Off` by default.**

* **If your plugin has admin functionality (functionality only an adminstrator or the super user can use) then your [Controller](#) must extend [Piwik\Plugin\ControllerAdmin](#).

* Some servers will disable PHP functions for (undisclosed) security reasons. Replacement functions can sometimes be found in **libs/upgradephp/upgrade.php**, including `_parse_ini_file()`, `_glob()`, `_fnmatch()`, and `_readfile()`. The functions `safe_serialize()` and `safe_unserialize()` are like the built-in functions, but won't serialize & unserialize objects. TODO: is this useful at all? for security or for something else?

TODO: what about: "Handle user/untrusted input & Handling output" both in plugins.md security section. don't know what it means.

## Learn more

* To learn **more about security in web applications** read this article: [Top 10 Security from The Open Web Application Security Project (OWASP)](http://www.owasp.org/index.php/Top_10_2007).
* To learn **more about security in PHP applications** read this two part article: [part 1](http://www.onlamp.com/pub/a/php/2003/03/20/php_security.html), [part 2](http://www.onlamp.com/pub/a/php/2003/04/03/php_security.html?CMP=AFC-ak_article&ATT=Ten+Security+Checks+for+PHP%2c+Part+2).