---
category: Develop
---
# Setting Up

Matomo lets you easily create new [tags](/guides/tagmanager/custom-tag), [triggers](/guides/tagmanager/custom-trigger) and [variables](/guides/tagmanager/custom-variable).

To start developing such custom tags, triggers, and variables, make sure to set up your development environment and to create a new plugin as explained in the [general setting up](/guides/getting-started-part-1) guide.

It is a requirement to have the [Tag Manager plugin](https://github.com/matomo-org/tag-manager) activated. Since Matomo 3.7.0 the plugin is automatically included as part of the Matomo Analytics release.

When you create a new template (a tag, trigger, or variable), please consider contributing this template to the [official Tag Manager plugin](https://github.com/matomo-org/tag-manager) as we'd like to ship the official plugin with as many templates by default as possible so users don't have to install too many third party plugins.

Alternatively, you may also [release](/guides/distributing-your-plugin) a tag or a collection of tags on the [Matomo Marketplace](https://plugins.matomo.org). However, much fewer users will be using this template as they have to find and install this plugin which is often not the case.

## Guides & API references

* Are you new to the Matomo Tag Manager? Check out our [user guide]().
* Want to integrate Matomo Tag Manager into your website? Check out our [integration guide](/guides/tagmanager/introduction).
* Looking for the Tag Manager API Reference? Check out our [JavaScript Tag Manager API Reference](/api-reference/tagmanager/javascript-api-reference).
