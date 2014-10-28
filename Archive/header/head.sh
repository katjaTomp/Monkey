#!/bin/bash
php header.php final.xlsx
mv navigation-out.xml ../upload/
cd ../upload
php up.php -e staging -b adidas -u stegetho -p adidas123 -t assets -f navigation-out.xml
//php up.php -e development -b adidas -u stegetho -p spring15 -t assets -f navigation-out.xml
