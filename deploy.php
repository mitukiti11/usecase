<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'usecase');

// Project repository
set('repository', 'git@github.com:mitukiti11/usecase.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
set('shared_files', []);
set('shared_dirs', []);

// Writable dirs by web server 
set('writable_dirs', []);

set('ssh_type', 'native');
set('ssh_multiplexing', false);

// Hosts
// stg
host('133.130.115.140')
	->forwardAgent()
	->stage('staging')
	->user('root')
	->port('22')
	->identityFile('~/.ssh/github_mitukiti11.pem')
	->set('deploy_path', '/var/www/html/{{application}}/staging');


// Tasks
desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
