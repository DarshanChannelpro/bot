@extends('layouts.app', ['title' => "Flows"])

@section('content')
    <div class="header pb-5 pt-2 pt-md-5">
        <div class="container-fluid">
            <div class="header-body">
                <h1 class="mb-3 mt--3">💰 {{__('Flows')}}</h1>
              <div class="row align-items-center pt-2">
              </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                    <a href="{{ route('chatboat',) }}" class="btn btn-sm btn-primary">Back</a>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('flows.create',['id'=>$boat_id]) }}" class="btn btn-sm btn-primary">{{ __('Add Flow') }}</a>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-12">
                        @include('partials.flash')
                    </div>
                    
                    @if(count($items))
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="example">
                            <thead class="thead-light">
                                <tr>
                                <th scope="col"><input type="checkbox" id="checkAll"></th>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">Trigger</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created by</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($items as $index => $item)
                                <tr>
                                <td><input type="checkbox" class="checkItem" name="flow_ids[]" value="{{ $item->id }}"></td>
                                <td>{{ $index + 1 }}</td>
                                <td><a href="{{route('flowDaigram', ['id' =>$item->id, 'back_id' => $boat_id])}}">{{ $item->name }} </a></td>
                                <td>{{ $item->trigger }}</td>
                                <td>{{ ucfirst($item->status) }}</td>
                                
                                @if($item->created_by == 1)
                                <td>Admin</td>
                                @else
                                <td>Owner</td>
                                @endif
                                <td>{{date("d-m-Y g:i A", strtotime($item->created_at))}}</td>

                                    <td class="text-right">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-icon-only text-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ni ni-settings-gear-65"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <form action="" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a class="dropdown-item" href="{{ route('flows.edit',['flowid'=>$item->id,'boat_id'=>$boat_id]) }}">{{ __('Edit') }}</a>
                                                    <a class="dropdown-item" href="{{ route('flows.delete',['flowid'=>$item->id]) }}">{{ __('Delete') }}</a>
                                                </form>
                                                {{-- <a class="dropdown-item" href="{{ route('chatboat.edit', ['id' => $boat->id]) }}">{{ __('Edit') }}</a>
                                                <button type="button" class="dropdown-item text-danger" data-toggle="modal" data-target="#exampleModal">
                                                    {{ __('Delete') }}
                                                </button> --}}
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
                        @if(count($items))
                            <nav class="d-flex justify-content-end" aria-label="...">
                                
                            </nav>
                        @else
                            <h4>{{ __('You don`t have any flow') }} ...</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
         <script src="https://cdn.datatables.net/1.11.7/js/jquery.dataTables.min.js"></script>
         <link rel="preconnect" href="https://fonts.bunny.net">
         <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
         <link href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" rel="stylesheet"/>
         <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>  
    <script>  
    new DataTable('#example');
    document.getElementById('checkAll').addEventListener('change', function() {
        let checkItems = document.querySelectorAll('.checkItem');
        checkItems.forEach(item => {
            item.checked = this.checked;
        });
    });
</script>
@endsection
