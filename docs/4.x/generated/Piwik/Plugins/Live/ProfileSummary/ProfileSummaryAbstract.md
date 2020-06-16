<small>Piwik\Plugins\Live\ProfileSummary\</small>

ProfileSummaryAbstract
======================

Class ProfileSummaryAbstract

This class can be implemented in a plugin to provide a new profile summary

Methods
-------

The abstract class defines the following methods:

- [`setProfile()`](#setprofile) &mdash; Set profile information
- [`getId()`](#getid) &mdash; Returns the unique ID
- [`getName()`](#getname) &mdash; Returns the descriptive name
- [`render()`](#render) &mdash; Renders and returns the summary
- [`getOrder()`](#getorder) &mdash; Returns order indicator used to sort all summaries before displaying them

<a name="setprofile" id="setprofile"></a>
<a name="setProfile" id="setProfile"></a>
### `setProfile()`

Set profile information

#### Signature

-  It accepts the following parameter(s):
    - `$profile` (`array`) &mdash;
      
- It does not return anything.

<a name="getid" id="getid"></a>
<a name="getId" id="getId"></a>
### `getId()`

Returns the unique ID

#### Signature

- It returns a `string` value.

<a name="getname" id="getname"></a>
<a name="getName" id="getName"></a>
### `getName()`

Returns the descriptive name

#### Signature

- It returns a `string` value.

<a name="render" id="render"></a>
<a name="render" id="render"></a>
### `render()`

Renders and returns the summary

**Example**

    public function render() {
        if (empty($this->profile['crmData'])) {
            return '';
        }

        $view = new View('@pluginName/summary.twig');
        $view->crmData = $this->profile['crmData];
        return $view->render();
    }

#### Signature

- It returns a `string` value.

<a name="getorder" id="getorder"></a>
<a name="getOrder" id="getOrder"></a>
### `getOrder()`

Returns order indicator used to sort all summaries before displaying them

#### Signature

- It returns a `int` value.

