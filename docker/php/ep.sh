#!/usr/bin/env sh

if [ -f /init.sh ]; then
    echo "Running init.sh"
    sh /init.sh &
fi

echo "Executing: $@"
exec "$@"