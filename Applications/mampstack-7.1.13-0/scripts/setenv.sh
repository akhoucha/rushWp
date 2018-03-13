#!/bin/sh
echo $PATH | egrep "/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common" > /dev/null
if [ $? -ne 0 ] ; then
PATH="/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/git/bin:/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/sqlite/bin:/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/php/bin:/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/mysql/bin:/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/apache2/bin:/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common/bin:$PATH"
export PATH
fi
echo $DYLD_FALLBACK_LIBRARY_PATH | egrep "/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common" > /dev/null
if [ $? -ne 0 ] ; then
DYLD_FALLBACK_LIBRARY_PATH="/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/git/lib:/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/sqlite/lib:/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/mysql/lib:/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/apache2/lib:/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common/lib:/usr/local/lib:/lib:/usr/lib:$DYLD_FALLBACK_LIBRARY_PATH"
export DYLD_FALLBACK_LIBRARY_PATH
fi

TERMINFO=/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common/share/terminfo
export TERMINFO
##### GIT ENV #####
GIT_EXEC_PATH=/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/git/libexec/git-core/
export GIT_EXEC_PATH
GIT_TEMPLATE_DIR=/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/git/share/git-core/templates
export GIT_TEMPLATE_DIR
GIT_SSL_CAINFO=/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common/openssl/certs/curl-ca-bundle.crt
export GIT_SSL_CAINFO

##### SQLITE ENV #####
			
##### GHOSTSCRIPT ENV #####
GS_LIB="/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common/share/ghostscript/fonts"
export GS_LIB
##### IMAGEMAGICK ENV #####
MAGICK_HOME="/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common"
export MAGICK_HOME

MAGICK_CONFIGURE_PATH="/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common/lib/ImageMagick-6.9.8/config-Q16:/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common/"
export MAGICK_CONFIGURE_PATH

MAGICK_CODER_MODULE_PATH="/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common/lib/ImageMagick-6.9.8/modules-Q16/coders"
export MAGICK_CODER_MODULE_PATH

##### FONTCONFIG ENV #####
FONTCONFIG_PATH="/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common/etc/fonts"
export FONTCONFIG_PATH
SASL_CONF_PATH=/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common/etc
export SASL_CONF_PATH
SASL_PATH=/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common/lib/sasl2 
export SASL_PATH
LDAPCONF=/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common/etc/openldap/ldap.conf
export LDAPCONF
##### PHP ENV #####
PHP_PATH=/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/php/bin/php
COMPOSER_HOME=/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/php/composer
export PHP_PATH
export COMPOSER_HOME
##### MYSQL ENV #####

##### APACHE ENV #####

##### FREETDS ENV #####
FREETDSCONF=/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common/etc/freetds.conf
export FREETDSCONF
FREETDSLOCALES=/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common/etc/locales.conf
export FREETDSLOCALES
##### CURL ENV #####
CURL_CA_BUNDLE=/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common/openssl/certs/curl-ca-bundle.crt
export CURL_CA_BUNDLE
##### SSL ENV #####
SSL_CERT_FILE=/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common/openssl/certs/curl-ca-bundle.crt
export SSL_CERT_FILE
OPENSSL_CONF=/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common/openssl/openssl.cnf
export OPENSSL_CONF
OPENSSL_ENGINES=/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common/lib/engines
export OPENSSL_ENGINES


. /Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/scripts/build-setenv.sh
