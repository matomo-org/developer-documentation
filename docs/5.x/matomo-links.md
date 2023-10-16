---
category: DevelopInDepth
---
# External Links to Matomo Domains 

All links to Matomo domains from with the Matomo application should include campaign 
parameters in the URL which will be used to track the source of in-app traffic to online
documentation and help improve them. No personal or identifying information is tracked, just the
install type and location in the application from which the link was followed. 

The campaign parameters should contain the following values:
- mtm_campaign : Always `Matomo_App`
- mtm_source : Either `Matomo_App_OnPremise` or `Matomo_App_Cloud` depending on the instance type.
- mtm_medium : `App.[Module].[action]` where [Module] is the application module and [action] is the current action.

### Format Examples ###

For a link on the no-data page, on premise, the format would be:

`&mtm_campaign=Matomo_App&mtm_source=Matomo_App_OnPremise&mtm_medium=App.CoreHome.index`

For a link on the Account Security page, on cloud, the format would be: 

`&mtm_campaign=Matomo_App&mtm_source=Matomo_App_Cloud&mtm_medium=App.UsersManager.userSecurity`

## Configuration ##

By default campaign parameters will be appended to all links for Matomo domains. On-premise users
may disable campaign parameters on Matomo links globally by setting the following config option:

```
[General]
disable_tracking_matomo_app_links = 1
```

## Formatting Links in Code

Since some of the campaign parameter values are dynamic it's not possible to manually add the 
parameters to URLs. Instead there are existing formatting methods detailed below that can be used to easily and
automatically append the parameters.

 - Only Matomo domains will have campaign parameters appended, non-Matomo domains can be used with the formatting methods, but will not be changed.
 - If the Matomo link tracking is disabled globally then the methods will not update the link.
 - Any existing campaign parameters on links passed to the formatting methods will be replaced.

### Custom Parameter Values ###

All formatting methods include optional parameters to explicity override the `mtm_campaign`,
`mtm_source` and `mtm_medium` values. If any of these values are overriden with `null` then the 
automatic values will be used for that parameter. For example, if `mtm_campaign` and `mtm_source` 
are both overriden with `null` and `mtm_medium` contains a custom value then the format will be

`&mtm_campaign=Matomo_App&mtm_source=Matomo_App_OnPremise&mtm_medium=customvalue`


### vue.js ###

Append campaign parameters to a raw URL:

```
import { externalRawLink } from '../externalLink';
...
const url = externalRawLink('https://matomo.org/docs/tracking-goals-web-analytics/'),
```

Append campaign parameters to a link returning an HTML tag in the format:

`<a target="_blank" rel="noreferrer noopener" href="[ link with campaign params ]">` 

```
import { externalLink } from '../externalLink';
...
const link = translate(
    'Goals_LearnMoreAboutGoalTrackingDocumentation', 
    externalLink('https://matomo.org/docs/tracking-goals-web-analytics/'), 
    '</a>', 
);
```

With custom campaign parameters:

```
import { externalRawLink } from '../externalLink';
...
const url = externalRawLink('https://matomo.org/docs/tracking-goals-web-analytics/',
                'MyCampaign', 'MySource', 'MyMedium'),

```

### PHP ###

```
use Piwik\Url;
$url = Url::addCampaignParametersToMatomoLink('https://matomo.org/url');
```

With custom campaign parameters:

```
use Piwik\Url;
$url = Url::addCampaignParametersToMatomoLink('https://matomo.org/url', 
        'MyCampaign', 'MySource', 'MyMedium');
```

### JavaScript ###

In JavaScript:

```
var link =  _pk_externalRawLink('https://matomo.org/faq/how-to/faq_54/')
``` 

With custom campaign parameters: 

```
var link =  _pk_externalRawLink('https://matomo.org/faq/how-to/faq_54/',
                'MyCampaign', 'MySource', 'MyMedium');
``` 


### Twig Templates ###

`{{ 'https://matomo.org/url'|trackmatomolink }}`

With custom campaign parameters:

`{{ 'https://matomo.org/url'|trackmatomolink('MyCampaign', 'MySource', 'MyMedium') }}`



