<?php

declare(strict_types=1);

use Cake\Utility\Inflector;
use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class ArticlesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 100; $i++) {
            $title = Inflector::humanize($faker->words($faker->randomElement([2, 3, 4]), true));

            $body = $faker->paragraphs($faker->randomElement([2, 3, 4, 5]), true);

            $data[] = compact('title', 'body');
        }

        $table = $this->table('articles');

        $table->truncate();

        $table->insert($data)->save();
    }
}
