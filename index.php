<?php get_header(); ?>

  <div class="container">
    <div class="row">
      <div id="filtro" class="col-md-4">
        <?php
            //estraggo l'array di oggetti
            $categorieTaxonomy = get_terms([
             'taxonomy' => 'Categoria',
             'hide_empty' => true,
            ]);
            //var_dump($categorieTaxonomy);
          foreach($categorieTaxonomy as $tassonomia) {
            //var_dump($tassonomia);
        ?>
          <div class="wrapElementoFiltro">
            <h3 id="<?php echo $tassonomia->term_id?>"><?php echo $tassonomia->name ?></h3>
          </div>
      <?php
    }
      ?>

      </div>
      <div id="filtroResult" class="col-md-8">

      </div>
    </div>
  </div>

<?php get_footer();?>
