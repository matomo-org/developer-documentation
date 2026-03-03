#!/bin/bash

# Run a composer audit and email the results out
# This should be run by a cron job
#25 3 * * * cd /path/to/dir/app && bash /path/to/dir/app/composer-audit.sh  notification@example.com >/dev/null 2>&1

email=$1
auditcount=$(composer audit -fjson | jq -r '.advisories | length')

if [ $auditcount -eq 0 ]; then
    exit;
fi

composer audit -ftable | mail -s "Security issue found on developer.matomo.org" $email
