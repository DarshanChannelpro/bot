@extends('layouts.app', ['title' => __('Send new campaign')])
@section('head')
@endsection

@section('content')
@include('companies.partials.modals')
<div class="header  pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center pt-2">
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">New flow create</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('flows.index',['id'=>$id]) }}" class="btn btn-sm btn-primary">Back</a>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                </div>
                <div class="card-body">
                    <form action="{{ route('flows.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                         <input type="hidden" name="boat_id" value="{{$id}}" />
                        <div id="form-group-name" class="form-group col-md-6">
                            <label class="form-control-label" for="name">Name</label>
                            <div class="input-group">
                                <input  type="text" name="name" id="name" class="form-control form-control   "
                                    placeholder="Enter name" value="" required>
                            </div>
                        </div>
                        <div id="form-group-name" class="form-group col-md-6">
                            <label class="form-control-label" for="trigger">Reply type</label>
                            <div class="input-group">
                                <select name="type" id="trigger" class="form-control" required>
                                    <option value="">Select reply type</option>
                                    <option value="2">Exact Match</option>
                                    <option value="3">When Message Contain</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                        </div>
                        <div id="form-group-name" class="form-group col-md-6">
                            <label class="form-control-label" for="name">Trigger</label>
                            <div class="input-group">
                                <input  type="text" name="trigger" id="Trigger" class="form-control form-control   "
                                    placeholder="Enter bot reply trigger" value="" required>
                            </div>
                        </div>        
                        {{-- <div id="form-group-type" class="form-group col-md-6 focused">
                            <label class="form-control-label">Status</label><br>
                            <select class="form-control form-control-alternative " name="status" id="status">
                                <option selected="" value="draft">Draft</option>
                                <option value="published">Published</option>
                                <option value="unpublished">Unpublished</option>
                            </select>
                        </div>
                        <div id="form-group-trigger" class="form-group col-md-6">
                            <label class="form-control-label" for="trigger">Trigger frequency</label>
                            <div class="input-group">
                                <input  type="number" name="trigger_frequency" id="trigger_frequency"
                                    class="form-control form-control   " placeholder="Enter trigger frequency" value="">
                            </div>
                        </div> --}}
                        <button type="submit" class="btn btn-primary">Insert</button>
                    </form>
                </div>
                </form>
            </div>


        </div>
    </div>
</div>

</div>
@endsection