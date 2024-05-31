#!/bin/bash

# Ask the user for the new version number
read -p "Enter the new version: " new_version

# Check if the new version is provided
if [[ -z "$new_version" ]]; then
  echo "You must provide a new version!"
  exit 1
fi

echo "v$new_version" >.github/.version

# Define the files to update
files_to_update=("composer.json" "package.json" "style.css")

# Loop through the files and update the version
for file in "${files_to_update[@]}"; do
  if [[ -f "$file" ]]; then
    if [[ "$file" == "style.css" ]]; then
      sed -i '' -E "s/(Version: )[0-9]+\.[0-9]+\.[0-9]+/\1$new_version/" "$file"
    else
      sed -i '' -E "s/(\"version\": \")[0-9]+\.[0-9]+\.[0-9]+\"/\1$new_version\"/" "$file"
    fi
  else
    echo "Warning: File $file does not exist and was not updated."
  fi
done

# Commit the changes with the provided message
git add "${files_to_update[@]}"
git commit -m "chore(🚀): bump project version"

echo "Version updated to $new_version and committed to git."
