<small>Piwik\View\</small>

SecurityPolicy
==============

Content Security Policy HTTP Header management class

Methods
-------

The class defines the following methods:

- [`addPolicy()`](#addpolicy) &mdash; Appends a policy to a directive.
- [`removeDirective()`](#removedirective) &mdash; Removes a directive.
- [`overridePolicy()`](#overridepolicy) &mdash; Overrides a directive.
- [`disable()`](#disable) &mdash; Disable CSP
- [`restrictToDataResponse()`](#restricttodataresponse) &mdash; Replaces all directives with a policy for responses that are data rather than application UI (API output, exports, generated reports): no scripts, plugins, framing, form submissions or base URI overrides.
- [`allowEmbedPage()`](#allowembedpage) &mdash; A less restrictive CSP which will allow embedding other sites with iframes (useful for heatmaps and session recordings)

<a name="addpolicy" id="addpolicy"></a>
<a name="addPolicy" id="addPolicy"></a>
### `addPolicy()`

Appends a policy to a directive.

#### Signature

-  It accepts the following parameter(s):
    - `$directive`
      
    - `$value`
      
- It does not return anything or a mixed result.

<a name="removedirective" id="removedirective"></a>
<a name="removeDirective" id="removeDirective"></a>
### `removeDirective()`

Removes a directive.

#### Signature

-  It accepts the following parameter(s):
    - `$directive`
      
- It does not return anything or a mixed result.

<a name="overridepolicy" id="overridepolicy"></a>
<a name="overridePolicy" id="overridePolicy"></a>
### `overridePolicy()`

Overrides a directive.

#### Signature

-  It accepts the following parameter(s):
    - `$directive`
      
    - `$value`
      
- It does not return anything or a mixed result.

<a name="disable" id="disable"></a>
<a name="disable" id="disable"></a>
### `disable()`

Disable CSP

#### Signature

- It does not return anything or a mixed result.

<a name="restricttodataresponse" id="restricttodataresponse"></a>
<a name="restrictToDataResponse" id="restrictToDataResponse"></a>
### `restrictToDataResponse()`

Replaces all directives with a policy for responses that are data rather than application UI
(API output, exports, generated reports): no scripts, plugins, framing, form submissions or
base URI overrides. Inline styles and first-party images stay allowed, as reports need both.

Call this on an instance of your own: the shared one a controller exposes as
`$this->securityPolicy` builds the policy of the surrounding page. The policy is always
enforced, whatever `[General] csp_report_only` is set to.

#### Signature

- It returns a `void` value.

<a name="allowembedpage" id="allowembedpage"></a>
<a name="allowEmbedPage" id="allowEmbedPage"></a>
### `allowEmbedPage()`

A less restrictive CSP which will allow embedding other sites with iframes
(useful for heatmaps and session recordings)

#### Signature

- It does not return anything or a mixed result.

