---
category: DevelopInDepth
title: Multi Tenant
---
# Matomo Multi Tenant Setup

You can configure Matomo to serve multiple customers with the same code base. While you can do this in any standard Matomo installation using it's permission system, the advantage of this solution is that you can configure each tenant differently and also configure a different database for each tenant which is more secure.

## Setting up a tenant specific config file

To do this, place a `config.ini.php` inside `misc/user/` for each hostname. For example:

* `$matomoDir/misc/user/subdomain_a.mydomain.com/config.ini.php`
* `$matomoDir/misc/user/subdomain_b.mydomain.com/config.ini.php`

Depending if you access Matomo using `subdomain_b.mydomain.com` or `subdomain_a.mydomain.com` the different config file will be read. Each config file may have different configurations and can point to a different database.

## Shared config files

There may be some configurations you want to share across all tenants. To do this, create a config file called `config/common.config.ini.php` starting with this line

```ini
; <?php exit; ?> DO NOT REMOVE THIS LINE
```

After this first line you can configure any settings that you want to apply to all your tenants. For example, if you want to disable auto update for all tenants use the following content:

```ini
; <?php exit; ?> DO NOT REMOVE THIS LINE
[General]
enable_auto_update = 0
```

Please note that any setting from this shared config file can be overwritten in a tenant specific config file.

## Custom brand logos

If a tenant uploads a custom logo, then these will be stored in the tenant specific directory. For example if the tenant `subdomain_b.mydomain.com` uploads a logo, then any logo will be stored in the directory `misc/user/subdomain_b.mydomain.com/`.

## Cache directories

Each tenant will have their own cache directory in Matomo's `tmp` directory. For example:

* `$matomoDir/tmp/subdomain_a.mydomain.com/*`
* `$matomoDir/tmp/subdomain_b.mydomain.com/*`

## Executing commands for a specific tenant

To execute a CLI console command you will need to specify for which tenant the command should be executed using the `--matomo-domain` option. For example to clear the cache for `subdomain_a` run the following command:

```bash
./console cache:clear --matomo-domain=subdomain_a.mydomain.com
```

## Updating the code base

It is highly recommended to disable the auto update by specificing the following configuration in the shared config file:

```ini
[General]
enable_auto_update = 0
```

This way no user can trigger updating the code base as one code base is used for multiple tenants. If you are using multiple servers, then you will also want to set the `multi_server_environment=1` setting see our [Load Balanced Matomo FAQ](https://matomo.org/faq/new-to-piwik/faq_134/).

Generally, the recommended way is to update the Matomo code base, deploy the new code base, and run the `core:update` console command for every tenant right after the code base was updated.

## Setting up a new tenant

It is currently not possible to set up a new tenant which is why it's documented on the developer docs and not on the Matomo website.

### Database

For Multi Tenant setup to work every tenant should have its own database schema. They can be all on the same physical database server but for best security should have each their own schema with their own unique MySQL username and password. It's not recommended to just use a different database prefix for each customer as it is less secure.

## Using the same database schema across tenants

You could technically "misuse" this multi tenant feature to set different configurations for each site in one Matomo installation which is otherwise not possible in Matomo.

This works to some extend for some config settings. For example, if you want to change a config tracking settings on a per site basis, then you only need to make sure to always use consistently the same host for the same idSite when sending tracking requests.

For some other config settings this can be more difficult. For example, if you want to change an archiving config setting on a per site basis, then you would need to make sure to never just run `./console core:archive` but always force specific sites with the expected host. For example `./console core:archive --force-idsites=1 --matomo-domain=...`.

Note that when you are using the very same database schema with the same table prefix for every tenant, then always all sites will be visible in all hosts. It is therefore usually always recommended to use different database schemas.
