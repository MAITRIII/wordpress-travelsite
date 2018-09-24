<?php
/**
 * Basic functions for the plugin.
 *
 * Maintain a list of functions that are used in the plugin for basic purposes
 *
 * @package    Wp_Travel_Engine
 * @subpackage Wp_Travel_Engine/includes
 * @author    
 */
class Wp_Travel_Engine_Functions
{

	function init()
	{
		foreach ( array( 'pre_term_description' ) as $filter ) {
    	remove_filter( $filter, 'wp_filter_kses' );
		}
		 
		foreach ( array( 'term_description' ) as $filter ) {
		    remove_filter( $filter, 'wp_kses_data' );
		}
		add_filter( 'term_description', 'shortcode_unautop');
		add_filter( 'term_description', 'do_shortcode' );
		add_filter( 'the_content', array( $this, 'wte_remove_empty_p' ), 20, 1);
		add_filter( 'term_description', array( $this, 'wte_remove_empty_p' ), 20, 1);
		add_filter( 'pll_get_post_types', array( $this, 'wte_add_cpt_to_pll' ), 10, 2 );
		add_filter( 'pll_get_taxonomies', array( $this,'wte_add_tax_to_pll' ), 10, 2 );
	}
 
	function wte_add_cpt_to_pll( $post_types, $is_settings ) {
	    if ( $is_settings ) {
	        unset( $post_types['my_cpt'] );
	        unset( $post_types['my_cpt1'] );
	        unset( $post_types['my_cpt2'] );
	        unset( $post_types['my_cpt3'] );
	    } else {
	        $post_types['my_cpt'] = 'trip';
	        $post_types['my_cpt1'] = 'booking';
	        $post_types['my_cpt2'] = 'customer';
	        $post_types['my_cpt3'] = 'enquiry';
	    }
	    return $post_types;
	}

 
	function wte_add_tax_to_pll( $taxonomies, $is_settings ) {
	    if ( $is_settings ) {
	        unset( $taxonomies['my_tax'] );
	        unset( $taxonomies['my_tax1'] );
	        unset( $taxonomies['my_tax2'] );
	    } else {
	        $taxonomies['my_tax'] = 'destination';
	        $taxonomies['my_tax1'] = 'activities';
	        $taxonomies['my_tax2'] = 'trip_types';
	    }
	    return $taxonomies;
	}

	//search value in array
	function wp_travel_engine_in_array_r($needle, $haystack, $strict = false) {
	    foreach ($haystack as $item) {
	        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
	            return true;
	        }
	    }

