<?php

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('shows courses overview', function () {
    // Arrange
    Course::factory()->create(['title'=>'Course A', 'description' => 'Description course A']);
    Course::factory()->create(['title'=>'Course B', 'description' => 'Description course B']);
    Course::factory()->create(['title'=>'Course C', 'description' => 'Description course C']);

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

});

it('shows by release order', function() {

});
