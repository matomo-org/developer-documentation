---
category: Integrate
title: Tracking & Cookie Consent
--- 
# Implementing tracking or cookie consent with the Matomo JavaScript Tracking Client

In the context of the [GDPR privacy regulations](https://matomo.org/faq/new-to-piwik/what-is-gdpr/), when you are processing personal data, in some cases you will need to ask for your users' consent. To identify whether you need to ask for any consent, you need to determine whether your lawful basis for processing personal data is "Consent" or "Legitimate interest", or whether you can avoid collecting personal data altogether. We recommend learning more about the [lawful basis under the GDPR for Matomo](https://matomo.org/blog/2018/04/lawful-basis-for-processing-personal-data-under-gdpr-with-matomo/). 

Matomo differentiates between tracking and cookie consent:

* **Tracking consent:** no cookies will be used and no tracking request will be sent unless consent was given. As soon as consent was given, tracking requests will be sent and cookies will be used. 
* **Cookie consent:** tracking requests will be always sent. However, cookies will be only used if consent for storing and using cookies was given by the user. [Learn how cookies impact reports accuracy](https://matomo.org/faq/general/faq_156/).
           
Matomo has guides available for setting up consent tracking with the following popular consent managers:
- [Osano Consent Manager](https://matomo.org/faq/how-to/using-osano-consent-manager-with-matomo/)
- [Cookiebot Consent Manager](https://matomo.org/faq/how-to/using-cookiebot-consent-manager-with-matomo/)
- [CookieYes Consent Manager](https://matomo.org/faq/how-to/using-cookieyes-consent-manager-with-matomo/)
- [Tarte au Citron Consent Manager](https://matomo.org/faq/how-to/using-tarte-au-citron-consent-manager-with-matomo/)
- [Klaro Consent Manager](https://matomo.org/faq/how-to/using-klaro-consent-manager-with-matomo/)
- [Complianz for WordPress Consent Manager](https://matomo.org/faq/how-to/using-complianz-for-wordpress-consent-manager-with-matomo/)

If you're not using one of these consent managers, you can follow the steps below to ask your users for tracking and cookie consent before their data is processed within Matomo.

## Step 1: require consent

To require consent, insert the following line at top of your existing Matomo Tracking code on all your pages:

```js
// require user tracking consent before processing data
_paq.push(['requireConsent']);

// OR require user cookie consent before storing and using any cookies
_paq.push(['requireCookieConsent']);

_paq.push(['trackPageView']);
[...]
```

* Once the function `requireConsent` is executed then no tracking request will be sent to Matomo and no cookies will be set. 
* Once the function `requireCookieConsent` is executed tracking requests will still be sent but no cookies will be set.

## Step 2: asking for consent through your privacy notice

Now you can ask the user for consent for example by displaying a clear privacy notice on your pages. Learn more about [privacy notices and asking for user consent](https://matomo.org/blog/2018/04/how-should-i-write-my-privacy-notice-for-matomo-analytics-under-gdpr/). Note that Matomo does not yet offer the feature to display a privacy notice, but may implement such a feature in the future to easily let you display the notice and gather user consent.

## Step 3: user gives consent

Once a user gives consent, you can either A) let Matomo remember the consent, or B) use your own consent tool to remember the consent. We present the two solutions below:

### A) if you want to let Matomo remember the consent

Once a user gives their consent, you can let Matomo remember that the user has given consent by simply calling the following method once the user has given their consent:

```js
// remember tracking consent was given for all subsequent page views and visits
_paq.push(['rememberConsentGiven']);

// OR remember cookie consent was given for all subsequent page views and visits
_paq.push(['rememberCookieConsentGiven']);
```

Matomo will then remember on subsequent requests that the user has given their consent by setting a cookie named "consent". As long as this cookie exists, Matomo will know that consent has been given and will automatically process the data. This means that you only need to call `_paq.push(['rememberConsentGiven'])` or `_paq.push(['rememberCookieConsentGiven'])` once.

Notes:

* By default, the cookie and consent will be remembered forever. It is possible to define an optional expiry period for your user consent by calling: `_paq.push(['rememberConsentGiven', optionallyExpireConsentInHours])` or `_paq.push(['rememberCookieConsentGiven', optionallyExpireConsentInHours])`.
* When you're tracking multiple sub-domains into the same website in Matomo, you want to ensure that when you ask for Consent, the user gives consent for all the sub-domains on which you are collecting data. If the user only gives consent for a particular domain or sub-domain(s), you may need to restrict or widen the scope of the consent cookie domain and path by using 'setCookieDomain' and ‘setCookiePath'. 
* For the consent to work, it is required that user does not disable first party cookies.

### B) if you use your own consent tool to remember the consent
            
In some cases, you record the information that the user has given consent to be tracked directly in your own system or CMS (for example when you use your own a cookie to remember user consent). Once you have the consent by the user to process their data, you need to call the `setConsentGiven` or `setCookieConsentGiven` method:
  
```js
// require user tracking consent before processing data
_paq.push(['requireConsent']);

// OR require user cookie consent before storing any cookies
_paq.push(['requireCookieConsent']);

_paq.push(['trackPageview']);
[...]

// user has given consent to process their data
_paq.push(['setConsentGiven']);

// OR user has given consent to store and use cookies
_paq.push(['setCookieConsentGiven']);
```
       
This lets the JavaScript tracker know that the user has given consent and ensures the tracking is working as expected. This function needs to be called anytime after `_paq.push(['requireConsent'])` or `_paq.push(['requireCookieConsent'])`.
     
Notes:

* when you call `_paq.push(['setConsentGiven'])` or `_paq.push(['setCookieConsentGiven'])`, Matomo will not remember on subsequent requests that this user has given consent: it is important that you call setConsentGiven on every page.
* when the user has given consent, you could also avoid calling `_paq.push(['requireConsent'])` in the first place. 

## Step 4: user removes consent

In order to remove his consent the user needs to perform a specific action, for example: clicking on a button "I do not want to be tracked anymore".

### A) if you want to let Matomo remember the consent
      
When the user has expressed they no longer give consent, you need to call the following method once:

```js
// revoke tracking consent
_paq.push(['forgetConsentGiven']);

// OR revoke cookie consent
_paq.push(['forgetCookieConsentGiven']);
```

This makes sure the cookie that remembered the given consent is deleted.

### B) if you use your own consent tool to remember the consent
When the user has expressed they no longer give consent, you shall not call the following method anymore:

```js
// do not call this once user has removed their consent
_paq.push(['setConsentGiven']);

// OR this method if you are using cookie consent
_paq.push(['setCookieConsentGiven']);
```

## Creating a custom opt-out form

Wanting to build a custom opt-out form instead of a consent screen? Check out the guide for [creating a custom opt-out form](/guides/tracking-javascript-guide#optional-creating-a-custom-opt-out-form).
