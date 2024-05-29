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
                            <h3 class="mb-0">Update flow</h3>
                        </div>
                        <div class="col-4 text-right">       
                            <a href="{{ route('flows.index', ['id' => $boat_id]) }}" class="btn btn-sm btn-primary">Back</a>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                </div>
                <div class="card-body">
                    <form action="{{ route('flows.update',['flowid'=>$items->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="boat_id" name="boat_id" value="{{$items->boat_id}}"/>
                        <div id="form-group-name" class="form-group col-md-6">
                            <label class="form-control-label" for="name">Name</label>
                            <div class="input-group">
                                <input  type="text" value="{{$items->name}}" name="name" id="name" class="form-control form-control   "
                                    placeholder="Enter name" required>
                            </div>
                        </div>
                        <div id="form-group-name" class="form-group col-md-6">
                            <label class="form-control-label" for="trigger">Trigger Text</label>
                            <div class="input-group">
                                <input  type="text" value="{{$items->trigger}}" name="trigger" id="trigger"
                                    class="form-control form-control   " placeholder="Enter trigger texr" 
                                    required>
                            </div>
                        </div>
                        <div id="form-group-name" class="form-group col-md-6">
                            <label class="form-control-label" for="trigger_on">Trigger on</label>
                            <div class="input-group">
                                <label for="male">Exact match</label>
                                <input type="radio" id="male" name="trigger_on" value="exactmatch" <?php echo ($items->trigger_on == 'exactmatch') ? 'checked' : ''; ?>>

                                <label for="female"> Text contains</label>
                                <input type="radio" id="female" name="trigger_on" value="textcontains" <?php echo ($items->trigger_on == 'textcontains') ? 'checked' : ''; ?>>
                            </div>
                        </div>


                        <div id="form-group-type" class="form-group col-md-6 focused">
                            <label class="form-control-label">Status</label><br>
                            <select class="form-control form-control-alternative " name="status" id="status">
                                <option value="draft" <?php echo ($items->status == 'draft') ? 'selected' : ''; ?>>Draft</option>
                                <option value="published" <?php echo ($items->status == 'published') ? 'selected' : ''; ?>>Published</option>
                                <option value="unpublished" <?php echo ($items->status == 'unpublished') ? 'selected' : ''; ?>>Unpublished</option>
                            </select>
                        </div>
                        <div id="form-group-trigger" class="form-group col-md-6">
                            <label class="form-control-label" for="trigger">Trigger frequency</label>
                            <div class="input-group">
                                <input  type="number" name="trigger_frequency" id="trigger_frequency"
                                    class="form-control form-control   " placeholder="Enter trigger frequency" value="{{$items->trigger_frequency}}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
                </form>
            </div>


        </div>
    </div>
</div>

</div>
@endsection