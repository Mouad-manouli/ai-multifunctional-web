<x-master-users-component title="Speach-to-text">
    <form action="{{route('text-audio')}}" method="POST" enctype="multipart/form-data" onsubmit="showLoading()">
        @csrf
        <input type="file" class="mt-3" name="audio">
        @error('audio')
            <div class="form-text text-danger ms-2">{{$message}}</div>
        @enderror
        <button class="btn btn-primary voice mt-3"  >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-text-fill" viewBox="0 0 16 16">
                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M4.5 9a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1z"/>
            </svg>
            Convert Audio to text
        </button>
        <textarea placeholder="Transcribed text will appear here..." class="mt-3 p-2 " id="transcribedText" >
            @if (session()->has('result'))
                {{session('result')}}
            @endif
        </textarea>
        
    </form>
    <button class="btn btn-primary voice mt-3 my-3" onclick="copyText()"  id="submitButton">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
        </svg>
        Copy text
    </button>
    <div class="custom-loader d-none" id="loadingMessage"></div>
    <div class=" w-75 my-4 pos_alert">
        @if (session()->has('error'))
            <x-alert-component type='danger'>
                {{session('error')}}
            </x-alert-component>
        @endif
    </div>

    <script>
        function copyText() {
            var textarea = document.getElementById("transcribedText");
            textarea.select();
            document.execCommand("copy");
            textarea.setSelectionRange(0, 0);
        }
    </script>
    <script>
        function showLoading() {
            document.getElementById('loadingMessage').classList.remove('d-none');
            // Optionally, you can disable the form submit button to prevent multiple submissions
            document.getElementById('submitButton').disabled = true;
        }
    </script>
</x-master-users-component>