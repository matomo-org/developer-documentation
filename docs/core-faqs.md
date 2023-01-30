---
category: DevelopInDepth
title: FAQs
---
# Matomo Core Developer FAQs

## How do I know which browsers support a certain JavaScript or CSS feature?

Go to the [Can I use website](http://caniuse.com/) and enter the name of the feature you want to use. It will tell you which browsers support this specific feature. 

Or search through the [Mozilla Developer Network](https://developer.mozilla.org/en-US/) which has more granular information about which browsers support specific functions, parameters, syntax, etc.

## How do I know if a feature is supported by specific PHP versions?

* You can check the [PHP manual](https://www.php.net/manual/en/). It will tell you which feature is supposed by which PHP versions.
* You can also [3v4l](https://3v4l.org/) to run a specific code on 300+ different PHP versions and compare the output for each version.

## How do I ensure `titles` are always escaped when using UI component `<div piwik-field data-title="YOUR_TITLE">`

The `data-title` attribute is designed to display HTML correctly and due to which escaping is ignored for `HTML` and `HTML attributes`. 

To ensure the text of the title is always escaped, you need to double escape it,
Example `<div piwik-field data-title="{{ TITLE | e('html_attr') | e('html_attr')}}">`.

**Note: ** You should always double escape the title, if it displays any user input or any value which can be changed by the user to avoid any XSS vulnerability.
