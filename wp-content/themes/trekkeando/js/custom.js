"use strict";

/*!
 * Custom v1.0
 * Contains handlers for the different site functions
 *
 * Copyright (c) 2013-2017 WPFriendship.com
 * License: GNU General Public License v2 or later
 * http://www.gnu.org/licenses/gpl-2.0.html
 */

/* global enquire:true */

( function( $ ) {

  var rowThm = {
    // home menu
    homeTopBarInit: function() {

      $(window).scroll(function(){
        var scrolled = $(document).scrollTop();

        if(scrolled > 10){
          $('#topbar').removeClass('transparent');
        } else if (scrolled < 10){
          $('#topbar').addClass('transparent');
        }
      }).trigger('scroll');

    },

    // Responsive Videos
    responsiveVideosInit: function() {
      $( '.entry-content, .sidebar' ).fitVids();
    },

    // Responsive Menu
    responsiveMenuInit: function() {

      // Add dropdown toggle that display child menu items.
      $( '#header-menu .menu-item-has-children > a' ).append( '<button class="dropdown-toggle" aria-expanded="false"/>' );
      $( '#header-menu .dropdown-toggle' ).off( 'click' ).on( 'click', function( e ) {
        e.preventDefault();
        $( this ).toggleClass( 'toggle-on' );
        $( this ).parent().next( '.children, .sub-menu' ).toggleClass( 'toggle-on' );
        $( this ).attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
      } );

    },

    // Open Slide Panel - Responsive Mobile Menu
    slidePanelInit: function() {

      // Elements
      var menuResponsive      = $( '#header-menu' ),
        toggleMenuBtn     = $( '.toggle-menu' );

      // Responsive Menu Slide
      $(toggleMenuBtn).off( 'click' ).on( 'click', function( e ) {

        // Prevent Default
        e.preventDefault();
        e.stopPropagation();

        // ToggleClass
        $('body').toggleClass( 'mobile-nav-open' );
      } );
    },

    // Media Queries
    mqInit: function() {

      enquire.register( 'screen and ( max-width: 767.99px )' , {

          deferSetup : true,
          setup : function() {

              // Responsive Menu
          rowThm.responsiveMenuInit();

          },
          match : function() {

          // Sliding Panels for Menu
          rowThm.slidePanelInit();

          // Responsive Tables
          $( '.entry-content, .sidebar' ).find( 'table' ).wrap( '<div class="table-responsive"></div>' );

          },
          unmatch : function() {

          // Responsive Tables Undo
          $( '.entry-content, .sidebar' ).find( 'table' ).unwrap( '<div class="table-responsive"></div>' );

          }

      });
    },

    // test browser css properties support
    testCssProp: function(property) {
      return property in document.body.style;
    },

    // css properties to test
    cssSupport: function(){
      var props = ['object-fit'];

      $.each(props, function( index, value ){
        if(! rowThm.testCssProp(value)) $('html').addClass('no-'+value);
      })
    }

  };

  // Document Ready
  $( document ).ready( function() {

    // Menu
    if($('body').hasClass('home'))
      rowThm.homeTopBarInit();

    // Responsive Videos
    rowThm.responsiveVideosInit();

    // Sliding Panels for Menu and Sidebar
    rowThm.slidePanelInit();

    // Media Queries
    rowThm.mqInit();

    // Test css propperties
    rowThm.cssSupport();

  } );

} )( jQuery );
