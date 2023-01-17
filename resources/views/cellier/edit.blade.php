
<h1>Espace cellier</h1>
<h4>Modification</h4>
@if (session()->has('success'))
<span style="color:green">{{ session('success') }}</span>
@endif


<form action="{{ route('cellier.update', ['id' => $cellier->id])}}" method="POST">

    @csrf

    <label style="display: block;">
        Nom du cellier <input name="nom_cellier" type="text" value="{{ old('nom_cellier', $cellier->nom_cellier)}}" />
        @error('nom_cellier')
        <span style="color:red"> {{ $message }}</span>
        @enderror
    </label>
    <!--TODO ajout de l'id de l'usager -->
    <input name="id_usager" type="hidden" value="1" />
    <button>Sauvegarde</button>

</form>

