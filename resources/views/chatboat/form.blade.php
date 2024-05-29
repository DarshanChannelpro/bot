
    <!-- Separator Section (if applicable) -->
    <br />
    <h4 id="sep123" class="display-4 mb-0">BOAT</h4>
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
                value="{{ old('boat_name') }}"
            >
        
            @error('boat_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
        
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
