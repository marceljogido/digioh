@extends('backend.layouts.app')

@section('title') {{ __($module_action) }} {{ __($module_title) }} @endsection

@section('breadcrumbs')
<x-backend.breadcrumbs>
    <x-backend.breadcrumb-item type="active" icon='{{ $module_icon }}'>{{ __($module_title) }}</x-backend.breadcrumb-item>
</x-backend.breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">

        <x-backend.section-header :module_name="$module_name" :module_title="$module_title" :module_icon="$module_icon" :module_action="$module_action" />

        <div class="row mt-4">
            <div class="col">
                <table id="datatable" class="table table-bordered table-hover table-responsive-sm">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                @lang("slider::text.name")
                            </th>
                            <th>
                                @lang("slider::text.slug")
                            </th>
                            <th>
                                @lang("slider::text.updated_at")
                            </th>
                            <th>
                                @lang("slider::text.created_by")
                            </th>
                            <th class="text-end">
                                @lang("slider::text.action")
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($$module_name as $module_name_singular)
                        <tr>
                            <td>
                                {{ $module_name_singular->id }}
                            </td>
                            <td>
                                <a href="{{ url("admin/$module_name", $module_name_singular->id) }}">{{ $module_name_singular->name }}</a>
                            </td>
                            <td>
                                {{ $module_name_singular->slug }}
                            </td>
                            <td>
                                {{ $module_name_singular->updated_at->diffForHumans() }}
                            </td>
                            <td>
                                {{ $module_name_singular->created_by }}
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a
                                        href="{{ route('backend.'.$module_name.'.show', $module_name_singular) }}"
                                        class="btn btn-outline-secondary"
                                        title="{{ __('Show') }}"
                                    >
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a
                                        href="{{ route('backend.'.$module_name.'.edit', $module_name_singular) }}"
                                        class="btn btn-outline-primary"
                                        title="{{ __('Edit') }}"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form
                                        action="{{ route('backend.'.$module_name.'.destroy', $module_name_singular) }}"
                                        method="POST"
                                        style="display: inline;"
                                        onsubmit="return confirm('{{ __('Are you sure you want to delete this slider?') }}')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="{{ __('Delete') }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    Total {{ $$module_name->total() }} {{ ucwords($module_name) }}
                </div>
            </div>
            <div class="col-5">
                <div class="float-end">
                    {!! $$module_name->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
