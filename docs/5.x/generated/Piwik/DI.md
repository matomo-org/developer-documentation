<small>Piwik\</small>

DI
==

Proxy class for using DI related methods

Methods
-------

The class defines the following methods:

- [`value()`](#value)
- [`create()`](#create)
- [`autowire()`](#autowire)
- [`factory()`](#factory)
- [`decorate()`](#decorate)
- [`get()`](#get)
- [`env()`](#env)
- [`add()`](#add)
- [`string()`](#string)

<a name="value" id="value"></a>
<a name="value" id="value"></a>
### `value()`

#### Signature

-  It accepts the following parameter(s):
    - `$value` (`mixed`) &mdash;
      
- It returns a `DI\Definition\ValueDefinition` value.

<a name="create" id="create"></a>
<a name="create" id="create"></a>
### `create()`

#### See Also

- `PHPDI\create()`

#### Signature

-  It accepts the following parameter(s):
    - `$className` (`string`|`null`) &mdash;
      
- It returns a `DI\Definition\Helper\CreateDefinitionHelper` value.

<a name="autowire" id="autowire"></a>
<a name="autowire" id="autowire"></a>
### `autowire()`

#### See Also

- `PHPDI\autowire()`

#### Signature

-  It accepts the following parameter(s):
    - `$className` (`string`|`null`) &mdash;
      
- It returns a `DI\Definition\Helper\AutowireDefinitionHelper` value.

<a name="factory" id="factory"></a>
<a name="factory" id="factory"></a>
### `factory()`

#### See Also

- `PHPDI\factory()`

#### Signature

-  It accepts the following parameter(s):
    - `$factory` (`callable`) &mdash;
      
- It returns a `DI\Definition\Helper\FactoryDefinitionHelper` value.

<a name="decorate" id="decorate"></a>
<a name="decorate" id="decorate"></a>
### `decorate()`

#### See Also

- `PHPDI\decorate()`

#### Signature

-  It accepts the following parameter(s):
    - `$callable` (`callable`) &mdash;
      
- It returns a `DI\Definition\Helper\FactoryDefinitionHelper` value.

<a name="get" id="get"></a>
<a name="get" id="get"></a>
### `get()`

#### See Also

- `PHPDI\get()`

#### Signature

-  It accepts the following parameter(s):
    - `$entryName` (`string`) &mdash;
      
- It returns a `DI\Definition\Reference` value.

<a name="env" id="env"></a>
<a name="env" id="env"></a>
### `env()`

#### See Also

- `PHPDI\env()`

#### Signature

-  It accepts the following parameter(s):
    - `$variableName` (`string`) &mdash;
      
    - `$defaultValue` (`mixed`) &mdash;
      
- It returns a `DI\Definition\EnvironmentVariableDefinition` value.

<a name="add" id="add"></a>
<a name="add" id="add"></a>
### `add()`

#### See Also

- `PHPDI\add()`

#### Signature

-  It accepts the following parameter(s):
    - `$values` (`array`|`mixed`) &mdash;
      
- It returns a `DI\Definition\ArrayDefinitionExtension` value.

<a name="string" id="string"></a>
<a name="string" id="string"></a>
### `string()`

#### See Also

- `PHPDI\string()`

#### Signature

-  It accepts the following parameter(s):
    - `$expression` (`string`) &mdash;
      
- It returns a `DI\Definition\StringDefinition` value.

