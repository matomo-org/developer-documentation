---
category: Develop
---
# Security best practices

If you plan on developing a plugin or [contributing to Piwik Core](/guides/contributing-to-piwik-core) **your code must be secure**.

This guide contains a list of methods to combat certain vulnerabilities. Follow all of them when working on your plugin or contribution.

## Preventing XSS

[XSS](https://en.wikipedia.org/wiki/Cross-site_scripting) is the injection of malicious scripts (e.g. JavaScript) into the user interface. It can allow attackers to gain control of the application or steal information.

Attackers can achieve that either by:

- storing malicious scripts in data (like website names for Piwik)
- passing malicious scripts as HTTP request parameter/data

### Get request parameters via [Common::getRequestVar()](/api-reference/Piwik/Common#getrequestvar)

In your PHP code, if you need access to a variable in `$_GET` or `$_POST`, **always** use [Common::getRequestVar()](/api-reference/Piwik/Common#getrequestvar).

`getRequestVar()` will sanitize the request variable. If an attacker passes a string containing `<script>...</script>`, it will be sanitized to `&lt;script&gt;...&lt;/script&gt;`. This will help to avoid accidentally embedding unescaped text in HTML output.

For text you know may contain special characters or if you need to output text in a format that doesn't need XML/HTML sanitization (like JSON), call [Piwik::unsanitizeInputValues()](/api-reference/Piwik/Common#unsanitizeinputvalues) to undo the sanitization.

*Note: You can sanitize text that isn't in a request parameter by using [Piwik::sanitizeInputValues()](/api-reference/Piwik/Common#sanitizeinputvalues).*

### Use `|raw` sparingly in Twig templates

When writing [Twig](https://twig.sensiolabs.org/) templates, try to avoid using the `|raw` filter when possible. As an alternative, put the HTML you want to reuse in a separate template and `{% include %}` it.

If you do use `|raw`, make sure what you're inserting has been properly escaped.

### Be careful when using `jQuery.html()`

In your JavaScript, be careful when using the `$.html` method to insert HTML into the DOM. Make sure the string you are inserting came from Piwik and has been escaped.

If you know that the text you're inserting shouldn't be HTML, then **do not use `$.html()`**, instead use `$.text()` or `$.val()`. For example:

```javascript
var ajaxData = getDataFromAjax();
$('#someLabel').text(ajaxData.labelToUse);
```

To escape strings in JavaScript you may use the helper method `piwikHelper.escape` for example:

```javascript
var safeString = piwikHelper.escape( userInputUnsafeString );
$('#someLabel').text( safeString );
```


## Preventing CSRF

[CSRF](https://en.wikipedia.org/wiki/Cross-site_request_forgery) attacks is where an attacker make a Piwik user perform an action unwillingly. To achieve that, the attacker sends a link to the user. The link could, for example, point to a Piwik controller method that changes the user's password, or delete a site.

This attack can be prevented with the following technique:

### Check for the **token_auth**

In every controller method you create that changes Piwik settings, changes a user's settings or does some other admin level function, call the [Controller::checkTokenInUrl()](/api-reference/Piwik/Plugin/Controller#checktokeninurl) method. For example:

```php
// method in a controller
public function doSomeAdminStuff()
{
    $this->checkTokenInUrl();

    // ...
}
```

In every API method that executes some admin level function, make sure to check for the proper user permissions by calling one of the [Piwik::check...](/api-reference/Piwik/Piwik) methods. For example:

```php
// method in an API class
public function changeSettingsForUser($userLogin)
{
    Piwik::checkUserHasSuperUserAccessOrIsTheUser($userLogin);
}
```

#### **token_auth** in the browser

Your JavaScript should send the **token\_auth** to controller and API methods that need it, but you should make sure the **token\_auth** **never appears in the URL**. This way, it will never be saved or cached by the browser.

To keep the **token_auth** out of a browser cache, you can use POST requests.

<!-- TODO: make sure Reporting API guide has security stuff -->

## Preventing SQL Injection

[SQL Injection](https://en.wikipedia.org/wiki/SQL_Injection) is the manipulation of the application's SQL queries by injecting malicious SQL statements. Attackers can inject malicious SQL through inputs of the application: form fields, request parameters, …

For example, if an application builds an SQL query like this:

```php
$sql = 'SELECT * from mytable where id = ' . $_GET['id'];
```

An attacker could pass `"1 OR 1"` for the `id` URL parameter. This would cause the following query to be executed: `SELECT * from mytable where id = 1 OR 1`, which would output every row of **mytable**.

SQL injection can be prevented by doing one thing:

### Use SQL prepared statements

When writing SQL statements, use SQL prepared statements instead of directly inserting variables into your statement. SQL prepared statements means using placeholders in your SQL queries.

In other words, **don't do this**:

```php
$idSite = Common::getRequestVar('idSite');
// DON'T DO THIS!!
$sql = "SELECT * FROM " . Common::prefixTable('site') . " WHERE idsite = " . $idSite;

$rows = Db::query($sql);
```

Instead, **do this**:

```php
$idSite = Common::getRequestVar('idSite');
$sql = "SELECT * FROM " . Common::prefixTable('site') . " WHERE idsite = ?";

$rows = Db::query($sql, array($idSite));
```

## Preventing Remote File Inclusion

[Remote File Inclusion](https://en.wikipedia.org/wiki/File_inclusion_vulnerability) is the inclusion and execution of source code that is not part of the webapp. It happens in PHP with `include` or `require` statements that use a path determined by the user.

In Piwik, the best way to prevent remote file inclusion attacks is to just never `require`/`include` files using data from the user. Instead, **put logic in classes that can be loaded by Piwik's autoloader** and instantiate/use different classes based on data obtained from the user. In other words, **don't do this**:

```php
$clientToUse = Common::getRequestVar('seoClient');

// DON'T DO THIS!!
require_once PIWIK_INCLUDE . '/plugins/MyPlugin/Clients/' . $clientToUse . '.php';

$client = new $clientToUse();

// ... use $client ...
```

Instead, **do this**:

```php
$clientToUse = Common::getRequestVar('seoClient');

if ($clientToUse == 'mySeoProvider') {
    $client = new Clients\MySeoProvider();
} else if ($clientToUse == 'myOtherSeoProvider') {
    $client = new Clients\MyOtherSeoProvider();
} else {
    throw new Exception("Invalid SEO provider client: $clientToUse!");
}

// ... use $client ...
```

## Other Coding Guidelines

Here are some other coding guidelines that will help make your code more secure:

- **PHP files should start with a `<?php` tag that is never closed.**

- **Use the `.php` extension for all your PHP scripts.**

- **Avoid executing php code using one of the following functions: [eval](https://secure.php.net/manual/en/function.eval.php), [exec](https://secure.php.net/manual/en/function.exec.php), [passthru](https://secure.php.net/manual/en/function.passthru.php), [system](https://secure.php.net/manual/en/function.system.php), [popen](https://secure.php.net/manual/en/function.popen.php) or [preg_replace](https://secure.php.net/manual/en/function.preg-replace.php) (with the `"e"` modifier).**

- **Make sure that accessing your files directly doesn't execute any code that could have an impact on your Piwik install.**

- **Make sure your code doesn't rely on `register_globals` set to `On`. Note: PHP5 sets `register_globals` to `Off` by default.**

- **If your plugin has admin functionality (functionality only an administrator or the super user can use) then your plugin's Controller must extend [Piwik\Plugin\ControllerAdmin](/api-reference/Piwik/Plugin/ControllerAdmin).**

## Learn more

- To learn **more about security in web applications** read this article: [Top 10 Security from The Open Web Application Security Project (OWASP)](https://www.owasp.org/index.php/Top_10_2013-Table_of_Contents).
