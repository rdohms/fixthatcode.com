#!/bin/sh

cd $(dirname $0)

BASEDIR=$(pwd)
NOW=$(date +"%d-%m-%Y_%k%M")
STAGING_DIR=$BASEDIR/staging-dir
PACKAGE_DIR=$BASEDIR/packages

echo "Building Podtrack"

mkdir $STAGING_DIR
mkdir $PACKAGE_DIR

## clone repo
echo "Cloning into $STAGING_DIR"
git clone git@github.com:rdohms/fixthatcode.com.git $STAGING_DIR

## move into repo
echo "Moving into $STAGING_DIR"
cd $STAGING_DIR

## checkout proper version
echo "Which tag/version, followed by [ENTER]:"
read BRANCH

git pull
git fetch --tags
git co $BRANCH

## Bundle config
echo "Bundle config"
cp $BASEDIR/config/production.yml $STAGING_DIR/app/config/parameters.yml

## Composer install w/ cache
echo "Composer install"
export SYMFONY_ENV=prod && composer install --prefer-dist --optimize-autoloader -n

### NPM deps
#echo "NPM install"
#npm install
#
### Assets
#echo "Gulp Build"
#gulp build

## Package
echo "Packaging..."
COPYFILE_DISABLE=1 tar --exclude="./.git" --exclude="./node_modules" --exclude="./vendor/bower_components" --exclude="./ansible" --exclude="./app/cache" --exclude="./app/logs"  --exclude="./web/media" -czf $PACKAGE_DIR/podtrack-$BRANCH-$NOW.tar.gz ./

## Move out
echo "Back into base"
cd $BASEDIR

echo "Packaged at $PACKAGE_DIR/ftc-$BRANCH-$NOW.tar.gz"
