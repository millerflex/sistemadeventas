<select name="ciudad" class="form-control" id="select_ciudades">
    @foreach ($ciudades as $ciudad)
        <option value="{{ $ciudad->id }}">{{ $ciudad->name }}</option>
    @endforeach
</select>