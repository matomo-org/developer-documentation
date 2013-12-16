# Manual UI Testing

## About this guide

This document contains a list of manual UI checks and tests that can be performed in order to ensure the UI works.

Piwik includes a [UI test suite](https://github.com/piwik/piwik-ui-tests) but these tests do not test everything. **If you have modified any of the Javascript, CSS, HTML, or PHP code that can affect the User Interface, you must go through this list to make sure everything still works.**

**Read this guide if**

* you've **made a change to the core UI and need to make sure there are no regressions**

## Asset Merging

Piwik comes with a dynamic JS/CSS/LESS file minifier and merger. Learn more about it here: [Blog post &mdash; Making Piwik UI Faster](http://piwik.org/blog/2010/07/making-piwik-ui-faster/).

During development you may find it necessary to disable this system. **You should enable it before performing UI tests.** You should also make sure merged assets are created with your changes. To do this, disable or enable a plugin in Piwik.

_Learn how to enable/disable the asset merger in our [Working with Piwik's UI](#) guide._

## Browsers to test with

Piwik should work with the following browsers:

*   Firefox,
*   Firefox with Firebug extension, check that there is no error or notice in the JS code,
*   Internet Explorer 8+
*   Internet Explorer with Debug enabled (set debugging in Tools > Internet > Advanced > Debug),
*   Opera,
*   Safari,
*   Chrome

Try and run the following tests with as many of these as you can.

To help with your testing you may want to generate screenshots of Piwik pages using a tool like [Browser Shots](http://browsershots.org/).

## The Table Report Visualization

This is the UI widget that displays a report as a table with columns and rows.

Check that the following things are true:

* label column icons are present (eg, icon of google/yahoo/..., flags for countries, etc.).
* the style (background color) is different for odd & even rows.
* the label text is truncated when it is too long and when it is truncated there is a tooltip that displays the original text.
* column documentation displays when hovering overa column name in the HTML table view.

And test the following features:

* clicking a column heading to sort by column (the _column sorted_ icon should appear over the sorted column once the action is completed)
* pagination (via the previous/next links).
  * Verify that the _current row number_ and _total row count_ are correct.
  * Check that pagination is reset after a table is refreshed (via column sort or pattern search) or the visualization changed.
* the commands availble via the [Cog](#) icon particularly in the Page URLs report and in _Referrers > Websites_.
* the _Number of rows to display_ dropdown.
* the inline search box. To test:
  * search for a string that is present in the label column of the table, navigate in the table and then cancel the search.
  * search for a string that is not present in the table (should display something like **There is no data for this report.**).
* the data exporting feature. Check that data can be exported as CSV, XML, JSON and TSV. _Note: You do not have to test for correctness since there are unit and integration tests that will test for that._
* row evolution and multi row evolution.

TODO: what does 'navigate in the table' mean?

## Subtable Visualization

Check that:

* Clicking on a row displays a new datatable for the proper reports (eg, the Keywords table and the Search engine table) and verify all previous tests pass for this subtable (the same testing procedure as for the root table).
* There is an external url link on some subtable rows for reports such as the Search engines reports and the Keywords report.
* Row Evolution + Multi Row Evolution works in subtables.

### Other Report Visualizations

Check that switching to the following visualizations works:

* bar graph (should load a bar graph)
* pie chart (should load a pie graph)
* tag cloud (displays values with relative font size)
* table with all columns
* (optional) table with goal metrics

## Reports under _Actions > Pages_

Run the following tests for actions reports:

* Run the same tests that were run on the standard reports (exclude the test for alternate row styles for even/odd rows).
* Expand and minimize rows through several nesting levels (check that the left margin gets bigger each time).
* Check that the figures are summed correctly in the **include low pop** mode.

## Sparklines

Check that:

* On the _Visitors > Overview_, _Referrers > Overview_ and _Goals > Overview_ pages, check that clicking on a sparkline updates the graph above with the correct data.

## Goals plugin

Runn the following tests:

* Try to create/edit/delete Goals.
* In the main _Goals > Goals Overview_ page, check that reports load properly when menu items on the bottom left (under **Conversions overview by type of visit**) are clicked.

## Dashboard

Run the following tests:

* Move widgets around (Flash and non-Flash content) TODO: flash still appropriate?
* Delete a widget.
* Add a new widget.
* Check that you can quit modal dialogs by pressing 'esc' key.
* Make sure that already added widgets cannot be added again.

## Calendar

Check that:

* The currently selected period is highlighted in the calendar.
* Changing the date and period works.
* Selecting a date range works.
  * Check that all widgets in the dashboards load w/ a date range as well.

## Menu

Check that:

* Clicking on a main menu item should select the first submenu item.
* The current menu category should be colored even when the mouse isn't over it.
* There are no broken links in the menu/submenus.

## Refresh and Back button

Run the following tests:

* Select a submenu, press refresh and check that the page refreshes as expected for the same submenu, the same period and the same website (ie, nothing changes).
* Change the website, check that the selected menu item page does not change.
* Select two different submenus, press Back button and check the state is restored as expected.

## Language Selector

Check that:

* Clicking on the language selector shows the list of languages.
* Clicking on a language from the list reloads Piwik and loads the clicked language.
* A click outside the language selector hides the open language selector.

If this works, it should also work for the Website Selector (which uses same code).

## Feedback

Check that:

* Clicking on the feedback link opens a box with grey background and links to forum and FA.
* Clicking on _Contact the Piwik team_ should display a form with a dropdown and two input fields to send feedback.

Run the following tests:

* Send an invalid message (e.g., too short) and navigate back (using the left arrow in the feedback window)
* Test successfully sending a message.
* Close window; re-click on feedback link should open box with grey background and links to forum and FAQ; there should be no trace of the previous error/success message

## Widgetize

* Test one report visualization in Widgetize iframe mode.
* Test that the dashboard loads well in iframe mode.

## Custom Segment Editor

The custom segment editor is a critical piece of the Piwik User Interface. Login as the Super User and:

* Create a segment named "Hello '"world<test>end".
* Add a few AND/OR segments, drag and drop metrics from the left.
* Verify that the Auto Suggest fields are working on the INPUT values (should display a drop down of suggested values).
* Click on Save & Apply segment.
* Check that the **Loading data...** message is displayed, and a notice about custom segments taking a few minutes to process.
* Check that on page reload, the data for the segment is displayed. We recommend to test using _Visitors > Visitor Log_ as it makes it easy to visualize the visits.

At this stage you have created a custom segment. Now you can test:

* _Visitors > Real time map_, check it displays only visitors from the segment.
* Click on _Email & SMS_ reports. Add a new Email report. When creating the report, select the newly created segment.
  * Check that the Email report generated with the Custom Segment, contains the segment name at the top.
* Change the date in the calendar. Check that the selected segment does not change.

And maybe run some more advanced tests:

* Rename the segment name to a new name, and change one segment value to **@#$%^,&*(';:&lt;test&gt;Test**. After clicking Save & Apply, click [edit], the segment name and value should display correctly.
* Check in a few reports that data is displayed for the Custom Segment
  * in the table report visualization, open the row evolution popover and check that the data loaded is for the segmented visitor set.
  * The [Transition report](http://piwik.org/docs/transitions/) should load for segmented data as well.

## Embed / Widgetize

In the top menu click on _Widgetize_.

* Test that Dashboard works when widgetized here.
* Test that other reports work when widgetized here.

## Testing the installer

To view the installation screens, rename the file `config/config.ini.php` to `config/_config.ini.php`

Refresh Piwik: you will be prompted to install Piwik. Install in a new database or use a different prefix to go through the install steps.

## Testing the Updater

To test the updater process, first update the Piwik version number in the `core/Version.php` file, for example to 2.0-b100 (if you are using less than 2.0). Next, you need to create a new file in `core/Updates/2.0-b100.php`, copying an existing Update file for inspiration (rename the class to `Piwik_Updates_2_0_b100`).

Refresh Piwik and you should see the Update screen. If you click "Update" and need to test the Updater again, you can update the version Piwik thinks it is using with the SQL query (source: [FAQ](http://piwik.org/faq/how-to-update/#faq_179)):

    UPDATE `piwik_option` SET option_value = "1.X" WHERE option_name = "version_core";

## Done!

If all these tests pass, the UI is working properly.