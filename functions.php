<?php

// DIPENDENZE -----------------
require_once('assets/bs4navwalker.php');

//------------------------------
function et_setup_theme(){

  add_theme_support('title-tag');

  add_theme_support( 'post-thumbnails' );

  add_image_size('et_big',1400, 800, true);
  add_image_size('et_quadro',600, 600, true);
  add_image_size('et_single',800, 600, true);

  register_nav_menus(array(
    'header' => esc_html__('Header','et'),
  ));
}

add_action('after_setup_theme','et_setup_theme');

/*INCLUDE JAVASCRIPT e CSS FILES*/
/*------------------------*/
function et_scripts(){
  wp_enqueue_script('et_popper_js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', array('jquery'), null, true);
  wp_enqueue_script('et_bootstrap_js', get_template_directory_uri().'/public/js/bootstrap.min.js', array('jquery'), null, true);
  wp_enqueue_script('et_main_js', get_template_directory_uri().'/public/js/main.js', array('jquery'), null, true);

  wp_localize_script('et_bootstrap_js', 'my_vars', array(
    'ajaxurl' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('pilota-nonce'))
  );

}

add_action('wp_enqueue_scripts','et_scripts');

function et_styles(){
  wp_enqueue_style('et_bootstrap_css', get_template_directory_uri().'/public/css/bootstrap.min.css');
  wp_enqueue_style('et_app_css', get_template_directory_uri().'/public/css/app.css');
}

add_action('wp_enqueue_scripts','et_styles');

//CUSTOM POST TYPE

function motorsport_custom_post() {
    // creo e registro il custom post type
    register_post_type( 'motorsport', /* nome del custom post type */
        // definisco le varie etichette da mostrare nei menù
        array('labels' => array(
            'name' => 'motorsports', /* nome, al plurale, dell'etichetta del post type. */
            'singular_name' => 'motorsport', /* nome, al singolare, dell'etichetta del post type. */
            'all_items' => 'Tutti i piloti', /* testo nei menu che indica tutti i contenuti del post type */
            'add_new' => 'Aggiungi nuovo pilota', /*testo del pulsante Aggiungi. */
            'add_new_item' => 'Aggiungi nuovo pilota', /* testo per il pulsante Aggiungi nuovo post type */
            'edit_item' => 'Modifica pilota', /*  testo modifica */
            'new_item' => 'Nuovo pilota', /* testo nuovo oggetto */
            'view_item' => 'Visualizza pilota', /* testo per visualizzare */
            'search_items' => 'Cerca pilota', /* testo per la ricerca*/
            'not_found' =>  'Nessun pilota trovato', /* testo se non trova nulla */
            'not_found_in_trash' => 'Nessun pilota trovato nel cestino', /* testo se non trova nulla nel cestino */
            'parent_item_colon' => ''
            ), /* fine dell'array delle etichette del menu */
            'description' => 'Archivio di tutte le categorie automobilistiche sportive', /* descrizione del post type */
            'public' => true, /* definisce se il post type sia visibile sia da front-end che da back-end */
            'publicly_queryable' => true, /* definisce se possono essere fatte query da front-end */
            'exclude_from_search' => false, /* esclude (false) il post type dai risultati di ricerca */
            'show_ui' => true, /* definisce se deve essere visualizzata l'interfaccia di default nel pannello di amministrazione */
            'query_var' => true,
            'menu_position' => 8, /* definisce l'ordine in cui comparire nel menù di amministrazione a sinistra */
            'menu_icon' => get_stylesheet_directory_uri() . '/img/mia-icona.png', /* imposta l'icona da usare nel menù per il posty type */
            'rewrite'   => array( 'slug' => 'motorsport', 'with_front' => false ), /* specificare uno slug per leURL */
            'has_archive' => 'true', /* definisci se abilitare la generazione di un archivio (tipo archive-cd.php) */
            'capability_type' => 'post', /* definisci se si comporterà come un post o come una pagina */
            'hierarchical' => false, /* definisci se potranno essere definiti elementi padri di altri */
            /* la riga successiva definisce quali elementi verranno visualizzati nella schermata di creazione del post */
            'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
        ) /* fine delle opzioni */
    ); /* fine della registrazione */

}

// Inizializzo la funzione
add_action( 'init', 'motorsport_custom_post');

//TASSONOMIA CUSTOM POST TYPE

function motorsport_categorie() {
    // L'array che contiene le etichette per la tassonomia personalizzata
    $labels = array(
        // Il nome plurale della tassonomia
        'name' => _x( 'Cateogorie', 'Taxonomy General Name', 'domain-name' ),
        // Il nome singolare della tassonomia
        'singular_name' => _x( 'Categoria', 'Taxonomy Singular Name', 'domain-name' ),
        // Il nome della tassonomia visualizzato nel menù
        'menu_name' => __( 'Categoria', 'domain-name' ),
        // L'etichetta del pulsante Tutti gli elementi
        'all_items' => __( 'Tutti i generi', 'domain-name' ),
        // L'etichetta dell'elemento genitore, utilizzata solo per le tassonomie gerarchiche
        'parent_item' => __( 'Categoria', 'domain-name' ),
        // L'etichetta dell'elemento genitore seguita dai due punti
        'parent_item_colon' => __( 'Categoria:', 'domain-name' ),
        // L'etichetta del pulsante Nuovo elemento
        'new_item_name' => __( 'Nome nuovo Categoria', 'domain-name' ),
        // L'etichetta del pulsante Aggiungi nuovo
        'add_new_item' => __( 'Aggiungi Categoria', 'domain-name' ),
        // L'etichetta del pulsante Modifica elemento
        'edit_item' => __( 'Modifica Categoria', 'domain-name' ),
        // L'etichetta del pulsante Aggiorna elemento
        'update_item' => __( 'Aggiorna Categoria', 'domain-name' ),
        // L'etichetta del pulsante Cerca elementi
        'search_items' => __( 'Cerca Categoria', 'domain-name' ),
        // L'etichetta del pulsante Aggiungi o rimuovi elementi
        'add_or_remove_items' => __( 'Aggiungi o rimuovi Categoria', 'domain-name' ),
    );

    // L'array contenente gli argomenti passati alla tassonomia personalizzata in fase di registrazione
    $args = array(
        // Le etichette
        'labels' => $labels,
        // Definisce se la tossonomia è gerarchica come le categorie o non gerarchica come i tag
        'hierarchical' => true,
        // Genera l'interfaccia per la gestione delle tassonomie
        'show_ui' => true,
        // Crea la colonna della tassonomia nella tabella del post type associato
        'show_admin_column' => true,
        // Rende la tassonoimia selezionabile per i menù di navigazione
        'show_in_nav_menus' => true,
        // Permette l'uso della tassonomia al widget Tag cloud
        'show_tagcloud' => true,
    );
    register_taxonomy( 'Categoria', array( 'motorsport' ), $args );
}
add_action( 'init', 'motorsport_categorie', 0 );


  function trovaPilota_ajax() {
    if(!wp_verify_nonce($_REQUEST['_nonce'], 'pilota-nonce')) {
      die('non autorizzato');
    }

    $idArrivato = $_POST['idCategoria'];

    echo $idArrivato;

    die();
  }
  add_action('wp_ajax_trovaPilota', 'trovaPilota_ajax');
  add_action('wp_ajax_nopriv_trovaPilota', 'trovaPilota_ajax');

 ?>