	    return false;
	}

	/**
	* Get Base Currency Code.
	*
	* @return string
	*/
	function wp_travel_engine_currency() {
		$option='';
		$option = get_option( 'wp_travel_engine_settings' );
		$currency_type = $option['currency_code'];
		return apply_filters( 'wp_travel_engine_currency', $currency_type );
	}
	
	function wte_remove_empty_p( $content ) {
	    $content = force_balance_tags( $content );
	    $content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
	    $content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content );
	    return $content;
	}

	
	/**
	* Get Pagination.
	*
	* @return string
	*/
	function pagination_bar( $custom_query ) {

	    $total_pages = $custom_query->max_num_pages;
	    $big = 999999999; // need an unlikely integer

	    if ($total_pages > 1){
	        $current_page = max(1, get_query_var('paged'));

	        echo paginate_links(array(
	            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	            'format' => '?paged=%#%',
	            'current' => $current_page,
	            'total' => $total_pages,
	        ));
	    }
	}

	function wpte_pagination_option(){
		$pagination_type = get_theme_mod('pagination_type');
		if( $pagination_type == 'pagination_type-radio-numbered' )
		{
			$this->pagination_bar();
		}
		elseif( $pagination_type == 'pagination_type-radio-default' ) {
			echo paginate_links( $args );
			$args = array(
				'base'               => '%_%',
				'format'             => '?paged=%#%',
				'total'              => 1,
				'current'            => 0,
				'show_all'           => false,
				'end_size'           => 1,
				'mid_size'           => 2,
				'prev_next'          => true,
				'prev_text'          => __('« Previous', 'wp-travel-engine'),
				'next_text'          => __('Next »', 'wp-travel-engine'),
				'type'               => 'plain',
				'add_args'           => false,
				'add_fragment'       => '',
				'before_page_number' => '',
				'after_page_number'  => ''
			);
		}
	}
	
	/**
	* Get full list of currency codes.
	*
	* @return array
	*/
	function wp_travel_engine_currencies() {
		return array_unique(
			apply_filters( 'wp_travel_engine_currencies',
				array(
					'AED' => __( 'United Arab Emirates dirham', 'wp-travel-engine' ),
					'AFN' => __( 'Afghan afghani', 'wp-travel-engine' ),
					'ALL' => __( 'Albanian lek', 'wp-travel-engine' ),
					'AMD' => __( 'Armenian dram', 'wp-travel-engine' ),
					'ANG' => __( 'Netherlands Antillean guilder', 'wp-travel-engine' ),
					'AOA' => __( 'Angolan kwanza', 'wp-travel-engine' ),
					'ARS' => __( 'Argentine peso', 'wp-travel-engine' ),
					'AUD' => __( 'Australian dollar', 'wp-travel-engine' ),
					'AWG' => __( 'Aruban florin', 'wp-travel-engine' ),
					'AZN' => __( 'Azerbaijani manat', 'wp-travel-engine' ),
					'BAM' => __( 'Bosnia and Herzegovina convertible mark', 'wp-travel-engine' ),
					'BBD' => __( 'Barbadian dollar', 'wp-travel-engine' ),
					'BDT' => __( 'Bangladeshi taka', 'wp-travel-engine' ),
					'BGN' => __( 'Bulgarian lev', 'wp-travel-engine' ),
					'BHD' => __( 'Bahraini dinar', 'wp-travel-engine' ),
					'BIF' => __( 'Burundian franc', 'wp-travel-engine' ),
					'BMD' => __( 'Bermudian dollar', 'wp-travel-engine' ),
					'BND' => __( 'Brunei dollar', 'wp-travel-engine' ),
					'BOB' => __( 'Bolivian boliviano', 'wp-travel-engine' ),
					'BRL' => __( 'Brazilian real', 'wp-travel-engine' ),
					'BSD' => __( 'Bahamian dollar', 'wp-travel-engine' ),
					'BTC' => __( 'Bitcoin', 'wp-travel-engine' ),
					'BTN' => __( 'Bhutanese ngultrum', 'wp-travel-engine' ),
					'BWP' => __( 'Botswana pula', 'wp-travel-engine' ),
					'BYR' => __( 'Belarusian ruble (old)', 'wp-travel-engine' ),
					'BYN' => __( 'Belarusian ruble', 'wp-travel-engine' ),
					'BZD' => __( 'Belize dollar', 'wp-travel-engine' ),
					'CAD' => __( 'Canadian dollar', 'wp-travel-engine' ),
					'CDF' => __( 'Congolese franc', 'wp-travel-engine' ),
					'CHF' => __( 'Swiss franc', 'wp-travel-engine' ),
					'CLP' => __( 'Chilean peso', 'wp-travel-engine' ),
					'CNY' => __( 'Chinese yuan', 'wp-travel-engine' ),
					'COP' => __( 'Colombian peso', 'wp-travel-engine' ),
					'CRC' => __( 'Costa Rican col&oacute;n', 'wp-travel-engine' ),
					'CUC' => __( 'Cuban convertible peso', 'wp-travel-engine' ),
					'CUP' => __( 'Cuban peso', 'wp-travel-engine' ),
					'CVE' => __( 'Cape Verdean escudo', 'wp-travel-engine' ),
					'CZK' => __( 'Czech koruna', 'wp-travel-engine' ),
					'DJF' => __( 'Djiboutian franc', 'wp-travel-engine' ),
					'DKK' => __( 'Danish krone', 'wp-travel-engine' ),
					'DOP' => __( 'Dominican peso', 'wp-travel-engine' ),
					'DZD' => __( 'Algerian dinar', 'wp-travel-engine' ),
					'EGP' => __( 'Egyptian pound', 'wp-travel-engine' ),
					'ERN' => __( 'Eritrean nakfa', 'wp-travel-engine' ),
					'ETB' => __( 'Ethiopian birr', 'wp-travel-engine' ),
					'EUR' => __( 'Euro', 'wp-travel-engine' ),
					'FJD' => __( 'Fijian dollar', 'wp-travel-engine' ),
					'FKP' => __( 'Falkland Islands pound', 'wp-travel-engine' ),
					'GBP' => __( 'Pound sterling', 'wp-travel-engine' ),
					'GEL' => __( 'Georgian lari', 'wp-travel-engine' ),
					'GGP' => __( 'Guernsey pound', 'wp-travel-engine' ),
					'GHS' => __( 'Ghana cedi', 'wp-travel-engine' ),
					'GIP' => __( 'Gibraltar pound', 'wp-travel-engine' ),
					'GMD' => __( 'Gambian dalasi', 'wp-travel-engine' ),
					'GNF' => __( 'Guinean franc', 'wp-travel-engine' ),
					'GTQ' => __( 'Guatemalan quetzal', 'wp-travel-engine' ),
					'GYD' => __( 'Guyanese dollar', 'wp-travel-engine' ),
					'HKD' => __( 'Hong Kong dollar', 'wp-travel-engine' ),
					'HNL' => __( 'Honduran lempira', 'wp-travel-engine' ),
					'HRK' => __( 'Croatian kuna', 'wp-travel-engine' ),
					'HTG' => __( 'Haitian gourde', 'wp-travel-engine' ),
					'HUF' => __( 'Hungarian forint', 'wp-travel-engine' ),
					'IDR' => __( 'Indonesian rupiah', 'wp-travel-engine' ),
					'ILS' => __( 'Israeli new shekel', 'wp-travel-engine' ),
					'IMP' => __( 'Manx pound', 'wp-travel-engine' ),
					'INR' => __( 'Indian rupee', 'wp-travel-engine' ),
					'IQD' => __( 'Iraqi dinar', 'wp-travel-engine' ),
					'IRR' => __( 'Iranian rial', 'wp-travel-engine' ),
					'IRT' => __( 'Iranian toman', 'wp-travel-engine' ),
					'ISK' => __( 'Icelandic kr&oacute;na', 'wp-travel-engine' ),
					'JEP' => __( 'Jersey pound', 'wp-travel-engine' ),
					'JMD' => __( 'Jamaican dollar', 'wp-travel-engine' ),
					'JOD' => __( 'Jordanian dinar', 'wp-travel-engine' ),
					'JPY' => __( 'Japanese yen', 'wp-travel-engine' ),
					'KES' => __( 'Kenyan shilling', 'wp-travel-engine' ),
					'KGS' => __( 'Kyrgyzstani som', 'wp-travel-engine' ),
					'KHR' => __( 'Cambodian riel', 'wp-travel-engine' ),
					'KMF' => __( 'Comorian franc', 'wp-travel-engine' ),
					'KPW' => __( 'North Korean won', 'wp-travel-engine' ),
					'KRW' => __( 'South Korean won', 'wp-travel-engine' ),
					'KWD' => __( 'Kuwaiti dinar', 'wp-travel-engine' ),
					'KYD' => __( 'Cayman Islands dollar', 'wp-travel-engine' ),
					'KZT' => __( 'Kazakhstani tenge', 'wp-travel-engine' ),
					'LAK' => __( 'Lao kip', 'wp-travel-engine' ),
					'LBP' => __( 'Lebanese pound', 'wp-travel-engine' ),
					'LKR' => __( 'Sri Lankan rupee', 'wp-travel-engine' ),
					'LRD' => __( 'Liberian dollar', 'wp-travel-engine' ),
					'LSL' => __( 'Lesotho loti', 'wp-travel-engine' ),
					'LYD' => __( 'Libyan dinar', 'wp-travel-engine' ),
					'MAD' => __( 'Moroccan dirham', 'wp-travel-engine' ),
					'MDL' => __( 'Moldovan leu', 'wp-travel-engine' ),
					'MGA' => __( 'Malagasy ariary', 'wp-travel-engine' ),
					'MKD' => __( 'Macedonian denar', 'wp-travel-engine' ),
					'MMK' => __( 'Burmese kyat', 'wp-travel-engine' ),
					'MNT' => __( 'Mongolian t&ouml;gr&ouml;g', 'wp-travel-engine' ),
					'MOP' => __( 'Macanese pataca', 'wp-travel-engine' ),
					'MRO' => __( 'Mauritanian ouguiya', 'wp-travel-engine' ),
					'MUR' => __( 'Mauritian rupee', 'wp-travel-engine' ),
					'MVR' => __( 'Maldivian rufiyaa', 'wp-travel-engine' ),
					'MWK' => __( 'Malawian kwacha', 'wp-travel-engine' ),
					'MXN' => __( 'Mexican peso', 'wp-travel-engine' ),
					'MYR' => __( 'Malaysian ringgit', 'wp-travel-engine' ),
					'MZN' => __( 'Mozambican metical', 'wp-travel-engine' ),
					'NAD' => __( 'Namibian dollar', 'wp-travel-engine' ),
					'NGN' => __( 'Nigerian naira', 'wp-travel-engine' ),
					'NIO' => __( 'Nicaraguan c&oacute;rdoba', 'wp-travel-engine' ),
					'NOK' => __( 'Norwegian krone', 'wp-travel-engine' ),
					'NPR' => __( 'Nepalese rupee', 'wp-travel-engine' ),
					'NZD' => __( 'New Zealand dollar', 'wp-travel-engine' ),
					'OMR' => __( 'Omani rial', 'wp-travel-engine' ),
					'PAB' => __( 'Panamanian balboa', 'wp-travel-engine' ),
					'PEN' => __( 'Peruvian nuevo sol', 'wp-travel-engine' ),
					'PGK' => __( 'Papua New Guinean kina', 'wp-travel-engine' ),
					'PHP' => __( 'Philippine peso', 'wp-travel-engine' ),
					'PKR' => __( 'Pakistani rupee', 'wp-travel-engine' ),
					'PLN' => __( 'Polish z&#x142;oty', 'wp-travel-engine' ),
					'PRB' => __( 'Transnistrian ruble', 'wp-travel-engine' ),
					'PYG' => __( 'Paraguayan guaran&iacute;', 'wp-travel-engine' ),
					'QAR' => __( 'Qatari riyal', 'wp-travel-engine' ),
					'RON' => __( 'Romanian leu', 'wp-travel-engine' ),
					'RSD' => __( 'Serbian dinar', 'wp-travel-engine' ),
					'RUB' => __( 'Russian ruble', 'wp-travel-engine' ),
					'RWF' => __( 'Rwandan franc', 'wp-travel-engine' ),
					'SAR' => __( 'Saudi riyal', 'wp-travel-engine' ),
					'SBD' => __( 'Solomon Islands dollar', 'wp-travel-engine' ),
					'SCR' => __( 'Seychellois rupee', 'wp-travel-engine' ),
					'SDG' => __( 'Sudanese pound', 'wp-travel-engine' ),
					'SEK' => __( 'Swedish krona', 'wp-travel-engine' ),
					'SGD' => __( 'Singapore dollar', 'wp-travel-engine' ),
					'SHP' => __( 'Saint Helena pound', 'wp-travel-engine' ),
					'SLL' => __( 'Sierra Leonean leone', 'wp-travel-engine' ),
					'SOS' => __( 'Somali shilling', 'wp-travel-engine' ),
					'SRD' => __( 'Surinamese dollar', 'wp-travel-engine' ),
					'SSP' => __( 'South Sudanese pound', 'wp-travel-engine' ),
					'STD' => __( 'S&atilde;o Tom&eacute; and Pr&iacute;ncipe dobra', 'wp-travel-engine' ),
					'SYP' => __( 'Syrian pound', 'wp-travel-engine' ),
					'SZL' => __( 'Swazi lilangeni', 'wp-travel-engine' ),
					'THB' => __( 'Thai baht', 'wp-travel-engine' ),
					'TJS' => __( 'Tajikistani somoni', 'wp-travel-engine' ),
					'TMT' => __( 'Turkmenistan manat', 'wp-travel-engine' ),
					'TND' => __( 'Tunisian dinar', 'wp-travel-engine' ),
					'TOP' => __( 'Tongan pa&#x2bb;anga', 'wp-travel-engine' ),
					'TRY' => __( 'Turkish lira', 'wp-travel-engine' ),
					'TTD' => __( 'Trinidad and Tobago dollar', 'wp-travel-engine' ),
					'TWD' => __( 'New Taiwan dollar', 'wp-travel-engine' ),
					'TZS' => __( 'Tanzanian shilling', 'wp-travel-engine' ),
					'UAH' => __( 'Ukrainian hryvnia', 'wp-travel-engine' ),
					'UGX' => __( 'Ugandan shilling', 'wp-travel-engine' ),
					'USD' => __( 'United States dollar', 'wp-travel-engine' ),
					'UYU' => __( 'Uruguayan peso', 'wp-travel-engine' ),
					'UZS' => __( 'Uzbekistani som', 'wp-travel-engine' ),
					'VEF' => __( 'Venezuelan bol&iacute;var', 'wp-travel-engine' ),
					'VND' => __( 'Vietnamese &#x111;&#x1ed3;ng', 'wp-travel-engine' ),
					'VUV' => __( 'Vanuatu vatu', 'wp-travel-engine' ),
					'WST' => __( 'Samoan t&#x101;l&#x101;', 'wp-travel-engine' ),
					'XAF' => __( 'Central African CFA franc', 'wp-travel-engine' ),
					'XCD' => __( 'East Caribbean dollar', 'wp-travel-engine' ),
					'XOF' => __( 'West African CFA franc', 'wp-travel-engine' ),
					'XPF' => __( 'CFP franc', 'wp-travel-engine' ),
					'YER' => __( 'Yemeni rial', 'wp-travel-engine' ),
					'ZAR' => __( 'South African rand', 'wp-travel-engine' ),
					'ZMW' => __( 'Zambian kwacha', 'wp-travel-engine' ),
				)
			)
		);
	}

	/**
	* Get Currency symbol.
	*
	* @param string $currency (default: '')
	* @return string
	*/
	function wp_travel_engine_currencies_symbol( $currency = '' ) {
		if ( ! $currency ) {
			$currency = $this->wp_travel_engine_currency();
		}

		$symbols = apply_filters( 'wp_travel_engine_currency_symbols', array(
			'AED' => '&#x62f;.&#x625;',
		'AFN' => '&#x60b;',
		'ALL' => 'L',
		'AMD' => 'AMD',
		'ANG' => '&fnof;',
		'AOA' => 'Kz',
		'ARS' => '&#36;',
		'AUD' => '&#36;',
		'AWG' => 'Afl.',
		'AZN' => 'AZN',
		'BAM' => 'KM',
		'BBD' => '&#36;',
		'BDT' => '&#2547;&nbsp;',
		'BGN' => '&#1083;&#1074;.',
		'BHD' => '.&#x62f;.&#x628;',
		'BIF' => 'Fr',
		'BMD' => '&#36;',
		'BND' => '&#36;',
		'BOB' => 'Bs.',
		'BRL' => '&#82;&#36;',
		'BSD' => '&#36;',
		'BTC' => '&#3647;',
		'BTN' => 'Nu.',
		'BWP' => 'P',
		'BYR' => 'Br',
		'BYN' => 'Br',
		'BZD' => '&#36;',
		'CAD' => '&#36;',
		'CDF' => 'Fr',
		'CHF' => '&#67;&#72;&#70;',
		'CLP' => '&#36;',
		'CNY' => '&yen;',
		'COP' => '&#36;',
		'CRC' => '&#x20a1;',
		'CUC' => '&#36;',
		'CUP' => '&#36;',
		'CVE' => '&#36;',
		'CZK' => '&#75;&#269;',
		'DJF' => 'Fr',
		'DKK' => 'DKK',
		'DOP' => 'RD&#36;',
		'DZD' => '&#x62f;.&#x62c;',
		'EGP' => 'EGP',
		'ERN' => 'Nfk',
		'ETB' => 'Br',
		'EUR' => '&euro;',
		'FJD' => '&#36;',
		'FKP' => '&pound;',
		'GBP' => '&pound;',
		'GEL' => '&#x10da;',
		'GGP' => '&pound;',
		'GHS' => '&#x20b5;',
		'GIP' => '&pound;',
		'GMD' => 'D',
		'GNF' => 'Fr',
		'GTQ' => 'Q',
		'GYD' => '&#36;',
		'HKD' => '&#36;',
		'HNL' => 'L',
		'HRK' => 'Kn',
		'HTG' => 'G',
		'HUF' => '&#70;&#116;',
		'IDR' => 'Rp',
		'ILS' => '&#8362;',
		'IMP' => '&pound;',
		'INR' => '&#8377;',
		'IQD' => '&#x639;.&#x62f;',
		'IRR' => '&#xfdfc;',
		'IRT' => '&#x062A;&#x0648;&#x0645;&#x0627;&#x0646;',
		'ISK' => 'kr.',
		'JEP' => '&pound;',
		'JMD' => '&#36;',
		'JOD' => '&#x62f;.&#x627;',
		'JPY' => '&yen;',
		'KES' => 'KSh',
		'KGS' => '&#x441;&#x43e;&#x43c;',
		'KHR' => '&#x17db;',
		'KMF' => 'Fr',
		'KPW' => '&#x20a9;',
		'KRW' => '&#8361;',
		'KWD' => '&#x62f;.&#x643;',
		'KYD' => '&#36;',
		'KZT' => 'KZT',
		'LAK' => '&#8365;',
		'LBP' => '&#x644;.&#x644;',
		'LKR' => '&#xdbb;&#xdd4;',
		'LRD' => '&#36;',
		'LSL' => 'L',
		'LYD' => '&#x644;.&#x62f;',
		'MAD' => '&#x62f;.&#x645;.',
		'MDL' => 'MDL',
		'MGA' => 'Ar',
		'MKD' => '&#x434;&#x435;&#x43d;',
		'MMK' => 'Ks',
		'MNT' => '&#x20ae;',
		'MOP' => 'P',
		'MRO' => 'UM',
		'MUR' => '&#x20a8;',
		'MVR' => '.&#x783;',
		'MWK' => 'MK',
		'MXN' => '&#36;',
		'MYR' => '&#82;&#77;',
		'MZN' => 'MT',
		'NAD' => '&#36;',
		'NGN' => '&#8358;',
		'NIO' => 'C&#36;',
		'NOK' => '&#107;&#114;',
		'NPR' => '&#8360;',
		'NZD' => '&#36;',
		'OMR' => '&#x631;.&#x639;.',
		'PAB' => 'B/.',
		'PEN' => 'S/.',
		'PGK' => 'K',
		'PHP' => '&#8369;',
		'PKR' => '&#8360;',
		'PLN' => '&#122;&#322;',
		'PRB' => '&#x440;.',
		'PYG' => '&#8370;',
		'QAR' => '&#x631;.&#x642;',
		'RMB' => '&yen;',
		'RON' => 'lei',
		'RSD' => '&#x434;&#x438;&#x43d;.',
		'RUB' => '&#8381;',
		'RWF' => 'Fr',
		'SAR' => '&#x631;.&#x633;',
		'SBD' => '&#36;',
		'SCR' => '&#x20a8;',
		'SDG' => '&#x62c;.&#x633;.',
		'SEK' => '&#107;&#114;',
		'SGD' => '&#36;',
		'SHP' => '&pound;',
		'SLL' => 'Le',
		'SOS' => 'Sh',
		'SRD' => '&#36;',
		'SSP' => '&pound;',
		'STD' => 'Db',
		'SYP' => '&#x644;.&#x633;',
		'SZL' => 'L',
		'THB' => '&#3647;',
		'TJS' => '&#x405;&#x41c;',
		'TMT' => 'm',
		'TND' => '&#x62f;.&#x62a;',
		'TOP' => 'T&#36;',
		'TRY' => '&#8378;',
		'TTD' => '&#36;',
		'TWD' => '&#78;&#84;&#36;',
		'TZS' => 'Sh',
		'UAH' => '&#8372;',
		'UGX' => 'UGX',
		'USD' => '&#36;',
		'UYU' => '&#36;',
		'UZS' => 'UZS',
		'VEF' => 'Bs F',
		'VND' => '&#8363;',
		'VUV' => 'Vt',
		'WST' => 'T',
		'XAF' => 'CFA',
		'XCD' => '&#36;',
		'XOF' => 'CFA',
		'XPF' => 'Fr',
		'YER' => '&#xfdfc;',
		'ZAR' => '&#82;',
		'ZMW' => 'ZK',
			) );

		$currency_symbol = isset( $symbols[ $currency ] ) ? $symbols[ $currency ] : '';

		return apply_filters( 'wp_travel_engine_currency_symbol', $currency_symbol, $currency );
	}

	/**
	* Get default settings when no settings are saved
	*
	* @return array of default settings
	*/
	public function wp_travel_engine_get_default_settings() {

		$default_settings = array(
			'currency_code'          => 'USD',
			'price'         => '0.01',
			'charges'          => '50.01',
			);
		$default_settings = apply_filters( 'wp_travel_engine_default_settings', $default_settings );
		return $default_settings;
	}

	/**
	* Get clean special characters free string
	*
	* @return clean string
	*/
	public function wpte_clean($string) {
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
		$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
		$string = strtolower($string); // Convert to lowercase
		return $string;
	} 
 	
	/**
	* Get field options for trip facts.
	*
	* @return string
	*/
 	function trip_facts_field_options()
	{

		$options = array(
            'text'   	=> 'text',
            'number' 	=> 'number',
            'select' 	=> 'select',
            'textarea' 	=> 'textarea',
            'duration'	=> 'duration',
            );
        $options = apply_filters( 'wp_travel_engine_trip_facts_field_options', $options );
        return $options;
	}

	/**
	* Get options for title while booking trip.
	*
	* @param string $title (default: '')
	* @return string
	*/
 	function order_form_title_options()
	{

		$options = array(
            'Mr'	=>'Mr',
			'Mrs'	=>'Mrs',
			'Ms'	=>'Ms',
			'Miss'	=>'Miss',
			'Other'	=>'Other'
            );
        $options = apply_filters( 'wp_travel_engine_order_form_title_options', $options );
        return $options;
	}

	/**
	* Get default payment method.
	*
	* @param string $options (default: '')
	* @return string
	*/
 	function payment_gateway_options()
	{
		$options = array(
            'paypal_standard'=> 'PayPal Standard',
            'test_payment' 	 => 'Test Payment',
            'amazon' 		 => 'Amazon',
            );
        $options = apply_filters( 'wp_travel_engine_default_payment_gateway_options', $options );
        return $options;
	}

	/**
	* Get field options for place order form.
	*
	*/
 	function wp_travel_engine_place_order_field_options()
	{

		$options = array(
            'text'   		=> 'text',
            'number' 		=> 'number',
            'select' 		=> 'select',
            'textarea' 		=> 'textarea',
            'country-list'	=> 'countrylist',
            'datetime'		=> 'datetime',
            'email'			=> 'email',
            );
        $options = apply_filters( 'wp_travel_engine_place_order_field_options', $options );
        return $options;
	}

	/**
	* Get template options for place order form.
	*
	*/
 	function wp_travel_engine_template_options()
	{

		$options = array(
            'default-template'=> 'default-template',
            );
        $options = apply_filters( 'wp_travel_engine_template_options', $options );
        return $options;
	}

	/**
	* Get formatted cost.
	*
	* @param string $formatted_cost (default: '')
	* @return string
	*/
	function wp_travel_engine_price_format( $cost='' )
	{
		$settings = get_option( 'wp_travel_engine_settings' ); 
		$settings['departure_dates']['decimal_no'] = isset( $settings['departure_dates']['decimal_no'] ) ? esc_attr( $settings['departure_dates']['decimal_no'] ):'2';
		$settings['departure_dates']['separator'] = isset( $settings['departure_dates']['separator'] ) ? esc_attr( $settings['departure_dates']['separator'] ):',';
		$settings['departure_dates']['dec_separator'] = isset( $settings['departure_dates']['dec_separator'] ) ? esc_attr( $settings['departure_dates']['dec_separator'] ):'.';
		$formatted_cost =  number_format( (int)$cost, 0, '', ',' );
		return $formatted_cost;
	}

	/**
	* Get country list for dropdown.
	*
	* @since 1.0.0
	*/
	function wp_travel_engine_country_list()
	{ 
		$options = array(
			"AFG"=>"Afghanistan",
			"ALA"=>"Åland Islands",
			"ALB"=>"Albania",
			"DZA"=>"Algeria",
			"ASM"=>"American Samoa",
			"AND"=>"Andorra",
			"AGO"=>"Angola",
			"AIA"=>"Anguilla",
			"ATA"=>"Antarctica",
			"ATG"=>"Antigua and Barbuda",
			"ARG"=>"Argentina",
			"ARM"=>"Armenia",
			"ABW"=>"Aruba",
			"AUS"=>"Australia",
			"AUT"=>"Austria",
			"AZE"=>"Azerbaijan",
			"BHS"=>"Bahamas",
			"BHR"=>"Bahrain",
			"BGD"=>"Bangladesh",
			"BRB"=>"Barbados",
			"BLR"=>"Belarus",
			"BEL"=>"Belgium",
			"BLZ"=>"Belize",
			"BEN"=>"Benin",
			"BMU"=>"Bermuda",
			"BTN"=>"Bhutan",
			"BOL"=>"Bolivia, Plurinational State of",
			"BES"=>"Bonaire, Sint Eustatius and Saba",
			"BIH"=>"Bosnia and Herzegovina",
			"BWA"=>"Botswana",
			"BVT"=>"Bouvet Island",
			"BRA"=>"Brazil",
			"IOT"=>"British Indian Ocean Territory",
			"BRN"=>"Brunei Darussalam",
			"BGR"=>"Bulgaria",
			"BFA"=>"Burkina Faso",
			"BDI"=>"Burundi",
			"KHM"=>"Cambodia",
			"CMR"=>"Cameroon",
			"CAN"=>"Canada",
			"CPV"=>"Cape Verde",
			"CYM"=>"Cayman Islands",
			"CAF"=>"Central African Republic",
			"TCD"=>"Chad",
			"CHL"=>"Chile",
			"CHN"=>"China",
			"CXR"=>"Christmas Island",
			"CCK"=>"Cocos (Keeling) Islands",
			"COL"=>"Colombia",
			"COM"=>"Comoros",
			"COG"=>"Congo",
			"COD"=>"Congo, the Democratic Republic of the",
			"COK"=>"Cook Islands",
			"CRI"=>"Costa Rica",
			"CIV"=>"Côte d'Ivoire",
			"HRV"=>"Croatia",
			"CUB"=>"Cuba",
			"CUW"=>"Curaçao",
			"CYP"=>"Cyprus",
			"CZE"=>"Czech Republic",
			"DNK"=>"Denmark",
			"DJI"=>"Djibouti",
			"DMA"=>"Dominica",
			"DOM"=>"Dominican Republic",
			"ECU"=>"Ecuador",
			"EGY"=>"Egypt",
			"SLV"=>"El Salvador",
			"GNQ"=>"Equatorial Guinea",
			"ERI"=>"Eritrea",
			"EST"=>"Estonia",
			"ETH"=>"Ethiopia",
			"FLK"=>"Falkland Islands (Malvinas)",
			"FRO"=>"Faroe Islands",
			"FJI"=>"Fiji",
			"FIN"=>"Finland",
			"FRA"=>"France",
			"GUF"=>"French Guiana",
			"PYF"=>"French Polynesia",
			"ATF"=>"French Southern Territories",
			"GAB"=>"Gabon",
			"GMB"=>"Gambia",
			"GEO"=>"Georgia",
			"DEU"=>"Germany",
			"GHA"=>"Ghana",
			"GIB"=>"Gibraltar",
			"GRC"=>"Greece",
			"GRL"=>"Greenland",
			"GRD"=>"Grenada",
			"GLP"=>"Guadeloupe",
			"GUM"=>"Guam",
			"GTM"=>"Guatemala",
			"GGY"=>"Guernsey",
			"GIN"=>"Guinea",
			"GNB"=>"Guinea-Bissau",
			"GUY"=>"Guyana",
			"HTI"=>"Haiti",
			"HMD"=>"Heard Island and McDonald Islands",
			"VAT"=>"Holy See (Vatican City State)",
			"HND"=>"Honduras",
			"HKG"=>"Hong Kong",
			"HUN"=>"Hungary",
			"ISL"=>"Iceland",
			"IND"=>"India",
			"IDN"=>"Indonesia",
			"IRN"=>"Iran, Islamic Republic of",
			"IRQ"=>"Iraq",
			"IRL"=>"Ireland",
			"IMN"=>"Isle of Man",
			"ISR"=>"Israel",
			"ITA"=>"Italy",
			"JAM"=>"Jamaica",
			"JPN"=>"Japan",
			"JEY"=>"Jersey",
			"JOR"=>"Jordan",
			"KAZ"=>"Kazakhstan",
			"KEN"=>"Kenya",
			"KIR"=>"Kiribati",
			"PRK"=>"Korea, Democratic People's Republic of",
			"KOR"=>"Korea, Republic of",
			"KWT"=>"Kuwait",
			"KGZ"=>"Kyrgyzstan",
			"LAO"=>"Lao People's Democratic Republic",
			"LVA"=>"Latvia",
			"LBN"=>"Lebanon",
			"LSO"=>"Lesotho",
			"LBR"=>"Liberia",
			"LBY"=>"Libya",
			"LIE"=>"Liechtenstein",
			"LTU"=>"Lithuania",
			"LUX"=>"Luxembourg",
			"MAC"=>"Macao",
			"MKD"=>"Macedonia, the former Yugoslav Republic of",
			"MDG"=>"Madagascar",
			"MWI"=>"Malawi",
			"MYS"=>"Malaysia",
			"MDV"=>"Maldives",
			"MLI"=>"Mali",
			"MLT"=>"Malta",
			"MHL"=>"Marshall Islands",
			"MTQ"=>"Martinique",
			"MRT"=>"Mauritania",
			"MUS"=>"Mauritius",
			"MYT"=>"Mayotte",
			"MEX"=>"Mexico",
			"FSM"=>"Micronesia, Federated States of",
			"MDA"=>"Moldova, Republic of",
			"MCO"=>"Monaco",
			"MNG"=>"Mongolia",
			"MNE"=>"Montenegro",
			"MSR"=>"Montserrat",
			"MAR"=>"Morocco",
			"MOZ"=>"Mozambique",
			"MMR"=>"Myanmar",
			"NAM"=>"Namibia",
			"NRU"=>"Nauru",
			"NPL"=>"Nepal",
			"NLD"=>"Netherlands",
			"NCL"=>"New Caledonia",
			"NZL"=>"New Zealand",
			"NIC"=>"Nicaragua",
			"NER"=>"Niger",
			"NGA"=>"Nigeria",
			"NIU"=>"Niue",
			"NFK"=>"Norfolk Island",
			"MNP"=>"Northern Mariana Islands",
			"NOR"=>"Norway",
			"OMN"=>"Oman",
			"PAK"=>"Pakistan",
			"PLW"=>"Palau",
			"PSE"=>"Palestinian Territory, Occupied",
			"PAN"=>"Panama",
			"PNG"=>"Papua New Guinea",
			"PRY"=>"Paraguay",
			"PER"=>"Peru",
			"PHL"=>"Philippines",
			"PCN"=>"Pitcairn",
			"POL"=>"Poland",
			"PRT"=>"Portugal",
			"PRI"=>"Puerto Rico",
			"QAT"=>"Qatar",
			"REU"=>"Réunion",
			"ROU"=>"Romania",
			"RUS"=>"Russian Federation",
			"RWA"=>"Rwanda",
			"BLM"=>"Saint Barthélemy",
			"SHN"=>"Saint Helena, Ascension and Tristan da Cunha",
			"KNA"=>"Saint Kitts and Nevis",
			"LCA"=>"Saint Lucia",
			"MAF"=>"Saint Martin (French part)",
			"SPM"=>"Saint Pierre and Miquelon",
			"VCT"=>"Saint Vincent and the Grenadines",
			"WSM"=>"Samoa",
			"SMR"=>"San Marino",
			"STP"=>"Sao Tome and Principe",
			"SAU"=>"Saudi Arabia",
			"SEN"=>"Senegal",
			"SRB"=>"Serbia",
			"SYC"=>"Seychelles",
			"SLE"=>"Sierra Leone",
			"SGP"=>"Singapore",
			"SXM"=>"Sint Maarten (Dutch part)",
			"SVK"=>"Slovakia",
			"SVN"=>"Slovenia",
			"SLB"=>"Solomon Islands",
			"SOM"=>"Somalia",
			"ZAF"=>"South Africa",
			"SGS"=>"South Georgia and the South Sandwich Islands",
			"SSD"=>"South Sudan",
			"ESP"=>"Spain",
			"LKA"=>"Sri Lanka",
			"SDN"=>"Sudan",
			"SUR"=>"Suriname",
			"SJM"=>"Svalbard and Jan Mayen",
			"SWZ"=>"Swaziland",
			"SWE"=>"Sweden",
			"CHE"=>"Switzerland",
			"SYR"=>"Syrian Arab Republic",
			"TWN"=>"Taiwan, Province of China",
			"TJK"=>"Tajikistan",
			"TZA"=>"Tanzania, United Republic of",
			"THA"=>"Thailand",
			"TLS"=>"Timor-Leste",
			"TGO"=>"Togo",
			"TKL"=>"Tokelau",
			"TON"=>"Tonga",
			"TTO"=>"Trinidad and Tobago",
			"TUN"=>"Tunisia",
			"TUR"=>"Turkey",
			"TKM"=>"Turkmenistan",
			"TCA"=>"Turks and Caicos Islands",
			"TUV"=>"Tuvalu",
			"UGA"=>"Uganda",
			"UKR"=>"Ukraine",
			"ARE"=>"United Arab Emirates",
			"GBR"=>"United Kingdom",
			"USA"=>"United States",
			"UMI"=>"United States Minor Outlying Islands",
			"URY"=>"Uruguay",
			"UZB"=>"Uzbekistan",
			"VUT"=>"Vanuatu",
			"VEN"=>"Venezuela, Bolivarian Republic of",
			"VNM"=>"Viet Nam",
			"VGB"=>"Virgin Islands, British",
			"VIR"=>"Virgin Islands, U.S.",
			"WLF"=>"Wallis and Futuna",
			"ESH"=>"Western Sahara",
			"YEM"=>"Yemen",
			"ZMB"=>"Zambia",
			"ZWE"=>"Zimbabwe"
		);
        $options = apply_filters( 'wp_travel_engine_country_options', $options );
        return $options;
	}

	function order_form_billing_options()
	{

		$options = array(
					'fname' => array(
							'label'=>'First Name',
							'type'=>'text',
							'placeholder'=>'Your First Name',
							'required'=>'1'
						),
					'lname' => array(
							'label'=>'Last Name',
							'type'=>'text',
							'placeholder'=>'Your Last Name',
							'required'=>'1'
						),
					'email' => array(
							'label'=>'Email',
							'type'=>'email',
							'placeholder'=>'Your Valid Email',
							'required'=>'1'
						),
					'address' => array(
							'label'=>'Address',
							'type'=>'text',
							'placeholder'=>'Your Address',
							'required'=>'1'
						),
					'city' => array(
							'label'=>'City',
							'type'=>'text',
							'placeholder'=>'Your City',
							'required'=>'1'
						),
					'country' => array(
							'label'=>'Country',
							'type'=>'country-list',
							'required'=>'1'
						),
		);
		$options = apply_filters( 'wp_travel_engine_order_form_billing_options', $options );
        return $options;
	}

	function order_form_personal_options()
	{

		$options = array(
					'title'	=> array(
							'label'			=>'Title',
							'type'			=>'select',
							'required'		=> '1',
							'options'		=>array(
												'Mr'	=>'Mr',
												'Mrs'	=>'Mrs',
												'Ms'	=>'Ms',
												'Miss'	=>'Miss',
												'Other'	=>'Other'
											)
						),
					'fname' 	=> array(
							'label'			=>'First Name',
							'type'			=>'text',
							'placeholder'	=>'Your First Name',
							'required'		=>'1'
						),
					'lname' 	=> array(
							'label'			=>'Last Name',
							'type'			=>'text',
							'placeholder'	=>'Your Last Name',
							'required'		=>'1'
						),
					'passport' 	=> array(
							'label'			=>'Passport Number',
							'type'			=>'text',
							'placeholder'	=>'Your Valid Passport Number',
							'required'		=>'1'
						),
					'email' 	=> array(
							'label'			=>'Email',
							'type'			=>'email',
							'placeholder'	=>'Your Valid Email',
							'required'		=>'1'
						),
					'address' 	=> array(
							'label'			=>'Address',
							'type'			=>'text',
							'placeholder'	=>'Your Address',
							'required'		=>'1'
						),
					'city' 		=> array(
							'label'			=>'City',
							'type'			=>'text',
							'placeholder'	=>'Your City',
							'required'		=>'1'
						),
					'country' 	=> array(
							'label'			=>'Country',
							'type'			=>'country-list',
							'required'		=>'1'
						),
					'postcode' 	=> array(
							'label'			=>'Post-code',
							'type'			=>'number',
							'required'		=>'1'
						),
					'phone'    	=> array(
							'label'			=>'Phone',
							'type'			=>'tel',
							'required'		=>'1'
						),
					'dob'		=> array(
							'label'			=>'Date of Birth',
							'type'			=>'text',
							'required'		=> '1'
						),
					'special'	=> array(
							'label'			=>'Special Requirements',
							'type'			=>'textarea',
							'required'		=> '1'
						),
				);
		$options = apply_filters( 'wp_travel_engine_order_form_personal_options', $options );
        return $options;
	}

	function wpte_enquiry_options()
	{

		$options = array(
					
					'country' 	=> array(
							'label'			=>__('Country','wp-travel-engine'),
							'type'			=>'country-list',
							'placeholder'	=>__('Choose a country&hellip;','wp-travel-engine'),
							'required'		=>'1'
						),
					'contact'    	=> array(
							'label'			=>__('Contact No.','wp-travel-engine'),
							'type'			=>'tel',
							'placeholder'	=>__('Enter Your Contact Number','wp-travel-engine'),
							'required'		=>'1'
						),
					'adults'		=> array(
							'label'			=>__('Adults','wp-travel-engine'),
							'type'			=>'number',
							'placeholder'	=>__('Enter Number of Adults','wp-travel-engine'),
							'required'		=> '1'
						),
					'children'		=> array(
							'label'			=>__('Children','wp-travel-engine'),
							'type'			=>'number',
							'placeholder'	=>__('Enter Number of Children','wp-travel-engine'),
							'required'		=> '1'
						),
					'message'	=> array(
							'label'			=>__('Your Message','wp-travel-engine'),
							'type'			=>'textarea',
							'placeholder'	=>__('Enter Your message','wp-travel-engine'),
							'required'		=> '1'
						),
				);
		$options = apply_filters( 'wp_travel_engine_inquiry_form_options', $options );
        return $options;
	}


	function order_form_relation_options()
	{

		$options = array(
					'title'	=> array(
							'label'			=>'Title',
							'type'			=>'select',
							'required'		=> '1',
							'options'		=>array(
												'Mr'	=>'Mr',
												'Mrs'	=>'Mrs',
												'Ms'	=>'Ms',
												'Miss'	=>'Miss',
												'Other'	=>'Other'
											)
						),
					'fname' => array(
							'label'=>'First Name',
							'type'=>'text',
							'placeholder'=>'Your First Name',
							'required'=>'1'
						),
					'lname' => array(
							'label'=>'Last Name',
							'type'=>'text',
							'placeholder'=>'Your Last Name',
							'required'=>'1'
						),
					'phone' => array(
							'label'=>'Phone',
							'type'=>'tel',
							'required'=>'1'
						),
					'relation' => array(
							'label'=>'Relationship',
							'type'=>'text',
							'required'=>'1'
						),
		);
		$options = apply_filters( 'wp_travel_engine_order_form_relation_options', $options );
        return $options;
	}

	/**
	* Get gender options.
	*
	* @param string $options (default: '')
	* @return string
	*/
 	function gender_options()
	{
		$options = array(
            'male'		=> 'male',
            'female' 	=> 'female',
            'other' 	=> 'other',
            );
        $options = apply_filters( 'wp_travel_engine_gender_options', $options );
        return $options;
	}

	function wp_mail_from() {
		$current_site = get_option('blogname');
    	return 'wordpress@'.$current_site;
	}

	/**
	 * Sanitize a multidimensional array
	 *
	 * @uses htmlspecialchars
	 *
	 * @param (array)
	 * @return (array) the sanitized array
	 */
	function wte_sanitize_array ($data = array()) {
		if (!is_array($data) || !count($data)) {
			return array();
		}
		foreach ($data as $k => $v) {
			if (!is_array($v) && !is_object($v)) {
				$data[$k] = htmlspecialchars(trim($v));
			}
			if (is_array($v)) {
				$data[$k] = $this->wte_sanitize_array($v);
			}
		}
		return $data;
	}
}
$obj = new Wp_Travel_Engine_Functions;
$obj->init();