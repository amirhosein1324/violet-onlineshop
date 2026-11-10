import os
import random
from datetime import datetime, timedelta

# Define date range (adjust the year if needed, currently set to 2026)
start_date = datetime(2026, 9, 11)
end_date = datetime(2026, 11, 11)

# File to modify for commits
log_file = "activity.log"

current_date = start_date
while current_date <= end_date:
    # Pick a random number of commits between 3 and 12 for this day
    num_commits = random.randint(3, 12)
    
    print(f"Generating {num_commits} commits for {current_date.strftime('%Y-%m-%d')}...")
    
    for _ in range(num_commits):
        # Pick a realistic random hour between 9 AM and 11 PM
        hour = random.randint(9, 23)
        minute = random.randint(0, 59)
        second = random.randint(0, 59)
        
        commit_time = current_date.replace(hour=hour, minute=minute, second=second)
        date_str = commit_time.strftime("%Y-%m-%d %H:%M:%S")
        
        # Make a small change to the log file
        with open(log_file, "a") as f:
            f.write(f"Activity update on {date_str}\n")
            
        # Stage and commit with custom author and committer dates
        os.system(f"git add {log_file}")
        
        commit_message = random.choice([
            "Refactor small component",
            "Update styles and layout",
            "Fix minor bug in storefront",
            "Optimize database query",
            "Update documentation",
            "Enhance UI micro-interactions",
            "Clean up unused assets"
        ])
        
        env_date = f'GIT_AUTHOR_DATE="{date_str}" GIT_COMMITTER_DATE="{date_str}"'
        os.system(f'{env_date} git commit -m "{commit_message}"')
        
    # Move to the next day
    current_date += timedelta(days=1)

print("✨ All fake commits generated successfully!")