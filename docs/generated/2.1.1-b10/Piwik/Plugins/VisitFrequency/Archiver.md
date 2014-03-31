<small>Piwik\Plugins\VisitFrequency\</small>

Archiver
========

Introduced to provide backwards compatibility for pre-2.0 data.

Uses a segment to archive
data for day periods and aggregates this data for non-day periods.

We normally would want to just forward requests to the VisitsSummary API w/ the correctly
modified segment, but in order to combine pre-2.0 data with post-2.0 data, there has
to be a VisitFrequency Archiver. Otherwise, the VisitsSummary metrics archiving will
be called, and the pre-2.0 VisitFrequency data (which is not retrieved by VisitsSummary) will
be ignored.
