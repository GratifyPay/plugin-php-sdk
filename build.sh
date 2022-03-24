#! /bin/bash
zip -r plugin-php-sdk.zip ./ -x "*.git*" -x "*.docker*" -x "examples*" -x "vendor*"
