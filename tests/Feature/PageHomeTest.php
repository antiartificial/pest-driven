<?php

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('shows courses overview', function () {
    // Arrange
    Course::factory()->create(['title'=>'Course A', 'description' => 'Description course A', 'released_at' => Carbon::now()]);
    Course::factory()->create(['title'=>'Course B', 'description' => 'Description course B', 'released_at' => Carbon::now()]);
    Course::factory()->create(['title'=>'Course C', 'description' => 'Description course C', 'released_at' => Carbon::now()]);

    // Act
    get(route('home'))->assertSeeText([
        'Course A',
        'Description course A',
        'Course B',
        'Description course B',
        'Course C',
        'Description course C'
    ]);
});

it('shows only released courses', function() {
    // Arrange
    Course::factory()->create(['title'=>'Course A', 'released_at' => Carbon::yesterday()]);
    Course::factory()->create(['title'=>'Course B']);

    // Act
    get(route('home'))->assertSeeText([
            'Course A'
        ])->assertDontSeeText([
            'Course B'
        ]);
});

it('shows by release order', function() {
    // Arrange, the one we don't want to see first, to ensure order
    Course::factory()->create(['title'=>'Course A', 'released_at' => Carbon::yesterday()]);
    Course::factory()->create(['title'=>'Course B', 'released_at' => Carbon::now()]);

    // Act & Assert specific order
    get(route('home'))->assertSeeTextInOrder([
        'Course B',
        'Course A'
    ]);
});
