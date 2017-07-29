-starter-theme wp-content/themes/PHONY:  default

default: clean wordpress wp-cli database install config
	@echo "\n\nNOTICE: You may need to configure a MySQL database for your Wordpress installation. Just run:"
	@echo " mysql -u root -p;"
	@echo " CREATE DATABASE brwp_projectname; \n"

wordpress: latest.tar.gz
	tar -zxvf latest.tar.gz;
	rm -rf wordpress/wp-content;
	mv wordpress/* ./;
	rm -rf latest.tar.gz wordpress license.txt readme.html wp-content/plugins/akismet wp-content/plugins/hello.php;
	mkdir -p wp-content/plugins;

latest.tar.gz:
	curl -LOk http://wordpress.org/latest.tar.gz;

database:
	@echo "Create your database, then exit to continue:"
	mysql -u root -p;

install:
	@echo " CREATE DATABASE teledent_wp; \n"
	@printf 'What is the project slug? (e.g. shr, axonify, farber ): '; \
	read SLUG_VAR; \
	wp core config --dbhost=127.0.0.1 --dbname=$$SLUG_VAR --dbuser=root --dbpass=root; \
	wp core install --url="http://$$SLUG_VAR.dev" --title="$$SLUG_VAR WordPress" --admin_name=vars_admin --admin_email=info@thevariables.com --admin_password=rnDhUfOX@dPkLE*e;

config:
	wp plugin install add-to-any advanced-access-manager advanced-custom-fields custom-post-type-ui duplicate-post googleanalytics mailchimp regenerate-thumbnails relevanssi simple-301-redirects svg-support taxonomy-terms-order theme-check welcome-email-editor wordpress-seo wp-all-import wp-optimize yoast-seo-acf-analysis --activate;
	wp rewrite structure "/%year%/%monthnum%/%postname%/";

startcoding:
	cd wp-content/themes/brbp-child-theme/src;
	sudo npm install && npm update;
	bower install;
	subl wp-config-sample.php;
	gulp;
	@echo " All done! Don't forget to rm .git and git remote add origin git@bitbucket.org:gocactus/projectname.git"

wp-cli:
	mkdir -p wp-cli && cd wp-cli;
	curl -LOk https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar;
	php wp-cli.phar --info
	chmod +x wp-cli.phar;
	sudo mv wp-cli.phar /usr/local/bin/wp;
	ln -s ./wp-cli/bin/wp wp

clean:
	rm -rf wp-config.php wp-content wp-admin wp-includes readme.html license.txt wp-activate.php wp-login.php wp-trackback.php wp-blog-header.php wp-cron.php wp-mail.php wp-comments-post.php wp-links-opml.php wp-settings.php wp-load.php wp-signup.php xmlrpc.php index.php;
	rm -rf latest.tar.gz wordpress;
	rm -rf wp wp-cli phpunit;

deploy:
	git checkout master && git merge development && git checkout development && git push --all

help:
	@echo "Makefile usage:"
	@echo " make \t\t Get Wordpress application files"
	@echo " make clean \t Delete Wordpress files"
	@echo " make deploy \t Merge development branch into master and push all"
