---
category: Integrate
title: Tracking Opt-out
--- 
# Opt-Out

If you want to provide your visitors with the choice to opt-out of Matomo tracking rather than [asking for consent](/guides/tracking-consent) then Matomo
includes a built-in opt-out form that you can add to your website. 

This involves adding a small snippet of HTML/JavaScript to the appropriate pages on your site. This code can be generated from the Administration
=> Privacy => Users opt-out menu in the Matomo dashboard. The generated code can include custom CSS styles and optionally skip the introduction text.

The opt-out form code can be generated to work in two ways, either using the Matomo tracker code or as self-contained code, each option has advantages and 
disadvantages.

## Opt-out using the Matomo tracker code

Using this option the embedded opt-out form code will load Javascript from your Matomo instance, this JavaScript will then create the opt-out form in the designated 
`<div>` container. If the visitor opts in or out then the Matomo tracking code functions will be preferred to set the consent choice.

### Process

- The embedded website `<script>` tag requests  the `optOutJS` JavaScript from the Matomo instance, passing admin configuration options as URL parameters. 
- The Matomo instance translates all form text into the chosen language, or the browser language if `language=auto` is used, and returns the resulting JavaScript.
- The opt-out JavaScript executes when the `DOMContentLoaded` event is fired, indicating the page has finished loading.
- It checks that the specified opt-out form div exists on the page, and shows an error if not.
- It then waits for the Matomo Tracker code to become available.
  - If the Matomo tracker code is found then the opt-out form is created to use the Matomo tracker code to set consent.
  - If the Matomo Tracker code does not become available with the timeout period then the opt-out form will be created to set consent cookies directly.
- If cookies are disabled in the browser or the connection is not `HTTPS` then an error will be shown. 

### Customization 

The embedded opt-out form code to add to the website page is simple:

```
<div id="matomo-opt-out"></div>
<script src="https://my-matomo-site.org/index.php?module=CoreAdminHome&action=optOutJS&div=matomo-opt-out></script>\
```

The opt-out div may be positioned anywhere on the page and can have it's own styling. If the div is created dynamitcally then it must exist when the `DOMContentLoaded`
event is fired.

Opt-out form configuration options can be passed as URL parameters, the following options are available:

- `div` Specify the id of the div tag in which the opt-out form will be created.
- `language` Override the language used to display the opt-out form text, by default the value `auto` is used which will automatically determine the language to use 
based on the browser. To force a particular language pass language code such as 'de' or 'en'.
- `showIntro` Set to `1` if the opt-out form should include text explaining the opt-out choice, set to `0` if the form should just show the checkbox.
- `useCookiesIfNoTracker` Fall back to setting consent cookies directly if the Matomo tracking code cannot be found on the page, defaults to `1`. If this is set to `0` 
and the Matomo tracking code cannot be found then the opt-out form will not be shown.
- `useCookiesTimeout` How long to wait for the Matomo tracking code to become available before giving up and setting consent cookies directly, defaults to 10 seconds.

Only used if applying a custom style:
- `backgroundColor` The background colour to apply to the opt-out form div.
- `fontColor` Colour of the font, eg. `#ABCDEF`
- `fontSize` Font size in pixels.
- `fontFamily` Font family name, eg. `Arial`
    
### Advantages

- Language translations are done server side.
- The embed code is small and simple.
- The opt-out JavaScript is served by the Matomo instance, so any future updates to this script will automatically be applied without needing to update the website embed code.
- Uses the Matomo tracker code to set the opt-out consent. 

### Disadvantages

- Loading the opt-out JavaScript remotely from the Matomo instance may be blocked by browser plugins or adblockers, preventing the opt-out from being shown.

### When should I choose this opt-out form type?

When ease of deployment, maintenance and automatic language translation are more important than 100% visitor coverage.

## Opt-out using Self-contained code

Using this option the embedded opt-out form code will contain all the JavaScript necessary to show the opt-out form and set consent cookies directly. No remote script calls
will be made.

### Process

- The embedded website `<script>` tag contains around 110 lines of JavaScript.
- The script executes when the `DomCOntentLoaded` event is fired, indicating the page has finished loading.
- It checks that the specified opt-out form div exists on the page, if not then an error is shown.
- The opt-out form is created to set consent cookies directly.
- If cookies are disabled in the browser or the connection is not `HTTPS` then an error will be shown.

### Customization

The embedded opt-out form code to add to the website page is quite long. Customizable options are in the first few lines: 

```
<div id="matomo-opt-out"></div>
<script>
     var settings = {"showIntro":true,"divId":"matomo-opt-out","cookiePath":"","cookieDomain":"","cookieSameSite":"Lax","OptOutComplete":"Opt-out complete","snip":"snip"};
     
     ... other JavaScript code removed for clarity ...
     
<script>               
```

Just like other opt-out form type, the opt-out div may be positioned anywhere on the page and can have it's own styling. If the div is created dynamitcally then it must
exist when the `DOMContentLoaded` event is fired.

The third line of code contains an array of settings which may be used to configure the self-contained opt-out form. 

- `divId` Specify the id of the div tag in which the opt-out form will be created.
- `showIntro` Set to `1` if the opt-out form should include text explaining the opt-out choice, set to `0` if the form should just show the checkbox.
- `cookiePath` Override the default path for Matomo setting consent cookies, should be blank for most websites.
- `cookieDomain` Override the default domain for Matomo setting consent cookies, should be blank for most websites.
- `cookieSameSite` Defaults to setting Matomo constent cookies same-site attribute as `Lax`, some sites may want to set this to `strict` if the Matomo instance is hosted on 
the same domain as the website.

Since the self-contained opt-out code does not make any requests to the Matomo instance, dynamic translation of text strings is not possible. When generating the 
self-containted embedded code from the Matomo administration UI a target language can be chosen and the appropriate translations are included in the settings array.

Translation strings:

- `OptOutComplete`
- `OptOutCompleteBis`
- `YouMayOptOut2`
- `YouMayOptOut3`
- `OptOutErrorNoCookies`
- `OptOutErrorNotHttps`
- `YouAreNotOptedOut`
- `UncheckToOptOut`
- `YouAreOptedOut`
- `CheckToOptIn`

   
### Advantages

- Unlikely to be blocked by browser plugins or ad blockers, since all code is served from the website domain and there are no remote scripts or resources.
- Easy to directly customize the opt-out form language.

### Disadvantages

- Embed code is not small.
- Only supports a single language translation.
- Any future changes to the JavaScript code would need to be updated manually each webpage embedding opt-out form. 

### When should I choose this opt-out form type?

When the opt-out must work for visitors who block third party scripts and domains.

## Legacy iFrame Opt-out

Prior to version 4.12 Matomo provided the option to generate embed code for an iFrame based opt-out form. This has now been removed as it relied on setting third party
cookies which is no longer supported by major browsers. Although it is no longer possible to generate new iFrame embed code using the Matomo UI, the underlying `OptOut`
method is still fully supported and any existing iFrame opt-out form code embedded in websites will still work as before.

It is recommended to migrate to one of the new opt-out form options as browser support for the iFrame opt-out will continue to decrease.

## Creating a custom opt-out form

Wanting to build your own custom opt-out form instead using one of the provided opt-out options? Check out the guide for [creating a custom opt-out form](/guides/tracking-javascript-guide#optional-creating-a-custom-opt-out-form).
