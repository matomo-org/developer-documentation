---
category: Develop
---
# Providing updates


## Change notifications

To add "What's new?" change notifications for your plugin, create a `changes.json` file in your plugin folder containing JSON data to describe each change.   

```json
[
  {
    "title":       "New feature x added",
    "description": "Now you can do a with b like this",
    "version":     "4.0.2",
    "link_name":   "For more information go here",
    "link":        "https://www.matomo.org"
  },
  {
    "title":       "New feature y added",
    "description": "Now you can do c with d like this.",
    "version":     "4.0.1"
  }
]
```

| Key         | Description |
| ----------- | ----------- |
| title       | A short heading describing the change. | 
| description | Body text describing the change in more detail, HTML may be used. | 
| version     | The version of the plugin in which this changes was made. |
| link_name   | Display name of a link to be shown underneath the change description, optional. |
| link        | URL of the link, optional. |

Whenever a plugin is installed or updated any new entries in the `changes.json` file will be loaded into the `changes` database
table and shown when the "What's New?" menu icon is clicked. Change notifications are loaded in the same order as they appear in
the `changes.json` file and will be shown for ninety days from the date that they were loaded. 
