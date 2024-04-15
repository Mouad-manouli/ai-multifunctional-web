
@props(['users'])
@if (session()->has('success'))
    <x-alert-component type='success'>
        {{ session('success') }}
    </x-alert-component>
@endif
<a href="{{ route('create') }}"><button class="btn btn-secondary add">Add new</button></a>

<form action="{{ route('liste') }}" method="GET">
    <div class="search">
        <input class="form-control me-2" type="search" placeholder="Search" name="search" value="{{ request()->input('search') }}">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </div>
</form>

<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Created_at</th>
        <th>Actions</th>
    </tr>
    @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : 'Date not available' }}</td>
            <td class="action">
                <form id="delete-form-{{ $user->id }}" action="{{ route('delete', $user->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger m-2" onclick="confirmDelete(event, {{ $user->id }})">Delete</button>
                </form>
                <form action="{{ route('update', $user->id) }}" method="GET">
                    @csrf
                    <button class="btn btn-success m-2">Update</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

<div class="paginate">{{ $users->links() }}</div>

<script>
    function confirmDelete(event, userId) {
        event.preventDefault();
        if (confirm('Are you sure you want to delete this user?')) {
            document.getElementById('delete-form-' + userId).submit();
        }
    }
</script>
