---
category: DevelopInDepth
title: Coding Standards
---
# Matomo Coding Standards

The following are a list of guidelines and requirements for contributions to Matomo Core. Developers and teams interested in contributing should read through them before starting to contribute and before sending a pull request. **Contributions that are not up to these standards will not be accepted**.

## General Considerations

* **Write clear, easily understandable code.** Is your code easy to read? Would anybody understand what each line and function does immediately after reading them? Code that does not do anything complicated should be this easy to understand. Complex code should have extra documentation that will aid new developers in understanding it.

* **Reuse as much code as possible.** Have you removed any redundancies in your code? Have you made sure your code does not replicate existing functionality? Try to reduce the amount of code you need to write for your contribution.

* **Write _correct_ code.** Does your code handle all possible scenarios? Does your code handle all possible error conditions (including any corner cases)? Do existing tests pass for your contribution? Does your code generate any unwanted PHP errors or warnings? We do not want contributions that introduce new bugs.

* **Write _efficient_ code.** Does your code scale well? What happens when there are hundreds of thousands of websites and billions of visits? Please note any potential performance issues and whether they would be easy to fix. We know how hard it can be to scale efficiently, but we would like for Piwik to be as fast as possible.

* **Follow our [security guidelines](/guides/security-in-piwik).** We do not allow any security vulnerabilities in contributions.

## Specific Considerations

* **Add new configuration settings for fixed values that may users may change.** Does your code use constants that users may want to change? They should be made configurable.

* **Use automated testing to test your PHP.** If you've written new PHP code, have you created unit and integration tests for them? All code that could benefit from automated tests should have tests written for them. Read our [Testing guide](/guides/tests) to learn about it.

* **Internationalize your text.** If your contribution has text, is it loaded from a language file? We want all text in Piwik Core to be available in as many languages as possible. To learn more about i18n in Piwik read our [Internationalization](/guides/internationalization) guide.

* **Generate HTML in template files only.** Does your PHP code contain HTML? It shouldn't. All HTML generation should be handled by Twig templates.

* **If your contribution includes third-party components & libraries, make sure they include GPL compatible licenses.** Third-party components/libraries must be compatible with GPL v3 since this is the license used by Piwik.

* **Make sure your code follows the [PSR 1](http://www.php-fig.org/psr/psr-1/), [PSR 12](https://www.php-fig.org/psr/psr-12/) and [PSR-4](http://www.php-fig.org/psr/psr-4/) coding standards.**

* **Make sure your source code files are encoded in UTF8.**

* **Make sure lines end with Linux EOL markers (LF).** To learn how to let git manage line endings for you, read [this](https://help.github.com/articles/dealing-with-line-endings#platform-all).

## Coding Considerations

The following are a list of guidelines you should follow while writing code and architecting software.

### Include Path

Piwik does not set or depend on the include path. Plugins should rely on the autoloader for classes and use the absolute path convention for other files:

```php
require_once PIWIK_INCLUDE_PATH . '/folder/script.php';
```

### Basic Clean Code recommendations

About classes:

* Classes should follow the [Single Responsibility Principle](https://en.wikipedia.org/wiki/Single_responsibility_principle).
* Refactor classes and aim for files/classes that are at most 400 lines.
* Avoid classes with both public attributes and getters/setters. Choose to use getters and setters only when they make code easier to read.
* Add `private` keywords to class attributes when forgotten.

About methods and functions:

* Functions should follow the Single Responsibility Principle: each function should do only one thing.
* Think about whether you can refactor the function body into smaller private methods.
* Aim for a maximum of 20-30 lines per method.
* Aim for maximum three function parameters.
* Extract the body of the `try {}` blocks into their own private method.

Keep the following principles (from Alan Shalloway) in mind while writing code: cohesion, loose coupling, no redundancy, encapsulation, testability, readability, and focus.

### Commenting

In order for new developers to get up to speed quickly and in order to lessen the amount of bugs Piwik will ever experience, the Piwik source code must be easy to understand. Comments, in addition to general code cleanliness, are important in achieving this goal.

> Comments are a central part of professional coding. Comments can be divided into three categories: **documentary** (serving the purpose of documenting the evolution of code over time), **functional** (helping the co-ordination of the development effort inside the team) and **explanatory** (generating the software documentation for general use). All three categories are vital to the success of a software development project.

> &mdash; [The fine Art of Commenting](http://www.icsharpcode.net/TechNotes/Commenting20020413.pdf)

For an example of a well commented Piwik class, see [Piwik\Cookie](https://github.com/matomo-org/matomo/blob/master/core/Cookie.php).

Despite their importance, comments can sometimes cause information overload - or worse for out-of-date comments. Useless or inaccurate comments and autogenerated comments that add no value should be avoided. Rather than writing comments inside a function, it is better to write shorter functions that do only one thing and are named thoughtfully. A well refactored class made of small methods will be easy to read and will not need many comments.

### No duplication

**No duplication** is a basic and core principle of extreme programming and of writing good code in general. Write code **"Once, and only once"**, i.e. Don't Repeat Yourself. Do not duplicate code.
