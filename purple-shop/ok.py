import os
import random
from datetime import datetime, timedelta

# Define date range (September 11 to November 11, 2026)
start_date = datetime(2026, 9, 11)
end_date = datetime(2026, 11, 11)

log_file = "activity.log"
current_date = start_date

while current_date <= end_date:
    num_commits = random.randint(3, 12)
    print(f"Generating {num_commits} commits for {current_date.strftime('%Y-%m-%d')}...")
    
    for _ in range(num_commits):
        hour = random.randint(9, 23)
        minute = random.randint(0, 59)
        second = random.randint(0, 59)
        
        commit_time = current_date.replace(hour=hour, minute=minute, second=second)
        date_str = commit_time.strftime("%Y-%m-%d %H:%M:%S")
        
        with open(log_file, "a") as f:
            f.write(f"Activity update on {date_str}\n")
            
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
        
        # Set environment variables securely via Python for Windows compatibility
        os.environ["GIT_AUTHOR_DATE"] = date_str
        os.environ["GIT_COMMITTER_DATE"] = date_str
        
        os.system(f'git commit -m "{commit_message}"')
        
    current_date += timedelta(days=1)

# Clear environment variables after completion
if "GIT_AUTHOR_DATE" in os.environ:
    del os.environ["GIT_AUTHOR_DATE"]
if "GIT_COMMITTER_DATE" in os.environ:
    del os.environ["GIT_COMMITTER_DATE"]

print("✨ All fake commits generated successfully with correct backdates!")