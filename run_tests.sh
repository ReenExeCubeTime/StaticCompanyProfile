#!/bin/bash
rm -rf storage
php bin/console scp:scrap:page
php vendor/bin/phpunit