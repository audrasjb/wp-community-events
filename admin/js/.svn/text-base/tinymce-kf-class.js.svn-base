(function() {
	tinymce.PluginManager.add( 'tinymce_kf_class', function( editor, url ) {
		// Add Button to Visual Editor Toolbar
		editor.addButton('tinymce_kf_class', {
			title: kfTranslations['kf_add_button'],
			id: 'mce-wp-kf',
			stateSelector: 'kf',
			onclick: function() {
				editor.windowManager.open({
					title: kfTranslations['kf_modal_title'],
					body: [
						{
							type: 'listbox',
							name: 'type',
							label: kfTranslations['kf_type_label'],
							tooltip: kfTranslations['kf_type_help'],
							values: [
								{text: kfTranslations['kf_type_number'], value: 'number'}, 
								{text: kfTranslations['kf_type_text'], value: 'text'}, 
							]
						},{
							type: 'textbox',
							name: 'figure',
							label: kfTranslations['kf_figure_label'],
							tooltip: kfTranslations['kf_figure_help'],
							minWidth: 300
						},{
							type: 'textbox',
							multiline: true,
							name: 'text',
							label: kfTranslations['kf_text_label'],
							tooltip: kfTranslations['kf_text_help'],
							minWidth: 300,
							minHeight: 100
						}],
					onsubmit: function( e ) {
						editor.insertContent( 
							'<span data-label="' + kfTranslations['kf_modal_title'] + '" class="keyfigure_bloc keyfigure_bloc_type_' + e.data.type + '"><span class="keyfigure_bloc_figure">' + e.data.figure + '</span><span class="keyfigure_bloc_text">' + e.data.text + '</span></span>' 
						);
					}
				});				
			}
		});		

	});
})();