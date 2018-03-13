#!/bin/sh
LDFLAGS="-L/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common/lib $LDFLAGS"
export LDFLAGS
CFLAGS="-I/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common/include/ImageMagick -I/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common/include $CFLAGS"
export CFLAGS
CXXFLAGS="-I/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common/include $CXXFLAGS"
export CXXFLAGS
		    
PKG_CONFIG_PATH="/Users/akhoucha/Documents/akhoucha/Applications/mampstack-7.1.13-0/common/lib/pkgconfig"
export PKG_CONFIG_PATH
