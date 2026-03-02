---
category: Develop
---
# Dimensions

Dimensions provide the possibility to extend the tracker to easily record any custom data. Before recording any custom data you have to decide what kind of dimension you need:

* A visit dimension lets you record any visitor related data. A typical dimension would be for example the name of the browser or the resolution of the device a visitor is using.
* An action dimension lets you track any action related data. For example a pageview, a download or an event.
* A conversion dimension lets you persist any additional information when a goal is converted.

## Creating a new dimension

To create a new dimension, use the console:

```bash
./console generate:dimension
```

The command will ask for your plugin name and what kind of dimension you'd like to create. You can choose between `visit`, `action` and `conversion`. Next it will ask you for the name of the dimension (eg 'Browsername'), for the MySQL database column name (eg `browser_name`) and column type (eg `VARCHAR(255) NOT NULL`).

Once all information is provided, a dimension class will be created in the `Columns` directory of your plugin containing an example on how to define which data should be tracked. The dimension will be automatically installed as soon as you open the Piwik UI.

## Visit dimensions

Let's assume you want to add a new tracking URL parameter `sport_activity_type` that lets you track the type of sport activity (eg running, cycling, ...). You can do this by implementing the method `onNewVisit`:

```php
public function onNewVisit(Request $request, Visitor $visitor, $action)
{
	return Common::getRequestVar('sport_activity_type', $default = false, 'string', $request->getParams());
}
```

Whenever you send a `sport_activity_type` parameter with any tracking request and the tracker detected a new visitor, this information will be recorded in the database and can be used to create new reports or to extend existing reports and API methods. An example tracking URL could look like this `matomo.php?idsite=1&sport_activity_type=running`

Optionally, you can overwrite any initial value that was written when a new visit was detected by implementing the method `onExistingVisit`. You can use this for example for counters, to store the time of the last action etc:

```php
public function onNewVisit(Request $request, Visitor $visitor, $action)
{
    return 1;
}

public function onExistingVisit(Request $request, Visitor $visitor, $action)
{
    return $visitor->getVisitorColumn($this->column_name) + 1;
}
```

When a new visitor is being tracked, the value `1` will be stored. On each further tracking request the value for this dimension will be increased.


## Action dimensions

Action dimensions work similarly, just the method name is different. Let's say you want to track the current speed of a runner by exposing a new URL parameter `speed`:

```php
public function onNewAction(Request $request, Visitor $visitor, Action $action)
{
    $value = Common::getRequestVar('speed', false, 'string', $request->getParams());

    $isRunner = 'running' === $visitor->getVisitorColumn('sport_activity_type');

    if ($isRunner && is_numeric($value)) {
        // only store the value if it is a runner and if speed is numeric
        return $value;
    }

    return false; // do not store any value for this action
}
```

A tracking request could be done like this: `matomo.php?idsite=1&sport_activity_type=running&speed=50`.

Of course, you can add any custom behaviour like limiting the max speed etc.

## Segmentation
Since Piwik 3.2.0 A new segment is automatically created for a dimension when you define a `$segmentName` property. It is also recommended adjusting the description of the accepted values.

## Learn more
Dimensions are quite powerful. For example, you can change the behavior of an existing dimension by creating a dimension that has the same column name, you can store action related data efficiently by using a lookup table. Dimensions can also force the creation of a new visit in case an existing visitor was recognized. We recommend having a look at the documentation within a created dimension and at the API-Reference of the classes [VisitDimension](/api-reference/Piwik/Plugin/Dimension/VisitDimension), [ActionDimension](/api-reference/Piwik/Plugin/Dimension/ActionDimension) and [ConversionDimension](/api-reference/Piwik/Plugin/Dimension/ConversionDimension)
