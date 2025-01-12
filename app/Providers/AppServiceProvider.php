<?php

namespace App\Providers;

use App\Types\TinyIntegerType;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!Type::hasType('tinyinteger')) {
            Type::addType('tinyinteger', TinyIntegerType::class);
        }

        $platform = $this->app['db']->getDoctrineSchemaManager()->getDatabasePlatform();
        $platform->markDoctrineTypeCommented(Type::getType('tinyinteger'));
        Paginator::useBootstrap();
    }
}
