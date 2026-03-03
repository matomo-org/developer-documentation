---
category: DevelopInDepth
previous: data-model
next: archiving
---
# Log data

The HTTP tracking API (i.e. the `Piwik\Tracker` component) receives **raw** analytics data, which we call **log data**.

There are five types of log data:

- visits
- action types
- plugin specific actions
- conversions
- ecommerce items

**Log data is aggregated by the [Archiving process](/guides/archiving) into [archive data](/guides/archive-data).**

**Log data is never used directly for Piwik reports**, archive data is used instead. The only exception is the *Live* plugin which uses log data to generate real-time reports.

## Persistence

Log data is represented in PHP as `Piwik\Tracker\Visit` objects, and is stored into the following tables:

- `log_visit` contains one entry per visit (returning visitor)
- `log_action` contains all the type of actions possible on the website (e.g. unique URLs, page titles, download URLs…)
- `log_link_visit_action` contains one entry per action of a visitor (page view, …)
- `log_conversion` contains conversions (actions that match goals) that happen during a visit
- `log_conversion_item` contains e-commerce conversion items

The content of those tables (and their related PHP entities) is explained in more details in the [Database schema guide](/guides/database-schema#log-data-persistence).
