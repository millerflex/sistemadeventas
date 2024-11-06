<select name="departamento" class="form-control" id="select_estado">
    @foreach ($estados as $estado)
        <option value="{{ $estado->id }}">{{ $estado->name }}</option>
    @endforeach
</select>