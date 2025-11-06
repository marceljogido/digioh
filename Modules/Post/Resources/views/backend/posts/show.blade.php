@extends("backend.layouts.app")

@section("title")
    {{ __($module_action) }} {{ __($module_title) }}
@endsection

@section("breadcrumbs")
    <x-backend.breadcrumbs>
        <x-backend.breadcrumb-item route='{{ route("backend.$module_name.index") }}' icon="{{ $module_icon }}">
            {{ __($module_title) }}
        </x-backend.breadcrumb-item>
        <x-backend.breadcrumb-item type="active">{{ __($module_action) }}</x-backend.breadcrumb-item>
    </x-backend.breadcrumbs>
@endsection

@section("content")
    <x-backend.layouts.show
        :data="$$module_name_singular"
        :module_name="$module_name"
        :module_path="$module_path"
        :module_title="$module_title"
        :module_icon="$module_icon"
        :module_action="$module_action"
    >
        <x-backend.section-header
            :data="$$module_name_singular"
            :module_name="$module_name"
            :module_title="$module_title"
            :module_icon="$module_icon"
            :module_action="$module_action"
        />

        @php
            $post = $$module_name_singular;
        @endphp
        <div class="row mt-4">
            <div class="col-12 col-sm-8">
                <div class="card mb-4">
                    <div class="card-header">
                        {{ __('Post Details') }}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-striped mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row">{{ __('Name') }}</th>
                                    <td>{{ $post->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Slug') }}</th>
                                    <td>{{ $post->slug ?? 'N/A' }}</td>
                                </tr>
                                @if(!empty($post->intro))
                                    <tr>
                                        <th scope="row">{{ __('Intro') }}</th>
                                        <td>{!! nl2br(e($post->intro)) !!}</td>
                                    </tr>
                                @endif
                                @if(!empty($post->content))
                                    <tr>
                                        <th scope="row">{{ __('Content') }}</th>
                                        <td class="small">{!! $post->content !!}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th scope="row">{{ __('Status') }}</th>
                                    <td class="text-capitalize">{{ $post->status }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Published At') }}</th>
                                    <td>{{ optional($post->published_at)->format('d M Y H:i') ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Featured on Home') }}</th>
                                    <td>{{ $post->is_featured ? __('Yes') : __('No') }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Event Start') }}</th>
                                    <td>{{ optional($post->event_start_date)->format('d M Y H:i') ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Event End') }}</th>
                                    <td>{{ optional($post->event_end_date)->format('d M Y H:i') ?? 'N/A' }}</td>
                                </tr>
                                @if(!empty($post->event_location))
                                    <tr>
                                        <th scope="row">{{ __('Event Location') }}</th>
                                        <td>{{ $post->event_location }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th scope="row">{{ __('Created By') }}</th>
                                    <td>{{ $post->created_by_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Created At') }}</th>
                                    <td>{{ optional($post->created_at)->format('d M Y H:i') ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Updated At') }}</th>
                                    <td>{{ optional($post->updated_at)->format('d M Y H:i') ?? 'N/A' }}</td>
                                </tr>
                                @if($post->image)
                                    @php
                                        $imageUrl = \Illuminate\Support\Str::startsWith($post->image, ['http://', 'https://'])
                                            ? $post->image
                                            : asset($post->image);
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ __('Cover Image') }}</th>
                                        <td>
                                            <a href="{{ $imageUrl }}" target="_blank" rel="noopener">
                                                <img src="{{ $imageUrl }}" alt="{{ $post->name }}" class="img-fluid rounded border" style="max-height: 160px;">
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($post->services->count())
                    <div class="mt-4">
                        <h5 class="fw-semibold">{{ __('Services Involved') }}</h5>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($post->services->sortBy('name') as $service)
                                <a href="{{ route('backend.services.show', $service) }}" class="badge rounded-pill bg-info text-decoration-none">
                                    {{ $service->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(is_array($post->gallery_images) && count($post->gallery_images))
                    <div class="mt-4">
                        <h5 class="fw-semibold">{{ __('Gallery Images') }}</h5>
                        <div class="d-flex flex-wrap gap-3">
                            @foreach($post->gallery_images as $galleryPath)
                                @php
                                    $isAbsolute = \Illuminate\Support\Str::startsWith($galleryPath, ['http://', 'https://']);
                                    $displayUrl = $isAbsolute
                                        ? $galleryPath
                                        : \Illuminate\Support\Facades\Storage::url($galleryPath);
                                @endphp
                                <a href="{{ $displayUrl }}" target="_blank" rel="noopener" class="d-block">
                                    <img src="{{ $displayUrl }}" alt="Gallery Image" class="img-fluid rounded border" style="max-height: 140px;">
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-12 col-sm-4"></div>
        </div>
    </x-backend.layouts.show>
@endsection

