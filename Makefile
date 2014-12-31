# Makefile
#
# Local requirements: git, ssh
#

# load defaults
-include .Makefile.defaults

# configuration

.PHONY: help clean init

help:
	@echo "Usage: {options} make [target ...]"
	@echo
	@echo "Remote-only:"
	@echo "  init            Initialize code"

clean:
	@git clean -d -f --exclude=.env --exclude=.Makefile.defaults -x

init:
	@-composer install
