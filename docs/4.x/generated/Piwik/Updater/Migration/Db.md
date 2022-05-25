<small>Piwik\Updater\Migration\</small>

Db
==

Base class for a single database migration.

Methods
-------

The abstract class defines the following methods:

- [`exec()`](#exec) &mdash; Executes the migration. Inherited from [`Migration`](../../../Piwik/Updater/Migration.md)
- [`__toString()`](#__tostring) &mdash; Get a description of what the migration actually does. Inherited from [`Migration`](../../../Piwik/Updater/Migration.md)
- [`shouldIgnoreError()`](#shouldignoreerror) &mdash; Decides whether an error should be ignored or not. Inherited from [`Migration`](../../../Piwik/Updater/Migration.md)

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
    - `$exception` (`Stmt_Namespace\Exception`) &mdash;
      
- It returns a `bool` value.

