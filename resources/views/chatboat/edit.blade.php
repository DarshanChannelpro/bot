@extends('layouts.app', ['title' => __('Edit Boat')])
@section('content')
    <div class="header  pb-8 pt-5 pt-md-8">
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('ChatBoat Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('chatboat') }}" class="btn btn-sm btn-primary">{{ __('Back to Chatboat') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="heading-small text-muted mb-4">{{ __('Chatboat information') }}</h6>
                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="pl-lg-4">
                            <form method="post" action="{{route("chatboat.update")}}" autocomplete="off" enctype="multipart/form-data">
                                @csrf           
                                <!-- Separator Section (if applicable) -->
                                <br />
                                <h4 id="sep123" class="display-4 mb-0"> Edit Boat</h4>
                                <hr />

                                <!-- Form Group -->
                                <div id="form-group-123" class="form-group">
                                    <!-- Label with optional link -->
                                    <label class="form-control-label" for="boat_name">Boat Name</label>

                                    <!-- Input Group -->
                                    <div class="input-group">
                                        <input 
                                            type="text" 
                                            placeholder="Enter boat name" 
                                            class="form-control @error('boat_name') is-invalid @enderror" 
                                            id="boat_name" 
                                            name="boat_name" 
                                            value="{{$boat->boat_name}}"
                                        >
                                    
                                        @error('boat_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                     <input type="hidden" name="id" value="{{$boat->id}}"/>
                                    <!-- Additional Info -->
                                    <small class="text-muted"><strong>Additional information about the input.</strong></small>

                                    <!-- Submit Button -->
                                    <div class="input-group mt-3">
                                        <input 
                                            type="submit" 
                                            class="btn btn-primary" 
                                            value="Submit"
                                        >
                                    </div>

                                    <!-- Error Message -->
                                    <!-- Uncomment and use this section if you need to display error messages -->
                                    <!--
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Error message goes here.</strong>
                                    </span>
                                    -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
    </div>
@endsection
