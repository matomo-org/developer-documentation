---
category: API Reference
---
# Java Tracker

The Matomo Java Tracker is a Java library to send tracking data to Matomo servers. It is compatible with Java 1.8 and above. You can use it to track data from any Java application, including Java web applications, Java desktop applications, Java command line applications, Java batch applications, Java microservices and more.

Due to the nature of Java applications, the API is different from the JavaScript Tracker API. Nevertheless it supports synchronous and asynchronous tracking, custom dimensions, custom variables, custom events, content tracking, ecommerce tracking, goal tracking, site search tracking, campaign tracking, and more.

The primary source to look for an API documentation is the [JavaDoc](https://matomo-org.github.io/matomo-java-tracker/javadoc/index.html). This guide provides a quick overview of the most important classes and methods of the library.

If you experience any problems or have any questions, please [create an issue](https://github.com/matomo-org/matomo-java-tracker/issues/new) in the [Matomo Java Tracker repository](https://github.com/matomo-org/matomo-java-tracker). We are happy to help you.

## Adding the dependency

To use the Matomo Java Tracker in your Java application, you need to add the dependency to your project. The library is available on Maven Central:

```xml
<dependency>
    <groupId>org.piwik.java.tracking</groupId>
    <artifactId>matomo-java-tracker</artifactId>
    <version>3.0.0</version>
</dependency>
```

Gradle users add the following dependency to their `build.gradle` file:

```groovy
implementation 'org.piwik.java.tracking:matomo-java-tracker:3.0.0'
```

## TrackerConfiguration

The class `TrackerConfiguration` configures the tracker and can be built in a fluent way. See the configuration properties in the [JavaDoc of TrackerConfiguration](https://matomo-org.github.io/matomo-java-tracker/javadoc/org/matomo/java/tracking/TrackerConfiguration.html).

To create a tracker configuration fluently you can use the `TrackerConfiguration.builder()` method:

```java
TrackerConfiguration configuration = TrackerConfiguration.builder()
    .apiEndpoint(URI.create("https://your-domain.net/matomo/matomo.php"))
    .defaultSiteId(42) // if not explicitly specified by the request
    .build();
```

In this example the tracker will send the tracking requests to the Matomo server at `https://your-domain.net/matomo/matomo.php` and use the site id `42`. The tracker will use the default values for all other configuration properties.

## MatomoTracker

The class `MatomoTracker` is the main class to use when sending tracking requests. It contains methods to send tracking requests synchronously and asynchronously.

```java
MatomoTracker tracker = new MatomoTracker(configuration);
tracker.sendBulkRequestAsync(requests);
```

In this example the tracker sends a bulk request asynchronously. The tracker will send the requests in the background and return immediately. The tracker will use the configuration set in the constructor to send the requests via HTTP POST.

We recommend to use the method `MatomoTracker.sendBulkRequestAsync(Collection<MatomoRequest>)` to send tracking requests asynchronously. If you want to send requests synchronously, you can use the method `MatomoTracker.sendBulkRequest(Collection<MatomoRequest>)`. Both methods will send the requests in a single HTTP request. If you want to send the requests in multiple HTTP GET requests, you can use the method `MatomoTracker.sendRequest(MatomoRequest)` or `MatomoTracker.sendRequestAsync(MatomoRequest)` to send a single request.

## MatomoRequest

The class `MatomoRequest` represents a single tracking request. It is the main class to use when collecting data. It contains methods to set all parameters of a Matomo tracking request. The following example shows how to create a new Matomo tracking request fluently:

```java
MatomoRequest request = MatomoRequest.request()
    .url("https://example.com")
    .actionName("My Action")
    .build();
```

Please mind that the ecommerce parameters can only be set if a goal id is also set. Search results count requires a search query. The visitor location parameters (like longitude, latitude, city, country, etc.) require an authentication token.

Here is complete example that shows how to create a tracker configuration, instantiate a tracker and send a request:

```java
// Create the tracker configuration
TrackerConfiguration configuration = TrackerConfiguration.builder()
    .apiEndpoint(URI.create("https://your-domain.net/matomo/matomo.php"))
    .defaultSiteId(42) // if not explicitly specified by action
    .build();

// Prepare the tracker (stateless - can be used for multiple requests)
MatomoTracker tracker = new MatomoTracker(configuration);

MatomoRequest request = MatomoRequest
    .builder()
    .actionName("User Profile / Upload Profile Picture")
    .actionUrl("https://your-domain.net/user/profile/picture")
    .visitorId(VisitorId.fromString("some@email-adress.org"))
    // ...
    .build();

// Send the request asynchronously (non-blocking) as an HTTP POST request (payload is JSON and contains the
// tracking parameters)
CompletableFuture<Void> future = tracker.sendBulkRequestAsync(request);

// If you want to ensure the request was sent without exceptions (not necessarily needed)
future.join(); // throws an unchecked exception if the request failed
```

This example configures the tracker to send the tracking requests to the Matomo server at `https://example.com/matomo.php` and use the site id `42`. The tracker will use the default values for all other configuration properties. The request sets the action name and action URL. It also sets a custom visitor id. The tracker will send the request asynchronously and return immediately. The tracker will use the configuration set in the constructor to send the requests via HTTP POST. Using the method `CompletableFuture.join()` you can wait for the request to be sent. If the request fails, the method will throw an unchecked exception.

## Authentikation Token

The parameter `token_auth` contains the authentication token of the Matomo user. Some parameters require it. The authorization key can be found in the Matomo user interface under "Administration" -> "Personal" -> "Security" -> "Auth tokens"

Using the Matomo Java Tracker are three different ways to set the authentication token:

1. Set the authentication token globally in the tracker configuration. The authentication token will be used for all tracking requests. The authorization key can be set using the method `TrackerConfiguration.builder().defaultTokenAuth(String)`.

2. Set the authentication token in the tracking request. The authentication token will be used for this tracking request only. The authorization key can be set using the method `MatomoRequest.request().authToken(String)`.

3. (Deprecated) Call a send method of the tracker with the authentication token as a parameter. The authentication token will be used for this tracking request only. Since this method is redundant, it is deprecated and will be removed in a future version. It has the same effect than setting it in the request. Set it in the request or globally instead.

The tracker uses primarily the authentication set via method parameter, then the authentication set in the request, and finally the authentication set in the tracker configuration. If no authentication token is set, the tracker won't set the parameter `token_auth` in the tracking request. This can lead to problems if you use parameters that require an authentication token. In this case, the tracker will throw an exception on sending the request.

Please mind that the token should be transmitted securely, for example using HTTPS. 

## Custom Tracking Parameters

You can also set additional custom request parameters using the method `MatomoRequest.request().additionalParameters(Map<String, Collection<Object>>)`. The additional parameters will be added to the request URL as query parameters. The query parameter name will be the key of the map entry and the query parameter value will be the value of the map entry. To add the same query parameter name with multiple values, you can use a collection as the parameter value, e.g. `additionalParameters(Map.of("foo", List.of("bar", "baz")))` will add the query parameters `?foo=bar&foo=baz` to the request URL (note that the order of the query parameters is not guaranteed). Note: If you set any parameter that is not supported by the Matomo tracking API, the parameter will be ignored by Matomo, although it will be added to the request URL.

To see which parameters are available, have a look at the [JavaDoc of MatomoRequest](https://matomo-org.github.io/matomo-java-tracker/javadoc/org/matomo/java/tracking/MatomoRequest.html) and the [Matomo Tracking API Reference](https://developer.matomo.org/api-reference/tracking-api) for your Matomo version.

## Ecommerce Items

Matomo supports ecommerce tracking, i.e. tracking of ecommerce actions like adding items to the cart, removing items from the cart, and purchasing items. Every ecommerce action can be tracked as a goal. To track ecommerce actions, you need to set a goal id in the request. You can set the goal id using the method `MatomoRequest.request().goalId(int)`. The goal id is the id of the goal in Matomo. You can find the goal id in the Matomo user interface under "Administration" -> "Websites" -> "Goals". The goal id is the number in the URL of the edit page.

Ecommerce items can be added to a request using the method `MatomoRequest.request().ecommerceItems(EcommerceItems)`. The items will be added to the request URL as a JSON representation in the query parameter `ec_items`. The JSON representation is an array of JSON objects. Each JSON object represents an ecommerce item. Ecommerce items are only supported if a goal id is set in the request. If you set ecommerce items without a goal id, the items will be ignored by Matomo.

To create an ecommerce items object, you can use the builder `EcommerceItems.builder()`:

```java
EcommerceItems ecommerceItems = EcommerceItems
    .builder()
    .item(EcommerceItem
        .builder()
        .sku("XYZ12345")
        .name("Matomo - The big book about web analytics")
        .category("Education & Teaching")
        .price(23.1)
        .quantity(2)
        .build())
    .item(EcommerceItem
        .builder()
        .sku("B0C2WV3MRJ")
        .name("Matomo for data visualization")
        .category("Education & Teaching")
        .price(15.0)
        .quantity(1)
        .build())
    .build();
```

## Custom Variables

Matomo supports custom variables. Custom variables are key-value pairs that can be used to track additional information about the visitor. Custom variables can be set in the request using the method `MatomoRequest.request().visitCustomVariables(CustomVariables)`. The custom variables will be added to the request URL as a JSON representation in the query parameter `cvar`. The JSON representation is an array of JSON objects. Each JSON object represents a custom variable.

To create a custom variables object use the constructor `new CustomVariables()` and add custom variables using the method `CustomVariables.add(String, String)`:

```java
CustomVariables customVariables = new CustomVariables()
    .add(new CustomVariable("Type", "Customer"), 1)
    .add(new CustomVariable("Status", "Logged In"), 3);
```

The first parameter contains the custom variable consisting of the key and the value. The second parameter contains the index of the custom variable. The index is used to identify the variable in the Matomo user interface. You can find the custom variables in the Matomo user interface under "Visitors" -> "Custom Variables". The index is the number in the URL of the custom variables page.

The class `MatomoRequest` has two different custom variables attributes: `visitCustomVariables` and `pageCustomVariables`. The `visitCustomVariables` attribute contains the custom variables for the visit. The `pageCustomVariables` attribute contains the custom variables for the page. The difference is that the `visitCustomVariables` attribute is set in the visit scope and the `pageCustomVariables` attribute is set in the page scope. The visit scope means that the custom variables are valid for the whole visit. The page scope means that the custom variables are valid for the current page only.