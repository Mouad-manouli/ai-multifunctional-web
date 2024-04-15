<form method="POST" action="{{route('edit',$utilisateur->id)}}" class="form_add">
    @csrf
    @method('put')
    <h2>Update user</h2>
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" class="form-control" name="name" value="{{old('name',$utilisateur->name) }}">
      @error('name')
      <div  class="form-text text-danger" >{{$message}}</div>
      @enderror
    </div>
    <div class="mb-3">
        <label  class="form-label">Email</label>
        <input type="email" class="form-control" name="email" value="{{old('email',$utilisateur->email)}}">
        @error('email')
      <div  class="form-text text-danger">{{$message}}</div>
      @enderror
      </div>
    <div class="mb-3">
      <label  class="form-label">Password</label>
      <input type="password" class="form-control" name="password" >
      @error('password')
      <div  class="form-text text-danger">{{$message}}</div>
      @enderror
    </div>
    <div class="mb-3">
        <label  class="form-label">Confirmation password</label>
        <input type="password" class="form-control" name="password_confirmation" >
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>