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

<a name="allowembedpage" id="allowembedpage"></a>
<a name="allowEmbedPage" id="allowEmbedPage"></a>
### `allowEmbedPage()`

A less restrictive CSP which will allow embedding other sites with iframes
(useful for heatmaps and session recordings)

#### Signature

- It does not return anything or a mixed result.

