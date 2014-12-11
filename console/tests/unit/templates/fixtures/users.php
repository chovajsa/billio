<?php 
return [
    [
        'table_column0' => 'faker_formatter',
        ...
        'table_columnN' => 'other_faker_formatter'
        'body' => function ($fixture, $faker, $index) {
            //set needed fixture fields based on different conditions

            $fixture['body'] = $faker->sentence(7,true); //generate sentence exact with 7 words.
            return $fixture;
        }
    ],
];