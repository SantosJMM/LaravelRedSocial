<form action="{{ route('statuses.store') }}" method="post">
    @csrf
    <label for="body">Body</label>
    <textarea name="body" id="body" cols="30" rows="10"></textarea>
    <button id="create-status">Publicar estado</button>
</form>
