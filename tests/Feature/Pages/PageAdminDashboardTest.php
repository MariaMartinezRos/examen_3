<?php

use App\Models\Course;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Carbon;

use Spatie\Permission\Models\Role;
use function Pest\Laravel\get;

beforeEach(function () {
    Role::firstOrCreate(['name' => 'client']);
});

it('cannot be accessed by guest', function () {
    // Act & Assert
    get(route('pages.dashboard'))
        ->assertRedirect(route('login'));
});

it('lists total courses', function () {
    // Arrange
    $user = User::factory()
        ->has(Course::factory()->count(2)->state(
            new Sequence(
                ['title' => 'Course A'],
                ['title' => 'Course B'],
            )), 'purchasedCourses')
        ->create();

    // Act & Assert
    loginAsUser($user);
    get(route('pages.admin-dashboard'))
        ->assertOk()
        ->assertSeeText([
            'Total Courses',
            '2',
        ]);
});

it('lists total videos', function () {
    // Arrange
    $user = User::factory()
        ->has(Course::factory()->count(2)->state(
            new Sequence(
                ['title' => 'Course A'],
                ['title' => 'Course B'],
            )), 'purchasedCourses')
        ->create();

    $course = $user->purchasedCourses[0];

    Video::factory()->count(2)->state(
        new Sequence(
            ['title' => 'Video A', 'course_id' => $course->id],
            ['title' => 'Video B', 'course_id' => $course->id],
        )
    )->create();

    // Act & Assert
    loginAsUser($user);
    get(route('pages.admin-dashboard'))
        ->assertOk()
        ->assertSeeText([
            'Total Videos',
            '2',
        ]);
});

it('lists total users', function () {
    // Arrange
    $adminRole = Role::create(['name' => 'admin']);

    $client = User::factory()->create();
    $client->assignRole('client');

    $admin = User::factory()->create();
    $admin->assignRole($adminRole);

    // Act & Assert
    loginAsUser($admin);
    get(route('pages.admin-dashboard'))
        ->assertOk()
        ->assertSeeText([
            'Total Users',
            '1',
        ]);
});

it('includes link to create courses', function () {
    // Arrange
    $user = User::factory()->create();

    // Act & Assert
    loginAsUser($user);
    get(route('pages.admin-dashboard'))
        ->assertOk()
        ->assertSeeText('Create Course');
//        ->assertSee(route('#', Course::first()));
});

it('includes link to create videos', function () {
    // Arrange
    $user = User::factory()->create();

    // Act & Assert
    loginAsUser($user);
    get(route('pages.admin-dashboard'))
        ->assertOk()
        ->assertSeeText('Create Video');
//        ->assertSee(route('#', Video::first()));
});

it('includes logout', function () {
    // Act & Assert
    loginAsUser();
    get(route('pages.admin-dashboard'))
        ->assertOk()
        ->assertSeeText('Log Out')
        ->assertSee(route('logout'));
});
