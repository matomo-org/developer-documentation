---
category: Develop
title: API Methods
---
# Exposing API Methods

This guide explains how to expose new API methods in the [HTTP Reporting API](https://developer.matomo.org/api-reference/reporting-api) by creating an API module. The Reporting API allows third party applications to access analytics data and manipulate miscellaneous data (such as users or websites) through HTTP requests.

### What is it good for?

The Reporting API is used by the Matomo UI to render reports, to manage users, and more. If you want to add a feature to the Matomo UI, you might have to expose a method in the API to access this data. As the API is called via HTTP it allows you to fetch or manipulate any Matomo related data from anywhere. In these exposed API methods you can do basically anything you want, for example:

* Enhance existing reports with additional data
* Filter existing reports based on custom rules
* Access the database and generate custom reports
* Persist and read any data
* Request server information

## Adding a new API module

To create a new API, use the [Matomo Console](/guides/piwik-on-the-command-line):

```bash
./console generate:api
```

The command will ask you to enter the name of the plugin the created API should belong to. There should now be a file <code>plugins/MyPlugin/API.php</code> with simple examples to get you started:

```php
class API extends \Piwik\Plugin\API
{
    public function getAnswerToLife(bool $truth = true): int
    {
        if ($truth) {
            return 42;
        }

        return 24;
    }

    public function getExampleReport(string $idSite, string $period, string $date, bool $wonderful = false): DataTable
    {
        $table = DataTable::makeFromSimpleArray(array(
            array('label' => 'My Label 1', 'nb_visits' => '1'),
            array('label' => 'My Label 2', 'nb_visits' => '5'),
        ));

        return $table;
    }
}
```

Any public method in that file will be available via the Reporting API. For example the method <code>getAnswerToLife</code> can be called via this URL: <code>index.php?module=API&amp;method=MyApiPlugin.getAnswerToLife</code>. The URL parameter <code>method</code> is a combination of your plugin name and the method name within this class.

### Passing parameters to your method

Both example methods define some parameters. To pass any value to a parameter of your method simply specify them by name in the URL. For example <code>...&amp;method=MyApiPlugin.getExampleReport&amp;idSite=1&amp;period=week&amp;date=today&amp;wonderful=1</code> to pass values to the parameters of the method <code>getExampleReport</code>.

#### Type handling / Type hinting

It is possible to define type hints for parameters of API methods. If a parameter has a type hint our API request processor will automatically check if the provided value is compatible with expected type. If the type does not match, the API will return an according error message.

As parameters for API paramters are usually provided as URL or request parameters only the following type hints are supported: `string`, `int`, `float`, `bool`, `array`.
Boolish paramters will automatically be converted by matching against `0`, `'0'`, `'false'` and `1`, `'1'`, `'true'`

If your API method is able to handle multiple types for one parameter, you may define no type hint. The paramter will then either be passed as string or an array of strings (depending on the request parameter). It's required to validate and check the parameters value manually then.

#### Parameter sanitizing

### Returning a value

In an API method you can return any boolean, number, string or array value. A resource or an object cannot be returned unless it implements the DataTableInterface such as [DataTable](/api-reference/Piwik/DataTable) (the primary data structure used to store analytics data in Matomo), [DataTable\Map](/api-reference/Piwik/DataTable/Map) (stores a set of DataTables) and [DataTable\Simple](/api-reference/Piwik/DataTable/Simple) (a DataTable where every row has two columns: label and value).

Did you know? You can choose the response format of your API request by appending a parameter <code>&amp;format=JSON|XML|CSV|...</code> to the URL. Check out the [Reporting API Reference](/api-reference/reporting-api) for more information.

<div markdown="1" class="alert alert-warning">
**DataTable vs Array**

You might be wondering why not simply returning the array directly in the `getExampleReport` example? By wrapping it with a DataTable you will be able to use many features like `filter_offset`, `filter_limit`, `filter_sort_column`, `showColumns` and many more.
</div>

## Best practices

### Check user permissions

Do not forget to check whether a user actually has permissions to access data or to perform an action. If you're not familiar with Matomo's permissions and how to check them read our [User Permissions](/guides/permissions) guide.

### Keep API methods small

At Matomo we aim to write clean code. Therefore, we recommend to keep API methods small (separation of concerns). An API basically acts like a Controller:

```php
public function createLdapUser(int $idSite, string $login, string $password)
{
    Piwik::checkUserHasAdminAccess($idSite);
    $this->checkLogin($login);
    $this->checkPassword($password);

    $myModel = new LdapModel();
    $success = $myModel->createUser($idSite, $login, $password);

    return $success;
}
```

This is not only easy to read, it will also allow you to create simple tests for <code>LdapModel</code> (without having to bootstrap the whole Matomo layer) and you will be able to reuse it in other places if needed.

### Calling other plugins' APIs

For example you want to fetch an existing report from another plugin - say a list of all Page URLs, do not request this report by calling that method directly: <code class="php">\Piwik\Plugins\Actions\API::getInstance()->getPageUrls($idSite, $period, $date);</code>. Instead, issue a new API request:

```php
$report = \Piwik\API\Request::processRequest('Actions.getPageUrls', array(
    'idSite' => $idSite,
    'period' => $period,
    'date'   => $date,
));
```

This has several advantages:

* It avoids a fatal error if the requested plugin is not available on a Matomo installation
* Other plugins can extend the called API method via [events](/guides/events) (adding additional report data to a report, doing additional permission checks) but those events will be only triggered when requesting the report as suggested
* If the method signature changes, your request will most likely still work
