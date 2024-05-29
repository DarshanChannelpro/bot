@extends('layouts.app', ['title' => __('Chatboat')])
@section('content')
    <div class="header pb-5 pt-3 pt-md-5">
        <div class="container-fluid">
            <div class="header-body">
                <h1 class="mb-3 mt--3">🤖🌟 {{ __('ChatBoat') }}</h1>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row align-items-center pt-2">
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="btn-group mb-3" id="bulk-action-button" style="display: none;">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ni ni-archive-2"></i>
                    {{ __('Bulk action') }}
                </button>
                <div class="dropdown-menu">
                    <button type="button" class="dropdown-item btn btn-danger" data-toggle="modal" data-target="#exampleModal1">
                        Delete All
                    </button>
                </div>
            </div>
    
            <div class="col-12 mt-3">
                <span id="selected-count"></span>
            </div>
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header border-0 d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">{{ __('Boats') }}</h3>
                        <a href="{{ route('chatboat.create') }}" class="btn btn-sm btn-primary">{{ __('Create Boat') }}</a>
                    </div>
                    <div class="col-12">
                        @include('partials.flash')
                    </div>
                    @if (count($boats))
                    <div class="table-responsive">
                        <table id="example" class="display table align-items-center table-flush" style="width:100%">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col"><input type="checkbox" id="select-all"></th>
                                    <th scope="col">{{ __('Boat Name') }}</th>
                                    <th scope="col">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($boats as $boat)
                                    <tr>
                                        <td><input type="checkbox" class="select-item" value="{{ $boat->id }}"></td>
                                        <td>
                                            @if($boat->boat_name)
                                                <a href="{{ route('flows.index', ['id' => $boat->id]) }}">{{ $boat->boat_name }}</a>
                                            @else
                                                {{ '' }}
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-icon-only text-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="ni ni-settings-gear-65"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <form action="" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" id="s" value="{{ $boat->id }}">
                                                        <a class="dropdown-item" href="{{ route('chatboat.edit', ['id' => $boat->id]) }}">{{ __('Edit') }}</a>
                                                        <button type="button" class="dropdown-item btn btn-danger w-100" data-toggle="modal" data-target="#exampleModal">
                                                            {{ __('Delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                    <div class="card-footer py-4">
                        @if (!count($boats))
                            <h4>{{ __('You don’t have any boats') }}...</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <p>Are you sure you want to delete this record?</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            @if(isset($boat))
                <form action="{{ route('chatboat.delete', ['id' => $boat->id]) }}" method="post">
                    @csrf
                        {{-- @method('delete') --}}
                    <button type="submit" class="btn btn-danger">
                    {{ __('delete') }}
                    </button>
                </form>
            @endif
            </div>
        </div>
        </div>
    </div>



    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Delete All</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete all selected records?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="bulk-delete-form" action="{{ route('chatboat.bulkDelete') }}" method="post">
                        @csrf
                        <div id="hidden-inputs-container"></div>
                        <button type="submit" class="btn btn-danger">
                            {{ __('Delete') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>

    new DataTable('#example');
    document.addEventListener('DOMContentLoaded', function () {
    const selectAllCheckbox = document.getElementById('select-all');
    const itemCheckboxes = document.querySelectorAll('.select-item');
    const bulkActionButton = document.getElementById('bulk-action-button');
    const selectedCountSpan = document.getElementById('selected-count');
    const bulkDeleteForm = document.getElementById('bulk-delete-form');
    const hiddenInputsContainer = document.getElementById('hidden-inputs-container');
    $("#example").removeClass('dataTable');

    function updateSelectedCount() {
        const selectedCount = document.querySelectorAll('.select-item:checked').length;
        selectedCountSpan.textContent = `${selectedCount} items selected`;

        if (selectedCount > 0) {
            bulkActionButton.style.display = 'block';
        } else {
            bulkActionButton.style.display = 'none';
        }
    }

    function getSelectedIds() {
        const selectedIds = [];
        document.querySelectorAll('.select-item:checked').forEach(checkbox => {
            selectedIds.push(checkbox.value);
        });
        return selectedIds;
    }

    function updateHiddenInputs() {
        const selectedIds = getSelectedIds();
        hiddenInputsContainer.innerHTML = '';
        selectedIds.forEach(id => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'ids[]';
            input.value = id;
            hiddenInputsContainer.appendChild(input);
        });
    }

    selectAllCheckbox.addEventListener('change', function () {
        itemCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateSelectedCount();
        updateHiddenInputs();
    });

    itemCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            updateSelectedCount();
            updateHiddenInputs();
        });
    });

    updateSelectedCount();
    updateHiddenInputs();
});
</script>

@endsection
