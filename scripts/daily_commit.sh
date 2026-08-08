#!/usr/bin/env bash
# Run this ONCE from the root of your repo (X:\violet-onlineshop), in Git Bash.
set -euo pipefail

LOG_FILE="activity.log"

# --- Configure your date ranges here (YYYY-MM-DD) ---
RANGES=(
  "2026-05-01 2026-07-12"
  "2026-08-08 2026-08-15"
)

commit_for_date() {
  local d="$1"
  local count=$(( (RANDOM % 20) + 1 ))
  echo "Backfilling $d with $count commit(s)..."
  for i in $(seq 1 "$count"); do
    # Spread commit times randomly through the day (09:00-21:00)
    hour=$(( (RANDOM % 12) + 9 ))
    minute=$(( RANDOM % 60 ))
    second=$(( RANDOM % 60 ))
    ts=$(printf "%sT%02d:%02d:%02d" "$d" "$hour" "$minute" "$second")

    echo "$ts - commit $i of $count" >> "$LOG_FILE"
    git add "$LOG_FILE"

    GIT_AUTHOR_DATE="$ts" GIT_COMMITTER_DATE="$ts" \
      git commit -m "Update ($i/$count)" --quiet --date="$ts"
  done
}

for range in "${RANGES[@]}"; do
  start=$(echo "$range" | cut -d' ' -f1)
  end=$(echo "$range" | cut -d' ' -f2)

  d="$start"
  while [ "$(date -d "$d" +%s)" -le "$(date -d "$end" +%s)" ]; do
    commit_for_date "$d"
    d=$(date -d "$d + 1 day" +%Y-%m-%d)
  done
done

echo ""
echo "All done. Review with: git log --oneline"
echo "Then push with: git push"