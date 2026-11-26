---
category: Integrate
title: Hybrid Tracking
---
# Hybrid Tracking: measuring consenting visitors without compliance restrictions

Hybrid Tracking (also called consent-aware analytics) lets a website measure every visitor under a compliance exemption, such as the [CNIL consent exemption](https://matomo.org/faq/how-to/how-do-i-configure-matomo-without-tracking-consent-for-french-visitors-cnil-exemption/), while collecting the data the exemption withholds from visitors who have given their consent.

Without Hybrid Tracking, a compliance policy applies the same restrictions to every visitor, because Matomo cannot tell a visitor who consented from one who did not. With Hybrid Tracking, both kinds of visitor are measured on the same website:

* **Visitors who have not given consent** are measured from their first page view, with the restrictions the policy requires.
* **Visitors who have given consent** are also measured with campaign names and keywords, full referrer URLs and their User ID. Settings an administrator configured for the website, such as referrer anonymisation, still apply.

This guide explains how to set up your tracking code and consent manager for Hybrid Tracking. If you are not using a compliance policy, see [Tracking & Cookie Consent](/guides/tracking-consent) instead.

<div markdown="1" class="alert alert-info">
Hybrid Tracking is being released in stages. This guide covers campaign names and keywords, full referrer URLs and User ID. More data will be collected for consenting visitors as later stages are released.
</div>

## How it works

Consent lifts a policy's restrictions only when all three of these are true:

1. **A compliance policy is enforced for the website**, such as the CNIL consent exemption in *Administration → Privacy → Compliance*. Hybrid Tracking relaxes what that policy restricts, so without a policy every visitor is measured the same way.
2. **Hybrid Tracking is enabled for the website, or for all websites** in Matomo. It is off by default.
3. **Your tracking code reports consent.** It does this by calling `requireConsentForRestrictedData()` and then `setConsentGiven()` or `rememberConsentGiven()` when the visitor accepts. The tracker sends `consent=1` on each request made after that.

Matomo records consent on the visit itself, so later requests in the same visit are still treated as consenting even if they don't repeat the signal.

If Hybrid Tracking is off or the tracking code reports no consent, tracking works exactly as it does without Hybrid Tracking. Without a policy, consent is still recorded on the visit, but there is no restriction for it to lift.

Only a superuser can enforce a compliance policy or enable Hybrid Tracking, because both change what a compliance policy enforces. A website administrator does not see the setting at all.

## Step 1: enable Hybrid Tracking for the website

As a superuser, go to *Administration → Privacy → Compliance*, choose *All Websites* or a single website, and turn on **Activate hybrid tracking** in the *Hybrid Tracking* section. A website measures it when it is on for all websites or for that website. Setting `[PrivacyManager] consent_aware_analytics` in `config.ini.php` fixes the *All Websites* value, which can then no longer be changed on the page: with `1`, every website measures it; with `0`, each website still follows its own setting.

Hybrid Tracking has no effect if the website forces cookieless tracking (`forceCookielessTracking`). Such a website keeps every visitor under the policy's restrictions, and Matomo shows no warning about it.

If you turn the setting off again, the website returns to applying the policy to every visitor immediately, including visits already recorded as consented. Data already stored is not changed: only requests tracked after the change are affected.

## Step 2: declare that only restricted data requires consent

Add `requireConsentForRestrictedData()` to your tracking code on every page:

```js
var _paq = window._paq = window._paq || [];

// Measure every visitor under the compliance exemption from the first page view.
// Cookies, and the data the exemption withholds, wait for the visitor's consent.
_paq.push(['requireConsentForRestrictedData']);

_paq.push(['trackPageView']);
_paq.push(['enableLinkTracking']);
(function() {
  var u = "//matomo.example.com/";
  _paq.push(['setTrackerUrl', u + 'matomo.php']);
  _paq.push(['setSiteId', '1']);
  var d = document, g = d.createElement('script'), s = d.getElementsByTagName('script')[0];
  g.async = true; g.src = u + 'matomo.js'; s.parentNode.insertBefore(g, s);
})();
```

`requireConsentForRestrictedData()`:

* **sends tracking requests straight away.** Nothing is held back waiting for the visitor to decide.
* **withholds cookies until the visitor gives consent or accepts cookies**, as `requireCookieConsent()` does. Call it *instead of* `requireCookieConsent()`, not as well as it. If the visitor accepted cookies on an earlier page view, the cookies are not removed again. Visitors who don't consent are therefore measured without cookies: a website that set cookies for every visitor under the exemption will recognise fewer returning visitors once it switches to this call.
* **is processed before other queued commands**, wherever you push it in `_paq`.
* **must not be combined with `requireConsent()`.** `requireConsent()` sends nothing until consent is given, and it takes priority if both are called. The tracker logs a console error if it sees both.
* **lets campaign parameters through once the visitor consents**, if you also call `disableCampaignParameters()`. Before consent, they are still removed.

This call is also what makes the tracker's consent-aware behaviour apply. A page that uses `requireConsent()` instead already sends `consent=1` once the visitor consents, so on a website with Hybrid Tracking its requests are measured as consenting too.

### Matomo Tag Manager

In your container, edit the **Matomo Configuration** variable and select **Require consent for data restricted by a compliance policy**. You don't need to add `requireConsentForRestrictedData()` to your website yourself.

This option cannot be combined with *Require Consent*, *Require Cookie Consent* or *Disable Cookies* on the same variable. If you don't see it, check that none of those is selected.

## Step 3: report consent when the visitor gives it

When the visitor accepts in your consent banner, call one of the following:

```js
// report consent, and remember it for later page views and visits
_paq.push(['rememberConsentGiven']);

// OR report consent for the current page view only
_paq.push(['setConsentGiven']);
```

* `rememberConsentGiven( hoursToExpire )` stores the consent in a first-party cookie named `mtm_measurement_consent`, so later page views report it without calling the method again. As with the other consent cookies, it expires after 30 years unless you pass an expiry in hours.
* `setConsentGiven()` reports consent for the current page view only. If your consent manager stores the decision itself, call `setConsentGiven()` on every page view where the visitor has consented.

Neither method requires `requireConsent()`. Requests already queued on the page carry the consent once it is given.

`setConsentGiven()` and `rememberConsentGiven()` turn cookies on for the rest of the page view, even on a website that calls `disableCookies()`. On such a website the consent is not carried to the next page view either, so call `setConsentGiven()` on every page view where the visitor has consented, and only if setting cookies after consent is acceptable for your website.

For example, with a consent manager that runs a callback when the visitor decides:

```js
myConsentManager.onAccept(function () {
    _paq.push(['rememberConsentGiven']);
});

myConsentManager.onReject(function () {
    _paq.push(['forgetConsentGiven']);
});
```

### Consent signals that do not count

Only `setConsentGiven()` and `rememberConsentGiven()` report consent to being measured. These do not:

* **`setCookieConsentGiven()` and `rememberCookieConsentGiven()`.** They record that the visitor accepted cookies, not that they agreed to be measured beyond what the policy allows. If your consent manager only calls these today, it also needs to call `setConsentGiven()` or `rememberConsentGiven()`.
* **The `mtm_consent` cookie.** The opt-out form also writes this cookie, and opting back in there answers whether the visitor wants to be tracked at all, not whether they agree to be measured without restrictions.

## Step 4: handle withdrawal and opt-out

On a website using Hybrid Tracking, "reject" and "opt out" mean different things and use different methods:

| Visitor action | Method | Result |
|---|---|---|
| Rejects, or withdraws consent | `forgetConsentGiven()` | Consent stops being reported and the `mtm_measurement_consent` and `mtm_consent` cookies are deleted. If the visitor accepted cookies separately (`rememberCookieConsentGiven()`), cookies stay on. Otherwise Matomo's tracking cookies are deleted too, and the visitor continues without cookies, with a new visitor ID. The visitor is still measured under the compliance exemption. |
| Opts out of tracking | `optUserOut()` | Nothing more is measured for this visitor. |
| Reverses an opt-out | `forgetUserOptOut()` | Measurement resumes under the compliance exemption. This does not report consent. |

Matomo records consent against the visit. If a visitor withdraws consent part way through a visit, the rest of that visit keeps the consented treatment, and the withdrawal takes full effect from their next visit. The tracker stops reporting consent immediately. Other open windows of the same website stop too when the consent was remembered with `rememberConsentGiven()`; a window where `setConsentGiven()` was called keeps reporting it until it is reloaded.

## Reporting consent through the HTTP Tracking API

If you track server-side or with a [tracking API client](/guides/tracking-api-clients), send the `consent` parameter:

* `consent=1`: the visitor had given consent when the request was sent.
* Any other value, or no `consent` parameter: no consent is being signalled. This is not recorded as a refusal.

`consent` is set by your own tracking code and Matomo does not authenticate it, as with the other tracking API parameters. It only has an effect on a website with Hybrid Tracking turned on (see Step 1). There, the consent is recorded on the visit, so later requests of the same visit are measured as consenting even without the parameter.

See the [Tracking HTTP API reference](/api-reference/tracking-api).

## When consent arrives part way through a visit

A visitor often gives consent after the first page view has already been tracked under the exemption. Matomo decides what happens to that visit from where the visitor is when consent arrives:

* **Still on the page they arrived on:** the same visit continues, and Matomo fills in the campaign, referrer URL and search keyword from the arrival. The page view is not sent again and the visit is not counted twice. This applies whichever request carries the consent, including the ping the tracker sends when consent is given, or an event your banner sends from that page.
* **Already moved to another page:** a page view carrying consent starts a new visit. The earlier visit keeps the treatment it was measured under. The new visit has the User ID but no campaign or referrer, because the arrival URL and original referrer are no longer in the request, and it appears as a direct entry.
* **A request that cannot start a visit** (a ping, an event, a download, an outlink, a site search or a manual goal conversion) sent after the visitor has moved on changes nothing. The next page view starts the consenting visit.

Visits are only split this way on a website where a policy restricts something for consent to lift. Visit length is decided by the usual visit timeout. There is no separate setting for Hybrid Tracking.

Data withheld before consent is not kept, so it cannot be recovered afterwards.

## Where consent is stored

Consent is stored in the `consent` column of the `log_visit` table (see the [database schema](/guides/database-schema)). It is `1` for a visit where consent was reported, and `NULL` where no consent was ever signalled. `NULL` does not mean consent was refused.

To report on consenting visitors, use the `consentState` [segment](/api-reference/reporting-api-segmentation) or the *Consent state* visit dimension. `consentState==consented` matches visits stored with consent, and `consentState==unknown` matches every other visit.

On a website whose compliance policy disables the visits log, turning on Hybrid Tracking also brings back the Visits Log, the Visitor Profile, the Real-time widget and map, and the Ecommerce log, with only the visits of visitors who gave consent. The GDPR tools can find and export these visits too, even with Hybrid Tracking off, so that their visitors' requests to access or erase their data can still be answered.

## Known limitations

* **Marketing Campaigns Reporting plugin:** its campaign dimensions are kept for consenting visitors from version 6.1.0. With an earlier version, they stay masked for every visitor.
* **Roll-up websites** offer the setting but never receive tracking requests, so it has no effect on them.
* **Heatmaps, Session Recordings, A/B Testing and Advertising Conversion Export** do not yet treat consenting visitors differently.

## For plugin developers

If your plugin withholds data under a compliance policy, you can relax it for consenting visitors with the same rule core uses:

* `Piwik\Tracker\Request::hasConsent()` returns whether the request can be measured as coming from a consenting visitor. It returns `false` when Hybrid Tracking is off for the website or the website forces cookieless tracking, whatever the request reports. It does not check whether a policy is enforced.
* `Piwik\Tracker\Request::measuresConsentAwareAnalytics()` returns whether Hybrid Tracking is on for the request's website and the website does not force cookieless tracking.
* `Piwik\Plugins\PrivacyManager\Config::getConfiguredValue()` returns the value an administrator configured for one of PrivacyManager's privacy settings, such as `anonymizeReferrer`, without the stricter value a policy may enforce on top of it. Use it so that consent relaxes only what the policy requires and never what the administrator chose. It reads the tracker cache, so it is safe to call while tracking. It only supports the settings PrivacyManager caches for this and throws an exception for any other one.

In the JavaScript tracker, `isRestrictedDataConsentRequired()` returns whether the page called `requireConsentForRestrictedData()`.

See the [developer changelog](/changelog) for the full list of API changes.
