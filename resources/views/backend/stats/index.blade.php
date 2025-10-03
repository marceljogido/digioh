@extends('backend.layouts.app')

@section('title', 'Statistik')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Statistik</h3>
            <div class="card-tools">
                <a href="{{ route('backend.stats.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Statistik
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Value</th>
                            <th>Label (ID)</th>
                            <th>Label (EN)</th>
                            <th>Sort Order</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stats as $index => $stat)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $stat->value }}</td>
                                <td>{{ $stat->label }}</td>
                                <td>{{ $stat->label_en ?? '-' }}</td>
                                <td>{{ $stat->sort_order }}</td>
                                <td>
                                    @if($stat->is_active)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-secondary">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('backend.stats.edit', $stat) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('backend.stats.destroy', $stat) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus statistik ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada statistik ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection