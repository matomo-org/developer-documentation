---
category: Develop
title: System check
---
# Enriching the system check

Some plugins may only work when certain extra conditions are met, like having an unusual PHP extension installed or needing certain write permission on the file system. In these cases it is recommended to add new checks to the Matomo diagnostics system check which you can find by going to `Matomo Administration -> Diagnostic -> System Check`. 

## Types of system checks 

Matomo typically differentiates between three kind of checks:

### A required check

A new check can be useful if your plugin requires for example a certain PHP extension or other capabilities for the plugin to work. If a Matomo installation does not have the required capability, then the user will be able to find out about this problem and find help to fix this issue.

### An optional check.

An optional check can be useful if there's a way to improve the performance of your plugin, or if there are other optional or recommended changes that improve the experience.

### An informational check.

Adding an informational output is typically useful for the plugin developer themselves to troubleshoot issues. Such information can then be easily requested from the user when a bug report is made. The user can then provide this information by simply copy / pasting the system check.

Typical information could be version numbers of installed packages or information about stored data.

## Creating a new system check

To create a new system check, use the [console](/guides/piwik-on-the-command-line) to execute below command (requires Matomo 4.4.1):

```bash
./console generate:system-check
```

The command will ask for your plugin name and for the name of the system check you want to create. You should enter some meaningful name that describes the check well. For example, "JS Directory Write Permission Check".

Once all information is provided, a system check class will be created in the `Diagnostic` directory of your plugin containing an example on how to define a system check. In above example it would have created a file `Diagnostic/JsDirectoryWritePermissionCheck.php` within the chosen plugin.

### Making the new system check known to Matomo

Matomo won't discover your newly created system check automatically. You have to tell Matomo that it exists using the `config/config.php` file within your plugin. 

First you need to decide if your system check is of type required, optional or informational. Then you can register one or multiple checks like below:

```php
return [
    'diagnostics.required' => array(
        // adds a required system check
        DI\get('Piwik\Plugins\MyPluginName\Diagnostic\JsDirectoryWritePermissionCheck'),
    ),
    'diagnostics.optional' => array(
        // adds an optional system check
        DI\get('Piwik\Plugins\MyPluginName\Diagnostic\JsDirectoryWritePermissionCheck'),
    ),
    'diagnostics.informational' => array(
        // adds an informational system check
        DI\get('Piwik\Plugins\MyPluginName\Diagnostic\JsDirectoryWritePermissionCheck'),
    )
];
```

Your plugin can also provide multiple system checks of different types.

### Implementing a system check

To implement the actual check you need to edit the `execute` method within the diagnostic class. In the case of our example where we are checking if a specific directory is writable, this could look like this:

```php
public function execute()
{
    $result = [];

    $directoryToCheck = PIWIK_DOCUMENT_ROOT . '/js';
    
    if (!is_writable($directoryToCheck)) {
        $status = DiagnosticResult::STATUS_ERROR; 
        $comment = "The $directoryToCheck is not writable but it is required because ... To make this directory writable execute ...";
    } else {
        $status = DiagnosticResult::STATUS_OK;
        $comment = '';
    }
    
    $label = 'JS Direcotry Writable';
    $result[] = DiagnosticResult::singleResult($label, $status, $comment);

    return $result;
}
```

#### Statuses of system check

Each check can have one of four different statuses:

* **OK** (`DiagnosticResult::STATUS_OK`) - Everything is fine and the system passes the check.
* **Error** (`DiagnosticResult::STATUS_ERROR`) - There is an error which does need to be fixed. Typically used for a required check.
* **Warning** (`DiagnosticResult::STATUS_WARNING`) - There is a warning and it is optional to fix this. Typically used for an optional check.
* **Informational** (`DiagnosticResult::STATUS_INFORMATIONAL`) - Only provides information. Typically used for an informational check.

#### Multiple system checks within one class

You can check for different requirements in each diagnostic class and return multiple results by adding another result to the `$result` array. However, we don't recommend mixing required, optional and informational checks within one class.

### Implementing an informational result

Similarly, you can print informational output that helps you as a developer troubleshoot bug reports. For example, you can print the PHP version like this:

```php
public function execute()
{
    $result = [];

    $label = 'PHP Version';
    $comment = 'The PHP version is ' . PHP_VERSION;
    $result[] = DiagnosticResult::informationalResult($label, $comment);

    return $result;
}
```

### Good practices for system checks

* System checks should explain why something is needed and provide instructions to fix a certain issue. This can also be a URL to another page.
* Potential exceptions should be caught. The system check is critical to troubleshoot issues and if there is any kind of unhandled error then a user cannot access the needed information.

## Removing a system check

You can remove existing system checks from other plugins using the `config/config.php` within your plugin where you define any system check class that should be removed like this:

```php
return [
    'diagnostics.disabled' => array(
        DI\get('Piwik\Plugins\Diagnostics\Diagnostic\PhpVersionCheck'),
    ),
];
```

Above example would remove the PHP version check from the system report and afterwards the check will be no longer executed and neither be visible anywhere.
