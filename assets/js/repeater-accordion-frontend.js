( function( $, elementor) {
	$(document).ready(function() {
		if (elementor ) {
			// Get accordion handler
			var accordionHandler = elementor.elementsHandler.getHandlers('accordion.default');
			// Register the handler for custom element
			elementor.hooks.addAction( 'frontend/element_ready/repeater_accordion.default', accordionHandler  );

			/*var repeaterAccordions = jQuery('[data-element_type="repeater_accordion.default"]');
			$(repeaterAccordions).each( function() {
				elementor.hooks.doAction( 'frontend/element_ready/repeater_accordion.default',jQuery(this) );
			} );*/

			var repeaterAccordions;
			if ( elementor.isEditMode() ) {
				// Elements outside from the Preview
				$repeaterAccordions = jQuery( '[data-element_type="repeater_accordion.default"]', '.elementor:not(.elementor-edit-mode)' );
			} else {
				$repeaterAccordions = $( '[data-element_type="repeater_accordion.default"]' );
			}

			$repeaterAccordions.each( function() {
				 elementor.elementsHandler.runReadyTrigger( $( this ) );
			} );

		}
	});
}( jQuery, window.elementorFrontend  ) );