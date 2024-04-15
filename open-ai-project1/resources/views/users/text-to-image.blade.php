<x-master-users-component title="text-to-image">
    <form action="{{route('image')}}" method="POST" onsubmit="showLoading()">
        @csrf
        <textarea placeholder="Enter your text here..." class="p-2 mt-3 mb-1" name="description"></textarea>
        @error('description')
            <div class="form-text text-danger ms-2">{{$message}}</div>
        @enderror
        <h6>Select image Size</h6>
        <select class="form-select " aria-label="Default select example" name="size">
            <option value="512x512" selected>512x512 pixels</option>
            <option value="1024x1024">1024x1024 pixels</option>
            <option value="256x256">256x256 pixels</option>
        </select>
        <button class="btn btn-primary voice mt-3 ms-1" type="submit" id="submitButton">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16" >
                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z"/>
            </svg>
            Generate image
        </button>
    </form>
    <div class=" w-75 my-4 pos_alert">
        @if (session()->has('error'))
            <x-alert-component type='danger'>
                {{session('error')}}
            </x-alert-component>
        @endif
    </div>
    <div class="custom-loader d-none" id="loadingMessage"></div>
    <script>
        function showLoading() {
            document.getElementById('loadingMessage').classList.remove('d-none');
            // Optionally, you can disable the form submit button to prevent multiple submissions
            document.getElementById('submitButton').disabled = true;
        }
    </script>
</x-master-users-component>