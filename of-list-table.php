<?php
/*
* Table rendering
*/

if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class OF_Taxonomy_List_Table extends WP_List_Table {

	private $taxonomy_data = array();
	
	function __construct()
	{
		global $status, $page;
		parent::__construct(array(
			'singular'=> 'wp_list_of_taxonomy', //Singular label
			'plural' => 'wp_list_of_taxonomies', //plural label, also this well be one of the table css class
			'ajax'	=> false //We won't support Ajax for this table
		));
				
		$args = array(
		  'public'   => true,
		); 
		$output = 'object'; // or objects
		$operator = 'and'; // 'and' or 'or'
		$taxonomies = get_taxonomies( $args, $output, $operator ); 
		
		//var_dump($taxonomies['post_tag']['labels']['all_items']); - all items should be used in the drop downs
		
		$counter = 0;
		if ( $taxonomies )
		{
			foreach ( $taxonomies  as $taxonomy )
			{
				$ttaxonomydata = array(
					"ID"			=>	$counter,
					"name"			=>	$taxonomy->name,
					"label"		=>	$taxonomy->labels->name,
					"posttypes"		=>	implode(', ', $taxonomy->object_type)
				);
				
				$this->taxonomy_data[] = $ttaxonomydata;
			}
		}
	}
	
	function get_columns(){
		$columns = array(
			'name'			=> 'Name',
			'label'			=> 'Label',
			'posttypes'		=> 'Post Types'
		);
		return $columns;
	}
	
	function prepare_items() {
		$columns = $this->get_columns();
		$hidden = array();
		$sortable = array();
		$this->_column_headers = array($columns, $hidden, $sortable);
		$this->items = $this->taxonomy_data;
	}
	
	function column_default( $item, $column_name ) {
		switch( $column_name )
		{ 
			case 'name':
			case 'label':
			case 'posttypes':
				return $item[ $column_name ];
			default:
				return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
		}
	}
	
	
	function get_sortable_columns()
	{
		$sortable_columns = array(
		);
		return $sortable_columns;
	}
}



class OF_Variable_List_Table extends WP_List_Table {

	private $taxonomy_data = array();
	
	function __construct()
	{
		parent::__construct(array(
			'singular'=> 'wp_list_of_variable', //Singular label
			'plural' => 'wp_list_of_variables', //plural label, also this well be one of the table css class
			'ajax'	=> false //We won't support Ajax for this table
		));
				
		//var_dump($taxonomies['post_tag']['labels']['all_items']); - all items should be used in the drop downs
		$counter = 0;
		$args = array(
		  'public'   => true,
		); 
		$output = 'names'; // or objects
		$taxonomies = get_taxonomies( $args, $output ); 
		$fulltaxonomylist = implode(",",$taxonomies);
		
		$this->taxonomy_data[] = array(
			"ID"			=> $counter,
			"name"			=> "taxonomies",
			"defaultval"	=> "&nbsp;",
			"options"		=> "<em>Comma seperated list of any taxonomy names found in the Public Taxonomies table below.</em>",
			"info"			=> "Example using all your public taxonomies (copy &amp; paste!):<pre><code class='string'>[searchandfilter taxonomies=\"".$fulltaxonomylist."\"]</code></pre>"
		);
		$counter++;
		
		
		$this->taxonomy_data[] = array(
			"ID"			=> $counter,
			"name"			=> "type",
			"defaultval"	=> "select",
			"options"		=> "<em>Comma seperated list of any of the types found below:</em><br /><br />select<br />checkbox<br />radio",
			"info"			=> "The order of values in this comma seperated list needs to match the taxonomies list. <br /><br />To display categories, tags and post formats, as a `select` dropdown, radio buttons and checkboxes, we must put them in the order we need: 
			<br /><pre><code class='string'>[searchandfilter taxonomies=\"category,post_tag,post_format\" type=\"select,checkbox,radio\"]</code></pre>
			If any taxonomies are left unspecified they well default to `select` dropdowns:
			<br /><pre><code class='string'>[searchandfilter taxonomies=\"category,post_tag,post_format\" type=\"select,checkbox\"]</code></pre>
			With this example using just \"select,checkbox\", the post format (being the third, not provided parameter) will be displayed as a `select` dropdown.<br /><br />
			
			If the `type` argument is ommited completely all taxonomies will be displayed as `select` dropdowns."
		);
		$counter++;
		
		$this->taxonomy_data[] = array(
			"ID"			=> $counter,
			"name"			=> "label",
			"defaultval"	=> "name",
			"options"		=> "0 - hide all labels<br /><br /> or <br /><br /><em>Comma seperated list of any of the types found below:</em><br /><br />name<br />singular_name<br />search_items<br />all_items<br /><em>*blank value</em>",
			"info"			=> "This list works the same as the `type` example above.<br /><br />
			The different values that can be used are taken directly from the labels within a taxonomy object - so make sure you set these in your taxonomies if you wish to use them below.
			<br /><br />Examples:<br /><br />
			<strong>Hide all labels:</strong>
			<pre><code class='string'>[searchandfilter taxonomies=\"category,post_tag,post_format\" label=\"0\"]</code></pre>
			<strong>Mixture of different label types:</strong>
			<pre><code class='string'>[searchandfilter taxonomies=\"category,post_tag,post_format\" label=\"singular_name,search_items,all_items\"]</code></pre>
			<strong>Hiding the label for category and tag, and set `name` for the post format:</strong>
			<pre><code class='string'>[searchandfilter taxonomies=\"category,post_tag,post_format\" label=\",,name\"]</code></pre>
			*In this last example, a blank value (ie, comma's with no data in between) tells Search &amp; Filter to hide the label for the particular taxonomy.<br /><br />
			If the `label` argument is ommited completely all labels will be shown by default and will be set to use the `name` label for a taxonomy.
			"
		);
		$counter++;
		
		$this->taxonomy_data[] = array(
			"ID"			=> $counter,
			"name"			=> "search",
			"defaultval"	=> "1",
			"options"		=> "0 - hide the search box<br />1 - display search box",
			"info"			=> "The search box is shown by default, ommit from shortcode unless you specifically want to hide it - then set it with a value of 0."
		);
		$counter++;
		
		$this->taxonomy_data[] = array(
			"ID"			=> $counter,
			"name"			=> "class",
			"defaultval"	=> "",
			"options"		=> "<em>Any string</em>",
			"info"			=> "Enter a class name here, or class names seperated by spaces to have them added to Search &amp; Filter form. This allows individual styling of each Search &amp; Filter instance.<br /><br />Ommit to ignore."
		);
		$counter++;
		
		
		$this->taxonomy_data[] = array(
			"ID"			=> $counter,
			"name"			=> "submitlabel",
			"defaultval"	=> "Submit",
			"options"		=> "<em>Any string</em>",
			"info"			=> "This is the text label on the submit button."
		);
		$counter++;
		
	}
	
	function get_columns(){
		$columns = array(
			'name'			=> 'Name',
			'defaultval'		=> 'Default Value',
			'options'		=> 'Options',
			'info'		=> 'Additonal Information'
		);
		return $columns;
	}
	
	function prepare_items() {
		$columns = $this->get_columns();
		$hidden = array();
		$sortable = array();
		$this->_column_headers = array($columns, $hidden, $sortable);
		$this->items = $this->taxonomy_data;
	}
	function column_default( $item, $column_name )
	{
		switch( $column_name )
		{ 
			case 'name':
			case 'defaultval':
			case 'options':
			case 'info':
				return $item[ $column_name ];
			default:
				return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
		}
	}
	
	
	
}


?>