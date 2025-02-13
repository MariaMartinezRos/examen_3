<?php
use App\Models\User;
use App\Models\Course;
use App\Models\Video;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;


beforeEach(function () {
    // Crear roles
    Role::firstOrCreate(['name' => 'admin']);
    Role::firstOrCreate(['name' => 'cliente']);

    // Crear usuario admin
    $this->admin = User::factory()->create();
    $this->admin->assignRole('admin');

    // Crear usuario cliente
    $this->cliente = User::factory()->create();
    $this->cliente->assignRole('cliente');

    // Crear un curso de prueba
    $this->course = Course::factory()->create();
});

test('un administrador puede crear un vídeo', function () {
    $this->actingAs($this->admin)
        ->post(route('admin.videos.store'), [
            'title' => 'Mi primer vídeo',
            'course_id' => $this->course->id,
            'url' => 'https://example.com/video.mp4'
        ])
        ->assertRedirect(route('admin.videos.index'));

    $this->assertDatabaseHas('videos', [
        'title' => 'Mi primer vídeo',
        'slug' => 'mi-primer-video',
        'course_id' => $this->course->id,
    ]);
})->todo();

test('un usuario cliente NO puede crear un vídeo', function () {
    $this->actingAs($this->cliente)
        ->post(route('admin.videos.store'), [
            'title' => 'Vídeo no autorizado',
            'course_id' => $this->course->id,
            'url' => 'https://example.com/video.mp4'
        ])
        ->assertForbidden();
})->todo();

test('un administrador puede actualizar un vídeo', function () {
    $video = Video::factory()->create(['course_id' => $this->course->id]);

    $this->actingAs($this->admin)
        ->put(route('admin.videos.update', $video), [
            'title' => 'Nuevo título',
            'course_id' => $this->course->id,
            'url' => 'https://example.com/new-video.mp4'
        ])
        ->assertRedirect(route('admin.videos.index'));

    $this->assertDatabaseHas('videos', [
        'id' => $video->id,
        'title' => 'Nuevo título',
    ]);
})->todo();

test('un usuario cliente NO puede actualizar un vídeo', function () {
    $video = Video::factory()->create(['course_id' => $this->course->id]);

    $this->actingAs($this->cliente)
        ->put(route('admin.videos.update', $video), [
            'title' => 'Intento de hackeo',
            'course_id' => $this->course->id,
            'url' => 'https://example.com/hackeo.mp4'
        ])
        ->assertForbidden();
})->todo();

test('un administrador puede eliminar un vídeo', function () {
    $video = Video::factory()->create(['course_id' => $this->course->id]);

    $this->actingAs($this->admin)
        ->delete(route('admin.videos.destroy', $video))
        ->assertRedirect(route('admin.videos.index'));

    $this->assertDatabaseMissing('videos', ['id' => $video->id]);
})->todo();

test('un usuario cliente NO puede eliminar un vídeo', function () {
    $video = Video::factory()->create(['course_id' => $this->course->id]);

    $this->actingAs($this->cliente)
        ->delete(route('admin.videos.destroy', $video))
        ->assertForbidden();

    $this->assertDatabaseHas('videos', ['id' => $video->id]);
})->todo();
