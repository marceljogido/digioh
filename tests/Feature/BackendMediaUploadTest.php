<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\ClientLogo\Models\ClientLogo;
use Modules\Post\Enums\PostStatus;
use Modules\Post\Models\Post;
use Modules\Slider\Models\Slider;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class BackendMediaUploadTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();

        Permission::firstOrCreate([
            'name' => 'view_backend',
            'guard_name' => 'web',
        ]);

        $user->givePermissionTo('view_backend');

        Gate::before(static function () {
            return true;
        });

        $this->actingAs($user);
    }

    public function test_client_logo_upload_uses_file_input(): void
    {
        Storage::fake('public');

        $response = $this->post(route('backend.clientlogos.store'), [
            'client_name' => 'Upload Test Inc',
            'logo' => UploadedFile::fake()->image('logo.png'),
            'website_url' => 'https://example.com',
            'is_active' => '1',
            'sort_order' => 1,
        ]);

        $response->assertRedirect(route('backend.clientlogos.index'));

        $logo = ClientLogo::first();
        $this->assertNotNull($logo);
        $this->assertStringStartsWith('/storage/', $logo->logo);

        $relative = ltrim(Str::after($logo->logo, '/storage/'), '/');
        Storage::disk('public')->assertExists($relative);
    }

    public function test_client_logo_update_replaces_previous_image(): void
    {
        Storage::fake('public');

        $initialPath = Storage::disk('public')->put('uploads/client-logos', UploadedFile::fake()->image('initial.png'));
        $logo = ClientLogo::create([
            'client_name' => 'Existing Client',
            'logo' => Storage::url($initialPath),
            'website_url' => 'https://example.com',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $response = $this->patch(route('backend.clientlogos.update', $logo), [
            'client_name' => 'Existing Client Updated',
            'logo' => UploadedFile::fake()->image('replacement.png'),
            'website_url' => 'https://example.com/profile',
            'is_active' => '0',
            'sort_order' => 3,
        ]);

        $response->assertRedirect(route('backend.clientlogos.show', $logo));

        $logo->refresh();
        $this->assertStringStartsWith('/storage/', $logo->logo);
        $this->assertSame('Existing Client Updated', $logo->client_name);
        $this->assertFalse((bool) $logo->is_active);
        $this->assertSame(3, $logo->sort_order);

        Storage::disk('public')->assertMissing($initialPath);
        $relative = ltrim(Str::after($logo->logo, '/storage/'), '/');
        Storage::disk('public')->assertExists($relative);
    }

    public function test_post_creation_stores_uploaded_cover_image(): void
    {
        Storage::fake('public');

        $response = $this->post(route('backend.posts.store'), [
            'name' => 'Sample Post',
            'slug' => 'sample-post',
            'intro' => 'Short intro',
            'content' => 'Full content goes here.',
            'image' => UploadedFile::fake()->image('cover.jpg'),
            'is_featured' => '1',
            'status' => PostStatus::Published->value,
            'published_at' => now()->format('Y-m-d H:i:s'),
        ]);

        $response->assertRedirect('admin/posts');

        $post = Post::where('slug', 'sample-post')->first();
        $this->assertNotNull($post);
        $this->assertStringStartsWith('/storage/', $post->image);

        $relative = ltrim(Str::after($post->image, '/storage/'), '/');
        Storage::disk('public')->assertExists($relative);
    }

    public function test_post_update_replaces_cover_image_when_new_file_uploaded(): void
    {
        Storage::fake('public');

        $existingPath = Storage::disk('public')->put('uploads/posts', UploadedFile::fake()->image('old-cover.jpg'));

        $post = Post::create([
            'name' => 'Editable Post',
            'slug' => 'editable-post',
            'intro' => 'Intro text',
            'content' => 'Content text',
            'image' => Storage::url($existingPath),
            'status' => PostStatus::Published->value,
            'is_featured' => true,
            'published_at' => now(),
        ]);

        $response = $this->patch(route('backend.posts.update', $post), [
            'name' => 'Editable Post Updated',
            'slug' => 'editable-post',
            'intro' => 'Intro text updated',
            'content' => 'Content text updated',
            'image' => UploadedFile::fake()->image('new-cover.jpg'),
            'status' => PostStatus::Published->value,
            'is_featured' => '0',
            'published_at' => now()->addDay()->format('Y-m-d H:i:s'),
        ]);

        $response->assertRedirect(route('backend.posts.show', $post));

        $post->refresh();
        $this->assertSame('Editable Post Updated', $post->name);
        $this->assertFalse((bool) $post->is_featured);
        $this->assertStringStartsWith('/storage/', $post->image);

        Storage::disk('public')->assertMissing($existingPath);
        $relative = ltrim(Str::after($post->image, '/storage/'), '/');
        Storage::disk('public')->assertExists($relative);
    }

    public function test_slider_creation_with_uploaded_image(): void
    {
        Storage::fake('public');

        $response = $this->post(route('backend.sliders.store'), [
            'title' => 'Hero Banner',
            'subtitle' => 'Sub headline',
            'button_text' => 'Selengkapnya',
            'button_link' => '/layanan',
            'image' => UploadedFile::fake()->image('slider.jpg', 1600, 900),
            'is_active' => '1',
            'sort_order' => 2,
        ]);

        $response->assertRedirect(route('backend.sliders.index'));

        $slider = Slider::where('title', 'Hero Banner')->first();

        $this->assertNotNull($slider);
        $this->assertSame('Selengkapnya', $slider->button_text);
        $this->assertSame('/layanan', $slider->button_link);
        $this->assertEquals(2, $slider->sort_order);
        $this->assertStringStartsWith('/storage/', $slider->image);

        $relative = ltrim(Str::after($slider->image, '/storage/'), '/');
        Storage::disk('public')->assertExists($relative);
    }

    public function test_slider_update_replaces_image_when_new_file_uploaded(): void
    {
        Storage::fake('public');

        $initialPath = Storage::disk('public')->put('uploads/sliders', UploadedFile::fake()->image('initial.jpg'));
        $slider = Slider::create([
            'title' => 'Existing Banner',
            'subtitle' => 'Subtitle',
            'button_text' => 'Contact',
            'button_link' => '/contact',
            'image' => Storage::url($initialPath),
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $response = $this->patch(route('backend.sliders.update', $slider), [
            'title' => 'Existing Banner Updated',
            'subtitle' => 'Subtitle Updated',
            'button_text' => 'Hubungi Kami',
            'button_link' => 'https://example.com/contact',
            'image' => UploadedFile::fake()->image('replacement.jpg', 1600, 900),
            'is_active' => '0',
            'sort_order' => 5,
        ]);

        $response->assertRedirect(route('backend.sliders.show', $slider));

        $slider->refresh();
        $this->assertSame('Existing Banner Updated', $slider->title);
        $this->assertSame('Subtitle Updated', $slider->subtitle);
        $this->assertSame('Hubungi Kami', $slider->button_text);
        $this->assertSame('https://example.com/contact', $slider->button_link);
        $this->assertEquals(5, $slider->sort_order);
        $this->assertFalse((bool) $slider->is_active);
        $this->assertStringStartsWith('/storage/', $slider->image);

        Storage::disk('public')->assertMissing($initialPath);
        $relative = ltrim(Str::after($slider->image, '/storage/'), '/');
        Storage::disk('public')->assertExists($relative);
    }
}
