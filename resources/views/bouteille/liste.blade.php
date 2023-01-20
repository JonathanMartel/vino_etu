
<!-- Pour tester des routes -->
<a href="/SAQ">Importer le catalogue</a>
<a href="/cellier">Espace cellier</a>
<a href="/bouteille/nouveau">Ajouter une bouteille</a>



    
<x-slot name="header">
  
@if ($msg)
<p>{{ $msg }}</p>
@endif


<h1>Vue : Liste Bouteilles du catalogue</h1>
@if (session('success'))
<p style="font-size:1.3em; color: green;">{{ session('success') }}</p>

@endif
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="cellier grid">
                    <?php
                    foreach ($data as $cle => $bouteille) {
                    ?>
                        <div class="bouteille" data-quantite="<?php echo $bouteille['quantite'] ?>">
                            <a class="btnModifier" href='{{ route('bouteille.edit', ['id' => $bouteille->id ]) }}'>Modifier</a>
                            <div class="img">
                                <img src="https:<?php echo $bouteille['image'] ?>">
                            </div>
                            <h5><?php echo $bouteille['nom'] ?></h5>
                            <div class="description">
                                <p class="quantite">Quantité : <?php echo $bouteille['quantite'] ?></p>
                                <p class="pays">Pays : <?php echo $bouteille['pays'] ?></p>
                                <p class="type">Type : <?php echo $bouteille['type'] ?></p>
                                <p class="millesime">Millesime : <?php echo $bouteille['millesime'] ?></p>
                                <p><a href="<?php echo $bouteille['url_saq'] ?>">Voir SAQ</a></p>
                            </div>
                            <div class="options" data-id="<?php echo $bouteille['id_bouteille_cellier'] ?>" data-id-vin="<?php echo $bouteille['id_bouteille'] ?>">
                                <!-- <button class='btnModifier'>Modifier</button> -->
            
                           
                                
                                    <button class='btnAjouter'>Ajouter</button>
                               
                                
                               
                                   
                                    <button class='btnAjouter'>Ajouter</button>
                                
                               
            
                            </div>
                        
                <?php
            
            
                }
            
                ?>
            </div>
            
            </div>
        </div>
    </div>
    
</div>
</div>
