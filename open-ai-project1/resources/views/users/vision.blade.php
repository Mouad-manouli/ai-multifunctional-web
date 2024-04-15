<x-master-users-component title="Vision">
    <form action="{{route('script')}}" method="POST" onsubmit="showLoading()">
        @csrf
        <h6>image URL :</h6>
        <input type="text" placeholder="Enter image URL..." class="form-control " name="imageUrl">
        @error('imageUrl')
            <div class="form-text text-danger ms-2">{{$message}}</div>
        @enderror
        <h6>Prompt :</h6>
        <textarea placeholder="Enter prompt..." class="p-2" name="prompt"></textarea>
        @error('prompt')
            <div class="form-text text-danger ms-2">{{$message}}</div>
        @enderror
        <button class="btn btn-primary voice mt-3 ms-1"  type="submit" id="submitButton">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
            </svg>
            Generate Vision
        </button>
    </form>

    @if(session()->has('response'))
        <div class="mt-4">
            <h5>Generated Vision:</h5>
            <p class="p_script">{{ session('response')['choices'][0]['message']['content'] }}</p>
        </div>
    @endif

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