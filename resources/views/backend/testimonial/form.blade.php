<div>
    <label for="name">Name</label>
    <input type="text" name="name" value="{{ $team->name ?? null }}">
</div>

<div>
    <label for="postion">Postion</label>
    <input type="text" name="postion" value="{{ $team->postion ?? null }}">
</div>

<div>
    <label for="facebook">facebook</label>
    <input type="text" name="facebook" value="{{ $team->facebook ?? null }}">
</div>

<div>
    <label for="photo">Photo</label>
    <input type="file" name="photo">
</div>