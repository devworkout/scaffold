@servers( [ 'localhost' => '127.0.0.1', 'website' => 'root@nasa.gov' ] )

@story('deploy', ['on' => 'website'])
git
composer
@endstory

@story('redeploy', ['on' => 'website'])
git
composer
reseed
@endstory

@task('up', ['on' => 'localhost'])
sudo docker-compose up -d --build
@endtask

@task('down', ['on' => 'localhost'])
sudo docker-compose down
@endtask

@task('workspace', ['on' => 'localhost'])
sudo docker-compose exec --user=laradock workspace bash
@endtask

@task('tail', ['on' => 'website'])
tail -f -n 50 /work/serpentine/storage/logs/caddy/access.log
@endtask

@task('git', ['on' => 'website'])
git stash; git pull origin master
@endtask

@task('composer')
docker-compose exec -T website__workspace bash -c "composer install --no-dev"
@endtask

@task('reseed')
docker-compose exec -T website__workspace bash -c "php artisan migrate:fresh --seed"
@endtask