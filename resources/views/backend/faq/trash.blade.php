@extends('backend.layouts.app')

@section('title') {{ __($module_action) }} {{ __($module_title) }} @endsection

@section('breadcrumbs')
    <x-backend.breadcrumbs>
        <x-backend.breadcrumb-item route='{{ route("backend.$module_name.index") }}' icon='{{ $module_icon }}'>
            {{ __($module_title) }}
        </x-backend.breadcrumb-item>
        <x-backend.breadcrumb-item type="active">{{ __($module_action) }}</x-backend.breadcrumb-item>
    </x-backend.breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <x-backend.section-header>
            <i class="{{ $module_icon }}"></i>
            {{ __($module_title) }}
            <small class="text-muted">{{ __($module_action) }}</small>

            <x-slot name="toolbar">
                <a href="{{ route('backend.'.$module_name.'.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-list"></i> {{ __('Back to List') }}
                </a>
            </x-slot>
        </x-backend.section-header>

        <div class="row mt-4">
            <div class="col">
                @if($$module_name->count())
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Question') }}</th>
                                    <th>{{ __('Deleted At') }}</th>
                                    <th class="text-end">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($$module_name as $faq)
                                    <tr>
                                        <td>{{ $faq->id }}</td>
                                        <td>{{ Str::limit($faq->question, 50) }}</td>
                                        <td>{{ $faq->deleted_at->diffForHumans() }}</td>
                                        <td class="text-end">
                                            <form action="{{ route('backend.'.$module_name.'.restore', $faq->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success" title="{{ __('Restore') }}">
                                                    <i class="fas fa-undo"></i> {{ __('Restore') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-center">
                        {{ $$module_name->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-trash-alt fa-3x text-muted mb-3"></i>
                        <p class="text-muted">{{ __('No deleted items found.') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
