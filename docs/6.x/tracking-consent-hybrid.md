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

Hybrid Tracking only applies when all three of these are true:

1. **A compliance policy is enforced for the website**, such as the CNIL consent exemption in *Administration → Privacy → Compliance*. Hybrid Tracking relaxes what that policy restricts, so without a policy every visitor is measured the same way.
2. **Hybrid Tracking is enabled for the website** in Matomo. It is off by default.
3. **Your tracking code reports consent.** It does this by calling `requireConsentForRestrictedData()` and then `setConsentGiven()` or `rememberConsentGiven()` when the visitor accepts. The tracker sends `consent=1` on each request made after that.

Matomo records consent on the visit itself, so later requests in the same visit are still treated as consenting even if they don't repeat the signal.

If any of the three is missing, tracking works exactly as it does without Hybrid Tracking, whatever consent calls your tracking code makes.

Only a superuser can enforce a compliance policy or enable Hybrid Tracking, because both change what a compliance policy enforces. A website administrator does not see the setting at all.

## Step 1: enable Hybrid Tracking for the website

As a superuser, go to *Administration → Websites → Manage*, edit the website, and in the privacy settings turn on **Measure consent-aware analytics for this site**.

Hybrid Tracking has no effect if the website forces cookieless tracking (`forceCookielessTracking`). Such a website keeps every visitor under the policy's restrictions, and Matomo shows no warning about it.

If you turn the setting off again, the website returns to applying the policy to every visitor immediately, including visits already recorded as consented.

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
* **withholds cookies until consent is given**, as `requireCookieConsent()` does. Call it *instead of* `requireCookieConsent()`, not as well as it. If the visitor accepted cookies on an earlier page view, the cookies are not removed again.
* **is processed before other queued commands**, wherever you push it in `_paq`.
* **must not be combined with `requireConsent()`.** `requireConsent()` sends nothing until consent is given, and it takes priority if both are called. The tracker logs a console error if it sees both.

This call is also what makes the tracker's consent-aware behaviour apply. If a page does not call it, the tracker sends the same requests it always has, whatever other consent methods the page calls.

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

* `rememberConsentGiven( hoursToExpire )` stores the consent in a first-party cookie named `mtm_measurement_consent`, so later page views report it without calling the method again. As with the other consent cookies, it is kept forever unless you pass an expiry in hours.
* `setConsentGiven()` reports consent for the current page view only. If your consent manager stores the decision itself, call `setConsentGiven()` on every page view where the visitor has consented.

Neither method requires `requireConsent()`. Requests already queued on the page carry the consent once it is given.

A website that also calls `disableCookies()` cannot store the `mtm_measurement_consent` cookie. On such a website `rememberConsentGiven()` only reports consent for the current page view, so call `setConsentGiven()` on every page view instead.

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
| Rejects, or withdraws consent | `forgetConsentGiven()` | Consent stops being reported and the `mtm_measurement_consent` cookie is deleted. The visitor is still measured under the compliance exemption. |
| Opts out of tracking | `optUserOut()` | Nothing more is measured for this visitor. |
| Reverses an opt-out | `forgetUserOptOut()` | Measurement resumes under the compliance exemption. This does not report consent. |

Matomo records consent against the visit. If a visitor withdraws consent part way through a visit, the rest of that visit keeps the consented treatment, and the withdrawal takes full effect from their next visit. The tracker stops reporting consent immediately, including in other open windows of the same website.

## Reporting consent through the HTTP Tracking API

If you track server-side or with a [tracking API client](/guides/tracking-api-clients), send the `consent` parameter:

* `consent=1`: the visitor had given consent when the request was sent.
* Any other value, or no `consent` parameter: no consent is being signalled. This is not recorded as a refusal.

`consent` is set by your own tracking code and Matomo does not authenticate it, as with the other tracking API parameters. It only changes what is stored for the request that carries it, and only on a website where Hybrid Tracking applies.

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

## Known limitations

* **Marketing Campaigns Reporting plugin:** campaign dimensions from this plugin stay masked for consenting visitors until the plugin is updated to support Hybrid Tracking.
* **Roll-up websites** offer the setting but never receive tracking requests, so it has no effect on them.
* **Heatmaps, Session Recordings, A/B Testing and Advertising Conversion Export** do not yet treat consenting visitors differently.

## For plugin developers

If your plugin withholds data under a compliance policy, you can relax it for consenting visitors with the same rule core uses:

* `Piwik\Tracker\Request::hasConsent()` returns whether the request can be measured as coming from a consenting visitor. It returns `false` on any website where Hybrid Tracking does not apply, whatever the request reports.
* `Piwik\Tracker\Request::measuresConsentAwareAnalytics()` returns whether Hybrid Tracking applies to the request's website at all.
* `Piwik\Plugins\PrivacyManager\Config::getConfiguredValue()` returns the value an administrator configured for a privacy setting, without the stricter value a policy may enforce on top of it. Use it so that consent relaxes only what the policy requires and never what the administrator chose.

In the JavaScript tracker, `isRestrictedDataConsentRequired()` returns whether the page called `requireConsentForRestrictedData()`.

See the [developer changelog](/changelog) for the full list of API changes.
