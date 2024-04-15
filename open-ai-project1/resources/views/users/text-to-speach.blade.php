<x-master-users-component title="text-to-speach">
    <form action="{{route('audio')}}" method="POST" onsubmit="showLoading()">
        @csrf
        <input type="text" placeholder="Enter your text here..." class="form-control input2" name="audio">
        @error('audio')
            <div class="form-text text-danger ms-2">{{$message}}</div>
        @enderror
        <h6>Select Voice</h6>
        <select class="form-select " aria-label="Default select example" name="voice">
            <option value="alloy" selected>Alloy</option>
            <option value="echo">Echo</option>
            <option value="fable">Fable</option>
            <option value="onyx">Onyx</option>
            <option value="nova">Nova</option>
            <option value="shimmer">Shimmer</option>
        </select>
        <h6>Select audio Quality</h6>
        <select class="form-select mb-4" aria-label="Default select example" name="quality">
            <option value="tts-1" selected>Fast (tts-1)</option>
            <option value="tts-1-hd">High Quality (tts-1-hd)</option>
        </select>
        <button class="btn btn-primary voice ms-1"  >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-volume-up-fill" viewBox="0 0 16 16">
                <path d="M11.536 14.01A8.47 8.47 0 0 0 14.026 8a8.47 8.47 0 0 0-2.49-6.01l-.708.707A7.48 7.48 0 0 1 13.025 8c0 2.071-.84 3.946-2.197 5.303z"/>
                <path d="M10.121 12.596A6.48 6.48 0 0 0 12.025 8a6.48 6.48 0 0 0-1.904-4.596l-.707.707A5.48 5.48 0 0 1 11.025 8a5.48 5.48 0 0 1-1.61 3.89z"/>
                <path d="M8.707 11.182A4.5 4.5 0 0 0 10.025 8a4.5 4.5 0 0 0-1.318-3.182L8 5.525A3.5 3.5 0 0 1 9.025 8 3.5 3.5 0 0 1 8 10.475zM6.717 3.55A.5.5 0 0 1 7 4v8a.5.5 0 0 1-.812.39L3.825 10.5H1.5A.5.5 0 0 1 1 10V6a.5.5 0 0 1 .5-.5h2.325l2.363-1.89a.5.5 0 0 1 .529-.06"/>
            </svg>
            Convert to speech
        </button>
    </form>
    @if (session()->has('text'))
        <audio controls >
            <source src="{{ asset('storage/audio/speech.mp3')}}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio><br>
        <button type="button" class="btn btn-secondary " id="downloadButton_audio" id="submitButton">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-down-fill" viewBox="0 0 16 16">
                <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2m2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708"/>
            </svg>
            download audio
        </button>
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
        // Ajouter un gestionnaire d'événements au clic sur le bouton de téléchargement
        document.getElementById('downloadButton_audio').addEventListener('click', function() {
            // Créer un lien pour télécharger l'image
            var link = document.createElement('a');
            link.href = "{{ asset('storage/audio/speech.mp3')}}";
            link.download = 'speech.mp3'; // Nom du fichier à télécharger
            // Simuler un clic sur le lien
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    </script>
    <script>
        function showLoading() {
            document.getElementById('loadingMessage').classList.remove('d-none');
            // Optionally, you can disable the form submit button to prevent multiple submissions
            document.getElementById('submitButton').disabled = true;
        }
    </script>
        
    
</x-master-users-component>