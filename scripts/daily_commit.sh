#!/usr/bin/env bash
set -euo pipefail

DURATION_DAYS=30
START_FILE="start_date.txt"
LOG_FILE="activity.log"

if [ ! -f "$START_FILE" ]; then
  date -u +%Y-%m-%d > "$START_FILE"
  git add "$START_FILE"
  git commit -m "Set start date"
fi

START_DATE=$(cat "$START_FILE")
START_EPOCH=$(date -u -d "$START_DATE" +%s)
TODAY_EPOCH=$(date -u +%s)
DAYS_ELAPSED=$(( (TODAY_EPOCH - START_EPOCH) / 86400 ))

if [ "$DAYS_ELAPSED" -ge "$DURATION_DAYS" ]; then
  echo "30-day window is over (day $DAYS_ELAPSED). Nothing to do."
  exit 0
fi

COUNT=$(( (RANDOM % 20) + 1 ))
echo "Day $DAYS_ELAPSED of $DURATION_DAYS: making $COUNT commit(s)."

for i in $(seq 1 "$COUNT"); do
  echo "$(date -u +'%Y-%m-%dT%H:%M:%SZ') - commit $i of $COUNT" >> "$LOG_FILE"
  git add "$LOG_FILE"
  git commit -m "Daily update ($i/$COUNT)" --quiet
done

echo "Done."