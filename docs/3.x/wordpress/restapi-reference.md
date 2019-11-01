---
category: API Reference
title: REST API
---
# Matomo for WordPress REST API reference

The regular [Matomo HTTP Reporting API](https://developer.matomo.org/api-reference/reporting-api) is not available within WordPress. Instead we utilise the WordPress REST API.

For more details about each method and all the available parameters please view the [HTTP Reporting API reference](https://developer.matomo.org/api-reference/reporting-api).

Example request: https://example.com/index.php?rest_route=/matomo/v1

Namespace: `matomo/v1`

* `GET api/processed_report`
* `GET api/report_metadata`
* `GET api/matomo_version`
* `GET api/metadata`
* `GET api/segments_metadata`
* `GET api/widget_metadata`
* `GET api/row_evolution`
* `GET api/suggested_values_for_segment`
* `GET api/settings`
* `POST annotations/add`
* `POST annotations/all`
* `POST core_admin_home/invalidate_archived_reports`
* `POST core_admin_home/run_scheduled_tasks`
* `GET dashboard/dashboards`
* `GET image_graph/get`
* `GET languages_manager/available_languages`
* `GET languages_manager/available_languages_info`
* `GET languages_manager/available_language_names`
* `GET languages_manager/language_for_user`
* `GET live/counters`
* `GET live/last_visit_details`
* `GET live/visitor_profile`
* `GET live/most_recent_visitor_id`
* `DELETE privacy_manager/data_subjects`
* `GET privacy_manager/export_data_subjects`
* `POST privacy_manager/anonymize_some_raw_data`
* `GET scheduled_reports/reports`
* `POST scheduled_reports/send_report`
* `POST segment_editor/add`
* `PUT segment_editor/update`
* `DELETE segment_editor/delete`
* `GET segment_editor/get`
* `GET segment_editor/all`
* `GET sites_manager/all`
* `GET sites_manager/all_sites_id`
* `GET users_manager/users`
* `GET users_manager/users_login`
* `GET users_manager/user`
* `GET goals/goals`
* `GET goals/goal`