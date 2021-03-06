@extends("estudiante.principal")

@section('content')
    <form action="{{route('cambio-grupo.store')}}" method="POST">
{{csrf_field()}}
        @include('partials.exito')
    <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
      <label for="nombre">Nombre completo</label>
      <input class="form-control" id="nombre" type="text" value="{{ $persona->nombre }} , {{ $persona->apellido }}" readonly>
        @if ($errors->has('nombre'))
            <span class="help-block">
                <strong>{{ $errors->first('nombre') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
      <div class="form-row">
        <div class="col-md-6">
          <label for="Carnet">Carnet</label>
          <input class="form-control" id="carnet" type="text" value="{{ $persona->carnet }}" readonly>
        </div>
        <div class="col-md-6">
          <label for="exampleConfirmPassword">Email</label>
          <input class="form-control" id="email" type="text" value="{{ Auth::user()->email }}" readonly>

        </div>
      </div>
    </div>

    <div class="form-group">
        <div class="form-row">
          <div class="col-md-6{{ $errors->has('telefono') ? ' has-error' : '' }}">
            <label for="telefono">Telefono</label>
            <input class="form-control" id="telefono" type="text" name="telefono" value="{{ old('telefono') }}" maxlength="9" required placeholder="ingrese numero de telefono" onkeyup="guion()" onkeypress="return valida(event)">
              @if ($errors->has('telefono'))
                  <span class="help-block">
                <strong>{{ $errors->first('telefono') }}</strong>
            </span>
              @endif
          </div>
          <div class="col-md-6">
            <label for="materia">Materia</label>
            <select class="form-control" name="materia">
                @foreach($materias as $materia)
                    <option value="{{ $materia->id }}" {{ (old('materia')) == $materia->id ? " selected" : "" }}>{{ $materia->nombreMateria }}</option>
                @endforeach
            </select>
          </div>
        </div>
      </div>

      <div class="form-group">
          <div class="form-row">
            <div class="col-md-4{{ $errors->has('grupoActual') ? ' has-error' : '' }}">
                <label for="grupoActual">Numero grupo actual</label>
                <input class="form-control" id="grupoActual" type="number" value="{{ old('grupoActual') }}" name="grupoActual" min="1" required placeholder="Numero grupo actual">
                @if ($errors->has('grupoActual'))
                    <span class="help-block">
                <strong>{{ $errors->first('grupoActual') }}</strong>
            </span>
                @endif
              </div>
            <div class="col-md-4{{ $errors->has('grupoDeseado') ? ' has-error' : '' }}">
                  <label for="grupoDeseado">Numero grupo deseado</label>
                  <input class="form-control" id="grupoDeseado" name="grupoDeseado" value="{{ old('grupoDeseado') }}" type="number" min="1" required placeholder="Numero grupo que desea">
                @if ($errors->has('grupoDeseado'))
                    <span class="help-block">
                <strong>{{ $errors->first('grupoDeseado') }}</strong>
            </span>
                @endif
            </div>
          </div>
        </div>

        <div class="form-group{{ $errors->has('justificacion') ? ' has-error' : '' }}">
            <label for="justificacion">Justificación</label>
            <textarea class="form-control" id="justificacion" name="justificacion" required rows="5">{{ old('justificacion') }}</textarea>
            @if ($errors->has('justificacion'))
                <span class="help-block">
                <strong>{{ $errors->first('justificacion') }}</strong>
            </span>
            @endif
          </div>
    <button type="submit" class="btn btn-primary btn-block">Enviar Petición</button>

  </form>
    <script>
        function guion() {
            var telefono = document.getElementById('telefono');
            if(telefono.value.length == 4){
                telefono.value += '-';
            }
        }

        function valida(e){
            tecla = (document.all) ? e.keyCode : e.which;

            //Tecla de retroceso para borrar, siempre la permite
            if (tecla==8){
                return true;
            }

            // Patron de entrada, en este caso solo acepta numeros
            patron =/[0-9]/;
            tecla_final = String.fromCharCode(tecla);
            return patron.test(tecla_final);
        }
    </script>
@endsection
