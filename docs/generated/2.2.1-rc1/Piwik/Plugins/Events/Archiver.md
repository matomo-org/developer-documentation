<small>Piwik\Plugins\Events\</small>

Archiver
========

Processing reports for Events

EVENT
   - Category
   - Action
   - Name
   - Value

   METRICS (Events Overview report)
   - Total number of events
   - Unique events
   - Visits with events
   - Events/visit
   - Event value
   - Average event value AVG(custom_float)

   MAIN REPORTS:
   - Top Event Category (total events, unique events, event value, avg+min+max value)
   - Top Event Action   (total events, unique events, event value, avg+min+max value)
   - Top Event Name     (total events, unique events, event value, avg+min+max value)

   COMPOSED REPORTS
   - Top Category > Actions     X
   - Top Category > Names       X
   - Top Actions  > Categories  X
   - Top Actions  > Names       X
   - Top Names    > Actions     X
   - Top Names    > Categories  X

   UI
   - Overview at the top (graph + Sparklines)
   - Below show the left menu, defaults to Top Event Category

   Not MVP:
   - On hover on any row: Show % of total events
   - Add min value metric, max value metric in tooltip
   - List event scope Custom Variables Names > Custom variables values > Event Names > Event Actions
   - List event scope Custom Variables Value > Event Category > Event Names > Event Actions

   NOTES:
   - For a given Name, Category is often constant
