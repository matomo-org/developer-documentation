---
category: DevelopInDepth

---
# Using GitHub Actions

[Github Action](https://github.com/features/actions) are used to automate our software workflows including running javascript builds, test suites, releases and code checks.


## GitHub Action Scripts

All the GitHub Action build files are locate in `.github/workflows/*.yml`

Each script is triggered by its own conditions, for more details see [Github Action Docs](https://docs.github.com/en/actions)

Matomo uses GitHub Action to automatically run its build by various triggers.
- [Build Tracker JS] Trigger by the comment `build js` into the pull request. That will compress js/piwik.js into matomo.js and piwik.js
- [Build VUE] Triggered for PRs when commits are pushed. It will build VUE files and commit back to the branch or leave a comment, if the branch is not within the same repo.
- [Composer Update] runs once a week. Executes `composer update` and creates a PR for available updates
- [PHPCS check] Auto trigger, checking PHPCS code quality if not valid will return error details.
- [Inactive PR] runs daily, inactive PR will be marked as stale after 14 days

(New scripts should be documented in the list above.)

## Create a new GitHub Action script

To create a new GitHub Action script please read [Quickstart for GitHub Actions](https://docs.github.com/en/actions/quickstart)

We recommend forking the Matomo project and running actions on your own pipeline first. Also, please check the following list before getting started:

### Security

There is a chance the action scripts are getting hacked, so paying attention to security is of the upmost importance when you create a new GitHub Action script. 

It could lead to a GitHub token loss and write access to our code. [More details](https://docs.github.com/en/actions/security-guides/security-hardening-for-github-actions#stealing-the-jobs-github_token)

There are two common attack [script injection attacks](https://docs.github.com/en/actions/learn-github-actions/security-hardening-for-github-actions#example-of-a-script-injection-attack) and [Security hardening](https://docs.github.com/en/actions/security-guides/security-hardening-for-github-actions).

For more details, refer [this article](https://docs.github.com/en/actions/security-guides/security-hardening-for-github-actions#overview)

#### Environment Variables
Please make sure the environment variables used in the action are not customizable by the PR title etc.

#### Sensitive Information
Do not save secrets with values like token, password or other sensitive information in plain text, JSON, XML, YAML (or similar).

### Third-party actions

Generally the best practice is to avoid using a third party GitHub action or script when possible. For example, when the action only executes few simple scripts. Then we won't need an action for this and can just do it ourselves thus reducing the security risk.

If you need to use an action from the marketplace, please ensure that it is either an official action provided by GitHub, or you did a review of the actions code. In latter case, please ensure to use a version fixed by a full length commit SHA.


### Permission
We recommend using `none` permissions where possible, `read` permissions if needed to read the value, `write` only if needed, for more details see [Permission syntax](https://docs.github.com/en/actions/using-workflows/workflow-syntax-for-github-actions#permissions) and [Assigning permissions to jobs](https://docs.github.com/en/enterprise-cloud@latest/actions/using-jobs/assigning-permissions-to-jobs) 
