set :application, "fixthatcode"
set :domain,      "#{application}.com"
set :serverName,   "ftc" # The server's hostname
set :user,        "rdohms"
ssh_options[:port] = "22123"

set :deploy_to,   "/var/www/vhosts/fixthatcode.com/"
set :app_path,    "app"

set :repository,  "git@github.com:rdohms/fixthatcode.com.git"
set :scm,         :git
set :deploy_via,  :rsync_with_remote_cache

set :model_manager, "doctrine"

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain                         # This may be the same as your `Web` server
role :db,         domain, :primary => true       # This is where Rails migrations will run

set  :keep_releases,  3

set  :use_sudo,       false
set  :use_composer,   true
#set  :update_vendors, true

# Set some paths to be shared between versions
set :shared_files,    ["app/config/parameters.yml"]
set :shared_children, [app_path + "/logs", web_path + "/uploads", "vendor"]
