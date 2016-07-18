<small>Piwik\PiwikPro\</small>

Advertising
===========

Since Piwik 2.16.0

Piwik PRO Advertising related methods.

Lets you for example check whether advertising is enabled, generate
links for different landing pages etc.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`arePiwikProAdsEnabled()`](#arepiwikproadsenabled) &mdash; Returns true if it is ok to show some Piwik PRO advertising in the Piwik UI.
- [`getPromoUrlForCloud()`](#getpromourlforcloud) &mdash; Get URL for promoting the Piwik Cloud.
- [`getPromoUrlForOnPremises()`](#getpromourlforonpremises) &mdash; Get URL for promoting Piwik On Premises.
- [`addPromoCampaignParametersToUrl()`](#addpromocampaignparameterstourl) &mdash; Appends campaign parameters to the given URL for promoting any Piwik PRO service.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature

-  It accepts the following parameter(s):
    - `$pluginManager` (`Piwik\PiwikPro\Plugin\Manager`) &mdash;
      
    - `$config` ([`Config`](../../Piwik/Config.md)) &mdash;
      

<a name="arepiwikproadsenabled" id="arepiwikproadsenabled"></a>
<a name="arePiwikProAdsEnabled" id="arePiwikProAdsEnabled"></a>
### `arePiwikProAdsEnabled()`

Returns true if it is ok to show some Piwik PRO advertising in the Piwik UI.

#### Signature

- It returns a `bool` value.

<a name="getpromourlforcloud" id="getpromourlforcloud"></a>
<a name="getPromoUrlForCloud" id="getPromoUrlForCloud"></a>
### `getPromoUrlForCloud()`

Get URL for promoting the Piwik Cloud.

#### Signature

-  It accepts the following parameter(s):
    - `$campaignMedium` (`string`) &mdash;
      
    - `$campaignContent` (`string`) &mdash;
      
- It returns a `string` value.

<a name="getpromourlforonpremises" id="getpromourlforonpremises"></a>
<a name="getPromoUrlForOnPremises" id="getPromoUrlForOnPremises"></a>
### `getPromoUrlForOnPremises()`

Get URL for promoting Piwik On Premises.

#### Signature

-  It accepts the following parameter(s):
    - `$campaignMedium` (`string`) &mdash;
      
    - `$campaignContent` (`string`) &mdash;
      
- It returns a `string` value.

<a name="addpromocampaignparameterstourl" id="addpromocampaignparameterstourl"></a>
<a name="addPromoCampaignParametersToUrl" id="addPromoCampaignParametersToUrl"></a>
### `addPromoCampaignParametersToUrl()`

Appends campaign parameters to the given URL for promoting any Piwik PRO service.

#### Signature

-  It accepts the following parameter(s):
    - `$url` (`string`) &mdash;
      
    - `$campaignName` (`string`) &mdash;
      
    - `$campaignMedium` (`string`) &mdash;
      
    - `$campaignContent` (`string`) &mdash;
      
- It returns a `string` value.

