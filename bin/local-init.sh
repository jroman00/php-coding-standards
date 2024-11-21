#!/usr/bin/env bash

set -e

readonly PARENT_DIR=$(cd $(dirname "${BASH_SOURCE[0]}") && pwd -P)
readonly APP_DIR=$(cd $(dirname "$PARENT_DIR") && pwd -P)

# Main functionality of the script
main() {
  echo "Initializing repo..."

  (
    # Make sure script is running from the main application directory
    cd $APP_DIR

    # Build images
    echo "Building images..."
    docker compose build

    # Install dependencies
    echo "Installing dependencies..."
    docker compose run --rm jroman00.php-coding-standards composer install
  )

  echo "Repo initialized successfully!"
}

# Function that outputs usage information
usage() {
  cat <<EOF

Usage: bash $BIN_ROOT/$(basename $0) <options>

Script used to initialize this application

Options:
  -h, --help              Print this message and quit
EOF
}

# Parse input options
while getopts ":h-:" opt; do
  case "$opt" in
    h) usage && exit 0;;
    -)
      case "${OPTARG}" in
        help) usage && exit 0;;
        *) echo "Invalid option: --$OPTARG." && usage && exit 1;;
      esac
    ;;
    \?) echo "Invalid option: -$OPTARG." && usage && exit 1;;
    :) echo >&2 "Option -$OPTARG requires an argument." && exit 1;;
  esac
done

# Execute main functionality
main
