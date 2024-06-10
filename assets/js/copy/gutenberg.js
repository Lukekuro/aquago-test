wp.domReady( () => {
	wp.blocks.unregisterBlockStyle('core/button', ['outline', 'fill']);

	wp.blocks.registerBlockStyle('core/button', [
		{
			name: 'btn-primary',
			label: 'Domyślny',
			isDefault: true
		},
		{
			name: 'btn-outline',
			label: 'Zarys'
		},
		{
			name: 'btn-white',
			label: 'Biały'
		}
	]);

	wp.blocks.registerBlockStyle('core/list', [
		{
			name: 'default',
			label: 'Domyślny',
			isDefault: true
		},
		{
			name: 'list-check',
			label: 'Lista (sprawdzony)'
		},
		{
			name: 'list-dot',
			label: 'Lista (kropkowany)'
		},
		{
			name: 'list-number',
			label: 'Lista (numeryczna)',
		}
	]);
});
