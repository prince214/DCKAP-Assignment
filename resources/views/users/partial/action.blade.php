<a data-id="{{ Crypt::encrypt($id) }}" data-type="edit-user" class="btn btn-sm btn-primary mange-user">Edit</a>
 <a data-id="{{ Crypt::encrypt($id) }}" data-type="view-user" class="btn btn-sm btn-warning mange-user">View</a>
 <form method="POST" class="d-inline" action="{{ route('users.update',['user' => Crypt::encrypt($id)]) }}">
{{ method_field('DELETE') }}
{{ csrf_field() }}
<button type="submit" class="btn btn-sm btn-danger">Delete</button>
</form>
