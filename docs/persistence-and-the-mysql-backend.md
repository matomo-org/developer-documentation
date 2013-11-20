# Persistence & the MySQL Backend

<!-- Meta (to be deleted)
Purpose:
- describe the mysql backend (schema + how tables are used),
- describe what info is stored when reports + log data are persisted,
- describe how plugins should persist their own data,
- describe future plans for NoSQL

Audience: devs who want to persist non-analytics data in their plugin, devs who want to understand how MySQL is used, devs interested in creating NoSQL backends

Expected Result: 

Notes: 

What's missing? (stuff in my list that was not in when I wrote the 1st draft)
-->

## About this guide

**Read this guide if**

* you'd like to know **how your plugin can persist new non-analytics data**
* you'd like to know **what information is stored when Piwik stores analytics data, log data and miscellaneous data**
* you'd like to know **how Piwik uses MySQL to persist data**

**Guide assumptions**

This guide assumes that you:

* can write PHP and SQL code,
* understand how relational databases work in general and MySQL in particular.
