<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Modules\OurWork\Models\OurWork;
use Tests\TestCase;

class BackendOurWorkManagementTest extends TestCase
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

        $this->actingAs($user);

        Gate::before(static function () {
            return true;
        });
    }

    public function test_our_work_store_requires_name(): void
    {
        $response = $this->from('/admin/our-works/create')->post('/admin/our-works', [
            'slug' => 'our-work-slug',
        ]);

        $response->assertRedirect('/admin/our-works/create');
        $response->assertSessionHasErrors('name');

        $this->assertDatabaseMissing('our_works', ['slug' => 'our-work-slug']);
    }

    public function test_our_work_store_filters_unexpected_fields(): void
    {
        $response = $this->post('/admin/our-works', [
            'name' => 'Landing Page',
            'slug' => 'landing-page',
            'icon_class' => 'fa-solid fa-star',
            'featured_on_home' => true,
            'unexpected' => 'should-not-be-saved',
        ]);

        $response->assertRedirect('/admin/ourworks');

        $ourWork = OurWork::where('slug', 'landing-page')->first();

        $this->assertNotNull($ourWork);
        $this->assertSame('Landing Page', $ourWork->name);
        $this->assertTrue((bool) $ourWork->featured_on_home);
        $this->assertArrayNotHasKey('unexpected', $ourWork->getAttributes());
    }

    public function test_our_work_update_rejects_duplicate_slug(): void
    {
        $first = OurWork::create([
            'name' => 'First Work',
            'slug' => 'first-work',
            'excerpt' => 'First excerpt',
            'description' => 'First description',
            'featured_on_home' => false,
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $second = OurWork::create([
            'name' => 'Second Work',
            'slug' => 'second-work',
            'excerpt' => 'Second excerpt',
            'description' => 'Second description',
            'featured_on_home' => false,
            'is_active' => true,
            'sort_order' => 2,
        ]);

        $response = $this->from("/admin/our-works/{$second->id}/edit")->put("/admin/our-works/{$second->id}", [
            'name' => 'Second Work Updated',
            'slug' => $first->slug,
        ]);

        $response->assertRedirect("/admin/our-works/{$second->id}/edit");
        $response->assertSessionHasErrors('slug');
    }

    public function test_service_destroy_removes_image_from_storage(): void
    {
        Storage::fake('public');

        $filePath = 'uploads/services/test-service.jpg';
        Storage::disk('public')->put($filePath, 'fake-image-contents');

        $service = Service::create([
            'name' => 'Brand Strategy',
            'slug' => 'brand-strategy',
            'image' => Storage::disk('public')->url($filePath),
            'is_active' => true,
            'featured_on_home' => false,
            'sort_order' => 1,
        ]);

        $response = $this->from('/admin/services')->delete("/admin/services/{$service->id}");

        $response->assertRedirect('/admin/services');
        $this->assertSoftDeleted('services', ['id' => $service->id]);
        Storage::disk('public')->assertMissing($filePath);
    }
}
