<small>Piwik\Updater\Migration\</small>

Custom
======

Create a custom migration that can execute any callback.

Methods
-------

The class defines the following methods:

- [`exec()`](#exec) &mdash; Executes the migration.
- [`__toString()`](#__tostring) &mdash; Get a description of what the migration actually does.
- [`shouldIgnoreError()`](#shouldignoreerror) &mdash; Decides whether an error should be ignored or not.
- [`__construct()`](#__construct)

<a name="exec" id="exec"></a>
<a name="exec" id="exec"></a>
### `exec()`

Executes the migration.

#### Signature

- It returns a `void` value.

<a name="__tostring" id="__tostring"></a>
<a name="__toString" id="__toString"></a>
### `__toString()`

Get a description of what the migration actually does. For example "Activate plugin $plugin" or
"SELECT * FROM table".

#### Signature

- It returns a `string` value.

<a name="shouldignoreerror" id="shouldignoreerror"></a>
<a name="shouldIgnoreError" id="shouldIgnoreError"></a>
### `shouldIgnoreError()`

Decides whether an error should be ignored or not.

#### Signature

-  It accepts the following parameter(s):
    - `$exception` (`Piwik\Updater\Exception`) &mdash;
      
- It returns a `bool` value.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature

-  It accepts the following parameter(s):
    - `$callback`
      
    - `$toString`
      

