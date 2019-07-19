# Rudwolf Composer Wordpress Template v0.1

This repository contains a [Composer](https://getcomposer.org/) package with the base installation for Wordpress Projects using single site installation. Follow the instructions to use it to install wordpress on a server or local environment. Fork it and use it on your own project ;)

1. Clone the repository.
2. Open `Vagrantfile` and edit line 8: `config.vm.hostname = "wpsite.local"` to have a pertinent LOCAL domain.
3. `cd /path/to/project/folder/ && vagrant up`
4. `vagrant ssh -- -A` to ssh into the vagrant machine passing your credentials.
    * The next step will clone protected repositories into the project, which is why you need to pass your ssh key into vagrant.
5. `cd /var/www/public && composer install`
6. Create `project-config.php` and `local-config.php`, as needed, copy them from the samples included in the repo.
7. Go to `http://wpsite.local/` and follow Wordpress install instructions.
8. Test your installation.
9. * Make sure to include `/composer.lock` file in the repository to keep dependencies' version synchronized between environments if you're using this repo to deploy your site.
1. If all went well, delete this readme.md file or write your own.

## Folder Structure

##### /public/content:
Namely wp_contents. All content for the project will go here, including plugins. Important consideartions:
* /uploads and /upgrade have been both added to .gitignore
* /themes will contain all the themes. In case you are using a pre-purchased theme, use a child theme.
* /plugins will contain all plugins. Keep in mind that when possible, these should be added as a composer dependency.

## Pointing to the right direc~~tion~~tory

The project works better at root domain level and the `/public` directory is supposed to be the webroot.

1. On local development environments, you can configure a VirtualHost and point DocumentRoot to the `/public` directory

```
<VirtualHost *:80>
  DocumentRoot "{project_dir}/public/"
    ServerName {project_url}
</VirtualHost>
```

2. If on a shared hosting or any other environment where you can't control DocumentRoot you can use this approach:
    * Install the project on a private directory (i.e. `/home/{username}/{project_dir}`)
    * Delete the `public_html` directory (or any other name the webroot may have)
    * Create a symlink to virtually point `public_html` to the project's `/public` directory

```
ln -s  /home/{username}/{project_dir}/public public_html
```
## Installing Extra Dependencies (Plugins and Themes)

1. WordPress' free plugins and themes directories are mirrored as composer packages at [WPackagist.org](https://wpackagist.org/). To install them in the project:
    * Use WPackagist search to confirm the dependency is there (for instance, you will find `https://wordpress.org/themes/twentytwelve/` searching for `twentytwelve`)
    * You can add the dependency to the composer.json file copying from WPackagist directory and then run `composer update` at the project's root directory
    OR
    * From the project's root directory run `composer require wpackagist-[type]/[dependency]` (for instance, `composer require wpackagist-theme/twentytwelve` or `composer require wpackagist-plugin/akismet`)
    * After confirmation, be sure to commit `/composer.json` and `/composer.lock` files to the repository
1. Custom made or commercial plugins and themes need to be tracked in the repository:
    * Copy/create the plugin or theme files into the right subdirectory of `/public/content`
    * Edit `/.gitignore` to include the exception (for instance `!public/content/themes/my-child-theme`)
    * Commit changes to the repository, use it and re-use it! `\_o_/`
