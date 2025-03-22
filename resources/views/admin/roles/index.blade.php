@extends('admin.layouts.app')

@section('title', 'Roles | Trigo')

@section('content')
<div class="container-fluid px-6 py-8">
    <!-- Options Card -->
    <div class="card mb-6 shadow-lg border-0">
        <div class="card-body p-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 text-center mb-4">Navigation</h1>
            <div class="row justify-content-center g-3">
                <div class="col-6 col-md-3">
                    <a href="{{ route('users.index') }}" class="btn btn-primary w-100 shadow-sm hover:shadow-md transition-all duration-200">
                        <i class="bi bi-people-fill me-2"></i> Go to Users
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('permissions.index') }}" class="btn btn-primary w-100 shadow-sm hover:shadow-md transition-all duration-200">
                        <i class="bi bi-shield-lock-fill me-2"></i> Go to Permissions
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Role Card -->
    <div class="card mb-6 shadow-lg border-0">
        <div class="card-body p-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 text-center mb-6">Create New Role</h1>
            <form method="POST" action="{{ route('roles.store') }}" class="needs-validation" novalidate>
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-semibold text-gray-700 dark:text-gray-300">Role Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-gray-100 dark:bg-gray-700 border-0">
                                <i class="bi bi-person-fill text-primary-custom"></i>
                            </span>
                            <input type="text" name="name" id="name" class="form-control border-0 shadow-sm focus:ring-primary-custom focus:border-primary-custom" placeholder="Enter Role Name" required>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="permissions" class="form-label fw-semibold text-gray-700 dark:text-gray-300">Permissions</label>
                        <select name="permissions[]" id="permissions" class="form-control select2 border-0 shadow-sm" multiple>
                            @foreach ($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                        @error('permissions')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mt-6 text-center">
                    <button type="submit" class="btn btn-primary btn-lg w-50 shadow-md hover:shadow-lg transition-all duration-200">
                        <i class="bi bi-save me-2"></i> Save Role
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Roles List Card -->
    <div class="card shadow-lg border-0">
        <div class="card-body p-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Existing Roles</h1>
            @if ($roles->isEmpty())
                <div class="alert alert-info text-center" role="alert">
                    No roles have been created yet.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="py-3 px-4 text-left text-gray-700 dark:text-gray-300">Role Name</th>
                                <th class="py-3 px-4 text-left text-gray-700 dark:text-gray-300">Permissions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors duration-150">
                                    <td class="py-3 px-4">
                                        <span class="badge bg-primary-custom text-white fw-semibold">{{ $role->name }}</span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="text-muted">
                                            {{ $role->permissions->pluck('name')->join(', ') ?: 'No permissions assigned' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

<!-- Custom Styles -->
<style>
    .card {
        background-color: #ffffff;
        border-radius: 12px;
        transition: transform 0.2s ease-in-out;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .form-control, .select2-container--default .select2-selection--multiple {
        background-color: #f8f9fa;
        border: none !important;
        border-radius: 8px;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: var(--primary-color);
        color: white;
        border-radius: 4px;
    }
    .table th, .table td {
        border: none;
    }
    .badge {
        padding: 6px 12px;
        font-size: 0.9rem;
    }
    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    .btn-primary:hover {
        background-color: #4338ca;
        border-color: #4338ca;
    }
</style>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<!-- Custom Scripts -->
@stack('scripts')
<script>
    $(document).ready(function() {
        $('#permissions').select2({
            placeholder: "Select permissions",
            allowClear: true,
            width: '100%'
        });

        // Bootstrap form validation
        (function () {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    });
</script>
@endsection