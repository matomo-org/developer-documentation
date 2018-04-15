---
category: Develop
---
# GDPR

On 25th May 2018 new privacy regulations become effective called GDPR (General Data Protection Regulation) which applies to businesses worldwide. It is also known under different wordings in other countries, for example to RGPD in French and Datenschutz-Grundverordnung, DS-GVO in German.

If your plugin is storing any personal information or tracks or imports any data, we highly recommend you give the [GDPR guide](https://matomo.org/docs/gdpr/) a read.

Many of Matomo's GDPR features are implemented in a way that most - but not all - plugins will support these features out of the box without having to do anything. 

Nevertheless, we recommend **every** plugin developer to check out below points on how to make your plugin GDPR compliant to see what **you** need to do.

## Make sure your plugin supports Matomo 3.5.0+
Matomo 3.5.0 comes with various new features that helps Matomo users to be GDPR compliant and to avoid tracking personal information.

## Mention whether your plugin stores personal or sensitive information or not
We recommend mentioning in your plugin’s README whether you store any personal or sensitive information and what kind of information this is. For example if you build a website live chat on top of Matomo, you should mention whether you store for example messages and whether there is maybe any data retention behind it. Even if you don't store any personal information,
it will be worth mentioning that the plugin is not storing any such information.

## Storing data in one of the existing log tables
If your plugin stores any extra data into an existing log DB table, such as `log_visit`, or `log_link_visit_action`, your plugin will support Matomo’s GDPR features such as the export and deletion of personal information out of the box. Also, 
the deletion of previously tracked data and the regular deletion of log data should all work out of the box.

## Storing data in custom database tables
Let's stick with the Live chat example and say your plugin stores chat message in a table `live_chat_messages`. As these
messages likely contain personal information, your plugin should listen to these events in order to support Matomo's deletion
and export features:

### `PrivacyManager.exportDataSubjects` 

Your plugin needs to export any information that your plugin stores along specific visits like this:

```php
public function exportDataSubjects(&export, $visitsToExport)
{
    $export['mypluginname'] = array();
    foreach($visitsToExport as $visit) {
         $export['mypluginname'][] = Db::query('SELECT * FROM mytable WHERE idsite = ? and idvisit = ?', array($visit['idsite'], $visit['idvisit']));
    }
}
```

### `PrivacyManager.deleteDataSubjects`
 
Your plugin needs to delete any information that is stored along specific visits. For example like this:

```php
public function deleteDataSubjects(&$result, $visitsToDelete)
{
    $result['mypluginname'] = 0;
    foreach($visitsToExport as $visit) {
        $result['mypluginname'] += Db::query('DELETE FROM mytable WHERE idsite = ? and idvisit = ?', array($visit['idsite'], $visit['idvisit']))->rowCount();
    }
}

```


### `PrivacyManager.deleteLogsOlderThan`
 
Your plugin needs to delete any data has been tracked before a certain time.

```php
public function deleteLogsOlderThan($dateUpperLimit, $deleteLogsOlderThan)
{
    Db::query('DELETE FROM mytable WHERE creation_date < ' . $dateUpperLimit->getDateTime());
}
```


