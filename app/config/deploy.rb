set :application, "paster"
set :domain,      "app1"
set :user, 'root'
set :deploy_to,   "/var/www/paster"
set :repository,  "git@github.com:peinwag/urlpaster.git"
set :scm,         :git
set :deploy_via, :remote_cache
set :model_manager, "doctrine"
set :keep_releases,  3
set :use_composer, true
set :use_sudo, false
set :writable_dirs,       ["app/cache", "app/logs"]
set :permission_method, :acl
set :webserver_user,      "www-data"
set :use_set_permissions, true
set :dump_assetic_assets, true
set  :keep_releases,  3

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

# Be more verbose by uncommenting the following line
 logger.level = Logger::MAX_LEVEL
