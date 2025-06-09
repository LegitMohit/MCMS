#!/bin/bash
set -e

# Function to update the .env file
update_env() {
    echo "Updating environment variables..."
    
    # Clear existing .env file
    > /var/www/.env
    
    # Add environment variables
    {
        echo "export DEBUG=${DEBUG:-false}"
        echo "export DATABASE_URL=${DATABASE_URL}"
        echo "export MYSQLHOST=${MYSQLHOST}"
        echo "export MYSQLPORT=${MYSQLPORT}"
        echo "export MYSQLUSER=${MYSQLUSER}"
        echo "export MYSQLPASSWORD=${MYSQLPASSWORD}"
        echo "export MYSQLDATABASE=${MYSQLDATABASE}"
    } >> /var/www/.env
    
    # Set proper permissions
    chown www-data:www-data /var/www/.env
    chmod 600 /var/www/.env
}

# Update environment variables
update_env

# Execute the main command
exec "$@" 