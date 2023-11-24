---
category: API Reference
---

# Java Tracker

The Matomo Java Tracker is a comprehensive Java library designed for sending tracking data to Matomo servers.
It is compatible with Java 1.8 and later versions. Whether you're working with Java web applications, desktop
applications, command line applications, batch applications, microservices, or other Java-based projects,
the Matomo Java Tracker has you covered.

It differs from the JavaScript Tracker API due to the unique characteristics of Java applications. This library offers
robust support for both synchronous and asynchronous tracking. It facilitates the tracking of custom dimensions, custom
variables, custom events, content, ecommerce activities, goals, site searches, campaign efforts, and more.

For detailed API documentation, refer to the [JavaDoc](https://javadoc.io/doc/org.piwik.java.tracking/matomo-java-tracker-core/latest/index.html).
This documentation provides a swift and informative overview of the essential classes and methods within the library.

If you encounter any challenges or have inquiries, feel free to [create an issue](https://github.com/matomo-org/matomo-java-tracker/issues/new) in
the [Matomo Java Tracker repository](https://github.com/matomo-org/matomo-java-tracker). Our team is dedicated to
assisting you promptly and ensuring a smooth experience with the Matomo Java Tracker.

## Adding the dependency

To integrate the Matomo Java Tracker into your Java application, you must include the necessary dependency in your
project. The library can be easily obtained from Maven Central:

```xml
<dependency>
   <groupId>org.piwik.java.tracking</groupId>
   <artifactId>matomo-java-tracker</artifactId>
   <version>3.x.x</version>
</dependency>
```

Gradle users add the following dependency to their `build.gradle` file:

```groovy
implementation 'org.piwik.java.tracking:matomo-java-tracker:3.x.x'
```

## TrackerConfiguration

The class `TrackerConfiguration` configures the tracker and can be built in a fluent way. See the configuration
properties in the [JavaDoc of TrackerConfiguration](https://javadoc.io/doc/org.piwik.java.tracking/matomo-java-tracker-core/latest/org/matomo/java/tracking/TrackerConfiguration.html).

To create a tracker configuration fluently you can use the `TrackerConfiguration.builder()` method:

```java
TrackerConfiguration configuration = TrackerConfiguration.builder()
        .apiEndpoint(URI.create("https://your-domain.net/matomo/matomo.php"))
        .defaultSiteId(42) // if not explicitly specified by the request
        .build();
```

In this example the tracker will send the tracking requests to the Matomo server at `https://your-domain.net/matomo/matomo.php`
and use the site id `42`. The tracker will use the default values for all other configuration properties.

## MatomoTracker

The class [`MatomoTracker`](https://javadoc.io/doc/org.piwik.java.tracking/matomo-java-tracker-core/latest/org/matomo/java/tracking/MatomoTracker.html)
is the main class to use for sending tracking requests. It contains methods to send tracking requests synchronously and
asynchronously.

```java
MatomoTracker tracker = new MatomoTracker(configuration);
        tracker.sendBulkRequestAsync(requests);
```

In this example, the tracker executes an asynchronous bulk request, enabling the concurrent transmission of requests in
the background while promptly returning control. The configuration specified in the constructor guides the tracker in
utilizing HTTP POST to dispatch the requests seamlessly.

Avoid creating a new `MatomoTracker` for each tracking request, as it is thread-safe and stateless. Create it once and
reuse it for multiple tracking requests.

We recommend to use the method `MatomoTracker.sendBulkRequestAsync(Collection<MatomoRequest>)` to send tracking requests
asynchronously. If you want to send requests synchronously, you can use the method `MatomoTracker.sendBulkRequest(Collection<MatomoRequest>)`.
Both methods will send the requests in a single HTTP request. If you want to send the requests in multiple HTTP GET requests, you can use the
method `MatomoTracker.sendRequest(MatomoRequest)` or `MatomoTracker.sendRequestAsync(MatomoRequest)` to send a single
request.

## MatomoRequest

The class `MatomoRequest` represents a single tracking request. It is the main class to use when collecting data. It
contains methods to set all parameters of a Matomo tracking request. The following example shows how to create a new
Matomo tracking request fluently:

```java
MatomoRequest request = MatomoRequest.request().url("https://example.com").actionName("My Action").build();
```

Nevertheless we strongly recommend you to use one of the methods of the
class [`MatomoRequests`](https://javadoc.io/doc/org.piwik.java.tracking/matomo-java-tracker-core/latest/org/matomo/java/tracking/MatomoRequests.html)
to track:

1. **action(@NonNull String url, @NonNull ActionType type):** Creates a `MatomoRequest` object for a download or a link action.
2. **contentImpression(@NonNull String name, String piece, String target):** Creates a `MatomoRequest` object for a content impression.
3. **contentInteraction(@NonNull String interaction, @NonNull String name, String piece, String target):** Creates a `MatomoRequest` object for a content interaction.
4. **crash(@NonNull String message, String type, String category, String stackTrace, String location, Integer line,
   Integer column):** Creates a `MatomoRequest` object for a crash with specified details.
5. **crash(@NonNull Throwable throwable, String category):** Creates a `MatomoRequest` object for a crash with information extracted from a `Throwable` object.
6. **ecommerceCartUpdate(@NonNull Double revenue):** Creates a `MatomoRequest` object for an ecommerce cart update (add item, remove item, update item).
7. **ecommerceOrder(@NonNull String id, @NonNull Double revenue, Double subtotal, Double tax, Double shippingCost,
   Double discount):** Creates a `MatomoRequest` object for an ecommerce order.
8. **event(@NonNull String category, @NonNull String action, String name, Double value):** Creates a `MatomoRequest` object for an event.
9. **goal(int id, Double revenue):** Creates a `MatomoRequest` object for a conversion of a goal on the website.
10. **pageView(@NonNull String name):** Creates a `MatomoRequest` object for a page view.
11. **ping():** Creates a `MatomoRequest` object for a ping.
12. **siteSearch(@NonNull String query, String category, Long resultsCount):** Creates a `MatomoRequest` object for a search.

Example:

```java
MatomoRequest request = MatomoRequests.pageView("My Page").build();
```



Search results count requires a search query. The visitor location parameters (like longitude, latitude, city, country,
etc.) require an authentication token.

Here is a complete example that shows how to create a tracker configuration, instantiate a tracker and send a request:

```java
// Create the tracker configuration
TrackerConfiguration configuration = TrackerConfiguration.builder()
        .apiEndpoint(URI.create("https://your-domain.net/matomo/matomo.php"))
        .defaultSiteId(42) // if not explicitly specified by action
        .build();

// Prepare the tracker (stateless - can be used for multiple requests)
MatomoTracker tracker = new MatomoTracker(configuration);

MatomoRequest request = MatomoRequests
  .event("Training","Workout completed","Bench press",60.0)
  .visitorId(VisitorId.fromString("some@email-adress.org"))
  // ...
  .build();

// Send the request asynchronously (non-blocking) as an HTTP POST request (payload is JSON and contains the
// tracking parameters)
tracker.sendBulkRequestAsync(request);
```

This example configures the tracker to send the tracking requests to the Matomo server at `https://example.com/matomo.php` and
use the site id `42`. The tracker will use the default values for all other configuration properties. The request sets the action
name and action URL. It also sets a custom visitor id.
The tracker will send the request asynchronously and return immediately. The tracker will use the configuration set in
the constructor to send the requests via HTTP POST. Using the method `CompletableFuture.join()` you can wait for the request to
be sent. If the request fails, the method will throw an unchecked exception.

## Authentication Token

The `token_auth` parameter contains the authentication token of the Matomo user. Some parameters require it. The
authorization key can be found in the Matomo user interface under "Administration" -> "Personal" -> "Security" -> "Auth
tokens"

Using the Matomo Java Tracker are three different ways to set the authentication token:

1. Set the authentication token globally in the tracker configuration. The authentication token will be used for all
   tracking requests. The authorization key can be set using the
   method `TrackerConfiguration.builder().defaultTokenAuth(String)`.

2. Set the authentication token in the tracking request. The authentication token will be used for this tracking request
   only. The authorization key can be set using the method `MatomoRequest.request().authToken(String)`.

3. (Deprecated) Call a send method of the tracker with the authentication token as a parameter. The authentication token
   will be used for this tracking request only. Since this method is redundant, it is deprecated and will be removed in
   a future version. It has the same effect than setting it in the request. Set it in the request or globally instead.

The tracker uses primarily the authentication set via method parameter, then the authentication set in the request, and
finally the authentication set in the tracker configuration. If no authentication token is set, the tracker won't set
the parameter `token_auth` in the tracking request. This can lead to problems if you use parameters that require an
authentication token. In this case, the tracker will throw an exception on sending the request.

Ensure that the token is transmitted securely, for example, using HTTPS.

## Visitor ID

The VisitorId class in your project is a utility class that provides methods to create a unique visitor ID for tracking
purposes in Matomo. Here's how you can use it:

1. **Create a visitor ID from a hash**: If you have a hash (for example, a hash code of a username), you can use the
   `fromHash` method to create a visitor ID. This method always creates the same visitor ID for the same hash.
   ```java
   VisitorId visitorIdFromHash = VisitorId.fromHash(2389472398L);
   ```
2. **Create a visitor ID from a UUID**: If you have a UUID, you can use the `fromUUID` method to create a visitor ID.
   This method uses the most significant bits of the UUID to create the visitor ID.
   ```java
   VisitorId visitorIdFromUUID = VisitorId.fromUUID(UUID.fromString("53e213f2-9a16-4e42-ac6f-5c8637db9fb0"));
   ```
3. **Create a visitor ID from a hexadecimal string**: If you have a hexadecimal string, you can use the `fromHex` method
   to create a visitor ID. The input string must be a valid hexadecimal string with a maximum length of 16 characters.
   ```java
   VisitorId visitorIdFromHex = VisitorId.fromHex("0815badeaffe");
   ```
4. **Create a visitor ID from a string**: If you have a string, you can use the `fromString` method to create a visitor ID.
   This method hashes the string to create the visitor ID.
   ```java
   VisitorId visitorIdFromHex = VisitorId.fromString("alice");
   ```

## Custom Tracking Parameters

You can also set additional custom request parameters using the
method `MatomoRequest.request().additionalParameters(Map<String, Object>)`. The additional parameters will
be added to the request URL as query parameters. The query parameter name will be the key of the map entry and the query
parameter value will be the value of the map entry. Note: If you set any parameter that is not supported by the Matomo
tracking API, the parameter will be ignored by Matomo, although it will be added to the request URL.

To see which parameters are available, have a look at
the [JavaDoc of MatomoRequest](https://javadoc.io/doc/org.piwik.java.tracking/matomo-java-tracker-core/latest/org/matomo/java/tracking/MatomoRequest.html)
and the [Matomo Tracking API Reference](https://developer.matomo.org/api-reference/tracking-api) for your Matomo
version.

## Ecommerce Items

Matomo supports ecommerce tracking, i.e., tracking of ecommerce actions like adding items to the cart, removing items
from the cart, and purchasing items.

Ecommerce items can be added to a request using the method `MatomoRequest.request().ecommerceItems(EcommerceItems)`. The
items will be added to the request URL as a JSON representation in the `ec_items` query parameter. The JSON
representation is an array of JSON objects. Each JSON object represents an ecommerce item.

To create an ecommerce items object, you can use the builder `EcommerceItems.builder()`:

```java
MatomoRequests
        .ecommerceCartUpdate(50.0)
        .ecommerceItems(EcommerceItems
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

Matomo supports custom variables. Custom variables are key-value pairs that can be used to track additional information
about the visitor. Custom variables can be set in the request using the
method `MatomoRequest.request().visitCustomVariables(CustomVariables)`. The custom variables will be added to the
request URL as a JSON representation in the `cvar` query parameter. The JSON representation is an array of JSON objects.
Each JSON object represents a custom variable.

To create a custom variables object use the constructor `new CustomVariables()` and add custom variables using the
method `CustomVariables.add(String, String)`:

```java
CustomVariables customVariables = new CustomVariables()
        .add(new CustomVariable("Type", "Customer"), 1)
        .add(new CustomVariable("Status", "Logged In"), 3);
```

The first parameter contains the custom variable consisting of the key and the value. The second parameter contains the
index of the custom variable. The index is used to identify the variable in the Matomo user interface. You can find the
custom variables in the Matomo user interface under "Visitors" -> "Custom Variables". The index is the number in the URL
of the custom variables page.

The class `MatomoRequest` has two different custom variables attributes: `visitCustomVariables`
and `pageCustomVariables`. The `visitCustomVariables` attribute contains the custom variables for the visit.
The `pageCustomVariables` attribute contains the custom variables for the page. The difference is that
the `visitCustomVariables` attribute is set in the visit scope and the `pageCustomVariables` attribute is set in the
page scope. The visit scope means that the custom variables are valid for the whole visit. The page scope means that the
custom variables are valid for the current page only.

## Servlet Functionality

The Matomo Java Tracker provides functionality to track HTTP requests in servlets. It supports both the Jakarta and
Javax servlet API.

The `JakartaHttpServletWrapper` class is a utility class that provides a method to convert a Jakarta `HttpServletRequest`
into a `HttpServletRequestWrapper`. To integrate the JakartaHttpServletWrapper in your controller class, you need to use
it within a method that handles HTTP requests. Here's an example of how you can do this in a Spring controller:

```java
import jakarta.servlet.http.HttpServletRequest;
import org.matomo.java.tracking.MatomoRequest;
import org.matomo.java.tracking.MatomoTracker;
import org.matomo.java.tracking.servlet.HttpServletRequestWrapper;
import org.matomo.java.tracking.servlet.JakartaHttpServletWrapper;
import org.matomo.java.tracking.servlet.ServletMatomoRequest;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class MyController {

   private final MatomoTracker matomoTracker;

   // Injected by your dependency injection framework
   public MyController(MatomoTracker matomoTracker) {
      this.matomoTracker = matomoTracker;
   }

   @GetMapping("/my-endpoint")
   public void handleRequest(HttpServletRequest request) {
      // send the request to the Matomo server
      matomoTracker.sendRequest(
              ServletMatomoRequest.fromServletRequest(
                      JakartaHttpServletWrapper.fromHttpServletRequest(request))
                      // add more request parameters if needed
                      .build()
      );
   }
}
```

Alternatively, if you already have a `MatomoRequestBuilder` and you want to add the headers from the `HttpServletRequestWrapper`
to it, you can use the `addServletRequestHeaders` method.

```java
ServletMatomoRequest.addServletRequestHeaders(MatomoRequest.builder().actionName("action"), requestWrapper);
```

## Spring Boot Starter

The Matomo Java Tracker Spring Boot Starter is a Maven artifact that provides Spring Boot integration for the Matomo
Java Tracker. It is designed to make it easier to use the Matomo Java Tracker in a Spring Boot application. It likely provides
auto-configuration for the Matomo Java Tracker and possibly some additional Spring-specific integration features.

By including this artifact in your project, you can take advantage of Spring Boot's auto-configuration features to
automatically set up and configure the Matomo Java Tracker, reducing the amount of manual configuration you need to do.

To integrate the Matomo Java Tracker Spring Boot Starter into your Spring application, you need to add it as a dependency
in your Maven `pom.xml` file. Here is an example of how to add it:

```xml
<dependencies>
    <!-- other dependencies -->

    <dependency>
        <groupId>org.piwik.java.tracking</groupId>
        <artifactId>matomo-java-tracker-spring-boot-starter</artifactId>
        <version>3.x.x</version> <!-- replace with your desired version -->
    </dependency>
</dependencies>
```

Once the dependency is added, you can use the features provided by the matomo-java-tracker-spring-boot-starter in your
Spring Boot application.
