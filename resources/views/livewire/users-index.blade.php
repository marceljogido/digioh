<div>
    <div class="row mt-4">
        <div class="col">
            <div class="mb-3">
                <input class="form-control" type="text" placeholder="🔍 Search users..." wire:model.live="searchTerm" />
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover" wire:loading.class="table-secondary">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px">#</th>
                            <th>{{ __("Name") }}</th>
                            <th>{{ __("Email") }}</th>
                            <th style="width: 100px" class="text-center">{{ __("Status") }}</th>
                            <th style="width: 150px">{{ __("Roles") }}</th>
                            <th style="width: 120px" class="text-center">{{ __("Updated") }}</th>
                            <th style="width: 200px" class="text-end">{{ __("Action") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                            <tr>
                                <td class="text-muted">{{ $users->firstItem() + $index }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ asset($user->avatar) }}" alt="{{ $user->name }}" class="rounded-circle" style="width: 32px; height: 32px; object-fit: cover;">
                                        <div>
                                            <a href="{{ route('backend.users.show', $user->id) }}" class="fw-semibold text-decoration-none">
                                                {{ $user->name }}
                                            </a>
                                            @if ($user->getRoleNames()->count() > 0)
                                                <div class="small text-muted">{{ $user->getRoleNames()->implode(', ') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $user->email }}</span>
                                    @if ($user->email_verified_at)
                                        <i class="fas fa-check-circle text-success ms-1" title="Verified"></i>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($user->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @elseif ($user->status == 2)
                                        <span class="badge bg-danger">Blocked</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @foreach ($user->getRoleNames() as $role)
                                        <span class="badge bg-primary">{{ ucwords($role) }}</span>
                                    @endforeach
                                </td>
                                <td class="text-center text-muted small">
                                    {{ $user->updated_at ? $user->updated_at->diffForHumans() : '-' }}
                                </td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a
                                            href="{{ route('backend.users.show', $user) }}"
                                            class="btn btn-outline-secondary"
                                            title="{{ __('Show') }}"
                                        >
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @can("edit_users")
                                            <a
                                                href="{{ route('backend.users.edit', $user) }}"
                                                class="btn btn-outline-primary"
                                                title="{{ __('Edit') }}"
                                            >
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a
                                                href="{{ route('backend.users.changePassword', $user) }}"
                                                class="btn btn-outline-info"
                                                title="{{ __('Change Password') }}"
                                            >
                                                <i class="fas fa-key"></i>
                                            </a>
                                            @if ($user->status != 2)
                                                <a
                                                    href="{{ route('backend.users.block', $user) }}"
                                                    class="btn btn-outline-warning"
                                                    data-method="PATCH"
                                                    data-token="{{ csrf_token() }}"
                                                    data-confirm="Are you sure you want to block this user?"
                                                    title="{{ __('Block') }}"
                                                >
                                                    <i class="fas fa-ban"></i>
                                                </a>
                                            @else
                                                <a
                                                    href="{{ route('backend.users.unblock', $user) }}"
                                                    class="btn btn-outline-success"
                                                    data-method="PATCH"
                                                    data-token="{{ csrf_token() }}"
                                                    data-confirm="Are you sure you want to unblock this user?"
                                                    title="{{ __('Unblock') }}"
                                                >
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            @endif
                                            <a
                                                href="{{ route('backend.users.destroy', $user) }}"
                                                class="btn btn-outline-danger"
                                                data-method="DELETE"
                                                data-token="{{ csrf_token() }}"
                                                data-confirm="Are you sure you want to delete this user?"
                                                title="{{ __('Delete') }}"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="fas fa-users fa-2x mb-2 d-block"></i>
                                    {{ __('No users found.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="row mt-3">
        <div class="col-7">
            <div class="text-muted small">
                Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} users
            </div>
        </div>
        <div class="col-5">
            <div class="float-end">
                {!! $users->links() !!}
            </div>
        </div>
    </div>
</div>
